<?php
class Admin_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function is_email_exist($id,$email){
        $this->db->where('email',$email);
        $this->db->where_not_in('id',$id);
        return $this->db->get('user')->result_array();
    }

   
}
 