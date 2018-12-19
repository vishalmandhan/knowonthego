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
                // errors show on form
            } else {

                $user_id = 0;
                if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
                    $user_id = $this->input->post('shop_users');
                } else {
                    $user_id = $_SESSION['user_login_data']['user_id'];
                }

                $shop_status = ($this->input->post('status')) ? 1 : 0;
                $shop_data = array(
                    'shop_name' => $this->input->post('shop_name'),
                    'shop_address' => $this->input->post('shop_address'),
                    'fk_country_id' => $this->input->post('shop_country'),
                    'fk_city_id' => $this->input->post('shop_city'),
                    'map_location' => $this->input->post('map_location'),
                    'fk_user_id' => $user_id,
                    'is_active' => $shop_status
                );

                $check_success = $this->shop_model->insert_shop($shop_data);
                if (!$check_success) {
                    $data['db_error'] = "Record already exist/DB error";
                } else {
                    $data['db_success'] = "Record Insert Successfully";
                }
            }
        }

        // add shop: Add location in database (map)
        $this->load->library('googlemaps');

        $config['center'] = '24.946218, 67.005615'; //Focus On
        $config['zoom'] = "10";
        $config['sensor'] = 'TRUE';
        $config['places'] = 'TRUE';
        $config['map_type'] = 'ROADMAP';
            //$config['onclick'] = 'createMarker_map({ map: map, position:event.latLng });';
        $config['onclick'] = 'alert(\'You just clicked at: \' + event.latLng.lat() + \', \' + event.latLng.lng());';
        // $config['trafficOverlay'] = "TRUE";
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = '24.946218, 67.005615';
        $this->googlemaps->add_marker($marker);

        $dataMap = array();
        $dataMap['map'] = $this->googlemaps->create_map();

        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $data['countries'] = $this->shop_model->get_countries();
        $data['cities'] = $this->shop_model->get_cities();

        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $data['users'] = $this->shop_model->get_users();
        }
        $mergeView = array_merge($data,$dataMap);
        $this->load->view('know/add_shop_view' , $mergeView);
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

        $config['center'] = '24.946218, 67.005615'; //Focus On
        $config['zoom'] = "10";
        $config['sensor'] = 'TRUE';
        $config['places'] = 'TRUE';
        $config['map_type'] = 'ROADMAP';
      //  $config['onclick'] = 'createMarker_map({ map: map, position:event.latLng });';
      //  $config['onclick'] = 'alert(\'You just clicked at: \' + event.latLng.lat() + \', \' + event.latLng.lng());';
        //// $config['trafficOverlay'] = "TRUE";
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

    function get_city_by_country() {
        $country_id = $this->input->post('country_id');
        if(empty($country_id)) {
            return false;
        }
        $data = $this->shop_model->get_cities_by_country($country_id);
        echo json_encode($data);
    }

    public function country_list(){
        $data = $this->shop_model->get_countries();
        echo json_encode($data);
    }



    public function shop_update(){

        $shop_id = $this->input->post('shop_id');
        $shop_name = $this->input->post('shop_name');
        $shop_address = $this->input->post('shop_address');
        $country_id = $this->input->post('country_id_fk');
        $city_id = $this->input->post('city_id_fk');
        $map_location = $this->input->post('map_location');
        $is_active = $this->input->post('status');

        if(empty($shop_id) || empty($shop_name) || empty($shop_address) || empty($country_id) || empty($city_id) || empty($map_location) || empty($is_active))  {
            return false;
        }

        $data=$this->shop_model->update_shop($shop_id, $shop_name, $shop_address, $country_id, $city_id, $map_location, $is_active);
        echo json_encode($data);
    }

}