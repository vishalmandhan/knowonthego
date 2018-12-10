<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class locationView_cont extends CI_Controller {


	public function __construct(){
		parent::__construct();

		}


    /*   ==============================================================
      VIEW LOCATIONS
   ============================================================== */
    public function view_shop_locations()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/view_shop_locations');
        $this->load->view('includes/dashboard_footer');

    }

    public function view_all_shops_locations()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/view_all_shops_locations');
        $this->load->view('includes/dashboard_footer');

    }
}