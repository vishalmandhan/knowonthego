<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_cont extends CI_Controller {


	public function __construct(){
		parent::__construct();

        $this->load->model('user_model');

    }

    /*   ==============================================================
           ADD MANAGER
        ============================================================== */
    public function add_manager()
    {
        if (isset($_SESSION['user_login_data']) && !$_SESSION['user_login_data']['is_admin']) {
            redirect(site_url() . '/dashboard_cont/dashboard');
        }

        if ($_POST) {
            // validations first names are from  fields names not db names
            $this->form_validation->set_rules('name', 'Full Name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.user_email]');
            $this->form_validation->set_rules('user_type', 'User Type', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]|min_length[6]');

            if ($this->form_validation->run() == FALSE) {

            } else {

                $user_status = ($this->input->post('status')) ? 1 : 0;
                $user_data = array(
                    'user_name' => $this->input->post('name'),
                    'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password')),
                    'user_email' => $this->input->post('email'),
                    'fk_user_type_id' => $this->input->post('user_type'),
                    'is_active' => $user_status
                );

                $check_success = $this->user_model->insert_user($user_data);
                if (!$check_success) {
                    $data['db_error'] = "Record already exist/DB error";
                } else {
                    $data['db_success'] = "Record Insert Successfully";
                }
            }
        }
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $data['user_types'] = $this->user_model->user_types();
        $this->load->view('know/add_manager_view', $data);
        $this->load->view('includes/dashboard_footer');

    }
    /* ==============================================================
            VIEW MANAGER DETAILS
       ============================================================== */
    public function view_manager()
    {
        if (isset($_SESSION['user_login_data']) && !$_SESSION['user_login_data']['is_admin']) {
            redirect(site_url() . '/dashboard_cont/dashboard');
        }
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/view_manager_view');
        $this->load->view('includes/dashboard_footer');

    }

    public function user_data(){
        $data = $this->user_model->user_list();
        echo json_encode($data);
    }


    public function user_update(){

        $user_id = $this->input->post('user_id');
        $user_name = $this->input->post('user_name');
        $user_email = $this->input->post('user_email');
        $status=$this->input->post('is_active');

        if(empty($user_id) || empty($user_name) || empty($user_email)) {
            return false;
        }

        $data=$this->user_model->update_user($user_id, $user_name,  $user_email, $status);
        echo json_encode($data);
    }

    public function user_delete(){

        $user_id = $this->input->post('user_id');

        if(empty($user_id)){ return false ;}

        $data = $this->user_model->delete_user($user_id);

        echo json_encode($data);
    }
}