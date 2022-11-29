<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin_controller extends MY_Controller {

public function __construct() {
	parent::__construct();
	$this->load->model('Admin_model','admin');
}

public function index(){
	$session=$this->session->userdata();
	$this->slug='user';
	$data['access_level']=$this->cnc_model->getData('access_level','*');
	if ($session['access']['user']['access_view'])
		$this->load('user',$data);
	else
		$this->load('denied');
}

public function userAccess($access_level = 0){

   	$data = array();      
   	$access_level = $this->input->get();

   	$userRole = !empty($access_level['userRole']) ? $access_level['userRole'] :$this->session->userdata('access_level_id');
   	if(!empty($userRole)){
        $join = array(
            array(
                "table" => 'access_level',
                "on" => 'access_level.access_level_id = access.access_level_id'
            ),
            array(
                "table" => 'module',
                "on" => 'module.module_id = access.access_module_id'
            )
        );
        $data['access'] = $this->cnc_model->getData('access',array('access_id','access.access_level_id','access.access_module_id','access_view','access_insert','access_update','access_delete','access_level_name','module_name'),array('access.access_level_id' => $userRole),$join);
   	}
   	$data['access_level'] = $this->cnc_model->getData('access_level','*',false,false,'access_level_id','ASC');
    //echo '<pre>';
    //print_r($data);die();
   	//die();
   	$this->slug='userAccess';
   	$session=$this->session->userdata();
  	if ($session['access']['userAccess']['access_view'])
  		$this->load('userAccess',$data);
  	else
  		$this->load('denied');
}

public function userAccessEdit($access_id = 0){
      $data = array();
      
      $join = array(
            array(
                "table" => 'module',
                "on" => 'module.module_id = access.access_module_id'
            ),
            array(
                "table" => 'access_level',
                "on" => 'access_level.access_level_id = access.access_level_id'
            )
        );
      $data['accessEdit'] = $this->cnc_model->getData('access',array('access.*','module.module_name','access_level.access_level_name'),array('access.access_id' => $access_id),$join);
      //$this->template->view(frontend_view() . 'access/edit',$data);
        $this->slug='userAccess';
  		$this->load('userAccessEdit',$data);
       
  }

  public function userAccessUpdate($access_id = 0){
    $accessData = $this->input->post();
    //print_r($accessData);die();
    $access_level_id =  isset($accessData['access_level_id']) ? $accessData['access_level_id']: 0;
    $accessDataArray = array(
        'access_view' =>  isset($accessData['access_checkbox']) ? $accessData['access_checkbox']: 0,
        'access_insert' => isset($accessData['insert_checkbox']) ? $accessData['insert_checkbox']: 0,
        'access_update' => isset($accessData['update_checkbox']) ? $accessData['update_checkbox']: 0,
        'access_delete' => isset($accessData['delete_checkbox']) ? $accessData['delete_checkbox']: 0,
    );
    $update =  $this->cnc_model->rowUpdate('access',$accessDataArray,array('access_id' => $access_id ));
    if($update == true){
        $this->session->set_flashdata("success","User access updated successfully");
    }
    redirect("userAccess/?userRole=$access_level_id");
  }

public function add_user(){
 	$post=$this->input->post();
 	if (!empty($post)) {
 		$hashed_password   = password_hash($post['password'], PASSWORD_DEFAULT);
 		$post['password']  = $hashed_password;
 		$post['user_name'] = $post['email'];
 		$post['created_at']= date('Y-m-d H:i');	
 		$res=$this->cnc_model->rowInsert('user',$post);
 		$this->session->set_flashdata("success","User added successfully");
 		redirect('user');
 	}else{
 		$this->session->set_flashdata("error","All fields are required");
 		redirect('user');
 	}
}

public function update_user(){
	$id=$this->input->post('id');
	$post=$this->input->post();
	$post['user_name']=$post['email'];
	unset($post['id']);
	$this->cnc_model->rowUpdate('user',$post,['id'=>$id]);
	$this->session->set_flashdata("success","User updated successfully");
 	redirect('user');
}

public function get_user(){
	 	
	 	$sLimit = "";
        $lenght = $_GET['iDisplayLength'];
        $str_point = $_GET['iDisplayStart'];
        
        $col_sort = array("id", "name", 'email', 'al.access_level_name',  'created_at');
		
		$order_by = "id";
        $order = 'asc';
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

        $join=array(
        		array('table'=>'access_level al',
        			'on'=>'al.access_level_id=u.access_level_id',
        			)
        	);

       	$result = $this->cnc_model->getData('user u','u.*,al.access_level_name as account',$where,$join,$order_by,$order,$lenght,$str_point);
        
        $total_record = $this->cnc_model->getRowCount('user u','*',$where,$join,$order_by,$order);
        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );
        
        $i=1;
		$session=$this->session->userdata();
        foreach ($result as $key=>$val) {
        	if ($val['access_level_id']>1) {
    		 	$action='';
    			if ($session['access']['user']['access_update']){
        			$action='<button type="button" data_id="'.$val['id'].'" class="edit yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-edit"></i></button>
        				<button type="button" data_id="'.$val['id'].'" class="change_password yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-key"></i></button>';
    			}
				if ($session['access']['user']['access_delete'])
    				$action.='<button type="button" data_id="'.$val['id'].'" class="delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';
        	
    			if (empty($action))
    				$action='<button title="Not Authorized" type="button" data_id="'.$val['id'].'" class="red btn-circle btn-sm btn" href="javascript:;"> <i class="fa fa-ban" ></i>  Not Authorized</button>';		
    			
    			$output['aaData'][]=array(($i),
	            		$val['name'],
	            		$val['email'],
	            		$val['account'],
	            		date('m-d-Y H:i',strtotime($val['created_at'])),
	            		$action,
				);
				$i++;	
        	}
        }
        echo json_encode($output);
        die;
}

public function delete_user(){
	$id=$this->input->post('id');
	$this->cnc_model->rowsDelete('user',array('id'=>$id));
	$this->session->set_flashdata('success', 'User Successfully Deleted');
	echo "true";
}

public function getUserById(){
	$id=$this->input->post('id');
	$res=$this->cnc_model->getData('user','*',['id'=>$id]);
	echo json_encode($res[0]);die();
}

public function change_password(){
	$post=$this->input->post();
	if (!empty($post)){
		$hashed_password   = password_hash($post['password'], PASSWORD_DEFAULT);
		$this->cnc_model->rowUpdate('user',['password'=>$hashed_password],['id'=>$post['id']]);
		$this->session->set_flashdata('success', 'Password changed Successfully');
	}
	redirect('user');
}

public function check_email(){	
	$email=$this->input->post('email');
	$id=$this->input->post('id');
	if (empty($id)) {
		$res=$this->cnc_model->getData('user','*',['email'=>$email]);
	}else{
		$res=$this->admin->is_email_exist($id,$email);
	}
	if (!empty($res))
		echo 'false';
	else
		echo "true";

	die();
}

}




