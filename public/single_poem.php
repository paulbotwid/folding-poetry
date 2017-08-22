<?php ob_start();
require_once("../includes/db.php");
require_once("../includes/functions.php");
include("../includes/PHPMailerAutoload.php");
 ?>


<!-- HTML  -->
<?php include "../includes/layout/header.php"; ?>


<?php

$fp_id = $_GET["fp_id"] ?? null; // Get full poem id from url
$fp_id = escape($fp_id); // Escape Url value
?>
  <?php
  echo get_single_poem($fp_id); // output single poem with wraps and styles
  ?>
</section>
<!-- TOp page end -->

<section id="under" class="under">
	<div class="poems">
		<?php include("latest_poems.php") ?>
	</div>
</section>

<?php include "../includes/layout/footer.php"; ?>
<?php ob_flush(); ?>
