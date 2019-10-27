jQuery(document).ready(function ($)
{
    /*
     |--------------------------------------------------------------------------
     | Ajax requests
     |--------------------------------------------------------------------------
     */

    // Upload selected image.
    $(document).on('click', '#upload', function (event)
    {
        event.preventDefault();

        // Create new formData object.
        var formData = new FormData(),
            image = $('input#image')[0].files[0];

        // Append _token and image to formData.
        formData.append('image', image);


        var ajax = new IO_Ajax();
        ajax.path = 'upload';
        ajax.setData(formData);
        ajax.complete(closeAlert);
        ajax.send();
    });


    // Create preview image.
    $(document).on('click', '#preview', function (event)
    {
        event.preventDefault();

        // Create new formData object.
        var formData = new FormData($('form[name=optimize]')[0]);
        var ajax = new IO_Ajax();
        ajax.path = 'optimize';
        ajax.setData(formData);
        ajax.complete(closeAlert);
        ajax.send();

        $('#download').fadeIn(500);
    });


    /*
    |--------------------------------------------------------------------------
    | Helper functions
    |--------------------------------------------------------------------------
    */

    function closeAlert()
    {
        setTimeout(function ()
        {
            $('.alert button.close').click();
        }, 3000);
    }
});