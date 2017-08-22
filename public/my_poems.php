<?php ob_start();
require_once("../includes/db.php");
require_once("../includes/functions.php");
?>

<!-- HTML START -->
<?php include "../includes/layout/header.php"; ?>

<?php 
// Check if there are poems
if ( isset($_COOKIE["my_full_poems"]) ) {
	$my_full_poems = get_my_poems();
	$got_poems = true;
} else {
	$got_poems = false;
}

if ($got_poems) { ?>

	<div class="poems" id="my-poems-wrap">
		<?php print_poems_from_array($my_full_poems); ?>
	</div>

<?php } else {
	echo "Sorry you don't have it in you.";
}

 ?>

 <?php include "../includes/layout/footer.php"; ?>
<?php ob_flush(); ?>