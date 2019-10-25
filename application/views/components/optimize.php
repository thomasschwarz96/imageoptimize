<form action="<?php echo base_url('optimize'); ?>" name="optimize" method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="col-xs-12 col-sm-6">

            <div class="settings-container">

                <?php $this->view('components/optimizeHelpers/quality'); ?>

                <?php $this->view('components/optimizeHelpers/change-size'); ?>

                <hr/>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="setFilter" name="setFilter"/>
                    <label class="form-check-label" for="setFilter">
                        Use additional filter
                    </label>
                </div>

                <div id="setFilterOptions">
                    <div class="form-row">
                        <?php
                        // Get optimize rules.
                        $rules = scandir(OPTIMIZE_RULES_PATH);
                        foreach ($rules as $rule)
                        {
                            $filePath = OPTIMIZE_RULES_PATH . $rule;
                            if (is_file($filePath))
                            {
                                $viewName = pathinfo($rule, PATHINFO_FILENAME);
                                $this->view('optimizeRules/' . $viewName);
                            }
                        }
                        ?>
                    </div>
                    <div class="spacer"></div>
                </div><!-- #setFilterOptions -->

                <?php $this->view('components/optimizeHelpers/preview-download'); ?>

            </div><!-- .settings-container -->

        </div><!-- .col-xs-12.col-sm-6 -->

        <div class="ajaxTarget-images col-xs-12 col-sm-6">
            <?php $this->view('components/preview-image'); ?>
        </div>

    </div><!-- .row -->

</form>
