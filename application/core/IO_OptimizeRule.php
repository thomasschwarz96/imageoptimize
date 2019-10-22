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
     * Options of rule.
     *
     * @var array
     */
    private $_options;


    /**
     * Image to apply rule on.
     *
     * @var image
     */
    protected $_image;


    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_options = array();
        $this->_image = FALSE;
    }


    /**
     * Set image where rule should be applied.
     *
     * @return void
     */
    public function setImage($image)
    {
        $this->_image = $image;
    }


    /**
     * Set options for correct execute.
     *
     * @return void
     */
    public function setOptions($options)
    {
    }


    /**
     * Apply rule to current image.
     *
     * @return image
     */
    public function execute()
    {
    }
}
