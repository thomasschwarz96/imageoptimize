<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Resize optimize rule for IO_Optimizer.
 *
 * @package    ImageOptimize
 * @author    Thomas Schwarz
 * @copyright    Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license    -
 * @link    https://www.image-optimize.com/
 * @since    Version 0.1.0
 * @filesource
 */
class IO_OptimizeRuleResize extends IO_OptimizeRule
{
    /**
     * Width for resizing.
     *
     * @var integer
     */
    private $_width;


    /**
     * Height for resizing.
     *
     * @var integer
     */
    private $_height;


    /**
     * Determine if aspectRatio is needed.
     *
     * @var boolean
     */
    private $_aspectRatio;


    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->_width = NULL;
        $this->_height = NULL;
        $this->_aspectRatio = FALSE;
    }


    /**
     * Set options for correct execute.
     *
     * @return void
     */
    public function setOptions($options)
    {
        if (!isset($options['resize']))
        {
            return;
        }
        $resize = $options['resize'];

        // Check if width was entered.
        if (isset($resize[1]))
        {
            $this->_width = $resize[1];
        }

        // Check if aspect ratio was checked.
        if (isset($resize[2]))
        {
            $this->_aspectRatio = TRUE;
        }

        // Check if height was entered.
        if (isset($resize[3]))
        {
            $this->_height = $resize[3];
        }
    }


    /**
     * @inheritDoc
     */
    public function execute()
    {
        if (!$this->_width)
        {
            return $this->_image;
        }

        // TODO: TS - Improve code!
        if ($this->_aspectRatio)
        {
            return $this->_image->resize(
                $this->_width,
                $this->_height
            );
        }

        return $this->_image->resize(
            $this->_width,
            $this->_height,
            function ($constraint)
            {
                $constraint->aspectRatio();
            }
        );
    }
}
