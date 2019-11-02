<form action="<?php echo base_url('optimize'); ?>" name="optimize" method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="col-xs-12 col-sm-6">

            <div class="settings-container">

                <?php $this->view('components/optimizeHelpers/quality'); ?>

                <?php $this->view('components/optimizeHelpers/change-size'); ?>

                <?php $this->view('components/optimizeHelpers/rules'); ?>

                <?php $this->view('components/optimizeHelpers/preview-download'); ?>

            </div><!-- .settings-container -->

        </div><!-- .col-xs-12.col-sm-6 -->

        <div class="ajaxTarget-images col-xs-12 col-sm-6">
            <?php $this->view('components/preview-image'); ?>
        </div>

    </div><!-- .row -->

</form>
