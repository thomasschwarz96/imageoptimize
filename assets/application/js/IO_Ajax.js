/**
 * Image Optimize
 *
 * Ajax class for the frontend application.
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 */
class IO_Ajax
{
    /**
     * Class constructor.
     *
     * @param   {string}    [path]    - Path where the ajax call should go
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
     * Render templates into DOM.
     *
     * @param    {string}   templates    - Request result
     * @return   void
     * @private
     */
    _render(templates)
    {
        // Render ajaxTarget's in DOM.
        for (let key in templates)
        {
            let $domTarget = $('.ajaxTarget-' + key);

            // Check if ajaxTarget exists.
            if ($domTarget.length)
            {
                $domTarget.html(templates[key]);
            }
        }
    }


    /**
     * Callback for succesfull request.
     *
     * @param    {string}   data    - Request result
     * @return   void
     * @private
     */
    _success(data)
    {
        // Parse data.
        let objectData = JSON.parse(data);
        if (!objectData)
        {
            return;
        }

        this._render(objectData);

        // Hide loader.
        $.hideIoLoader();
    }


    /**
     * Set callback after request is complete.
     *
     * @param   {function}    callback    - Callback function
     * @return  void
     */
    complete(callback)
    {
        if (typeof (callback) === "function")
        {
            this.callback = callback;
        }
    }


    /**
     * Set data for request.
     *
     * @param   {object}    data    - Data for request
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

        let wrapThis = this;
        // Make request.
        $.ajax({
            url: this.path,
            data: this.data,
            type: 'POST',
            enctype: 'multipart/form-data',
            contentType: false,
            processData: false,
            success: function (response) {
                wrapThis._success(response);
            },
            complete: function (response) {
                if (typeof(wrapThis.callback) === "function")
                {
                    wrapThis.callback(response);
                }
            }
        });
    }
}
