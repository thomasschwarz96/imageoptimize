<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * IO Statistics
 *
 * Class for statistics (e.g. images downloaded, optimized size).
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 */
class IO_Statistics extends IO_Base
{
    /**
     * File with all necessary statistics.
     *
     * @var    array|boolean
     */
    private $_statFile;


    /**
     * Original JSON from file.
     *
     * @var    string
     */
    private $_json;


    /**
     * Optimized size in bytes (not converted).
     *
     * @var  integer
     */
    private $_size;


    /**
     * Number of total optimized images.
     *
     * @var    integer
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
     * @return  Boolean  true if update was successful, false if not.
     */
    private function _updateFile()
    {
        $this->_json['optimizedImages'] = $this->optimizedImages;
        $this->_json['optimizedSize'] = $this->_size;

        $success = file_put_contents(
            $this->_statFile,
            json_encode($this->_json)
        );

        return $success !== FALSE;
    }

    /**
     * Convert optimized size from Bytes to GB.
     *
     * @return integer
     */
    private function _convertOptimizedSize()
    {
        $gbSize = $this->_size / 1024 / 1024 / 1024;

        return round($gbSize, 2);
    }

    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->_statFile = FCPATH . 'assets/statistics.json';
        $this->_json = json_decode(
            file_get_contents($this->_statFile), true
        );

        $this->_size = intval($this->_json['optimizedSize']);
        $this->optimizedImages = intval($this->_json['optimizedImages']);
        $this->optimizedSize = $this->_convertOptimizedSize();
    }

    /**
     * Increase number of downloads.
     *
     * @return Boolean
     */
    public function newDownload()
    {
        $this->optimizedImages += 1;
        return $this->_updateFile();
    }

    /**
     * Increase optimizedSize.
     *
     * @param Integer/Float $newOptimizedSize
     *
     * @return Boolean
     */
    public function updateSize($newOptimizedSize)
    {
        $size = intval($newOptimizedSize);
        $this->_size += abs($size);
        return $this->_updateFile();
    }

}
