<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard_cont extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('user_login_data')) {
            redirect(site_url() . '/login_cont/login');
            die;
        }
    }



    public function dashboard()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/dashboard_view');
        $this->load->view('includes/dashboard_footer');
    }




    /*   ==============================================================
        CALENDAR
     ============================================================== */
    public function calendar()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/pages-calendar');
        $this->load->view('includes/dashboard_footer');
    }



}






