<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Blur optimize rule for IO_Optimizer.
 *
 * @package    ImageOptimize
 * @author    Thomas Schwarz
 * @copyright    Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license    -
 * @link    https://www.image-optimize.com/
 * @since    Version 0.1.0
 * @filesource
 */
class IO_OptimizeRuleBlur extends IO_OptimizeRule
{
    /**
     * Amount for blur.
     *
     * @var integer
     */
    private $_amount;


    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->_amount = FALSE;
        $this->_optionName = 'blur';
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

        $blur = $options[$this->_optionName];
        if (isset($blur['amount']))
        {
            $this->_amount = $blur['amount'];
        }
    }


    /**
     * @inheritDoc
     */
    public function execute()
    {
        if (!$this->_amount)
        {
            return $this->_image;
        }
        return $this->_image->blur($this->_amount);
    }
}
