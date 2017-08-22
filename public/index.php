<!-- HTML START -->
<?php include "../includes/layout/header.php"; ?>
<?php
// Clear wp cookie
// setcookie("my_working_poems", "", time()+4000, "/"); // UNSET THE COOKIE!!

// get my full poems from cookie
if ( isset($_COOKIE["my_full_poems"]) ) {
	$my_full_poems = json_decode($_COOKIE["my_full_poems"], true);
} else {
	$my_full_poems = "No full poems yet!";
}

$timer = 6; // Minutes - timer value
$selected_poem = select_wp(); // SELECT WORKING POEM
$passed_on;

// Set all the variables
$lastLine2 = $selected_poem["last_line"]; // GET LAST LINE
$curr_line_count = $selected_poem["curr_line_count"]; // GET CURRENT LINE COUNT
$target_line_count = $selected_poem["target_line_count"]; // GET TARGET LINE COUNT
$wp_id = $selected_poem["id"]; // GET ID
// check if the selected poem was passed on
$passed_on = isset($_GET["wp_id"]) ? ($_GET["wp_id"] == $wp_id ? true : false) : false;

if ( $curr_line_count == 0 ) { $new_poem = 1; } else { $new_poem = 0; } // New poem
if ( $curr_line_count == ($target_line_count-1) ) { $last_contribution = true; } else { $last_contribution = false; } // New poem
if ($last_contribution) {
	$line2_max = 40;
	$line2_width = "100%";
} else {
	$line2_max = 15;
	$line2_width ="50%";
}
$state = $new_poem === 1 ? 1 : $last_contribution ? 3 : 2;
// Color
$poem_color = $colors[rand(0,11)]; // set poem color
$welcome_messages = get_welcome_messages($state);

?>
<?php if (!isset($_COOKIE["my_working_poems"])) { ?>
	<div id="welcome-wrap">
		<div id="welcome-content">
			<h1>Hey 👋 welcome to Folding Poetry!</h1>
			<span class="subtitle">The poetry site for non-poets*</span><br><br>
			<div id="welcome-steps">
				<p><span class="welcome-step-number">1</span>
					<?php echo $welcome_messages[0]; ?>
				</p>
				<p><span class="welcome-step-number">2</span>
					<?php echo $welcome_messages[1]; ?>
				<p><span class="welcome-step-number">3</span>
					<?php echo $welcome_messages[2]; ?>
			</div><br>
			<button class="welcome-close" onclick="$('#welcome-wrap').slideUp();">Let's go</button>
			<!-- <a href="#first-page" class="nav-link help-me">I don't get it 😕</a> -->
		</div>
		<span id="welcome-footnote">*(poets also welcome)</span>
		<a href="#" onclick="$('#welcome-wrap').slideUp();" class="welcome-close"><div id="close-cross"></div></a>
	</div>
<?php } ?>
	<!-- Timeout message -->
	<section id="first-page" class="<?php if($new_poem){echo "new-poem";};?>">
		<?php
		if ( !empty($wp_id) ) {
			include("poem_input_form.php");
		} else {
			include("no_more.php");
		}
		?>
	</section>
</section>
<!-- TOp page end -->
<section id="under" class="under">
		<div class="poems">
			<?php $r = get_full_poems(10); ?>
			<?php include("latest_poems.php"); ?>
		</div>
</section>
<span id="wp_id" class="hidden"><?php echo $wp_id; ?></span>

<div id="fixed-info">
	<?php echo "Current line count: " . $curr_line_count . "<br>"; ?>
	<?php echo "Target line count: " . $target_line_count . "<br>"; ?>
	<?php echo "Poem id: " . $wp_id . "<br>"; ?>
	<?php echo $poem_color . "<br>"; ?>
	<?php print_r($my_full_poems); ?>
</div>

<?php include "../includes/layout/footer.php"; ?>
<?php ob_flush(); ?>
