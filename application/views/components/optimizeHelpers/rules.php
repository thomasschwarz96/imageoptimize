<hr/>
<div class="form-check option-group--opener">
    <input class="form-check-input" type="checkbox" value="1" id="setFilter" name="setFilter"/>
    <label class="form-check-label" for="setFilter">
        Use additional filter
    </label>
</div>

<div id="setFilterOptions" class="option-group--wrapper">
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