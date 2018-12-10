<?php
/**
 * Created by PhpStorm.
 * User: Aakash
 * Date: 15-Nov-18
 * Time: 5:20 PM
 */

class shop_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_shops(){
        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $query = $this->db->select('*')
                ->from('shop')
                ->get();
            return $query->result();
        }
        $user_id = $_SESSION['user_login_data']['user_id'];
        $query = $this->db->select('*')
            ->from('shop')
            ->where('fk_user_id', (int)$user_id)
            ->get();
        return $query->result();
    }

    public function user_names() {

       // $query = $this->db->query('SELECT * FROM users;');

            $this->db->select('*');
            $this->db->from('users');
            $query = $this->db->get();

            return $query->result();
        }

    public function insert_shop($user_data) {

        try {
            $this->db->set($user_data);
            $result = $this->db->insert('shop');
            if ($result)
            {
                $id = $this->db->insert_id();
            } else {
                throw new Exception("Log database error");
            }
        } catch (Exception $e) {
            log_message('error',$e->getMessage());
            return;
        }
        return true;
    }

}