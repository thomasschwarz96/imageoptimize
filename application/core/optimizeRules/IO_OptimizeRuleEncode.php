<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Encode optimize rule for IO_Optimizer.
 *
 * @package    ImageOptimize
 * @author    Thomas Schwarz
 * @copyright    Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license    -
 * @link    https://www.image-optimize.com/
 * @since    Version 0.1.0
 * @filesource
 */
class IO_OptimizeRuleEncode extends IO_OptimizeRule
{
    /**
     * Format which the image should get.
     *
     * @var string|boolean
     */
    private $_format;


    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->_format = FALSE;
        $this->_optionName = 'encode';
    }


    /**
     * @inheritDoc
     */
    public function setOptions($options)
    {
        if (!$this->_optionsAvailable($options))
        {
            return;
        }

        $encode = $options[$this->_optionName];
        if (isset($encode['format']))
        {
            $this->_format = $encode['format'];
        }
    }


    /**
     * @inheritDoc
     */
    public function execute()
    {
        if (!$this->_format)
        {
            return $this->_image;
        }

        return $this->_image->encode($this->_format);
    }
}
