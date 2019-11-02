<div class="col-md-12 col-xl-6">
    <div class="card">
        <div class="card-body">
            <label class="form-check-label" for="encode">
                <h5 class="card-title">Enocde</h5>
            </label>
            <p class="card-text">Encodes the current image in given format.</p>

            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" id="encode" name="encode[active]">
                    </div>
                </div>
                <select id="encodeSelect" class="form-control custom-select" name="encode[format]"  disabled="disabled">
                    <option value="jpg">.jpg</option>
                    <option value="png">.png</option>
                    <option value="gif">.gif</option>
                </select>
            </div>
        </div>
    </div>
</div><!-- .col-6 -->