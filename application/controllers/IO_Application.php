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
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$viewData = [
			'optimizedImages' => $this->stats->optimizedImages,
			'optimizedSize' => $this->stats->optimizedSize
		];

		$this->load->view('application', $viewData);
	}
}
