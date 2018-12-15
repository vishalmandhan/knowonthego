<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class shop_cont extends CI_Controller {


	public function __construct(){
		parent::__construct();
        $this->load->model('shop_model');

		}

    /* ==============================================================
       ADD SHOP
    ============================================================== */
    public function add_shop()
    {
        if ($_POST) {
            // validations first name is comes from the form name not db names
            $this->form_validation->set_rules('shop_name', 'Shop Name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('shop_address', 'Address', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('city', 'City', 'trim|required');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('map_location', 'Location', 'required');
            // $this->form_validation->set_rules('user_name', 'Username', 'trim|required');


            if ($this->form_validation->run() == FALSE) {

            } else {

                $user_status = ($this->input->post('status')) ? 1 : 0;
                $user_data = array(
                    'shop_name' => $this->input->post('shop_name'),
                    'shop_address' => $this->input->post('shop_address'),
                    'city' => $this->input->post('city'),
                    'country' => $this->input->post('country'),
                    'map_location' => $this->input->post('map_location'),
                    // 'fk_user_id' => $this->input->post('user_name'),
                    'is_active' => $user_status
                );

                $check_success = $this->shop_model->insert_shop($user_data);
                if (!$check_success) {
                    $data['db_error'] = "Record already exist/DB error";
                } else {
                    $data['db_success'] = "Record Insert Successfully";
                }
            }
        }


        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $data['user_names'] = $this->shop_model->user_names();
        $this->load->view('know/add_shop_view');
        $this->load->view('includes/dashboard_footer');

    }


    public function view_shops()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/view_shops_view');
        $this->load->view('includes/dashboard_footer');

    }
}