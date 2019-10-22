<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load image intervention.
require_once FCPATH . 'vendor/autoload.php';

use Intervention\Image\ImageManager;

/**
 * IO Optimizer
 *
 * Class to optimize images.
 *
 * @package    ImageOptimize
 * @author    Thomas Schwarz
 * @copyright    Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license    -
 * @link    https://www.image-optimize.com/
 * @since    Version 0.1.0
 * @filesource
 */
class IO_Optimizer extends IO_Base
{
    /**
     * Path where images are stored.
     *
     * @var    string
     */
    private $_uploadPath;


    /**
     * Prefix for new optimized image.
     *
     * @var    string
     */
    private $_namePrefix;


    /**
     * CI_Upload class, uploaded image.
     *
     * @var    CI_Upload
     */
    private $_file;

    /**
     * ImageManager class to make all changes on images.
     *
     * @var    ImageManager
     */
    private $_manager;

    /**
     * Rules which specify how to optimize the image.
     *
     * @var IO_OptimzeRule[]
     */
    private $_ruleSet;

    /**
     * Form with all settings for rules.
     *
     * @var Array
     */
    private $_form;


    /**
     * Filesize of current image.
     *
     * @var Integer
     */
    private $_filesize;


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
     * Get quality from form, if not set returns standard.
     *
     * @return integer
     */
    private function _getQuality()
    {
        if (isset($this->_form['quality']))
        {
            return $this->_form['quality'];
        }

        return 90;
    }

    /**
     * Class constructor.
     *
     * @param   $file - Uploaded image
     *
     * @return  void
     */
    public function __construct($file)
    {
        parent::__construct();

        $this->_uploadPath = FCPATH . 'uploads/';
        $this->_namePrefix = 'io_';
        $this->_ruleSet = array();
        $this->_form = array();
        $this->_filesize = 0;

        // Clone given file object.
        $this->_file = clone $file;

        $this->_manager = new ImageManager(array(
            'driver' => 'imagick'
        ));
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

        // Make intervention image.
        $image = $this->_manager->make($fileName);

        // Apply all rules on image.
        foreach ($this->_ruleSet as $ruleClass)
        {
            $rule = new $ruleClass();
            $rule->setOptions($this->_form);
            $rule->setImage($image);
            $image = $rule->execute();
        }

        // Save optimized image with new name.
        $image = $image->save($newName, $this->_getQuality());

        // Update current filesize.
        $this->_filesize = $image->filesize();
    }


    /**
     * Create rules by given form.
     *
     * @param array   Form data
     *
     * @return  void
     */
    public function createRules($form)
    {
        $this->_form = $form;
        $rulePrefix = "IO_OptimizeRule";

        foreach ($this->_form as $key => $entry)
        {
            $className = $rulePrefix . ucfirst($key);
            if (class_exists($className))
            {
                array_push($this->_ruleSet, $className);
            }
        }
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


    /**
     * Get filesize of current image.
     *
     * @return  Integer
     */
    public function getFilesize()
    {
        return $this->_filesize;
    }

}
