<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Greyscale optimize rule for IO_Optimizer.
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     -
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 */
class IO_OptimizeRuleGreyscale extends IO_OptimizeRule
{
    /**
     * @inheritDoc
     */
    protected function _setRuleOptions()
    {
        // nothing to do here
    }


    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->_optionName = 'greyscale';
    }


    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->_image->greyscale();
    }
}
