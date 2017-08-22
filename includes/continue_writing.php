<?php ob_start();
require_once("../includes/db.php");
require_once("../includes/functions.php");

$wp_id = $_POST["wp_id"];

// run function
update_time($wp_id);


function update_time($wp_id) {
  global $connection;

	$q = "UPDATE working_poems SET last_update=now() WHERE id='$wp_id'";
	$r = mysqli_query($connection, $q);

  if ($r) {
    echo "succedful result";
  } else {
    echo "fail" . mysqli_error($connection);
  }

}

?>
