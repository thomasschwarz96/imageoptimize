<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gamma optimize rule for IO_Optimizer.
 *
 * @package    ImageOptimize
 * @author    Thomas Schwarz
 * @copyright    Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license    -
 * @link    https://www.image-optimize.com/
 * @since    Version 0.1.0
 * @filesource
 */
class IO_OptimizeRuleGamma extends IO_OptimizeRule
{
    /**
     * Correction for gamma.
     *
     * @var float
     */
    private $_correction;


    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->_correction = 0;
    }


    /**
     * @inheritDoc
     */
    public function setOptions($options)
    {
        if (!isset($options['gamma']))
        {
            return;
        }
        $gamma = $options['gamma'];

        if (isset($gamma[1]))
        {
            $this->_correction = $gamma[1];
        }
    }
    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->_image->gamma($this->_correction);
    }
}
