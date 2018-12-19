<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer_cont extends CI_Controller {


    public function __construct(){
        parent::__construct();

        $this->load->model('customer_model');

    }

    /* ==============================================================
            VIEW Customers DETAILS
       ============================================================== */
    public function view_customer()
    {
        if (isset($_SESSION['user_login_data']) && !$_SESSION['user_login_data']['is_admin']) {
            redirect(site_url() . '/dashboard_cont/dashboard');
        }
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/view_customer_view');
        $this->load->view('includes/dashboard_footer');

    }

    public function customer_data(){
        $data = $this->customer_model->customer_list();
        echo json_encode($data);
    }


    public function customer_update(){

        $customer_id = $this->input->post('customer_id');
        $customer_name = $this->input->post('customer_name');
        $customer_email = $this->input->post('customer_email');
        $customer_contact = $this->input->post('customer_contact');
        $status=$this->input->post('status');

        if(empty($customer_id) || empty($customer_name) || empty($customer_email) || empty($customer_contact)) {
            return false;
        }

        $data=$this->customer_model->update_customer($customer_id, $customer_name,  $customer_email, $customer_contact, $status);
        echo json_encode($data);
    }

    public function customer_delete(){

        $customer_id = $this->input->post('customer_id');

        if(empty($customer_id)){ return false ;}

        $data = $this->customer_model->delete_customer($customer_id);

        echo json_encode($data);
    }

    public function view_customer_location()
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
        // $config['trafficOverlay'] = "TRUE";
        $this->googlemaps->initialize($config);

        $coords = $this->customer_model->get_customer_location();

        foreach ($coords as $coordinate) {
            $marker = array();
            $marker['position'] = $coordinate->customer_location;
            $marker['title'] = $coordinate->customer_name;
            $this->googlemaps->add_marker($marker);
        }

        $data = array();
        $data['map'] = $this->googlemaps->create_map();

        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/customer_map' , $data);
        $this->load->view('includes/dashboard_footer');
    }
}