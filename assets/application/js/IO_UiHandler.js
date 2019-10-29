jQuery(document).ready(function ($)
{

    /*
    |--------------------------------------------------------------------------
    | General UI control
    |--------------------------------------------------------------------------
    */
    // Show size options.
    $(document).on('click', '#changeSize', function ()
    {
        $('#changeSizeOptions').toggle();
    });

    // Fit to size click
    $(document).on('click',  '#fitToSize', function()
    {
        $('#fitToSizeIcon').toggleClass('active fa-unlink');
    });


    // Show filter options.
    $(document).on('click', '#setFilter', function ()
    {
        $('#setFilterOptions').toggle();
    });


    // Enable 'height' input field.
    $(document).on('click', '#fitToSize', function ()
    {
        var $inputImageHeight = $('#imageHeight');
        if (this.checked)
        {
            $inputImageHeight.prop('disabled', false);
        }
        else
        {
            $inputImageHeight.prop('disabled', true);
        }
    });


    // Enable input of group if checkbox was clicked
    $(document).on('click', '.input-group input[type=checkbox]', function()
    {
        var $parent = $(this).closest('.input-group');
        var $input = $parent.find('input[type=text]');
        $input.prop('disabled', function(i, v) { return !v; });
    });


    // Open uploaded, optimized image in new tab.
    $(document).on('click', '#uploadedImage, #optimizedImage', function ()
    {
        var imageLink = $(this).attr('data-image');
        window.open(imageLink, '_blank');
    });

});
