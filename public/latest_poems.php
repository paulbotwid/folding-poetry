<?php
// Print poems
$r = get_full_poems("15");
while ( $row = mysqli_fetch_assoc($r) ) { ?>
	<div class="poem-wrap section fp-auto-height" style="background-color: <?php echo $row["bg_color"]; ?>;">
		<a  class="poem-link" href="single_poem.php?fp_id=<?php echo $row["id"]; ?>">
			<span class="poem" style="<?php echo $row["styles"]; ?>;"><?php echo $row["poem"]; ?> </span>
		</a>
	</div>
<?php } ?>
