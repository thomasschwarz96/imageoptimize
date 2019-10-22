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
     * @inheritDoc
     */
    public function execute()
    {
        return $this->_image->blur(15);
    }
}
