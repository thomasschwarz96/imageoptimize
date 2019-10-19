<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html lang="en">
    <?php $this->view("layout/header"); ?>
    <body>
      <?php $this->view("layout/navigation"); ?>
			<?php $this->view("components/forkme"); ?>

      <div class="container container--main">
        <?php $this->view($contentView); ?>
      </div><!-- .container -->

      <?php $this->view("layout/footer"); ?>
      <?php $this->view("components/loader"); ?>
    </body>
</html>
