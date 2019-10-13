<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * IO Optimizer
 *
 * Class to optimize images.
 *
 * @package	ImageOptimize
 * @author	Thomas Schwarz
 * @copyright	Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license	-
 * @link	https://www.image-optimize.com/
 * @since	Version 0.1.0
 * @filesource
 */
class IO_Optimizer extends IO_Base
{
  /**
	 * File with all necessary statistics.
	 *
	 * @var	file
	 */
  private $_fileName;

  /**
	 * Class constructor.
	 *
   * @param   $fileName   - Name of uploaded image
	 * @return  void
	 */
	public function __construct($fileName)
	{
    parent::__construct();

    $this->_fileName = $fileName;

    echo $this->_fileName;
  }

}
