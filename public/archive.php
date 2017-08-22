<?php
require_once("../includes/db.php");
require_once("../includes/functions.php");
include ("../includes/layout/header.php"); 
?>

<main>
	<section class="poems">	

		<?php $r = get_full_poems(25); ?>
		<?php include("latest_poems.php") ?>

	</section>
</main>

<?php include("../includes/layout/footer.php"); ?>