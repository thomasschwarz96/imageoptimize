<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load image intervention.
require_once FCPATH.'vendor/autoload.php';
use Intervention\Image\ImageManager;

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
	 * Path where images are stored.
	 *
	 * @var	string
	 */
  private $_uploadPath;


  /**
	 * Prefix for new optimized image.
	 *
	 * @var	string
	 */
  private $_namePrefix;


  /**
	 * CI_Upload class, uploaded image.
	 *
	 * @var	CI_Upload
	 */
  private $_file;

  /**
	 * ImageManager class to make all changes on images.
	 *
	 * @var	ImageManager
	 */
  private $_manager;


  /**
	 * Create name for new optimized image.
	 *
	 * @return string
	 */
  private function _getNewOptimizedName()
  {
    return $this->_uploadPath .
      $this->_namePrefix .
      $this->_file->file_name;
  }

  /**
	 * Class constructor.
	 *
   * @param   $file   - Uploaded image
	 * @return  void
	 */
	public function __construct($file)
	{
    parent::__construct();

    $this->_uploadPath = FCPATH . 'uploads/';
    $this->_namePrefix = 'io_';

    // Clone given file object.
    $this->_file = clone $file;

    $this->_manager = new ImageManager([
      'driver' => 'imagick'
    ]);
  }


  /**
   * Execute optimizing process for image.
   *
   * @return  void
   */
  public function execute()
  {
    $newName = $this->_getNewOptimizedName();
    $fileName = $this->_uploadPath . $this->_file->file_name;

    $image = $this->_manager->make($fileName)->greyscale();
    $image->save($newName);
  }


  /**
   * Get name of uploaded image.
   *
   * @return  String
   */
  public function getUploadedImageName()
  {
    return $this->_file->file_name;
  }


  /**
   * Get name of new optimized image.
   *
   * @return  String
   */
  public function getNewImageName()
  {
    return $this->_namePrefix . $this->_file->file_name;
  }

}
