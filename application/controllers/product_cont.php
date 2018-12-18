<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product_cont extends CI_Controller {


	public function __construct(){
		parent::__construct();
        $this->load->model('product_model');
        $this->load->model('shop_model');

		}

    /*   ==============================================================
          ADD PRODUCT
         ============================================================== */
    public function add_product()
    {
        if ($_POST) {
            // validations first name is comes from the form name not db names
            $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('product_description', 'Description', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('product_price', 'Price', 'trim|required');
            $this->form_validation->set_rules('product_image', 'Image');
            $this->form_validation->set_rules('product_shop', 'Shop', 'required');

            $product_id_new = 0;
            // insert product into DB
            if ($this->form_validation->run() == FALSE) {
                // errors if form issues
            } else {

                $product_data = array(
                    'product_name' => $this->input->post('product_name'),
                    'product_description' => $this->input->post('product_description'),
                    //md5 removed from below line
                    'product_price' => $this->input->post('product_price'),
                    'fk_shop_id' => $this->input->post('product_shop'),

                );

                $product_id_new = $this->product_model->insert_product($product_data);
            }

            $filename = 'product_'.$product_id_new;

            // upload image
            $config['upload_path']   = 'assets/product_images';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_size']      = '2048';
            //$config['max_width']     = '1024';
            //$config['max_height']    = '768';
            $config['file_name']    = $filename;

            $this->load->library('upload' , $config);
            $this->upload->initialize($config);
            $field_name = "image";
            if(!$this->upload->do_upload($field_name)) {
                $upload_error = $this->upload->display_errors();
            }
            $data = $this->upload->data();
            $check_success= $this->product_model->insert_image_path($product_id_new,$filename.$data['file_ext']);
            if (!$check_success) {
                $data['db_error'] = "Record already exist/DB error";
            } else {
                $data['db_success'] = "Record Insert Successfully";
            }

        }
        $user_session['session_data'] = $this->session->userdata('user_login_data');
        $this->load->view('includes/dashboard_header', $user_session);
        $data['shops'] = $this->shop_model->get_shops_by_user();
        $this->load->view('know/add_product_view' , $data);
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

        $product_id = $this->input->post('product_id_edit');
        $product_name = $this->input->post('product_name_edit');
        $product_description = $this->input->post('product_description_edit');
        $product_price = $this->input->post('product_price_edit');
        $shop_id = $this->input->post('shop_name');

        if(empty($product_id) || empty($product_name)
            || empty($product_price) || empty($shop_id) || !is_numeric($product_price)) {
            return false;
        }

        $filename = 'product_'.$product_id;

        $config['upload_path']   = 'assets/product_images';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
//        $config['max_size']      = '100';
//        $config['max_width']     = '1024';
//        $config['max_height']    = '768';
        $config['file_name']    =  $filename;

        $this->load->library('upload' , $config);
        $this->upload->initialize($config);
        $field_name = "product_image";
        if(!$this->upload->do_upload($field_name)) {
            $upload_error = $this->upload->display_errors();
        }
        $data = $this->upload->data();
        //$this->product_model->insert_image_path($product_id,$filename.$data['file_ext']);
        //json_encode($data); exit;
        $data=$this->product_model->update_product($product_id,$product_name,$product_description,$product_price,$filename.$data['file_ext'],$shop_id);

        echo json_encode($data);
    }


    public function shop_list(){
        $data = $this->shop_model->shop_list();
        echo json_encode($data);
    }

    public function product_delete(){

        $product_id=$this->input->post('product_id');

        if(empty($product_id)){ return false ;}

        $data=$this->product_model->delete_product($product_id);
        echo json_encode($data);
    }
}