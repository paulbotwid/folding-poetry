<?php ob_start();
require_once("../includes/db.php");
require_once("../includes/functions.php");
include("../includes/PHPMailerAutoload.php");
?>

<?php

$wp_id = escape($_GET["wp_id"]); // Get working poem id
$fp_id = $_GET["fp_id"] ?? null; /* Finished poem id */ $fp_id = escape($fp_id);

// Poem finished?
if (isset($_GET["poem_done"])) {
	$poem_done = true;
} else {
	$poem_done = false;
}
?>

 <!-- HTML START -->
<?php include "../includes/layout/header.php"; ?>


<section id="thanks">
<!-- If NO email submitted-->
<?php if ( !isset($_POST["submit_email"]) ) { ?>
		<?php add_poem_to_list($wp_id) ?>
		<?php if ( !$poem_done ) { ?> <!-- If the poem is NOT done -->
		<h2>Thanks &lt;3</h2>
		<div>
			<span>If you want us to let you know when the poem is finished, just type in your email:</span>
			<form id="email-form" method="post" action="contribution.php?wp_id=<?php echo $wp_id; ?>">
				<input id="email-input" required autofocus type="email" name="email"><br>
				<input class="button" id="email_submit" type="submit" name="submit_email" value="Notify me">
			</form>
			<br>
			<a class="nav-link" id="pass-on" href="#">
				Click here to copy a link to pass this poem on to a friend
				<span id="pass_on_link" class="hidden">http://foldingpoetry.com/index.php?wp_id=<?php echo $wp_id; ?></span>
			</a>
		</div>
		<?php } else { // THE POEM IS DONE ?>

				<h2>Omg the poem is done!</h2>
				<?php echo get_single_poem($fp_id); ?>
		<?php } ?>

	<?php } else { ?> <!-- If email HAS BEEN submitted -->
			<p>Awesome.<br>We'll be in touch.</p>
	<?php } ?>

</section>
</section>
<section  id="under" class="under">
		<div class="poems">
			<?php include("latest_poems.php") ?>
		</div>
</section>


<?php include "../includes/layout/footer.php"; ?>
<?php ob_flush(); ?>
