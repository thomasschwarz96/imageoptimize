<?php
session_start(); // TODO: TS - fix session loading!
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * IO Application
 *
 * Class for main frontend.
 *
 * @package    ImageOptimize
 * @author    Thomas Schwarz
 * @copyright    Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license    -
 * @link    https://www.image-optimize.com/
 * @since    Version 0.1.0
 * @filesource
 */
class IO_Application extends IO_Base
{
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

        $this->stats = new IO_Statistics();
    }


    /**
     * Main application.
     */
    public function index()
    {
        // Generate view data.
        $viewData = $this->_getStatisticsViewData();
        $viewData['contentView'] = 'components/upload';

        // Load main application.
        $this->load->view('application', $viewData);
    }


    /**
     * Upload form target.
     */
    public function upload()
    {
        // Configuration for uploader.
        $config = array(
            'upload_path' => FCPATH . 'uploads/',
            'allowed_types' => 'jpg|png',
            'max_size' => 6500, // 6.5 MB
            'file_ext_tolower' => TRUE,
            'overwrite' => TRUE,
            'remove_spaces' => TRUE
        );

        // Generate view data.
        $viewData = $this->_getStatisticsViewData();
        $viewData['contentView'] = 'components/optimize';

        // Init uploader.
        $this->upload->initialize($config);

        // Make upload.
        if (!$this->upload->do_upload('image'))
        {
            // Create alert message.
            $alertData = array(
                'alertText' => "The Upload gone wrong!",
                'alertStyle' => 'danger'
            );
            $viewData['alert'] = $this->load->view('components/alert', $alertData, TRUE);
        }
        else
        {
            $viewData['image'] = $this->upload->file_name;
            $_SESSION['uploadedImage'] = $this->upload; // TODO: TS - Update after session fixing
            $_SESSION['filesize'] = $this->upload->file_size * 1024; // Convert to bytes
        }

        // Load main application.
        $viewData['content'] = $this->load->view('components/optimize', $viewData, true);

        echo json_encode($viewData);
    }


    /**
     * Optimize form target.
     */
    public function optimize()
    {
        // Create new optimizer.
        $optimizer = new IO_Optimizer($_SESSION['uploadedImage']); // TODO: TS - Update after session fixing

        // Create optimizing rules depending on user selection.
        $form = $this->input->post();
        $optimizer->createRules($form);

        // Optimize image.
        $optimizer->execute();

        // Update session data.
        $_SESSION['optimizedSize'] = $_SESSION['filesize'] - $optimizer->getFilesize();
        $_SESSION['optimizedImageName'] = $optimizer->getNewImageName();

        // Get alert mesasge.
        $alertData = array('alertText' => "Preview succesfully generated!");
        $viewData['alert'] = $this->load->view('components/alert', $alertData, TRUE);

        // Get images.
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
        // Update statistics.
        $this->stats->newDownload();
        $this->stats->updateOverallOptimized($_SESSION['optimizedSize']);

        // Create download path.
        $imageName = $_SESSION['optimizedImageName'];
        $fullPath = FCPATH . 'uploads/' . $imageName;

        // Load file helper.
        $this->load->helper('download');

        force_download($fullPath, NULL);
    }
}
