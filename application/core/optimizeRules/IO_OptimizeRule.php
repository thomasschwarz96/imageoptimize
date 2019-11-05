<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Abstracted base optimize rule for IO_Optimizer.
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 * @abstract
 */
abstract class IO_OptimizeRule
{
    /**
     * Image to apply rule on.
     *
     * @var Intervention\Image\Image|boolean
     */
    protected $_image;


    /**
     * Options for rule.
     *
     * @var array
     */
    protected $_options;


    /**
     * Form option name.
     *
     * @var string|boolean
     */
    protected $_optionName;


    /**
     * Determine if necessary options are available and active
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
     * Set rule specific options.
     *
     * @return void
     * @abstract
     */
    abstract protected function _setRuleOptions();

    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_image = FALSE;
        $this->_options = array();
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
        if (!isset($options))
        {
            return;
        }

        if ($this->_optionsAvailable($options))
        {
            $this->_options = $options[$this->_optionName];
        }

        $this->_setRuleOptions();
    }


    /**
     * Apply rule to current image.
     *
     * @return Intervention\Image\Image
     * @abstract
     */
    abstract public function execute();
}
