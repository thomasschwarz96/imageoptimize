<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base optimize rule for IO_Optimizer.
 *
 * @package    ImageOptimize
 * @author    Thomas Schwarz
 * @copyright    Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license    -
 * @link    https://www.image-optimize.com/
 * @since    Version 0.1.0
 * @filesource
 */
class IO_OptimizeRule
{
    /**
     * Image to apply rule on.
     *
     * @var Intervention\Image\Image|boolean
     */
    protected $_image;


    /**
     * Form option name.
     *
     * @var string|boolean
     */
    protected $_optionName;


    /**
     * Determine if necessary options are available
     *
     * @param   {array}     $options        - Form data
     * @return  boolean
     */
    protected function _optionsAvailable($options)
    {
        if (!isset($options[$this->_optionName]))
        {
            return false;
        }

        $ruleOptions = $options[$this->_optionName];
        return isset($ruleOptions['active']) && $ruleOptions['active'] === 'on';
    }

    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_image = FALSE;
        $this->_optionName = FALSE;
    }


    /**
     * Set image where rule should be applied.
     *
     * @param   {Intervention\Image\Image}     $image   - Uploaded image
     * @return  void
     */
    public function setImage($image)
    {
        $this->_image = $image;
    }


    /**
     * Set options for correct execute.
     *
     * @param   {array}     $options        - Form data
     * @return  void
     */
    public function setOptions($options)
    {
    }


    /**
     * Apply rule to current image.
     *
     * @return Intervention\Image\Image|boolean
     */
    public function execute()
    {
        return false;
    }
}
