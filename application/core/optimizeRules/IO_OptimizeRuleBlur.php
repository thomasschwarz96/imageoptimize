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
    }


    /**
     * @inheritDoc
     */
    public function setOptions($options)
    {
        if (!isset($options['blur']))
        {
            return;
        }
        $blur = $options['blur'];

        if (isset($blur[1]))
        {
            $this->_amount = $blur[1];
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
