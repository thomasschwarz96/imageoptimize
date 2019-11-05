/**
 * Image Optimize
 *
 * jQuery loader class.
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 */
(function ($)
{
    $.showIoLoader = function ()
    {
        $("#io-loader").css({
            opacity: 1,
            visibility: 'visible'
        });
        return this;
    };

    $.hideIoLoader = function ()
    {
        $("#io-loader").css({
            opacity: 0,
            visibility: 'hidden'
        });
        return this;
    };
})(jQuery);
