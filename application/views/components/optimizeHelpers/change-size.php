<div class="form-check">
    <input class="form-check-input" type="checkbox" id="changeSize" name="resize[active]"/>
    <label class="form-check-label" for="changeSize">
        Change image dimensions
    </label>
</div>

<div id="changeSizeOptions">
    <div class="form-row">
        <div class="col-5">
            <div class="input-group">
                <input type="text" class="form-control" id="imageWidth"
                       name="resize[width]" placeholder="width">
                <div class="input-group-append">
                    <span class="input-group-text">px</span>
                </div>
            </div>
        </div>
        <div class="col-2 text-center fit-size-container">
            <span id="fitToSizeIcon" class="fas fa-link"></span>
            <input class="form-check-input" type="checkbox" id="fitToSize" name="resize[keepRatio]"/>
        </div>
        <div class="col-5">
            <div class="input-group">
                <input type="text" class="form-control" id="imageHeight"
                       name="resize[height]" placeholder="height" disabled="disabled">
                <div class="input-group-append">
                    <span class="input-group-text">px</span>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
</div><!-- #changeSizeOptions -->