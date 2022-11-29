<?php
class Customer_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function is_chassis_exist($id,$chessis){
        $this->db->where('chassis',$chessis);
        $this->db->where_not_in('id',$id);
        return $this->db->get('customer')->result_array();
    }
    function is_brand_id_exist($id,$brand_id){
        $this->db->where('brand_id',$brand_id);
        $this->db->where_not_in('id',$id);
        return $this->db->get('customer')->result_array();
    }
    function is_customer_number_exist($number){
        $this->db->where('number',$number);
        return $this->db->get('customer_number')->result_array();
    }

    public function getdata($tablename,$where){
                $this->db->where($where);
        $query = $this->db->get($tablename);
        if($query){
           return $query->result_array();
        }   
    }

    public function rowUpdate($tablename,$data,$where){
        $query = $this->db->where($where)
                          ->update($tablename,$data);
        if ($query) {
            $affected_rows = $this->db->affected_rows();
            return  $affected_rows;
        } else {
            return false;
        }
   
    }
    // public function table_field($tablename){
    //     $fields = $this->db->list_fields($tablename);
    //     return  $fields;
    // }
}
 