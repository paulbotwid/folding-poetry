<?php ob_start();
require_once("../includes/db.php");
require_once("../includes/functions.php");

$wp_id = $_POST["wp_id"];

// run function
unload_the_poem($wp_id);


function unload_the_poem($wp_id) {
  global $connection;

	$q = "UPDATE working_poems SET in_use = 0 WHERE id='$wp_id'";
	$r = mysqli_query($connection, $q);

  if ($r) {
    echo "Poem unloaded";
  } else {
    echo "fail" . mysqli_error($connection);
  }

}

?>
