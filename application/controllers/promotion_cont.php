<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class promotion_cont extends CI_Controller {


	public function __construct(){
		parent::__construct();
        $this->load->model('promotion_model');
        $this->load->model('shop_model');

		}

    /*   ==============================================================
          ADD PROMOTIONS
       ============================================================== */
    public function add_promotion()
    {
        if ($_POST) {
            // validations first name is comes from the form name not db names
            $this->form_validation->set_rules('promotion_description', 'Promotion Description', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('startDate', 'StartDate', 'trim|required');
            $this->form_validation->set_rules('endDate', 'endDate', 'trim|required');
            $this->form_validation->set_rules('promotion_product', 'Products', 'required');

            // insert product into DB
            if ($this->form_validation->run() == FALSE) {
                // errors if form issues
            } else {

                $promotion_status = ($this->input->post('status')) ? 1 : 0;
                $promotion_data = array(
                    'promotion_description' => $this->input->post('promotion_description'),
                    'startDate' => $this->input->post('startDate'),
                    'endDate' => $this->input->post('endDate'),
                    'fk_product_id' => $this->input->post('promotion_product'),
                    'status' => $promotion_status
                );

                $check_success = $this->promotion_model->insert_promotion($promotion_data);
                if ($check_success) {
                    $data['db_success'] = "Record Insert Successfully";
                }
            }
        }

        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $data['products'] = $this->promotion_model->get_products();
        $data['shops'] = $this->shop_model->get_shops_by_user();
        $this->load->view('know/add_promotion_view',$data);
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
        if(empty($shop_id)) {
            return false;
        }
        $data = $this->product_model->get_products_by_shop($shop_id);
        echo json_encode($data);
    }

}