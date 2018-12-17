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
            $this->form_validation->set_rules('map_location', 'Location', 'required');

            if ($this->form_validation->run() == FALSE) {

            } else {

                $user_status = ($this->input->post('status')) ? 1 : 0;
                $user_data = array(
                    'shop_name' => $this->input->post('shop_name'),
                    'shop_address' => $this->input->post('shop_address'),
                    'fk_country_id' => $this->input->post('shop_country'),
                    'fk_city_id' => $this->input->post('shop_city'),
                    'map_location' => $this->input->post('map_location'),
                    'fk_user_id' => $this->input->post('shop_users'),
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
        $data['countries'] = $this->shop_model->get_countries();
        $data['cities'] = $this->shop_model->get_cities();

        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $data['users'] = $this->shop_model->get_users();
        }
        $this->load->view('know/add_shop_view' , $data);
        $this->load->view('includes/dashboard_footer');

    }

    public function view_shops()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/view_shops_view');
        $this->load->view('includes/dashboard_footer');
    }

    public function shop_data(){
        $data = $this->shop_model->shop_list();
        echo json_encode($data);
    }

    public function shop_delete(){

        $shop_id=$this->input->post('shop_id');

        if(empty($shop_id)){ return false ;}

        $data=$this->shop_model->delete_shop($shop_id);
        echo json_encode($data);
    }

    public function view_shop_location()
    {

        $this->load->library('googlemaps');

        $this->load->model('shop_model', '', TRUE);

        //$config['center'] = 'Karachi , Pakistan';
        $config['zoom'] = "auto";
        $config['trafficOverlay'] = "TRUE";
        $this->googlemaps->initialize($config);

        $coords = $this->shop_model->get_shop_location();

        foreach ($coords as $coordinate) {
            $marker = array();
            $marker['position'] = $coordinate->lat . ',' . $coordinate->lng;
            $marker['title'] = $coordinate->shop_name;
            $this->googlemaps->add_marker($marker);
        }

        $data = array();
        $data['map'] = $this->googlemaps->create_map();

        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/view_map' , $data);
        $this->load->view('includes/dashboard_footer');
    }

    function get_cities_by_country() {
        $country_id = $this->input->post('country');
        if(empty($country_id)) {
            return false;
        }
        $data = $this->shop_model->get_cities_by_country($country_id);
        echo json_encode($data);
    }

}