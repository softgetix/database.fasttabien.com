<?php

ini_set('memory_limit', '-1');
ini_set ( 'max_execution_time', 0);

defined('BASEPATH') or exit('No direct script access allowed');

class Customer_controller extends MY_Controller {

function __construct() {
	parent::__construct();
	$this->load->model('Customer_model','customer');
	$this->load->helper('date');	
}

function addCustomer(){
	$this->slug='customer';
	$this->sub_menu='addCustomer';
	$car_name['car_names'] =$this->cnc_model->getData('car_names','*');
	$this->load('customer/addCustomer',$car_name);
}

function check_add_number($name,$number){
	$this->slug='customer';
	$this->sub_menu='addCustomer';
    $check_number['check_number']=array('name' => $name,'number'=>$number);
    $check_number['car_names'] =$this->cnc_model->getData('car_names','*');
	$this->load('customer/addCustomer',$check_number);
}

function viewCustomer(){
	$this->slug='customer';
	$this->sub_menu='viewCustomer';
    $table_clm['clm_name'] = get_clm('customer');
	$this->load('customer/viewCustomer',$table_clm);
}

function newcases(){
	$this->slug='customer';
	$this->sub_menu='newcases';
	$this->load('customer/newCases');
}


function is_chassis_exist(){
	$chassis=$this->input->post('chassis');
	$id=$this->input->post('id');
	if (empty($id)) {
		$res=$this->cnc_model->getData('customer','*',['chassis'=>$chassis]);
	}else{
		$res=$this->customer->is_chassis_exist($id,$chassis);
	}
	if (!empty($res))
		echo 'false';
	else
		echo "true";

	die();
}

function is_brand_id_exist(){
	$brand_id=$this->input->post('brand_id');
	$id=$this->input->post('id');
  
	if (empty($id)) {
		$res=$this->cnc_model->getData('customer','*',['brand_id'=>$brand_id]);
	}else{
		$res=$this->customer->is_brand_id_exist($id,$brand_id);
	}
	if (!empty($res))
		echo 'false';
	else
		echo "true";

	die();
}



function check_vip_number($no=''){
    if (!empty($no)) {
        $v_where = array('v.number'=>$no);
	    $v_res = $this->cnc_model->getData('vip_number v','v.*',$v_where);
        if(!empty($v_res)){
	        return true;
	    }
	    else{
	        return false;
	    }
	}
}

function check_vip_number_optional($no_array=[]){
    $flag=false;
    foreach ($no_array as $key => $value) {
		if (!empty($value)) {
            $v_where = array('v.number'=>$value);
	        $v_res = $this->cnc_model->getData('vip_number v','v.*',$v_where);
            if(!empty($v_res)){
	        	$flag=true;
	        }
	    }
	}
	return $flag;
}

function create_group($cat=[],$no=[],$cat_array=[],$no_array=[]){
	
	$new_array[]=array('cat' =>$cat ,'no' =>$no);
   
	foreach ($cat_array as $key => $value) {

        if (!empty($value) && !empty($no_array[$key])) {
        	$category = $value;
        	$number = $no_array[$key];
            $new_array[]=array('cat' =>$category ,'no' =>$number);
        }
    }
    return $new_array;
}

function create_group_for_edit($cat=[],$no=[],$cat_array=[],$no_array=[]){
	
	if(!empty($cat) && !empty($no)){
		$new_array[1]=array('cat' =>$cat ,'no' =>$no);
	}
	foreach ($cat_array as $key => $value) {

        if (!empty($value) && !empty($no_array[$key])) {
        	$category = $value;
        	$number = $no_array[$key];
            $new_array[($key+2)]=array('cat' =>$category ,'no' =>$number);
        }
    }
    return $new_array;
}


function check_number($type,$new_array=[],$cust_id=0){

    if($this->has_dupes($new_array))
		return false;

	$flag = true;
   	$clm_count=get_clmno_count('customer')/2;

        foreach ($new_array as $key => $value) {
            
            for($i=1; $i <= $clm_count; $i++){
              
				$this->db->or_group_start();
                	$this->db->where('cat'.$i,$value['cat']);
	          		$this->db->where('no'.$i,$value['no']);
	          		$this->db->where('status =','in progress');
					if($i==($key) && $type=="edit")
						$this->db->where_not_in('id',$cust_id);
	          	$this->db->group_end();
	          
            } 
          
            $result=$this->db->get('customer')->result_array();
           /* print_r($this->db->last_query());*/
            if(!empty($result))
            	$flag = false;  
        }
        // die('ok');
        return $flag; 
}

function has_dupes($array)  
{  	
	$group_arr=[];
	foreach ($array as $key => $value) {
		$group_arr[]['group']=$value['cat'].$value['no'];
	}
	$unique_arr = array_unique($group_arr,SORT_REGULAR);  
		
	if(count($array) != count($unique_arr))
		return true;
	else
		return false;			
}

function js_validate_no(){

	$post =$this->input->post();

	if($post['type']=='edit')
		$id = $post['id'];
	
	else
		$id = 0;

	$data['status']=true;
	$data['msg']='Number is new';

	if(!empty($post['no1'])){
       	$vip_number = $this->check_vip_number($post['no1']);
			if($vip_number){
				$data['status']=false;
				$data['msg']='Warning! Vip Number'; 	
			}
	}
	if(!empty($post['no_optional'])){
		$vip_number = $this->check_vip_number_optional($post['no_optional']);
      	if($vip_number){
			$data['status']=false;
			$data['msg']='Warning! Vip Number'; 	
		}
	}
	if($post['type']=='edit')
		$new_group=$this->create_group_for_edit($post['cat1'],$post['no1'],$post['cat_optional'],$post['no_optional']);	
	else
		$new_group=$this->create_group($post['cat1'],$post['no1'],$post['cat_optional'],$post['no_optional']);
	/*print_r($new_group);die('ok');*/
	if (!$this->check_number($post['type'],$new_group,$id)) {
		$data['status']=false;
		$data['msg']='Warning! Duplicate Number';
	}

	echo json_encode($data);die();
}

function save_customer(){
	$post=$this->input->post();
    $optional_number=false;

    if (!empty($post)) {

        if(!empty($post['no1'])){
           	$vip_number = $this->check_vip_number($post['no1']);
				if($vip_number){
				    $this->session->set_flashdata('warning', 'Number is vip number');
					redirect('addCustomer');
				}
        }
           
        if(!empty($post['no_optional'])){

            $vip_number = $this->check_vip_number_optional($post['no_optional']);
           
				if($vip_number){
				    $this->session->set_flashdata('warning', 'Number is vip number');
					redirect('addCustomer');
				}
    	}

        $new_group=$this->create_group($post['cat1'],$post['no1'],$post['cat_optional'],$post['no_optional']);

		if ($this->check_number('add',$new_group)) {


            $cat_optional=$post['cat_optional'];
			$no_optional=$post['no_optional'];
			unset($post['cat_optional']);
			unset($post['no_optional']);
			
			
			$post['created_at']=date('Y-m-d H:i');
			$post['created_by']=$this->session->userdata('user_id');
			$post['role'] = $this->session->userdata('name').'('.$this->session->userdata('role').')';

          
            $i=2;
            foreach ($cat_optional as $key => $value) {
            	if (!empty($value) && !empty($no_optional[$key])) {
				
					$post['cat'.$i]			= $value;
					$post['no'.$i]			= $no_optional[$key];
                    $i++;
                 }	
			}
			
			$cust_id = $this->cnc_model->rowInsert('customer',$post);

			if($post['status']=='completed'){

			   $data = array('cust_id'=>$cust_id,'chat_name'=>$post['chat_name'],'completed_date'=>date('Y-m-d H:i'));
			  $winning_cust_id = $this->cnc_model->rowInsert('winning_number',$data);
            }

			$username=$this->session->userdata('name').'('.$this->session->userdata('role').')';
             $this->cnc_model->rowInsert('history',array('action'=>'new','table_id'=>$cust_id,'user_roll'=>$username,'user_id'=>$this->session->userdata('user_id'),'col_name'=>"customer",'description'=>"new customer added","created_at"=>date('Y-m-d H:i')));


			$this->session->set_flashdata('success', 'Customer added successfully');
			 	redirect('viewCustomer');

		}else
			$this->session->set_flashdata('warning', 'Warning! Duplicate');
			 	redirect('addCustomer');
	}else
		$this->session->set_flashdata('error', 'All fields are required');
			 	redirect('addCustomer');
}

function get_customer(){

	$filter_by_day = $this->input->post('filter_by_day');
	$status = $this->input->post('status');
	$seession[] = $this->input->post('seession');
	$case_search = $this->input->post('case_search');

    $sLimit = "";
    $lenght = $_POST['iDisplayLength'];
    $str_point = $_POST['iDisplayStart'];
    
    if(empty($seession[0])){

       $col_sort = array('c.id','c.status','c.created_at','c.chat_name','c.type','c.price','c.car_type','c.customer_name','c.brand_id','c.chassis','c.brand','c.phone','c.role','c.updated_at','c.cat1','c.no1');
      
        $table_clm['clm_name'] = get_clm('customer');
        for($i=17; $i < count($table_clm['clm_name']); $i++){
			 $col_sort[] = $table_clm['clm_name'][$i];
	    }
    }
    else{

        $table_clm['clm_name'] = get_clm('customer');
        $col_sort = explode(',',$seession[0]);
    }

	$select = "al.access_level_name,u.name,c.*";
        
    $join = array(
            array(
                "table" => 'user as u',
                "on" => 'u.id = c.created_by'
            ),
            array(
                "table" => 'access_level as al',
                "on" => 'al.access_level_id = u.access_level_id'
            )
        );
	
	$order_by = "c.id";
    $order = "desc";

    if (isset($_POST['iSortCol_0'])) {
        $index = $_POST['iSortCol_0'];
        $order = $_POST['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
        if(!empty($seession[0]))
        	$order_by = 'c.'.$col_sort[$index];
        else
        	$order_by = $col_sort[$index];
    }

    $where = '';

    if (isset($_POST['sSearch']) && $_POST['sSearch'] != "") {
        $words = $_POST['sSearch'];
		$where = '( ';
		
	        for ($i = 0; $i < count($col_sort); $i++) {
	        	if(!empty($seession[0]))
	            $where .= 'c.'."$col_sort[$i] REGEXP '$words'";
	         else
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

    $where .= "(c.id REGEXP c.id)";

    if($status == 'on'){
      $where .= "AND (c.status ='in progress')";
    }

    if(!empty($case_search)){
       $where .= "AND (c.id = ".$case_search.")";
    }

	if($filter_by_day == "today"){

	  $result = [];	

      $curr_date = date("Y-m-d");

      $auction_list = $this->cnc_model->getData('auction_list','*',['auction_date'=>$curr_date]);

        if (!empty($auction_list)) {
      	  $result = $this->get_auction_number($auction_list,$select,$where,$join,$order_by,$order,$lenght,$str_point);
        }
    }

    elseif($filter_by_day == "yesterday"){

    	$result = [];

    	$yesterday = date("Y-m-d",strtotime("-1 days"));

    	$auction_list = $this->cnc_model->getData('auction_list','*',['auction_date'=>$yesterday]);

        if (!empty($auction_list)) {
      	  $result = $this->get_auction_number($auction_list,$select,$where,$join,$order_by,$order,$lenght,$str_point);
        }
    }
    elseif($filter_by_day == "tomorrow"){

    	$result = [];

    	$tomorrow = date("Y-m-d",strtotime("+1 days"));

    	$auction_list = $this->cnc_model->getData('auction_list','*',['auction_date'=>$tomorrow]);

        if (!empty($auction_list)) {
      	  $result = $this->get_auction_number($auction_list,$select,$where,$join,$order_by,$order,$lenght,$str_point);
        }
    }
    elseif($filter_by_day == "next 7days from yesterday"){

    	$result = [];
    	$yesterday = date("Y-m-d",strtotime("-1 days"));
    	$next_7days = date("Y-m-d",strtotime("+6 days"));

    	$auction_list = $this->cnc_model->getData('auction_list','*',['auction_date <=' => $next_7days,'auction_date >=' => $yesterday ]);

        if (!empty($auction_list)) {
      	  $result = $this->get_auction_number($auction_list,$select,$where,$join,$order_by,$order,$lenght,$str_point);
        }
    }
    else{
    	$result = $this->cnc_model->getData('customer as c',$select,$where,$join,$order_by,$order,$lenght,$str_point);
    }
    
    $total_record = $this->cnc_model->getRowCount('customer as c',$select,$where,$join,$order_by,$order);
  
    $output = array(
        "sEcho" => 0,
        "iTotalRecords" => $total_record,
        "iTotalDisplayRecords" => $total_record,
        "aaData" => array()
    );

    $session = $this->session->userdata();
	$i = 0;
	foreach ($result as $key => $val) {

        $updated_date =! empty($val['updated_at'])?date('m-d-Y H:i',strtotime($val['updated_at'])):'Not updated';

        $action = '';
        
        $action.='<a><button type="button"  data_id="'.$val['id'].'" class="copy yellow-casablanca btn-circle btn-sm btn"><i class="fa fa-copy" href="javascript:;"></i></button></a>';

		if ($session['access']['viewCustomer']['access_update']){
			$action.='<a href='.base_url("editCustomer/".$val['id']."").'><button  type="button"  data_id="'.$val['id'].'" class=" edit yellow-casablanca btn-circle btn-sm btn"><i class="fa fa-edit" href="javascript:;"></i></button></a>';
		}
		if ($session['access']['viewCustomer']['access_delete']){
			$action.='<button type="button" data_id="'.$val['id'].'" class="delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';

		    $action.='<button type="button" data_id="'.$val['id'].'" class="multiple_delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;">Remove Number</button>';
		}

		$action.='<a><button type="button"  data_id="'.$val['id'].'" class="change_chatname yellow-casablanca btn-circle btn-sm btn"><i class="fa fa-user" href="javascript:;"></i></button></a>';
	
		if (empty($action))
			$action = '<button title="Not Authorized" type="button" data_id="'.$val['id'].'" class="red btn-circle btn-sm btn" href="javascript:;"> <i class="fa fa-ban" ></i>  Not Authorized</button>';

            $button = '';

			if($val['status'] == 'in progress'){
                $button = '<button  type="button" class="label-warning btn-sm btn input-circle"  href="javascript:;">in progress</button>';
			}
			if($val['status'] == 'completed'){
                $button = '<button  type="button" class="label-success btn-sm btn input-circle"  href="javascript:;">completed</button>';
			}
			if($val['status'] == 'cancel'){
                $button = '<button  type="button" class="label-danger btn-sm btn input-circle"  href="javascript:;">cancel</button>';
			}
			if($val['status'] == 'waiting'){
                $button = '<button  type="button" class="label-info btn-sm btn input-circle"  href="javascript:;">waiting</button>';
			}
			if($val['no1'] == 0){
               $no1 = '';
            }
            else{
            	$no1 = $val['no1'];
            }

            if($val['name'] && $val['access_level_name']){
               $role = $val['name'].'('. $val['access_level_name'].')';
            }else{
            	$role="Not Authorized";
            }

		    $customer_data = array(
        	    $action,
        		$val['id'],
        		$button,
        		date('d-m-Y H:i',strtotime($val['created_at'])),
        		$val['chat_name'],
        		$val['type'],
        		$val['price'],
        		$val['car_type'],
        		$val['customer_name'],
        		$val['brand_id'],
        		$val['chassis'],
        		$val['brand'],
        		$val['phone'],
        		$role,
        		$updated_date,
        		$val['cat1'],
        		$no1,
        	);

	    for($i=17; $i < count($val); $i++){
	     	if($i<=32){
                $number = $val[$table_clm['clm_name'][$i]];
				if($number != "0")
					$customer_data[] = $number;
				else
					$customer_data[]='';
		    }else{
		    	$customer_data[]='';
		    }
		}

        $output['aaData'][] = $customer_data;
    }

	echo json_encode($output);
	die;
    
}

function get_auction_number($auction_list,$select,$where,$join,$order_by,$order,$lenght,$str_point){
	$final_res=[];
	$res=[];
	$old_where = $where;
	foreach ($auction_list as $key => $value) {
		$where2 ='';
		$clm=get_clm('customer');
		$where2.=" AND ( ";
		for($i=15; $i < count($clm); $i++){
			$flag=false;
			if (strpos($clm[$i],'cat') !== false) {
		    	$where2.=" ( ($clm[$i] = '".$value['category']."' OR $clm[$i] = '".'xx'."')";
			}
			if (strpos($clm[$i],'no') !== false) {
		    	$where2.=" and ( $clm[$i] >= $value[start_number] and  $clm[$i] <= $value[end_number]) ) ";
		    	$flag=true;
			}
			if ($i+1 != count($clm) && $flag) {
			    $where2 .= " OR ";
		    }
		}
		$where2.=" ) ";
        $where = $old_where .$where2;
		$res=$this->cnc_model->getData('customer as c',$select,$where,$join,$order_by,$order,$lenght,$str_point);
		$final_res=array_merge ($final_res, (array)$res);
	}
	$final_res=array_unique($final_res,SORT_REGULAR);
	return $final_res;
}

function delete_customer(){
	$id=$this->input->post('id');

	$delete_Customer=$this->customer->getData('customer',['id'=>$id]);
    $customer_name=$delete_Customer[0]['customer_name'];

    $username=$this->session->userdata('name').'('.$this->session->userdata('role').')';
        $this->cnc_model->rowInsert('history',array('action'=>'delete','table_id'=>$id,'user_roll'=>$username,'user_id'=>$this->session->userdata('user_id'),'description'=>$customer_name."(Deleted)","created_at"=>date('Y-m-d H:i')));

	$this->cnc_model->rowsDelete('customer',array('id'=>$id));
	$this->session->set_flashdata('success', 'Customer Successfully Deleted');
	echo "true";		 
}



function editCustomer($id){
	 $res["result"]=$this->customer->getData('customer',['id'=>$id]);
	 $res['car_names'] =$this->cnc_model->getData('car_names','*');
	 $this->slug='customer';
	 $this->load('customer/updateCustomer',$res);
}

function update_customer(){
	$post=$this->input->post();

    $optional_number=false;	
	if (!empty($post)) {

		if(!empty($post['no1'])){
           	$vip_number = $this->check_vip_number($post['no1']);
				if($vip_number){
				    $this->session->set_flashdata('warning', 'Number is vip number');
					redirect('viewCustomer');
				}
        }

        if(!empty($post['no_optional'])){

            $vip_number = $this->check_vip_number_optional($post['no_optional']);
           
				if($vip_number){
				    $this->session->set_flashdata('warning', 'Number is vip number');
					redirect('viewCustomer');
				}
    	}

    	$new_group=$this->create_group_for_edit($post['cat1'],$post['no1'],$post['cat_optional'],$post['no_optional']);

    	if ($this->check_number("edit",$new_group,$post['id'])) {
     		
     		$this->history_insert($post);

			$cat_optional=$post['cat_optional'];
            $no_optional=$post['no_optional'];
			unset($post['cat_optional']);
			unset($post['no_optional']);
			unset($post['cat1']);
			unset($post['no1']);
				
			$post['updated_at']	= date('Y-m-d H:i');

            foreach ($new_group as $key => $value) {
            	
            	if (!empty($value['cat']) && !empty($value['no'])) {

					$post['cat'.$key]			= $value['cat'];
					$post['no'.$key]			= $value['no'];
                       	
			    }
			}

	    $cust_id=$this->customer->rowUpdate('customer',$post,array('id'=>$post['id']));
	   
	    if($post['status']=='completed'){

			$data = array('cust_id'=>$post['id'],'chat_name'=>$post['chat_name'],'completed_date'=>date('Y-m-d H:i'));
			if(empty($this->cnc_model->getData('winning_number','*',['cust_id'=>$post['id']]))){
				$winning_cust_id = $this->cnc_model->rowInsert('winning_number',$data);
			}
			else{
				$winning_cust_id = $this->cnc_model->rowUpdate('winning_number',['chat_name'=>$post['chat_name']],['cust_id'=>$post['id']]);
			}
        }

		$this->session->set_flashdata('success', 'Customer updated successfully');
			 	redirect('viewCustomer');

		}else
		 	$this->session->set_flashdata('warning', 'Warning! Duplicate');
		 	 	redirect('viewCustomer');
	}else
		$this->session->set_flashdata('error', 'All fields are required');
			 	redirect('viewCustomer');
}


public function history_insert($data){

	$old_res=$this->customer->getData('customer',['id'=>$data['id']]);

	$old_status=$old_res[0]['status'];
	/*$old_chat_name=$old_res[0]['chat_name'];*/
	$old_type=$old_res[0]['type'];
	$old_price=$old_res[0]['price'];
	$old_car_type=$old_res[0]['car_type'];
	$old_customer_name=$old_res[0]['customer_name'];
	$old_brand_id=$old_res[0]['brand_id'];
	$old_chassis=$old_res[0]['chassis'];
	$old_brand=$old_res[0]['brand'];
	$old_phone=$old_res[0]['phone'];
	$old_cat1=$old_res[0]['cat1'];
    $old_no1=$old_res[0]['no1'];

    if($old_status != $data['status']){
       $this->insertToHistory($data,$old_status,$data['status'],'status');
	}
	/*if($old_chat_name != $data['chat_name']){
       $this->insertToHistory($data,$old_chat_name,$data['chat_name'],'chat_name');
	}*/
	if($old_type != $data['type']){
       $this->insertToHistory($data,$old_type,$data['type'],'type');
	}
	if($old_price != $data['price']){
       $this->insertToHistory($data,$old_price,$data['price'],'price');
	}
	if($old_car_type != $data['car_type']){
       $this->insertToHistory($data,$old_car_type,$data['car_type'],'car_type');
	}
	if($old_customer_name != $data['customer_name']){
       $this->insertToHistory($data,$old_customer_name,$data['customer_name'],'customer_name');
	}
	if($old_brand_id != $data['brand_id']){
       $this->insertToHistory($data,$old_brand_id,$data['brand_id'],'brand_id');
	}
	if($old_chassis != $data['chassis']){
       $this->insertToHistory($data,$old_chassis,$data['chassis'],'chassis');
	}
	if($old_brand != $data['brand']){
       $this->insertToHistory($data,$old_brand,$data['brand'],'brand');
	}
	if($old_phone != $data['phone']){
       $this->insertToHistory($data,$old_brand,$data['phone'],'phone');
	}
	if($old_cat1 != $data['cat1']){
       $this->insertToHistory($data,$old_cat1,$data['cat1'],'cat1');
	}
	if($old_no1 != $data['no1']){
       $this->insertToHistory($data,$old_no1,$data['no1'],'no1');
	}

	$clm = get_clm('customer');
    $cat_optional = $data['cat_optional'];
    $no_optional = $data['no_optional'];
   
    $c=0;
    $n=0;
    
    for($i=17; $i < count($old_res[0]); $i++) {

        $old_number = $old_res[0][$clm[$i]];
        
        if (!empty($cat_optional[$c])) {
            if(strpos($clm[$i],'cat')!== false ){
        	    if($i%2 != 0){
	     	        if($old_number != $cat_optional[$c]){

	                   $this->insertToHistory($data,$old_number,$cat_optional[$c],$clm[$i]);
	                }
            	    $c++;  
	            }
            }     	
        }

        if(!empty($no_optional[$n])){
         	if(strpos($clm[$i],'no')!==false){
         		if($i%2 == 0){
		            if($old_number != $no_optional[$n])
		            {
					   $this->insertToHistory($data,$old_number,$no_optional[$n],$clm[$i]);
		            }
		            $n++; 
		        }
	        }
        }
    }
   
}

public function insertToHistory($newdata,$old_value,$new_value,$col_name){
	
	$username=$this->session->userdata('name').'('.$this->session->userdata('role').')';
    $this->cnc_model->rowInsert('history',array('action'=>'edit','table_id'=>$newdata['id'],'user_roll'=>$username,'user_id'=>$this->session->userdata('user_id'),'col_name'=>$col_name,'old_value'=>$old_value,'new_value'=>$new_value,'description'=>$old_value.">>".$new_value,"created_at"=>date('Y-m-d H:i')));
}


function multiple_delete_number(){
	$id=$this->input->post('id');
    $res=$this->customer->getData('customer',['id'=>$id])[0];
    $clm_count=get_clmno_count('customer')/2;

    for ($i=1; $i <= $clm_count ; $i++) { 
    	if(!empty($res['cat'.$i]))
    	$array['data'][]=['cat'.$i=>$res['cat'.$i],'no'.$i=>$res['no'.$i],'number'=>$i];
    }
    $array['id'] =$res['id'];
    echo json_encode($array);die();

}

function remove_clm_data(){
	$id = $this->input->post('id');
	$clm = $this->input->post('clm');
	$catg = $this->input->post('catg');
	$number = $this->input->post('number');

    $username = $this->session->userdata('name').'('.$this->session->userdata('role').')';

    $this->cnc_model->rowInsert('history',array('action'=>'delete','table_id'=>$id,
    	'col_name'=>'cat'.$clm.' and no'.$clm,'user_roll'=>$username,'user_id'=>$this->session->userdata('user_id'),'description'=>$catg ." and " .$number ." (Deleted) ","created_at"=>date('Y-m-d H:i')));

    $where = array('cat'.$clm => '' ,'no'.$clm => 0 );
	$this->customer->rowUpdate('customer',$where,array('id'=>$id));
	$this->session->set_flashdata('success', 'Number removed Successfully');
	echo "true";die();  
}

function create_group_for_delete($clm_array=[],$cat_array=[],$no_array=[]){

	$new_array = [];

	foreach ($clm_array as $key => $value) {
		$new_array[$key]['clm'] =  $value;
    }
    foreach ($cat_array as $key1 => $value1) {
		$new_array[$key1]['cat'] = $value1;
	}
	foreach ($no_array as $key2 => $value2) {
	   $new_array[$key2]['no'] = $value2;
	}
    return $new_array;
}


function remove_all_clm_data(){
    $id = $this->input->post('id');
    $clm = explode(",",$this->input->post('clm'));
    $catg = explode(",",$this->input->post('catg'));
    $num = explode(",",$this->input->post('num'));

    $allcombines = $this->create_group_for_delete($clm,$catg,$num);

    $username = $this->session->userdata('name').'('.$this->session->userdata('role').')';

    foreach($allcombines as $colm){

       $this->cnc_model->rowInsert('history',array('action'=>'delete','table_id'=>$id,
    	'col_name'=>'cat'.$colm['clm'].' and no'.$colm['clm'],'user_roll'=>$username,'user_id'=>$this->session->userdata('user_id'),'description'=> $colm['cat'] ." and " .$colm['no'] ." (Deleted) ","created_at"=>date('Y-m-d H:i')));

    	$where = array('cat'.$colm['clm'] => '' ,'no'.$colm['clm'] => 0 );
    	$this->customer->rowUpdate('customer',$where,array('id'=>$id));

    }

    $this->session->set_flashdata('success', 'Number removed Successfully');
    echo "true";die();
}

public function viewnumber_list($id){
	$res["result"]=$this->customer->getData('customer',['id'=>$id]);
    $this->slug='customer';
	$this->load('customer/viewnumber_list',$res);

}

public function get_listnumber($id){
	$today=$this->input->get('today');

	$sLimit = "";

    $lenght = $_GET['iDisplayLength'];
    $str_point = $_GET['iDisplayStart'];
    
    $col_sort = array("n.id",'c.customer_name','c.status','n.category','n.number');
  		
	$select="n.id,n.category,n.number,c.status,c.customer_name";
	
	$order_by = "n.id";
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
    $where .= "(n.id REGEXP n.id)";

    $where.="AND (c.id = $id)";
    $join=array(
        		array(
        			'table'=>'customer c',
        			'on'=>'c.id=n.cust_id',
        		)		
        	);

    if($today == "on"){

      $curr_date =date("Y-m-d");

      $where .= "AND (DATE(c.created_at) ='$curr_date')";

      $result = $this->cnc_model->getData('customer_number n',$select,$where,$join,$order_by,$order,$lenght,$str_point);

    }else{

    	$result = $this->cnc_model->getData('customer_number n',$select,$where,$join,$order_by,$order,$lenght,$str_point);
    }

    $total_record = $this->cnc_model->getRowCount('customer_number n',$select,$where,$join,$order_by,$order);

    $output = array(
        "sEcho" => 0,
        "iTotalRecords" => $total_record,
        "iTotalDisplayRecords" => $total_record,
        "aaData" => array()
    );
    
    $session=$this->session->userdata();
	
	foreach ($result as $key=>$val) {

		$updated_date=!empty($val['updated_at'])?date('m-d-Y H:i',strtotime($val['updated_at'])):'Not updated';

    	$action='';

		if ($session['access']['viewCustomer']['access_update']){
			$action.='<button type="button" data_id="'.$val['id'].'" class="edit yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-edit"></i></button>';
		}
		if ($session['access']['viewCustomer']['access_delete'])
			$action.='<button type="button" data_id="'.$val['id'].'" class="delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';
	
		if (empty($action))
			$action='<button title="Not Authorized" type="button" data_id="'.$val['id'].'" class="red btn-circle btn-sm btn" href="javascript:;"> <i class="fa fa-ban" ></i>  Not Authorized</button>';	

		$button = '';

			if($val['status'] == 'in progress'){
                $button='<button  type="button" class=" label-warning btn-sm btn input-circle"  href="javascript:;">in progress</button>';
			}
			if($val['status'] == 'completed'){
                $button='<button  type="button" class=" label-success btn-sm btn input-circle"  href="javascript:;">completed</button>';
			}
			if($val['status'] == 'cancel'){
                $button='<button  type="button" class=" label-danger btn-sm btn input-circle"  href="javascript:;">cancel</button>';
			}
			if($val['status'] == 'waiting'){
                $button='<button  type="button" class=" label-info btn-sm btn input-circle"  href="javascript:;">waiting</button>';
			}

        $output['aaData'][]=array(($key+1),
        		
        		$val['customer_name'],
        		$button,
        		$val['category'],
        		$val['number'],
        		$action,
        		
			);
    }
    echo json_encode($output);
    die;
}

function delete_customer_number(){
	$id=$this->input->post('id');
    $this->cnc_model->rowsDelete('customer_number',array('id'=>$id));
    $this->session->set_flashdata('success', 'Records Successfully Deleted');
	echo "true";		 
}

function getcustomer_Number_ByID(){
    $id=$this->input->post('id');
	$res=$this->customer->getData('customer_number',['id'=>$id]);
	$records=$res[0];
    echo json_encode($records);die();
}

function update_numberList(){
	$post=$this->input->post();
	$old_res=$this->customer->getData('customer_number',['id'=>$post['id']]);
	$old_number=$old_res[0]['number'];
	$cust_id=$old_res[0]['cust_id'];

	if (!empty($post)) {
		$id=$post['id'];
		$new_number=$post['number'];
	
		$new_res=$this->cnc_model->rowUpdate('customer_number',$post,['id'=>$id]);

        $username=$this->session->userdata('name').'('.$this->session->userdata('role').')';
         $this->cnc_model->rowInsert('history',array('action'=>'edit','table_id'=>$cust_id,'user_roll'=>$username,'user_id'=>$this->session->userdata('user_id'),'col_name'=>"number",'old_value'=>$old_number,'new_value'=>$new_number,'description'=>$old_number.">>".$new_number,"created_at"=>date('Y-m-d H:i')));


		if ($new_res) {
			$this->session->set_flashdata('success', 'Number List Updated successfully Updated');
			 redirect('viewCustomer'); 
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('viewCustomer');
		}
	}else{
		$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('viewCustomer');
	}
}

function is_customer_number_exist(){
    $number=$this->input->post('number');
    if (empty($number)) {
		$res=$this->cnc_model->getData('customer_number','*',['number'=>$number]);
    }else{
		$res=$this->customer->is_customer_number_exist($number);
	}
	if (!empty($res))
		echo 'false';
	else
		echo "true";

	die();
}


public function update_multiple_status(){

    $file=$_FILES['file'];

    if (!empty($file)) {
        $allowed = array('csv');
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (in_array($ext, $allowed)) {
            $file = fopen($file['tmp_name'],"r");
            $i=1;
            $count=0;
            
            while(! feof($file))
            {   
                $fdata = fgetcsv($file);

                if ($i >1 && is_array($fdata)) {

                    $id = $fdata[0];
                    $status = $fdata[1];

                    $new_res = $this->cnc_model->rowUpdate('customer',array('status' =>  $status,'updated_at'=> date('Y-m-d H:i')),['id'=>$id]);

                    if($status == 'completed'){

                       $cust_data = $this->cnc_model->getData('customer','*',['id'=>$id])[0];
                     
                        $data = array('cust_id'=>$cust_data['id'],'chat_name'=> $cust_data['chat_name'],'completed_date'=>date('Y-m-d H:i'));

                        if(empty($this->cnc_model->getData('winning_number','*',['cust_id'=>$cust_data['id']]))){

							$winning_cust_id = $this->cnc_model->rowInsert('winning_number',$data);
						}
						else{
							$winning_cust_id = $this->cnc_model->rowUpdate('winning_number',['chat_name'=>$cust_data['chat_name']],['cust_id'=>$cust_data['id']]);
						}  
                    }

                    $count++;
                }

               $i++;
            }

            if ($count>0) {
                
                $this->session->set_flashdata('success', $count.' Customer status change successfully');
                redirect('viewCustomer');
            }else{
                $this->session->set_flashdata('error', 'Something went wrong');
                redirect('viewCustomer');
            }
        }else{
            $this->session->set_flashdata('error', 'Please upload valid excel file');
             redirect('viewCustomer');
        }
    }else{
        $this->session->set_flashdata('error', 'File is required to upload');
             redirect('viewCustomer');
    }
}


public function customer_import(){
    $file=$_FILES['file'];

	if (!empty($file)) {
		$allowed = array('csv');
		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
		if (in_array($ext, $allowed)) {
		    $file = fopen($file['tmp_name'],"r");
            $i=1;
			$count=0;
			
			while(! feof($file))
			{	
                $fdata=fgetcsv($file);
			    if ($i >1 && is_array($fdata)) {

			        $data=[];
			        $no_optional=[];
			        $cat_optional=[];
                    $optional_number=false;

                    for($j=14; $j < count($fdata); $j++){
		                if($j%2 == 0){
		                    $no_optional[]=$fdata[$j];
	                    }
				    }

	                for($k=13; $k < count($fdata); $k++){
						if($k%2 == 1){
		                    $cat_optional[]=$fdata[$k];
		                }
					}

                    if(!empty($fdata[12])){
			           	$vip_number = $this->check_vip_number($fdata[12]);
							if($vip_number){
								if(!empty($cust_id) &&($count>0)){

			                       $this->session->set_flashdata('success', $count.' Customer successfully inserted');

			                    }
							    $this->session->set_flashdata('warning', 'Number is vip number');
								redirect('viewCustomer');
							}
			        }
			           
			        if(!empty($no_optional)){

			            $vip_number = $this->check_vip_number_optional($no_optional);
			           
							if($vip_number){
								if(!empty($cust_id) &&($count>0)){

			                       $this->session->set_flashdata('success', $count.' Customer successfully inserted');

			                    }
							    $this->session->set_flashdata('warning', 'Number is vip number');
								redirect('viewCustomer');
							}
			    	}

				    $new_group=$this->create_group($fdata[11],$fdata[12],$cat_optional,$no_optional);

		            if ($this->check_number('add',$new_group)) {

				        $L=2;
				        foreach ($cat_optional as $key => $value) {
				            if (!empty($value) && !empty($no_optional[$key])){ 
									
								$data['cat'.$L]			= $value;
								$data['no'.$L]			= $no_optional[$key];
				                $L++;
	                        }	
					    }

				    	$data['status']=$fdata[0];
				    	$data['chat_name']=$fdata[1];
				    	$data['type']=$fdata[2];
				    	$data['price']=$fdata[3];
				    	$data['car_type']=$fdata[4];
				    	$data['customer_name']=$fdata[5];
				    	$data['brand_id']=$fdata[6];
				    	$data['chassis']=$fdata[7];
				    	$data['brand']=$fdata[8];
				    	$data['phone']=$fdata[9];
				    	$data['created_at']=$fdata[10];
				    	$data['created_by']=$this->session->userdata('user_id');
		                $data['role'] = $this->session->userdata('name').'('.$this->session->userdata('role').')';
				    	$data['cat1']=$fdata[11];
				    	$data['no1']=$fdata[12];

				    	$cust_id = $this->cnc_model->rowInsert('customer',$data);
				    	if($data['status'] == 'completed'){

						  $data = array('cust_id'=>$cust_id,'chat_name'=>$data['chat_name'],'completed_date'=>date('Y-m-d H:i'));
						  $winning_cust_id = $this->cnc_model->rowInsert('winning_number',$data);
			            }			
				        $count++;
                    }
                    else{

                    	if(!empty($cust_id) &&($count>0)){

                        $this->session->set_flashdata('success', $count.' Customer successfully inserted');
                        }
                        $this->session->set_flashdata('warning', 'Warning! Duplicate');
			 		        redirect('viewCustomer');
                    }
                }

               $i++;
		    }
			if ($count>0) {
				
			    $this->session->set_flashdata('success', $count.' Customer successfully inserted');
				redirect('viewCustomer');
			}else{
				$this->session->set_flashdata('error', 'Something went wrong');
			 	redirect('viewCustomer');
			}
		}else{
			$this->session->set_flashdata('error', 'Please upload valid excel file');
			 redirect('viewCustomer');
		}
	}else{
		$this->session->set_flashdata('error', 'File is required to upload');
			 redirect('viewCustomer');
	}
}

public function get_newcases(){

    $sLimit = "";

    $lenght = $_GET['iDisplayLength'];
    $str_point = $_GET['iDisplayStart'];
    
    $total_record = $this->cnc_model->getData('customer','count(*) as date_count,DATE_FORMAT(created_at, "%Y-%m-%d") as date',false,false,'created_at','DESC',$lenght,$str_point,false,'date');

    $output = array(
        "sEcho" => 0,
        "iTotalRecords" => count($total_record),
        "iTotalDisplayRecords" => count($total_record),
        "aaData" => array()
    );
    
    foreach ($total_record as $key=>$val) {

        $query = "SELECT count(*)as source_count,source.id,source.price from (SELECT id,price FROM `customer` WHERE DATE_FORMAT(created_at, '%Y-%m-%d') = '".$val['date']."') as source group BY source.price";
         $result = $this->db->query($query)->result_array();
      
        $Facebook='';
        $Line='';
        foreach ($result as $key2 => $value) {

        	if($value['price']=='Facebook'){
        		$Facebook = $value['source_count'];
        	}

        	if($value['price']=='Line@'){
        		$Line = $value['source_count'];
        	}
        }
       

        if ($val['date']!= '0000-00-00'){
        	$date =date('d-m-Y',strtotime($val['date']));
        }
        else{
           $date ="00-00-0000";
        }


    	$output['aaData'][]=array(($key+1),
            $date,
            $val['date_count'],
            $Line,
            $Facebook,
        );
      
    }
    /*die('ok');*/
    echo json_encode($output);
    die;
}

public function newcase_by_month(){

    $sLimit = "";
    $lenght = $_GET['iDisplayLength'];
    $str_point = $_GET['iDisplayStart'];

    $total_record = $this->cnc_model->getData('customer','count(*) as date_count,DATE_FORMAT(created_at, "%m %Y") as month',false,false,'created_at','DESC',$lenght,$str_point,false,'month');

    $output = array(
        "sEcho" => 0,
        "iTotalRecords" => count($total_record),
        "iTotalDisplayRecords" => count($total_record),
        "aaData" => array()
    );
    
    foreach ($total_record as $key=>$val) {

        $query = "SELECT count(*)as source_count,source.id,source.price from (SELECT id,price FROM `customer` WHERE DATE_FORMAT(created_at, '%m %Y') = '".$val['month']."') as source group BY source.price";

         $result = $this->db->query($query)->result_array();
      
        $Facebook='';
        $Line='';

        foreach ($result as $key2 => $value) {

        	if($value['price']=='Facebook'){
        		$Facebook = $value['source_count'];
        	}

        	if($value['price']=='Line@'){
        		$Line = $value['source_count'];
        	}
        }

        $dateObj   = DateTime::createFromFormat('!m', substr($val['month'], 0, 2));
	    $monthName = $dateObj->format('F');
	    $year = substr($val['month'], -4);
	    $final_month_year = $monthName.' '. $year;


    	$output['aaData'][]=array(($key+1),
            $final_month_year,
            $val['date_count'],
            $Line,
            $Facebook,
        );
      
    }
     /*die('ok');*/
    echo json_encode($output);
    die;
}

public function newcase_by_year(){

    $sLimit = "";
    $lenght = $_GET['iDisplayLength'];
    $str_point = $_GET['iDisplayStart'];

    $total_record = $this->cnc_model->getData('customer','count(*) as date_count,DATE_FORMAT(created_at, "%Y") as year',false,false,'created_at','DESC',$lenght,$str_point,false,'year');

    $output = array(
        "sEcho" => 0,
        "iTotalRecords" => count($total_record),
        "iTotalDisplayRecords" => count($total_record),
        "aaData" => array()
    );
    
    foreach ($total_record as $key=>$val) {

        $query = "SELECT count(*)as source_count,source.id,source.price from (SELECT id,price FROM `customer` WHERE DATE_FORMAT(created_at, '%Y') = '".$val['year']."') as source group BY source.price";

        $result = $this->db->query($query)->result_array();
      
        $Facebook='';
        $Line='';

        foreach ($result as $key2 => $value) {

        	if($value['price']=='Facebook'){
        		$Facebook = $value['source_count'];
        	}

        	if($value['price']=='Line@'){
        		$Line = $value['source_count'];
        	}
        }
        
        if($val['year']==0000){
        	continue;
        }

    	$output['aaData'][]=array(($key+1),
            $val['year'],
            $val['date_count'],
            $Line,
            $Facebook,
        );
      
    }
     /*die('ok');*/
    echo json_encode($output);
    die;
}

public function exportAll(){

	$session=$this->session->userdata();
	$this->slug='customer';
    $select='*';
    $result = $this->cnc_model->getData('customer',$select);    
   if(!empty($result)){
    $delimiter = ",";
    $filename = "Fasttabien".date('m-d-Y H:i').".csv";
    $f = fopen('php://memory', 'w');
    $fields = array('id','status','created_at','chat_name','type','price','car_type','customer_name','brand_id','chassis','brand','phone','role','updated_at','cat1','no1');

    $table_clm['clm_name'] = get_clm('customer');

        for($i=17; $i < count($table_clm['clm_name']); $i++){
             $fields[] = $table_clm['clm_name'][$i];
        }

    fputcsv($f, $fields, $delimiter);
    foreach ($result as $key => $value) {
    	$customer_data = array($value['id'], $value['status'],date('m-d-Y H:i',strtotime($value['created_at'])),$value['chat_name'], $value['type'], $value['price'], $value['car_type'], $value['customer_name'], $value['brand_id'], $value['chassis'], $value['brand'], $value['phone'], $value['role'],date('m-d-Y H:i',strtotime($value['updated_at'])) ,$value['cat1'], $value['no1']);

    	for($i=17; $i < count($value); $i++){

            $number=$value[$table_clm['clm_name'][$i]];
        
            if($number != "0")
                $customer_data[] = $number;
            else
                $customer_data[]='';
        }
    	fputcsv($f, $customer_data, $delimiter);
    }
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
 }
  exit;
}

function copy_customer(){
	$id = $this->input->post('id');
	$data['copy'] = $this->cnc_model->getData('customer','*',['id'=>$id])[0];

	$customer_data=[];
	$r_num = [];

	$table_clm['clm_name'] = get_clm('customer');
	foreach($data as $key => $val){

		for($i=15; $i < count($val); $i++){

	     	if($i <= 32){

	     		$number = $val[$table_clm['clm_name'][$i]];

	     		if(!preg_match('/\p{Thai}/u',$number) && !preg_match('/[a-zA-Z]/',$number ) ){

				    if($number != "0" && !empty($number)){
					   $customer_data[] = $number;   
				    }
	     		}			   
		    }
		}
	}

	foreach($customer_data as $key1 => $val1){
		$allnumber = $this->cnc_model->getData('allnumbers','*',['number'=>$val1])[0];
		if(!empty($allnumber)){

			if(!empty($allnumber['resultdata'])){
			   $num = explode(" ",$allnumber['resultdata']);
			   $r_num[$key1]['amount'] = $num[0].' '. $num[1];
			   $r_num[$key1]['number'] = $allnumber['number'];	
            }else{
               $r_num[$key1]['amount'] = 'Not Available';
			   $r_num[$key1]['number'] = $allnumber['number'];	
            }
		}
	}

	if(!empty($r_num)){
		$data['price'] = $r_num;
	}
	echo json_encode($data);die();
}

public function import_chatname(){

	$file = $_FILES['file'];

    if (!empty($file)) {
        $allowed = array('csv');
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (in_array($ext, $allowed)) {
            $file = fopen($file['tmp_name'],"r");
            $i = 1;
            $count = 0;
            
            while(!feof($file))
            {   
                $fdata = fgetcsv($file);
                if ($i >1 && is_array($fdata)) {

	                $cust_res = $this->cnc_model->getData('customer','*',['id'=>$fdata[0]]);
	                if($cust_res){
	                	$new_chatname = $this->cnc_model->rowUpdate('customer',array('chat_name' =>$fdata[1],'updated_at'=> date('Y-m-d H:i')),['id'=>$fdata[0]]);
			        }

                    $count++; 
                }
                $i++;
            }

            if ($count > 0) {
                
                $this->session->set_flashdata('success', $count.' Chatname change successfully');
                redirect('viewCustomer');
            }else{
                $this->session->set_flashdata('error', 'Something went wrong');
                redirect('viewCustomer');
            }
        }else{
            $this->session->set_flashdata('error', 'Please upload valid excel file');
            redirect('viewCustomer');
        }
    }else{
        $this->session->set_flashdata('error', 'File is required to upload');
        redirect('viewCustomer');
    }

}


function get_chatname(){
	$id = $this->input->post('id');
	$data = $this->cnc_model->getData('customer','*',['id'=>$id]);
	echo json_encode($data);die();
}

function change_chatname(){

	$post = $this->input->post();

	if(!empty($post)){
		$data = $this->cnc_model->rowUpdate('customer',array('chat_name' =>  $post['chat_name'],'updated_at'=> date('Y-m-d H:i')),['id'=>$post['id']]);
		if($data){
			$this->session->set_flashdata('success', 'Chat name successfully Updated');
			redirect('viewCustomer'); 
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('viewCustomer');
		}
	}else{
		$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('viewCustomer');
	}
	
}


}