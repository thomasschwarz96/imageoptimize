/**
 * Image Optimize
 *
 * Alert singelton for the frontend application.
 *
 * @package	ImageOptimize
 * @author	Thomas Schwarz
 * @copyright	Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @since	Version 0.1.0
 * @filesource
 */
 class IO_Alert
 {
   /**
    * Class constructor.
    *
    * @return  void
    */
   constructor()
   {
     // Check if we have to create a new instance.
     if(!IO_Alert.instance)
     {
       /**
        * DOM selector.
        *
        * @var  jQuery
        */
       this.$alert = $('.alert');


       /**
        * Content of alert.
        *
        * @var  string
        */
       this.text = '';


       /**
        * Style of alert.
        *
        * @var  IO_Alert.styles
        */
       this.style = IO_Alert.styles.primary;


       /**
        * Timer which determiner how long to display alert.
        *
        * @var  integer
        */
       this.hideTimer = 3000;

       /**
        * Instance.
        *
        * @var  IO_Alert
        */
       IO_Alert.instance = this;
     }

     IO_Alert.instance.$alert.fadeOut(500);
     IO_Alert.instance.$alert.removeClass(this.style);

      return IO_Alert.instance;
   }


   /**
    * Prepares alert.
    *
    * @return  void
    * @private
    */
   _prepare()
   {
     var $alertText = this.$alert.find('.alert-text');

     this.$alert.addClass(this.style)
     $alertText.html(this.text);
   }


   /**
    * Show alert.
    *
    * @return  void
    */
   show()
   {
     this._prepare();
     this.$alert.fadeIn(500);

     // Create auto fadeout.
     setTimeout(function() {
       IO_Alert.instance.$alert.fadeOut(500);
     }, this.hideTimer);
   }
 }


/**
 * List of available styles.
 */
IO_Alert.styles = {
  primary: 'alert-primary',
  secondary: 'alert-secondary',
  success: 'alert-success',
  danger: 'alert-danger',
  warning: 'alert-warning'
};
