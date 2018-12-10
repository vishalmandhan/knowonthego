<?php 
class User_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	public function user_types() {

		$this->db->select('*');
		$this->db->from('user_type');
		$query = $this->db->get();

        return $query->result_array();
	}

	public function insert_user($user_data) {

	    try {
            $this->db->set($user_data);
            $result = $this->db->insert('users');
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


    function user_list(){

        if (isset($_SESSION['user_login_data']) && $_SESSION['user_login_data']['is_admin']) {
            $query = $this->db->select('u.user_id , u.user_name, u.username , u.user_email , u.is_active, ut.user_type, ut.user_type_id')
                ->from('users as u')
                ->join('user_type as ut', 'u.fk_user_type_id = ut.user_type_id', 'LEFT')
                ->where('u.user_id != ',$_SESSION['user_login_data']['user_id'])
                ->get();
            return $query->result();
        }
    }
    function update_user($user_id, $user_name, $user_email, $status){

        $this->db->set('user_name', $user_name);
        $this->db->set('user_email', $user_email);
        $this->db->set('is_active', $status);

        $this->db->where('user_id', $user_id);
        $result=$this->db->update('users');
        return $result;
    }

     function delete_user($user_id){

         $this->db->where('fk_user_id',$user_id);
         $query = $this->db->get('shop');
         if ($query->num_rows() > 0){
             return array('message'=>'This user has shop','success'=>false);
         }

        $this->db->where('user_id', $user_id);
        $result=$this->db->delete('users');
        return $result;
    }
}
?>