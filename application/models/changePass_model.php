<?php
/**
 * Created by PhpStorm.
 * User: Aakash
 * Date: 27-Nov-18
 * Time: 4:29 PM
 */

class changePass_model extends CI_Model
{
    public function updatePassword($email, $old_password, $new_password){

//        $query = $this->db->query("SELECT password from users where password = '" . $old_password . "' ");


        $this->db->where('user_email', $email);
        $this->db->where('password', $old_password);
        $query = $this->db->get('users');

        $row = $query->result_array();
        if ($row) {
            $this->db->set('password', $new_password);
            $this->db->where('user_email', $email);
            $this->db->where('password', $old_password);
            $this->db->update('users');

            return true;
        }
    }

}