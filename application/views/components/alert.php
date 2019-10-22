<?php
// Create alert class.
$alertClass = 'alert-success';
if (isset($alertStyle))
{
    $alertClass = 'alert-' . $alertStyle;
}
?>

<div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
  <span class="alert-text"><?php
      if (isset($alertText))
      {
          echo $alertText;
      }
  ?></span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
