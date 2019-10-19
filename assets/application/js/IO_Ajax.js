/**
 * Image Optimize
 *
 * Ajax class for the frontend application.
 *
 * @package	ImageOptimize
 * @author	Thomas Schwarz
 * @copyright	Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @since	Version 0.1.0
 * @filesource
 */
 class IO_Ajax
 {
   /**
    * Class constructor.
    *
    * @param   string    path (optional)    - Path where the ajax call should go
    * @return  void
    */
   constructor(path)
   {
     /**
      * Path for ajax request.
      *
      * @var  string
      */
     this.path = path || '';

     /**
      * Data for ajax request.
      *
      * @var  object
      */
     this.data = {};

     /**
      * Callback function when request is complete.
      *
      * @var  function
      */
     this.callback = undefined;
   }


   /**
    * Callback for succesfull request.
    *
    * @param    object    - Request result
    * @return   void
    * @private
    */
   _success(data)
   {
     // Create base path.
     var basePath = "http://localhost/imageoptimize/uploads/";

     // Parse data.
     var objectData = JSON.parse(data);
     if (!objectData)
     {
       return;
     }

     // Render optimized image
     for (var key in objectData)
     {
       var $domTarget = $('#' + key);
       var imageLink = basePath + objectData[key] + '?ver=' + Date.now();
       $domTarget.attr("data-image",imageLink);
       $domTarget.css({
         backgroundImage: 'url(' + imageLink + ')'
       });
     }

     // Hide loader.
     $.hideIoLoader();
   }


   /**
    * Set callback after request is complete.
    *
    * @param   function    callback    - Callback function
    * @return  void
    */
   complete(callback)
   {
     if (typeof(callback) === "function")
     {
       this.callback = callback;
     }
   }


   /**
    * Set data for request.
    *
    * @param   object    data    - Data for request
    * @return  void
    */
   setData(data)
   {
     this.data = data || {};
   }


   /**
    * Send request.
    *
    * @return  void
    */
   send()
   {
     // Check if path is given.
     if (this.path === '')
     {
       return;
     }

     // Show loader.
     $.showIoLoader();

     // Make request.
     $.ajax({
       url: this.path,
       data: this.data,
       type: 'POST',
       enctype: 'multipart/form-data',
       success: this._success,
       complete: this.callback
     });
   }
}
