<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home_cont extends CI_Controller {


	public function __construct(){
		parent::__construct();

		}

	public function index()
	{
		$this->load->view('includes/home_header');
		$this->load->view('know/home_view');
		$this->load->view('includes/home_footer');

	}
}