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
     * Determines if we should keep ratio.
     *
     * @var boolean
     */
    private $_keepRatio;


    /**
     * Callback for keeping ratio (for resize() method).
     *
     * @var callback
     */
    private $_ratioCallback;


    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->_width = NULL;
        $this->_height = NULL;
        $this->_keepRatio = TRUE;

        $this->_ratioCallback = function ($constraint)
        {
            $constraint->aspectRatio();
        };
    }


    /**
     * @inheritDoc
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
            $this->_keepRatio = FALSE;
            $this->_ratioCallback = NULL;
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

        return $this->_image->resize(
            $this->_width,
            $this->_height,
            $this->_ratioCallback
        );
    }
}
