<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product_cont extends CI_Controller {


	public function __construct(){
		parent::__construct();
        $this->load->model('product_model');

		}

    /*   ==============================================================
          ADD PRODUCT
       ============================================================== */
    public function add_product()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/add_product_view');
        $this->load->view('includes/dashboard_footer');

    }

    public function view_products()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/view_products_view');
        $this->load->view('includes/dashboard_footer');
    }

    public function product_data(){
        $data=$this->product_model->product_list();
        echo json_encode($data);
    }

    public function product_update(){

        $product_id = $this->input->post('product_id');
        $product_name = $this->input->post('product_name');
        $product_description = $this->input->post('product_description');
        $product_price = $this->input->post('product_price');
        $product_image=$this->input->post('product_image');
        $shop_id = $this->input->post('shop_id_fk');

        if(empty($product_id) || empty($product_name)
            || empty($product_price) || empty($shop_id) || !is_numeric($product_price)) {
            return false;
        }

        $data=$this->product_model->update_product($product_id,$product_name,$product_description,$product_price,$product_image,$shop_id);
        echo json_encode($data);
    }

    public function shop_list(){
        $data = $this->shop_model->get_shops();
        echo json_encode($data);
    }

    public function product_delete(){

        $product_id=$this->input->post('product_id');

        if(empty($product_id)){ return false ;}

        $data=$this->product_model->delete_product($product_id);
        echo json_encode($data);
    }
}