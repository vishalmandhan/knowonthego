<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class promotion_cont extends CI_Controller {


	public function __construct(){
		parent::__construct();
        $this->load->model('promotion_model');

		}

    /*   ==============================================================
          ADD PROMOTIONS
       ============================================================== */
    public function add_promotion()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/add_promotion_view');
        $this->load->view('includes/dashboard_footer');

    }

    public function view_promotions()
    {
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $this->load->view('know/view_promotions_view');
        $this->load->view('includes/dashboard_footer');

    }

    public function promotion_data(){
        $data = $this->promotion_model->promotion_list();
        echo json_encode($data);
    }

    public function promotion_delete(){

        $promotion_id=$this->input->post('promotion_id');

        if(empty($promotion_id)){ return false ;}

        $data=$this->promotion_model->delete_promotion($promotion_id);
        echo json_encode($data);
    }

    public function promotion_update(){

        $promotion_id = $this->input->post('promotion_id');
        $promotion_description = $this->input->post('promotion_description');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $status=$this->input->post('status');
        $product_id = $this->input->post('product_id_fk');

        if(empty($promotion_id) || empty($promotion_description) || empty($startDate) || empty($endDate)) {
            return false;
        }

        $data=$this->promotion_model->update_promotion($promotion_id, $promotion_description,  $startDate, $endDate, $status, $product_id);
        echo json_encode($data);
    }

    public function shop_list(){
        $this->load->model('shop_model');
        $data = $this->shop_model->get_shops();
        echo json_encode($data);
    }

    public function get_products_by_shop(){
        $shop_id = $this->input->post('shop_id');
        $data = $this->product_model->get_products_by_shop($shop_id);
        echo json_encode($data);
    }

}