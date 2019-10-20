jQuery(document).ready(function($) {

  /*
  |--------------------------------------------------------------------------
  | General UI control
  |--------------------------------------------------------------------------
  */
  // Show size options.
  $('#changeSize').click(function() {
    $('#changeSizeOptions').toggle();
  });


  // Show filter options.
  $('#setFilter').click(function() {
    $('#setFilterOptions').toggle();
  });


  // Enable 'height' input field.
  $('#fitToSize').click(function() {
    var $inputImageHeight = $('#imageHeight');
    if (this.checked) {
        $inputImageHeight.prop('disabled', false);
    } else {
        $inputImageHeight.prop('disabled', true);
    }
  });


  // Open uploaded, optimized image in new tab.
  $(document).on('click', '#uploadedImage, #optimizedImage', function() {
    var imageLink = $(this).attr('data-image');
    window.open(imageLink, '_blank');
  });


  /*
  |--------------------------------------------------------------------------
  | Ajax requests
  |--------------------------------------------------------------------------
  */
  // Create preview image.
  $('#preview').click(function(event) {
    event.preventDefault();

    var formData = $('form[name=optimize]').serialize();
    var ajax = new IO_Ajax();
    ajax.path = 'optimize';
    ajax.setData(formData);
    ajax.complete(function() {
      setTimeout(function(){
        $('.alert button.close').click();
      }, 3000);
    });
    ajax.send();
  });

});
