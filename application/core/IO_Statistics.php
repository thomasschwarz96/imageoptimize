<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * IO Statistics
 *
 * Class for statistics (e.g. images downloaded, optimized size).
 *
 * @package	ImageOptimize
 * @author	Thomas Schwarz
 * @copyright	Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license	-
 * @link	https://www.image-optimize.com/
 * @since	Version 0.1.0
 * @filesource
 */
class IO_Statistics extends IO_Base
{
  /**
	 * File with all necessary statistics.
	 *
	 * @var	file
	 */
  private $_statFile;


  /**
	 * Original JSON from file.
	 *
	 * @var	string
	 */
  private $_json;


  /**
 	 * Number of total optimized images.
 	 *
 	 * @var	integer
 	 */
  public $optimizedImages;

  /**
   * Number of total optimized size of images.
   *
   * @var  integer
   */
  public $optimizedSize;


  /**
   * Updates the 'statistics.json' file.
   *
   * @return  Boolean  true if update was successull, false if not.
   */
  private function _updateFile()
  {
    // Update JSON.
    $this->_json['optimizedImages'] = $this->optimizedImages;
    $this->_json['optimizedSize'] = $this->optimizedSize;

    // Write JSON to file.
    $success = file_put_contents(
     $this->_statFile,
     json_encode($this->_json)
    );

    return $success !== FALSE;
   }

   /**
    * Convert optimized size from Bytes to GB.
    */
   private function _convertOptimizedSize()
   {
     $gbSize = $this->optimizedSize / 1024 / 1024 / 1024;

     $this->optimizedSize = round($gbSize, 2);
   }

  /**
	 * Class constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
    parent::__construct();

    // Get file.
    $this->_statFile = FCPATH . 'assets/statistics.json';

    // Get json.
    $this->_json = json_decode(
      file_get_contents($this->_statFile), true
    );

    // Init values.
    $this->optimizedImages = intval($this->_json['optimizedImages']);
    $this->optimizedSize = intval($this->_json['optimizedSize']);

    $this->_convertOptimizedSize();
  }

  /**
	 * Increase number of downloads.
	 *
	 * @return Boolean
	 */
	public function newDownload()
  {
		// Increase downloaded.
		$this->optimizedImages += 1;

		return $this->_updateFile();
	}

  /**
	 * Increase size of optimizedSize.
	 *
	 * @param  Integer/Float $newOptimizedSize
	 *
	 * @return Boolean
	 */
	public function updateOverallOptimized($newOptimizedSize)
  {
		// Increase size of 'overallOptimized'.
		$this->optimizedSize += $newOptimizedSize;

		return $this->_updateFile();
	}

}
