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

    public function get_countries()
    {
        $this->db->select('country_id , country_name');
        $this->db->from('country');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_cities()
    {
        $this->db->select('city_id , city_name');
        $this->db->from('city');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_users()
    {
        $this->db->select('user_id , username');
        $this->db->from('users');
        $this->db->where('fk_user_type_id != 1');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function insert_shop($user_data)
    {

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

     public function shop_list()
    {
        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $query = $this->db->select('sh.*,con.country_id,con.country_name,c.city_id,c.city_name,u.user_id,u.user_name')
                ->from('shop as sh')
                ->join('country as con', 'sh.fk_country_id = con.country_id', 'LEFT')
                ->join('city as c', 'sh.fk_city_id = c.city_id', 'LEFT')
                ->join('users as u', 'sh.fk_user_id = u.user_id', 'LEFT')
                ->get();
            return $query->result();
        }
        $user_id = $_SESSION['user_login_data']['user_id'];
        $query = $this->db->select('sh.*,con.country_id,con.country_name,c.city_id,c.city_name,u.user_id,u.user_name')
            ->from('shop as sh')
            ->join('country as con', 'sh.fk_country_id = con.country_id', 'LEFT')
            ->join('city as c', 'sh.fk_city_id = c.city_id', 'LEFT')
            ->join('users as u', 'sh.fk_user_id = u.user_id', 'LEFT')
            ->where('u.user_id', (int)$user_id)
            ->get();
        return $query->result();

    }

    function get_shop_location()
    {
        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $return = array();
            $this->db->select("map_location,shop_name");
            $this->db->from("shop");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    array_push($return, $row);
                }
            }
            return $return;
        }
        $user_id = $_SESSION['user_login_data']['user_id'];
        $return = array();
        $query = $this->db->select("s.map_location,s.shop_name, u.user_id")
            ->from("shop as s")
            ->join('users as u', 's.fk_user_id = u.user_id', 'LEFT')
            ->where('u.user_id', (int)$user_id)
            ->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                array_push($return, $row);
            }
        }
        return $return;
    }

    public function get_shops_by_user()
    {
        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $this->db->select('shop_id , shop_name');
            $this->db->from('shop');
            $query = $this->db->get();
            return $query->result_array();
        }
        $user_id = $_SESSION['user_login_data']['user_id'];
        $this->db->select('shop_id , shop_name');
        $this->db->where('fk_user_id',$user_id);
        $this->db->from('shop');
        $query = $this->db->get();

        return $query->result_array();
    }

    function get_cities_by_country($country_id) {
        $this->db->select('city_id , city_name');
        $this->db->where('fk_country_id',$country_id);
        $this->db->from('city');
        $query = $this->db->get();

        return $query->result_array();
    }

    function update_shop($shop_id, $shop_name, $shop_address, $country_id, $city_id, $map_location, $is_active){

        $this->db->set('shop_id', $shop_id);
        $this->db->set('shop_name', $shop_name);
        $this->db->set('shop_address', $shop_address);
        $this->db->set('fk_city_id', $city_id);
        $this->db->set('fk_country_id', $country_id);
        $this->db->set('map_location', $map_location);
        $this->db->set('is_active', $is_active);

        $this->db->where('shop_id', $shop_id);
        $result=$this->db->update('shop');
        return $result;
    }

    function delete_shop($shop_id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('fk_shop_id', $shop_id);
        $query = $this->db->get();


            if ($query->num_rows() > 0)
            {
                return array('message'=>'This shop has products','success'=>false);
            }

        $this->db->where('shop_id', $shop_id);
        $result = $this->db->delete('shop');

        return $result;
    }


}