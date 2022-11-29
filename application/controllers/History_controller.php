<?php

defined('BASEPATH') or exit('No direct script access allowed');

class History_controller extends MY_Controller {

    public function __construct() {
    	parent::__construct();
    	$this->load->model('History_model','history');
    }

    public function viewHistory(){
    	$this->slug='history';
    	$this->load('history/history');
    }

    public function get_history(){
    	 	
    	$sLimit = "";

        $lenght = $_GET['iDisplayLength'];
        $str_point = $_GET['iDisplayStart'];
        
        $col_sort = array("id",'action','col_name','description','table_id','user_roll','created_at','updated_at');

  		$select="id,table_id,col_name,description,action,old_value,new_value,user_roll,created_at,updated_at";
		
		$order_by = "id";
        $order = 'desc';
        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $order = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $where = '';
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];

            $where = '( ';
            for ($i = 0; $i < count($col_sort); $i++) {

                $where .= "$col_sort[$i] REGEXP '$words'";

                if ($i + 1 != count($col_sort)) {
                    $where .= " OR ";
                }
            }
            $where .= ') ';
        }
        if ($where != "") {
            $where .= " AND ";	
        }
        $where .= "(id REGEXP id)";

        $result = $this->cnc_model->getDatanew('history',$select,$where,$order_by,$order,$lenght,$str_point);
        $total_record = $this->cnc_model->getRowCountnew('history',$select,$where,$order_by,$order);

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );
        
        $session=$this->session->userdata();
		
		foreach ($result as $key=>$val) {
        	$action='';
	
			if ($session['access']['history']['access_delete'])
				$action.='<button type="button" data_id="'.$val['id'].'" class="delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';
    	
			if (empty($action))
				$action='<button title="Not Authorized" type="button" data_id="'.$val['id'].'" class="red btn-circle btn-sm btn" href="javascript:;"> <i class="fa fa-ban" ></i>  Not Authorized</button>';	
            $button='';
            if($val['action'] == 'delete'){
             $button='<button  type="button" class=" label-danger btn-sm btn input-circle "  href="javascript:;">delete</button>';
            }
            if($val['action'] == 'new'){
             $button='<button  type="button" class=" label-success btn-sm btn input-circle"  href="javascript:;">new</button>';
            }
            if($val['action'] == 'edit'){
             $button='<button  type="button" class=" label-info btn-sm btn input-circle"  href="javascript:;">edit</button>';
            }


            $output['aaData'][]=array(($key+1),
            		
            		$button,
            		$val['table_id'],
                    $val['col_name'],
            		$val['description'],
                    $val['user_roll'],
            		date('m-d-Y H:i',strtotime($val['created_at'])),
            		$action,
				);
        }
        echo json_encode($output);
        die;
    }

    public function checkRecord(){
    	$this->slug='history';
    	$this->load('history/checkrecord');
    }

    public function get_record(){
    	 	
	 	$sLimit = "";

        $lenght = $_GET['iDisplayLength'];
        $str_point = $_GET['iDisplayStart'];
        
        $col_sort = array('id','number','time_checked');

  		$select="id,number,time_checked";
		
		$order_by = "id";
        $order = 'desc';
        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $order = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $where = '';
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];

            $where = '( ';
            for ($i = 0; $i < count($col_sort); $i++) {

                $where .= "$col_sort[$i] REGEXP '$words'";

                if ($i + 1 != count($col_sort)) {
                    $where .= " OR ";
                }
            }
            $where .= ') ';
        }
        if ($where != "") {
            $where .= " AND ";	
        }
        $where .= "(id REGEXP id)";

        $result = $this->cnc_model->getDatanew('check_record_time',$select,$where,$order_by,$order,$lenght,$str_point);
        $total_record = $this->cnc_model->getRowCountnew('check_record_time',$select,$where,$order_by,$order);

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );
        
        $session=$this->session->userdata();
		
		foreach ($result as $key=>$val) {
            $output['aaData'][]=array(($key+1),
            		
            		$val['number'],
            		$val['time_checked'],
				);
        }
        echo json_encode($output);
        die;
    }

    public function delete_history(){
        $id=$this->input->post('id');
        $this->cnc_model->rowsDelete('history',array('id'=>$id));
        $this->session->set_flashdata('success', 'Records Successfully Deleted');
        echo "true";         
    }

    public function change_database(){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $customer = $this->cnc_model->getData('customer','*');
    
        if(!empty($customer)){

            foreach ($customer as $key => $value) {
                $data = $this->cnc_model->getData('history','*',['description'=>'new customer added','table_id'=>$value['id']]);
                
                if(!empty($data)){
            
                   $cust_id = $this->cnc_model->rowUpdate('customer',['created_by'=>$data[0]['user_id'],'role'=>$data[0]['user_roll']],array('id'=>$data[0]['table_id']));
                   
                }
                
            }  
        }
    }

}