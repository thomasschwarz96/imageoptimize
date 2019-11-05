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
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 */
class IO_Optimizer extends IO_Base
{
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
     * @var IO_OptimizeRule[]
     */
    private $_ruleSet;

    /**
     * Form with all settings for rules.
     *
     * @var array
     */
    private $_form;


    /**
     * Filesize of current image.
     *
     * @var integer
     */
    private $_filesize;


    /**
     * Encoding format.
     *
     * @var string|boolean
     */
    private $_encodingFormat;


    /**
     * Set encoding format for image.
     */
    private function _setEncodingFormat()
    {
        if (isset($this->_form['encode']))
        {
            $this->_encodingFormat = $this->_form['encode']['format'];
        }
    }


    /**
     * Get base filename depending on encoding format.
     *
     * @return string
     */
    private function _getFilenameBasedOnEncoding()
    {
        $filename = $this->_file->file_name;

        if ($this->_encodingFormat)
        {
            $filename = preg_replace(
                '"\.(jpg|png|gif)$"',
                '.' . $this->_encodingFormat,
                $filename
            );
        }

        return $filename;
    }


    /**
     * Get path of uploaded image.
     *
     * @return string
     */
    private function _getUploadedImageName()
    {
        return IO_UPLOAD_PATH . $this->_file->file_name;
    }


    /**
     * Get path for new optimized image.
     *
     * @return string
     */
    private function _getNewOptimizedName()
    {
        return IO_UPLOAD_PATH . $this->_namePrefix . $this->_getFilenameBasedOnEncoding();
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

        return 80;
    }


    /**
     * Apply all rules on image.
     *
     * @param   $image    - Uploaded image which should optimized
     *
     * @return  void
     */
    private function _applyRules($image)
    {
        foreach ($this->_ruleSet as $ruleClass)
        {
            $rule = new $ruleClass();
            $rule->setOptions($this->_form);
            $rule->setImage($image);
            $image = $rule->execute();
        }
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

        $this->_namePrefix = 'io_';
        $this->_ruleSet = array();
        $this->_form = array();
        $this->_filesize = 0;
        $this->_encodingFormat = FALSE;

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
        // Make intervention image.
        $image = $this->_manager->make($this->_getUploadedImageName());

        // Apply all rules on image.
        $this->_applyRules($image);

        // Save optimized image with new name.
        $image = $image->save($this->_getNewOptimizedName(), $this->_getQuality());

        // Update current filesize.
        $this->_filesize = $image->filesize();

        // Frees associated memory.
        $image->destroy();
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
        $this->_setEncodingFormat();

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
     * @return  string
     */
    public function getUploadedImageName()
    {
        return $this->_file->file_name;
    }


    /**
     * Get name of new optimized image.
     *
     * @return  string
     */
    public function getNewImageName()
    {
        return $this->_namePrefix . $this->_getFilenameBasedOnEncoding();
    }


    /**
     * Get filesize of current image.
     *
     * @return  integer
     */
    public function getFilesize()
    {
        return $this->_filesize;
    }

}
