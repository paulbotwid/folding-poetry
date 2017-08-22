 <?php

//Escape a string
function escape($string) {
	global $connection;

	$escaped_string = mysqli_real_escape_string($connection, $string);
	return $escaped_string;
}

// Redirect
function redirect($page) {
	header("Location: $page");
	exit;
}

// Clear old In Use poems
function clear_in_use() {
	global $connection;
	global $timer;

	$curr_time = time();

	$q =  "UPDATE working_poems SET in_use=0 ";
	$q .= "WHERE in_use=1 AND UNIX_TIMESTAMP(last_update)<$curr_time-(60*$timer)";
	$r = mysqli_query($connection, $q);
  // if ($r) {
	// 	echo "succedful result";
	// } else {
	// 	echo "fail" . mysqli_error($connection);
	// }
}

// Insert submission to working poem
function insert_contribution($wp_id, $old_line_count, $new_poem, $poem_color) {
	global $connection;

	// convert the old row count to int
	$new_line_count = (int)$old_line_count + 1;

	// Check if anything is in POST
	if ( isset($_POST["submit"]) ) {
		// Set vars from POST
		$line1 = escape($_POST["line1"]); $line1 = trim($line1);
		$line2 = escape($_POST["line2"]); $line2 = trim($line2);
		$location = escape($_POST["location"]);

		if ( $new_poem === 1 && isset($_POST["length"]) ) {
			$length = escape($_POST["length"]);
		} elseif ($new_poem === 1 || (int)target_line_count($wp_id) === 0) {
			// Set interval for poem line count
			$length = rand(3, 7);
		} else {
			$length = target_line_count($wp_id);
		}

		$working_poem_contribution  = "<span class=\"poem-line\" data-color=\"$poem_color\" data-location=\"$location\">"
									  . "%l1s%" . $line1 . "%l1e%" . "%l2s%" . $line2 . "%l2e%" ."</span>";
		echo "working poem contribution: " . $working_poem_contribution . "<br>";

		// Insert into DB
		$query  = "UPDATE working_poems SET ";
		$query .= "working_poem = CONCAT(working_poem, '$working_poem_contribution'), ";
		$query .= "last_line = '$line2', curr_line_count='$new_line_count', ";
		$query .= "target_line_count='$length', color='$poem_color' ";
		$query .= "WHERE id='$wp_id' ";

		$result = mysqli_query($connection, $query);

		return $result;

	} else {
		$line2 = null;
		$line1 = null;
	}

	$contributed_lines = [$line1, $line2];

}

