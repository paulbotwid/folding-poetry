<?php ob_start();
require_once("../includes/db.php");
require_once("../includes/functions.php");
include("../includes/PHPMailerAutoload.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 ?>

 <?php

// set returning
setcookie("returning", "1", time() + (12 * 365 * 24 * 60 * 60), "/");

// Get submitted data
$wp_id = escape($_GET["wp_id"]);
$old_line_count = escape($_GET["rc"]);
$new_poem = (int)escape($_GET["np"]);

// Color set
if ( isset($_POST["color"]) ) {
	if (!empty($_POST["color"])) {
		$poem_color = escape($_POST["color"]);
	} else {
		$poem_color = $colors[rand(0,6)];
	}
} else {
	$poem_color = $colors[rand(0,6)];
}


// Insert contribution into working poem
$result = insert_contribution($wp_id, $old_line_count, $new_poem, $poem_color);

// If the poem is finished, create it
$cp_result = create_poem($wp_id, $poem_color);
$fp_id = $cp_result["fp_id"]; // Get full poem id of created poem

echo "<br> The fp_id is: " . $fp_id . "<br>";

print_r($cp_result);

// For seding in URL
$wp_id = urlencode($wp_id);
$fp_id = urlencode($fp_id);

if ($result && $cp_result["created"] === 1) { // If created new full poem
	send_email($wp_id, $fp_id);
	redirect("../public/single_poem.php?fp_id=$fp_id");
}
elseif ($result && $cp_result) { // if succesfull contribution
	redirect("../public/contribution.php?wp_id=$wp_id&success=1");
} else {
	redirect("../public/contribution.php?fail=1"); // fail 
}
ob_flush();
?>
<br>
 <a href="../public/index.php">
 	 home
 </a>
