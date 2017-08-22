<?php
// new poem attributes
if ($new_poem) {
	$auto_c = "on";
	$np_maxlength = 40;
} else {
	$auto_c = "off";
	$np_maxlength = 32;
}
?>
<!-- BEFORE THE INPUTS -->
<?php
if ($new_poem) {
	$message = "Start a new poem";
	$class="starting";
} else {
	 if ( $last_contribution ) {
			$message = "Finish this poem";
			$class = "finishing";
		} else {
			$message = "Continue this poem";
			$class="continue";
		}
}
if ($passed_on) {
	$message .= ", and make your friend proud";
}
?>
<section id="poemInputs" class="<?php echo $class; ?>" style="color: <?php echo $input_color; ?>;">
	<span id='new-poem' onclick="unload_the_poem()" class="" style="color: <?php echo $input_color; ?>;" class='lines-select-title fine-hand night-text'><?php echo $message; ?></span>
	<form id="poem-form" method="post" action="parse_input.php?wp_id=<?php echo urlencode($wp_id); ?>&rc=<?php echo urlencode($curr_line_count); ?>&np=<?php echo urlencode($new_poem); ?>" onsubmit="return validatePoem();">
			<div id="poem-input-wrap" class="day-text">
					<?php if (!$new_poem) { ?>
					<span id="last-line-2" class="last-line-2  highlight-field"
					style="color: <?php echo $input_color; ?>;
								font-family: <?php echo $input_family; ?>; font-weight: <?php echo $input_weight; ?>;
								font-style: <?php echo $input_style; ?>;">
						<?php echo $lastLine2; ?>
					</span>
					<span id="hidden-last-line" class="hidden"><?php echo $lastLine2; ?></span>
					<?php }; ?>

				<!-- INPUTS START -->
				<input id="line1" autocapitalize="<?php echo $auto_c; ?>" class="poemInput highlight-field" value="" name="line1" type="text" maxlength="<?php echo $np_maxlength; ?>"
				style="color: <?php echo $input_color; ?>;
							font-family: <?php echo $input_family; ?>; font-weight: <?php echo $input_weight; ?>;
							font-style: <?php echo $input_style; ?>;"
				autofocus autocomplete="off">
				<!-- Help line 1 -->
				<p class="help-line" id="help-1" data-title="line1"></p>
				<br>
				<input id="line2" class="poemInput highlight-field" name="line2" type="text" maxlength="<?php echo $line2_max; ?>"
				style="max-width: <?php echo $line2_width; ?>; color: <?php echo $input_color; ?>;
							font-family: <?php echo $input_family; ?>; font-weight: <?php echo $input_weight; ?>;
							font-style: <?php echo $input_style; ?>;"
				autocomplete="off">
				<!-- Help line 2 -->
				<p class="help-line" id="help-2" data-title="line2"></p>

				<!-- Length SELECTOR -->
				<?php if ( $new_poem === 1 && $random100 < 40 ) { ?>
					<span>
						<select name="length" id="lines-select">
							<?php for ($i=3; $i <= 15; $i++) : ?>
								<option value="<?php echo $i; ?>"><?php echo $i ?></option>
							<?php endfor; ?>
						</select>
						<span class="lines-select-title fine-hand day-text">lines long</span>
					</span>
				<?php } ?>
			</div>

			<!-- SUBMIT BUTTON -->
			<input id="submit-btn" type="submit" value="SUBMIT" name="submit" style="color: <?php echo $input_color; ?>">
			<!-- Hidden color select -->
			<input id="color_input" type="hidden" name="color" value="">
			<!-- hidden location select -->
			<input id="location" type="hidden" name="location" value="">
		</form>
		<div id="help-wrap">
			<a href="#first-page" class="nav-link help-me">what do I do?</a>
		</div>
</section>