function format_poem($wp_id) {
	global $connection;

	$q = "SELECT working_poem FROM working_poems WHERE id='$wp_id'";
	$r = query($q);

	$raw_poem = mysqli_fetch_assoc($r)["working_poem"];
	echo "<br> the raw poem is: <br>" . $raw_poem;

	$formatted_poem = str_replace("%l1s%,", ", ", $raw_poem);
	$formatted_poem = str_replace("%l1s%", " ", $formatted_poem);
	$formatted_poem = str_replace(".%l1e%", "<br><br>", $formatted_poem);
	$formatted_poem = str_replace(".%l2e%", "<br><br>", $formatted_poem);
	$formatted_poem = str_replace("%l1e%", "<br>", $formatted_poem);
	$formatted_poem = str_replace("%l2e%", "", $formatted_poem);
	$formatted_poem = str_replace("%l2s%", "", $formatted_poem);
	$formatted_poem = escape($formatted_poem);

	echo "<br> the formatted poem is: <br>" . $formatted_poem;

	return $formatted_poem;
}
// SEND emails to participants
function send_email($wp_id, $fp_id) {
	global $connection;

	$q = "SELECT email FROM emails WHERE poem_id='$wp_id'";
	$r = mysqli_query($connection, $q);

	$mail = new PHPMailer;

	//Enable SMTP debugging.
	$mail->SMTPDebug = 0;
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();
	//Set SMTP host name
	$mail->Host = "send.one.com";
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = "ssl";
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;
	//Provide username and password
	$mail->Username = "paul@makesmefeel.com";
	$mail->Password = "Wmmf2m?";
	//Set TCP port to connect to
	$mail->Port = 465;

	$mail->From = "paul@makesmefeel.com";
	$mail->FromName = "Folding Poetry";



	//$mail->addAddress("pbotwid@gmail.com", "John Doe");

	$mail->isHTML(true);

	$mail->Subject = "Your poetry is done!";
	$mail->Body = "
	<html>
	<body>
		<h2>Hey,</h2> the poem that you contributed to is finished!<br> Read it <a href=\"http://www.foldingpoetry.com/single_poem.php?fp_id=$fp_id\">here!</a>
	</body>
	</html>
	";
	$mail->AltBody = "This is the plain text version of the email content";

	while ( $email = mysqli_fetch_assoc($r) ) {
		$mail->ClearAddresses();
		$mail->addAddress($email["email"], "Your name");
		if(!$mail->send()) {
			    echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			    echo "Message has been sent successfully";
			}
	}
	// Delete email adresses
	$q = "DELETE FROM emails WHERE poem_id='$wp_id'";
	$r = query($q);

}
// Find working poem with highest number of current line
// and return he last line
function select_wp() {
	global $connection;

	// Clear Old In use
	clear_in_use();

	// If user is returning, check for used poems
	if (isset($_COOKIE["my_working_poems"])) {
		$my_working_poems = json_decode($_COOKIE["my_working_poems"], true);
		$my_working_poems = implode(",", $my_working_poems);
		//echo "Imploded cookie before poem is selected: "; print_r($my_working_poems); echo "<br>";
	} else {
		$my_working_poems = "";
	}

	$q = "SELECT * FROM working_poems WHERE ";
	// If there user has contributed before
  if ( isset($_GET["wp_id"]) ) {
    $passed_on_id = $_GET["wp_id"];
    $q .= "id = $passed_on_id AND ";
  }
  if ( !empty($my_working_poems) ) {
		$q .= "id NOT IN ($my_working_poems) AND ";
	}
	$q .= "in_use=0 ORDER BY curr_line_count DESC LIMIT 1";
	$r = mysqli_query($connection, $q);
  if ( mysqli_num_rows($r)>0 ) { // if there was a single GET result
    $selected_wp = mysqli_fetch_assoc($r); // get array
  } else { // get normal last poem
    $q = "SELECT * FROM working_poems WHERE in_use=0 ORDER BY curr_line_count DESC LIMIT 1";
    $r = mysqli_query($connection, $q);
    $selected_wp = mysqli_fetch_assoc($r); // get array
  }
  $wp_id = $selected_wp["id"]; // get id
  in_use($wp_id);//SET the poem to IN USE
  return $selected_wp;
}

// SET poem to "in use"
function in_use($wp_id) {
	global $connection;

	$q = "UPDATE working_poems SET in_use = 1 WHERE id=$wp_id";
	$r = mysqli_query($connection, $q);
}

