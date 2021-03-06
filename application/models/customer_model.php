<?php
class customer_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function customer_list()
    {

        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $query = $this->db->select('customer_id , customer_name, username , customer_email , contact, status, application_id, dateTime')
                ->from('customer')
                ->get();
            return $query->result();
        }
    }

    function update_customer($customer_id, $customer_name, $customer_email, $customer_contact, $status)
    {

        $this->db->set('customer_name', $customer_name);
        $this->db->set('customer_email', $customer_email);
        $this->db->set('contact', $customer_contact);
        $this->db->set('status', $status);

        $this->db->where('customer_id', $customer_id);
        $result = $this->db->update('customer');
        return $result;
    }

    function delete_customer($customer_id)
    {
        {
            $this->db->where('customer_id', $customer_id);
            $result = $this->db->delete('customer');
            return $result;
        }
    }

    function get_customer_location()
    {
        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $return = array();
            $this->db->select("customer_location,customer_name");
            $this->db->from("customer");
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
        $query = $this->db->select("s.customer_location,s.customer_name, u.user_id")
            ->from("customer as s")
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

    public function customer_subscription_list()
    {
        $query = $this->db->select('cs.customer_subscribe_id , cs.dateTime,s.shop_id,s.shop_name ,c.customer_id,c.customer_name')
            ->from('customer_subscribe as cs')
            ->join('shop as s', 'cs.fk_shop_id = s.shop_id', 'LEFT')
            ->join('customer as c', 'cs.fk_customer_id = c.customer_id', 'LEFT')
            ->get();
        return $query->result();
    }

    function delete_customer_subscribe($customer_subscribe_id)
    {
        $this->db->where('customer_subscribe_id', $customer_subscribe_id);
        $result = $this->db->delete('customer_subscribe');
        return $result;
    }

}
?>