<?php

class login_model extends CI_Model
{
    public function login($username, $password)
    {
        $query = $this->db->get_where('users', array('username' => $username, 'password' => $password , 'is_active' => 1));

        if ($query->num_rows() > 0) {

            return $query->row_array();
        } else {
            return FALSE;
        }

    }

}
