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
                'alertText' => "The Upload gone wrong!",
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
            $_SESSION['filesize'] = $this->upload->file_size * 1024; // Convert to bytes
        }

        echo json_encode($viewData);
    }


    /**
     * Optimize form target.
     */
    public function optimize()
    {
        $optimizer = new IO_Optimizer($_SESSION['uploadedImage']);
        $optimizer->createRules(
            $this->input->post()
        );
        $optimizer->execute();

        $_SESSION['optimizedSize'] = $_SESSION['filesize'] - $optimizer->getFilesize();
        $_SESSION['optimizedImageName'] = $optimizer->getNewImageName();

        $alertData = array('alertText' => "Preview succesfully generated!");
        $viewData['alert'] = $this->load->view('components/alert', $alertData, TRUE);

        $imagesData = array(
            'image' => $optimizer->getUploadedImageName(),
            'preview' => $optimizer->getNewImageName()
        );
        $viewData['images'] = $this->load->view('components/preview-image', $imagesData, TRUE);

        echo json_encode($viewData);
    }


    /**
     * Download target for ajax.
     */
    public function download()
    {
        $this->stats->newDownload();
        $this->stats->updateOverallOptimized($_SESSION['optimizedSize']);

        $this->load->helper('download');

        force_download(
            IO_UPLOAD_PATH . $_SESSION['optimizedImageName'],
            NULL
        );
    }
}