// Insert email adress
function insert_email($wp_id) {
	global $connection;

	$email_adress = escape($_POST["email"]);
	$q = "INSERT INTO emails (email, poem_id) VALUES ('$email_adress', '$wp_id')";
	$r = mysqli_query($connection, $q);

	return $r;
}
// SET poem to "NOT in use"
function not_in_use($wp_id) {
	global $connection;

	$q = "UPDATE working_poems SET in_use = 0 WHERE id=$wp_id";
	$r = mysqli_query($connection, $q);
}
// Check if poem is ended and create full poem entry
// Clear the working poem
function create_poem($wp_id, $poem_color) {
	global $connection;
	global $colors;
  global $font_style;
  global $font_family;
  global $font_case;
  global $font_weights;

  // put all styles in variable
	$styles =       "text-transform: " . $font_case[rand(0,3)] . ";" .
									"font-style: " . $font_style[rand(0,2)] . ";" .
                  "color: " . $poem_color . ";" .
                  "font-weight: " . $font_weights[rand(0,4)] . ";" .
                  "font-family: " . $font_family[rand(0,4)] . ";";

	// set poem bg color
	$bg_color = $colors[rand(0,11)];
	while($bg_color === $poem_color && !$ugly) {
		$bg_color = $colors[rand(0,11)];
    if ($bg_color === "#0043EF" && $poem_color === "#FF2F67") {
      $ugly = true;
    } else { $ugly = false; }
	}

	$curr_line_count = curr_line_count($wp_id);
	$target_line_count = target_line_count($wp_id);
	$formatted_poem = format_poem($wp_id); // format the poem

	if ( $curr_line_count >= $target_line_count ) {

		// Insert new full poem
		$q = "INSERT INTO poems (poem, line_count, bg_color, styles) VALUES ('$formatted_poem', '$target_line_count', '$bg_color', '$styles')";
		$r = mysqli_query($connection, $q);

		echo "<br>The query to insert the fp was: " . $q . "<br>";
		echo "and the result: ";
		if ($r) {
			echo "succedful result";
		} else {
			echo "fail" . mysqli_error($connection);
		}

		// Delete working poem from working-poem table
		$q = "DELETE FROM working_poems WHERE id='$wp_id'";
		$r = mysqli_query($connection, $q);

		// GET full poem id
		$q = "SELECT id FROM poems ORDER BY id DESC LIMIT 1";
		$r = mysqli_query($connection, $q);
		$fp_id = mysqli_fetch_assoc($r)["id"];

		// and create new working wp
		$q = "INSERT INTO working_poems (curr_line_count) VALUES (0)";
		$r = mysqli_query($connection, $q);

		if ($r) {
			$return = array("created"=>1, "success"=>1, "fp_id"=>$fp_id);
		}

	} else if ($curr_line_count < $target_line_count) {
		$return = array("created"=>0, "success"=>1, "fp_id"=>"");
		not_in_use($wp_id); // Set poem to "not in use"
	}

	// add poem to user poems
	if ( !empty($fp_id) ) {
		add_to_my_poems($fp_id);
	}


	return $return;
}

// Get the last line2 from current poem
function last_line_2($curr_working_poem_id) {
	global $connection;

	$query = "SELECT last_line FROM working_poems WHERE id = '$curr_working_poem_id' LIMIT 1";
	$result = mysqli_fetch_assoc( mysqli_query($connection, $query) );
	$lastLine2 = $result["last_line"];
	return $lastLine2;
}

// Get all full poems
function get_full_poems($amount) {
	global $connection;

	$q = "SELECT * FROM poems ORDER BY id DESC LIMIT $amount";
	$r = mysqli_query($connection, $q);
	return $r;
}

function get_single_poem($fp_id) {
	global $connection;

	$q = "SELECT * FROM poems WHERE id='$fp_id'";
	$r = query($q);

	$single_poem_array = mysqli_fetch_assoc($r);
	$styles = $single_poem_array['styles'];
  $bg_color = $single_poem_array['bg_color'];
	$poem = $single_poem_array["poem"];

	$output = "<div class='single-poem-wrap' style='background: " . $bg_color .";'>";
	$output .= "<span style='" . $styles . "' id='poem' class='single-poem'>" . $poem . "</span></div>";

	return $output;
}
// Get working-poem finished line count
function target_line_count($curr_working_poem_id) {
	global $connection;

	$q = "SELECT target_line_count FROM working_poems WHERE id = '$curr_working_poem_id' LIMIT 1";
	$r = mysqli_query($connection, $q);
	$line_count = mysqli_fetch_assoc($r)["target_line_count"];
	if ( !empty($line_count) ) {
		return $line_count;
	} else {
		return "Not set";
	}
}

// Get current row count from poem
function curr_line_count($curr_working_poem_id) {
	global $connection;

	$q = "SELECT curr_line_count FROM working_poems WHERE id = '$curr_working_poem_id' LIMIT 1";
	$r = mysqli_query($connection, $q);
	$rows = mysqli_fetch_row($r)[0];
	return $rows;
}

// Check for cookie and add working poem to list
function add_poem_to_list($wp_id) {
  // Get the current line count
  // $line_count = curr_line_count($wp_id);

	// CHECK for earlier poems otherwise create array for poems
	if ( isset($_COOKIE["my_working_poems"]) ) {
		//echo "cookie before update: ";
		$my_working_poems = json_decode($_COOKIE["my_working_poems"], true);
	} else {
		$my_working_poems = array();
	}
	// Ad current if to my poems var
	$my_working_poems[] = $wp_id;

	// Remember which working poems this user has added to
	setcookie("my_working_poems", json_encode($my_working_poems), time()+(60*60*36), "/");
}

