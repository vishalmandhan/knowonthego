<?php
/**
 * Created by PhpStorm.
 * User: ACER
 * Date: 12/3/2018
 * Time: 7:58 PM
 */

class product_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function get_shops ()
    {
        $this-> db ->select('shop_id , shop_name');
        $this-> db ->from('shop');
        $query = $this->db->get();
        return $query->result_array();
    }

    function insert_product ($product_data) {

        try {
            $this->db->set($product_data);
            $result = $this->db->insert('product');
            if ($result)
            {
                return $this->db->insert_id();
            } else {
                throw new Exception("Log database error");
            }
        } catch (Exception $e) {
            log_message('error',$e->getMessage());
            //return;
        }
        return false;
    }


    function insert_image_path ($product_id , $product_image) {

            $this->db->set('product_image', $product_image);
            $this->db->where('product_id', $product_id);
            $result=$this->db->update('product');
            return $result;
    }

    function product_list(){
        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $query = $this->db->select('p.*, s.shop_name, s.shop_id')
                ->from('product as p')
                ->join('shop as s', 'p.fk_shop_id = s.shop_id', 'LEFT')
                ->get();
            return $query->result();
        }
        $user_id = $_SESSION['user_login_data']['user_id'];
        $query = $this->db->select('p.*, s.shop_name')
            ->from('product as p')
            ->join('shop as s', 'p.fk_shop_id = s.shop_id', 'LEFT')
            ->join('users as u', 'u.user_id = s.fk_user_id', 'LEFT')
            ->where('u.user_id', (int)$user_id)
            ->get();
        return $query->result();
    }

    function get_products_by_shop($shop_id){
        $query = $this->db->select('*')
            ->from('product')
            ->where('fk_shop_id', (int)$shop_id)
            ->get();
        return $query->result();
    }

    function update_product($product_id,$product_name,$product_description,$product_price,$product_image,$shop_id){

        $this->db->set('product_name', $product_name);
        $this->db->set('product_description', $product_description);
        $this->db->set('product_price', $product_price);
        $this->db->set('product_image', $product_image);
        $this->db->set('fk_shop_id', $shop_id);

        $this->db->where('product_id', $product_id);
        $result=$this->db->update('product');
        return $result;
    }

    function delete_product($product_id){

        $this->db->where('product_id', $product_id);
        $result=$this->db->delete('product');
        return $result;
    }
}