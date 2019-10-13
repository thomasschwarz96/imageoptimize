<form action="<?php echo base_url('upload'); ?>" name="optimize" method="post" enctype="multipart/form-data">

  <div class="row">
    <div class="col-xs-12 col-sm-6">
      <div class="upload-container">

        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control-file" id="image" name="image" value="" />
        </div>
        <input type="submit" value="Upload" />

      </div><!-- .upload-container -->
    </div>

    <div class="col-xs-12 col-sm-6">
      <?php $this->view('components/preview-image'); ?>
    </div>

  </div><!-- .row -->

</form>
