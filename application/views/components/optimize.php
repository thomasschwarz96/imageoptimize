<form action="<?php echo base_url('optimize'); ?>" name="optimize" method="post" enctype="multipart/form-data">

  <div class="row">
    <div class="col-xs-12 col-sm-6">

      <div class="settings-container">

        <div class="form-group">
          <label for="quality">Quality</label>
          <input type="range" class="form-control-range" id="quality" name="quality" value="80" />
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="changeSize" name="resize[]" />
          <label class="form-check-label" for="changeSize">
            Change image dimensions
          </label>
        </div>

        <div id="changeSizeOptions">
          <div class="form-row">
            <div class="col-5">
              <div class="input-group">
                <input type="text" class="form-control" id="imageWidth"
                       name="resize[]" placeholder="width">
                <div class="input-group-append">
                  <span class="input-group-text">px</span>
                </div>
              </div>
            </div>
            <div class="col-2 text-center">
              <input class="form-check-input" type="checkbox" id="fitToSize" name="resize[]" />
            </div>
            <div class="col-5">
              <div class="input-group">
                <input type="text" class="form-control" id="imageHeight"
                       name="resize[]" placeholder="height" disabled="disabled">
                <div class="input-group-append">
                  <span class="input-group-text">px</span>
                </div>
              </div>
            </div>
          </div>
          <div class="spacer"></div>
        </div><!-- #changeSizeOptions -->

        <hr />
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" id="setFilter" name="setFilter" />
          <label class="form-check-label" for="setFilter">
            Use additional filter
          </label>
        </div>

        <div id="setFilterOptions">
          <div class="form-row">
            <div class="col-6">
              <div class="card">
                <div class="card-body">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="greyscale" name="greyscale" />
                    <label class="form-check-label" for="greyscale">
                      <h5 class="card-title">Greyscale</h5>
                    </label>
                  </div>
                  <p class="card-text">Image gets grayscaled</p>
                </div>
              </div>
            </div><!-- .col-6 -->

            <div class="col-6">
              <div class="card">
                <div class="card-body">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="invert" name="invert" />
                    <label class="form-check-label" for="invert">
                      <h5 class="card-title">Invert</h5>
                    </label>
                  </div>
                  <p class="card-text">Colors get inverted.</p>
                </div>
              </div>
            </div><!-- .col-6 -->

            <div class="spacer" style="height: 10px;"></div>

            <div class="col-6">
              <div class="card">
                <div class="card-body">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="blur" name="blur" />
                    <label class="form-check-label" for="blur">
                      <h5 class="card-title">Blur</h5>
                    </label>
                  </div>
                  <p class="card-text">Add blur effect to image.</p>
                </div>
              </div>
            </div><!-- .col-6 -->

            <div class="col-6">
              <div class="card">
                <div class="card-body">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="gamma" name="gamma" />
                    <label class="form-check-label" for="gamma">
                      <h5 class="card-title">Gamma</h5>
                    </label>
                  </div>
                  <p class="card-text">Add gamma correction to image.</p>
                </div>
              </div>
            </div><!-- .col-6 -->
          </div>
          <div class="spacer"></div>
        </div><!-- #setFilterOptions -->
        <hr />
        <div class="form-group">
          <a href="#" id="preview" class="btn btn-primary" target="_blank">Preview</a>
          <a href="#" id="download" class="btn btn-success" target="_blank" download>Download</a>
        </div>

      </div><!-- .settings-container -->

    </div><!-- .col-xs-12.col-sm-6 -->

    <div class="col-xs-12 col-sm-6">
      <?php $this->view('components/preview-image'); ?>
    </div>

  </div><!-- .row -->

</form>
