<!-- HTML START -->
<?php include "../includes/layout/header.php"; ?>
<section class="standard-page">
  <div class="text-box">
    <h2>about</h2>
    <p>
      Folding poetry is a website dedicated to blindfolded collective creation.<br><br>
      The concept itself comes from <a href="https://en.wikipedia.org/wiki/Exquisite_corpse" target="_blank">an old parlour game</a>
      called exquisite corpse. To play, each participant writes a word or phrase on a piece of paper,
      then fold it so that the next player can not see what they have written.
      It was invented by surrealists artists in the 1920s,
      and one of the phrases that came out of it was “Le cadavre exquis boira le vin nouveau”
      (The exquisite corpse will drink the new wine),
      which was the phrase after which the game was named.
      <br><br>
      This website is really just an attempt at seeing what happens when this sort of random creation happens on a bigger scale.
      <br><br>
      ——
      <br><br>
      <span id="about-footer">
        This site is still a work in progress, as you might have noticed.
        Want to contribute? Please
        <a id="my-email" data-name="hello" data-domain="foldingpoetry" data-tld="com" href="#" class="cryptedmail" onclick="window.location.href = 'mailto:' + this.dataset.name + '@' + this.dataset.domain + '.' + this.dataset.tld">
          write!
        </a>
      </span>
    </p>
  </div>
</section>

<?php include "../includes/layout/footer.php"; ?>
<?php ob_flush(); ?>
