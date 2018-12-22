<?php
class promotion_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_products()
    {

            $this->db->select('product_id , product_name');
            $this->db->from('product');
            $query = $this->db->get();

            return $query->result_array();
    }

    public function insert_promotion($promotion_data)
    {
        try {
            $this->db->set($promotion_data);
            $result = $this->db->insert('promotion');
            if ($result) {
                $id = $this->db->insert_id();
                return $id;
            } else {
                throw new Exception("Log database error");
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return fasle;
        }
        return false;
    }

    function promotion_list()
    {
        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $query = $this->db->select('pr.*,s.shop_id,s.shop_name,p.product_id,p.product_name,u.user_id,u.user_name')
                ->from('promotion as pr')
                ->join('product as p', 'pr.fk_product_id = p.product_id', 'LEFT')
                ->join('shop as s', 'p.fk_shop_id = s.shop_id', 'LEFT')
                ->join('users as u', 's.fk_user_id = u.user_id', 'LEFT')
                ->get();
            return $query->result();
        }
        $user_id = $_SESSION['user_login_data']['user_id'];
        $query = $this->db->select('pr.*,s.shop_id,s.shop_name,p.product_id,p.product_name,u.user_id,u.user_name')
            ->from('promotion as pr')
            ->join('product as p', 'pr.fk_product_id = p.product_id', 'LEFT')
            ->join('shop as s', 'p.fk_shop_id = s.shop_id', 'LEFT')
            ->join('users as u', 's.fk_user_id = u.user_id', 'LEFT')
            ->where('u.user_id = ', (int)$user_id)
            ->get();
        return $query->result();

    }

    function update_promotion($promotion_id, $promotion_description, $startDate, $endDate, $status, $product_id){

        $this->db->set('promotion_description', $promotion_description);
        $this->db->set('startDate', $startDate);
        $this->db->set('endDate', $endDate);
        $this->db->set('status', $status);
        $this->db->set('fk_product_id', $product_id);

        $this->db->where('promotion_id', $promotion_id);
        $result=$this->db->update('promotion');
        return $result;
    }

    function delete_promotion($promotion_id)
    {
        $this->db->where('promotion_id', $promotion_id);
        $result = $this->db->delete('promotion');
        return $result;
    }
}

?>