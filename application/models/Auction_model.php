<?php
class Auction_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function rowInsert($tablename, $data) {

        $query = $this->db->insert($tablename, $data);

        if ($query) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    public function rowsDelete($tablename, $where) {

        if ($this->db->delete($tablename, $where)) {

            return true;
        } else {
            return false;
        }
    }

    public function getdata($tablename,$where){
                $this->db->where($where);
        $query = $this->db->get($tablename);
        if($query){
           return $query->result_array();
        }   
    }
    
}
 