// Check for user poems and add FP to list
function add_to_my_poems($fp_id) {
	// CHECK for earlier poems otherwise create array for user poems
	if ( isset($_COOKIE["my_full_poems"]) ) {
		$my_full_poems = json_decode($_COOKIE["my_full_poems"], true);
	} else {
		$my_full_poems = array();
	}
	// Add to list of full poems
	$my_full_poems[] = $fp_id;

	// remember the finished poems
	setcookie("my_full_poems", json_encode($my_full_poems), time()+(60*60*36), "/");
}

function get_my_poems() {
	global $connection;

	$my_full_poems = json_decode($_COOKIE["my_full_poems"], true);
	$my_full_poems = implode(",", $my_full_poems);

	$q = "SELECT * FROM poems WHERE id IN ($my_full_poems)";
	$r = query($q);

	return $r;
}

function print_poems_from_array($poem_array) {
	while ( $poem = mysqli_fetch_assoc($poem_array) ) { ?>
		<div class="poem-wrap">
		<a  class="poem-link" href="single_poem.php?fp_id=<?php echo $poem["id"]; ?>">
			<span id="poem" style="color: <?php echo $poem["color"]; ?>;"><?php echo $poem["poem"]; ?> </span>
		</a>
	</div>
	<?php }
}

// mysqli query
function query($q) {
	global $connection;
	$r = mysqli_query($connection, $q);
	return $r;
}

$random100 = rand(1, 100);
$colors = ["#0043ef", "#ffe700", "#202020", "#202020",
 						"#D800FF", "#ff2f67", "#f9f9f9", "#0bffbd",
						"#f9f9f9", "#6bdf0d", "#ff8816", "#202020"];
// extra styles
$font_case = ["uppercase", "default", "default", "lowercase"];
$font_weights = [100, 400, 300, 500, 800];
$font_family = ["Anton", "Questrial", "Rakkas", "Shrikhand", "Yeseva One", "Josefin Slab", "Abril Fatface", "Audiowide"];
$font_style = ["italic", "normal", "normal"];

$input_colors = ["#0043ef", "#ff21c9", "#ffc811", "#ff2f67",
                "#20f3d2", "#6bdf0d"];

//temp. input styles
$input_color =  $input_colors[rand(0,5)];
$input_weight =  $font_weights[rand(0,4)];
$input_style =  $font_style[rand(0,2)];
$input_family =  $font_family[rand(0,7)];
$bg_color = $colors[rand(0,11)];
while($bg_color == $input_color) {
  $bg_color = $colors[rand(0,11)];
}

function get_welcome_messages($state) {
	$messages = array();
	switch ($state) {
		case 1:
			$messages = array(
				"You're lucky ✨, you get to start a new poem. Think about what you want to say to the world. Or actually, don't think, just write whatever comes to mind.",
				"When you're done thinking, write a line in <a href='#' data-highlight='line1' class='welcome-link'>the first field</a>.",
				"Finish with a few words in <a href='#' data-highlight='line2' class='welcome-link'>the second field</a>"
				);
			break;
		case 2:
			$messages = array(
				"Read the <a href='#' data-highlight='last-line-2' class='welcome-link'>the last line</a>, ponder its meaning.",
				"Continue the line in <a href='#' data-highlight='line1' class='welcome-link'>the first field</a>. Don't overthink it!",
				"Finish with a few words in <a href='#' data-highlight='line2' class='welcome-link'>the second field</a>"
				);
			break;
		case 3:
			$messages = array(
				"Read the <a href='#' data-highlight='last-line-2' class='welcome-link'>the last line</a>, ponder its meaning.",
				"Continue the line in <a href='#' data-highlight='line1' class='welcome-link'>the first field</a>. Don't overthink it!",
				"Finish this whole poem in <a href='#' data-highlight='line2' class='welcome-link'>the second field</a>."
				);
			break;

	}
	return $messages;
}
 ?>

