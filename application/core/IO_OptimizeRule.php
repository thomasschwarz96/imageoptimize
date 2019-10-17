<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base optimize rule for IO_Optimizer.
 *
 * @abstract
 * @package	ImageOptimize
 * @author	Thomas Schwarz
 * @copyright	Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license	-
 * @link	https://www.image-optimize.com/
 * @since	Version 0.1.0
 * @filesource
 */
abstract class IO_OptimizeRule
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
  private $_image;


  /**
	 * Class constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
    $this->_options = [];
    $this->_image = FALSE;
  }


  /**
	 * Set image where rule should be applied.
	 *
	 * @return void
	 */
  public function setImage($image)
  {}


  /**
	 * Set options for correct execute.
	 *
	 * @return void
	 */
  public function setOptions($options)
  {}


  /**
	 * Apply rule to current image.
	 *
	 * @return image
	 */
  public function execute()
  {}
}
