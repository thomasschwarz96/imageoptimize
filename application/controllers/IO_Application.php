<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * IO Application
 *
 * Class for main frontend.
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 */
class IO_Application extends IO_Base
{
    /**
     * Configuration for uploader.
     *
     * @var array
     */
    private $_uploadConfig;


    /**
     * Statistic controller.
     *
     * @var IO_Statistics
     */
    public $stats;


    /**
     * Creates statistics part of view data.
     */
    private function _getStatisticsViewData()
    {
        return array(
            'optimizedImages' => $this->stats->optimizedImages,
            'optimizedSize' => $this->stats->optimizedSize
        );
    }


    /**
     * Set validation rules depending on needed optimized rules.
     */
    private function _setValidationRules()
    {
        $postData = $this->input->post();
        $classNames = IO_Helper::getOptimizeRuleClasses($postData);

        foreach ($classNames as $className)
        {
            $className::setValidationRules($this->validator);
        }
    }


    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->_uploadConfig = array(
            'upload_path' => IO_UPLOAD_PATH,
            'allowed_types' => 'jpg|png|gif',
            'max_size' => 6500, // 6.5 MB
            'file_ext_tolower' => TRUE,
            'overwrite' => FALSE,
            'remove_spaces' => TRUE
        );
        $this->stats = new IO_Statistics();
    }


    /**
     * Main application.
     */
    public function index()
    {
        $viewData = $this->_getStatisticsViewData();
        $viewData['contentView'] = 'components/upload';

        $this->load->view('application', $viewData);
    }


    /**
     * Upload form target.
     */
    public function upload()
    {
        $viewData = $this->_getStatisticsViewData();
        $viewData['contentView'] = 'components/optimize';

        $this->upload->initialize($this->_uploadConfig);

        if (!$this->upload->do_upload('image'))
        {
            $alertData = array(
                'alertText' => implode("<br />", $this->upload->error_msg),
                'alertStyle' => 'danger'
            );
            $viewData['alert'] = $this->load->view('components/alert', $alertData, TRUE);
            $viewData['content'] = $this->load->view('components/upload', $viewData, true);
        }
        else
        {
            $viewData['image'] = $this->upload->file_name;
            $viewData['content'] = $this->load->view('components/optimize', $viewData, true);

            $_SESSION['uploadedImage'] = $this->upload;
        }

        echo json_encode($viewData);
    }


    /**
     * Optimize form target.
     */
    public function optimize()
    {
        $this->_setValidationRules();
        if ($this->validator->run() === FALSE)
        {
            $alertData = array(
                'alertText' => implode("<br />", $this->validator->error_array()),
                'alertStyle' => 'danger'
            );
            $viewData['alert'] = $this->load->view('components/alert', $alertData, TRUE);
        }
        else
        {
            $optimizer = new IO_Optimizer($_SESSION['uploadedImage']);
            $optimizer->createRules(
                $this->input->post()
            );
            $optimizer->execute();

            $_SESSION['fileSizeUploaded'] = $optimizer->fileSizeUploaded;
            $_SESSION['fileSizeOptimized'] = $optimizer->fileSizeOptimized;
            $_SESSION['optimizedImageName'] = $optimizer->getNewImageName();

            $alertData = array('alertText' => "Preview succesfully generated!");
            $viewData['alert'] = $this->load->view('components/alert', $alertData, TRUE);

            $imagesData = array(
                'image' => $optimizer->getUploadedImageName(),
                'preview' => $optimizer->getNewImageName()
            );
            $viewData['images'] = $this->load->view('components/preview-image', $imagesData, TRUE);
        }

        echo json_encode($viewData);
    }


    /**
     * Download target for ajax.
     */
    public function download()
    {
        $size = $_SESSION['fileSizeUploaded'] - $_SESSION['fileSizeOptimized'];
        $this->stats->newDownload();
        $this->stats->updateSize($size);

        $this->load->helper('download');

        force_download(
            IO_UPLOAD_PATH . $_SESSION['optimizedImageName'],
            NULL
        );
    }
}
