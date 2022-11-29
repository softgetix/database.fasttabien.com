<?php
class History_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getdata($tablename,$where){
    			$this->db->where($where);
        $query = $this->db->get($tablename);
        if($query){
    	   return $query->result_array();
        }	
    }

    public function insertdata($tablename,$data){
        $query = $this->db->insert($tablename,$data);

        if($query){
    	   return true;
        }	
    }

    public function update_record_time($tablename,$data,$where){
        $query = $this->db->where($where)
                 		  ->update($tablename,$data);
        if ($query) {
            $affected_rows = $this->db->affected_rows();
            return  $affected_rows;
        } else {
            return false;
        }
   
    }
    
}
 