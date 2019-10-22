<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Image Optimize
 *
 * Base class for whole application.
 *
 * @package    ImageOptimize
 * @author    Thomas Schwarz
 * @copyright    Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license    -
 * @link    https://www.image-optimize.com/
 * @since    Version 0.1.0
 * @filesource
 */
class IO_Base extends CI_Controller
{
    /**
     * Classname
     *
     * @var  string
     */
    public $className;


    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->className = get_class($this);
    }
}
