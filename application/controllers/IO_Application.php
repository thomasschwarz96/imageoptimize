<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * IO Application
 *
 * Class for main frontend.
 *
 * @package	ImageOptimize
 * @author	Thomas Schwarz
 * @copyright	Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license	-
 * @link	https://www.image-optimize.com/
 * @since	Version 0.1.0
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
	 * Optimizer controller.
	 *
	 * @var IO_Optimizer
	 */
	public $optimizer;


	/**
	 * Creates statistics part of view data.
	 */
	private function _getStatisticsViewData()
	{
		return [
			'optimizedImages' => $this->stats->optimizedImages,
			'optimizedSize' => $this->stats->optimizedSize
		];
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
		$config = [
			'upload_path' => FCPATH . 'uploads/',
			'allowed_types' => 'jpg|png',
			'max_size' => 2000,
			'file_ext_tolower' => TRUE,
			'overwrite' => TRUE,
			'remove_spaces' => TRUE
		];

		// Init uploader.
		$this->upload->initialize($config);

		// Make upload.
		if (!$this->upload->do_upload('image'))
		{
			// Generate view data.
			$viewData = [
				'heading' => 'Whoops!',
				'message' => 'Something went wrong :/ Please try again!'
			];

			// Load error view.
			$this->load->view('errors/html/error_general', $viewData);
    }
		else
		{
			// Generate view data.
			$viewData = $this->_getStatisticsViewData();
			$viewData['contentView'] = 'components/optimize';
			$viewData['image'] = $this->upload->file_name;

			// Create new optimizer.
			$this->optimizer = new IO_Optimizer($this->upload->file_name);

			// Load main application.
			$this->load->view('application', $viewData);
    }
	}

	/**
	 * Optimize form target.
	 */
	public function optimize()
	{
		echo "optimize";
	}
}
