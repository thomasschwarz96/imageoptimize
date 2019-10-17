jQuery(document).ready(function($) {

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
  $('#uploadedImage, #optimizedImage').click(function() {
    var imageLink = $(this).attr('data-image');
    window.open(imageLink, '_blank');
  });

});
