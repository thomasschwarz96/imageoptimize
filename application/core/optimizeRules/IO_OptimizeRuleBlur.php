<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Blur optimize rule for IO_Optimizer.
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
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
    protected function _setRuleOptions()
    {
        $options = $this->_options;
        if (isset($options['amount']))
        {
            $this->_amount = $options['amount'];
        }
    }


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
    public function execute()
    {
        if (!$this->_amount)
        {
            return $this->_image;
        }
        return $this->_image->blur($this->_amount);
    }
}
