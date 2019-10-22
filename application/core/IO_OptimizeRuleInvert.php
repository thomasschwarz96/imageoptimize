<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Invert optimize rule for IO_Optimizer.
 *
 * @package    ImageOptimize
 * @author    Thomas Schwarz
 * @copyright    Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license    -
 * @link    https://www.image-optimize.com/
 * @since    Version 0.1.0
 * @filesource
 */
class IO_OptimizeRuleInvert extends IO_OptimizeRule
{
    /**
     * Apply rule to current image.
     *
     * @return image|boolean
     */
    public function execute()
    {
        return $this->_image->invert();
    }
}
