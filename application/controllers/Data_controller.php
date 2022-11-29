<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_controller extends MY_Controller {

public function __construct() {
	parent::__construct();
	$this->load->model('Data_model','data');
	$this->load->model('History_model','history');
}

public function records(){
	$session=$this->session->userdata();
	$records=$this->cnc_model->getData('records');
	$records['category']=$this->cnc_model->getData('category');
	$records['group']=$this->cnc_model->getData('group_table');
	//$records['all_ranges']=$this->cnc_model->getData('check_all_numbers');
	$this->slug='specialNumber';
	if ($session['access']['specialNumber']['access_view'])
		$this->load('records',$records);
	else
		$this->load('denied');
}

public function get_records(){
	 	
	 	$sLimit = "";

        $lenght = $_GET['iDisplayLength'];
        $str_point = $_GET['iDisplayStart'];
        
        $col_sort = array("s.id",'s.number','s.created_at','s.updated_at');
      		
  		$select="s.id,s.number,s.created_at,s.updated_at";
		
		$order_by = "s.id";
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
        $where .= "(s.id REGEXP s.id)";

        $result = $this->cnc_model->getDatanew('special_number s',$select,$where,$order_by,$order,$lenght,$str_point);
       

        $total_record = $this->cnc_model->getRowCountnew('special_number s',$select,$where,$order_by,$order);

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );
        
        $session=$this->session->userdata();
		
		foreach ($result as $key=>$val) {
			
				$status="<span class='label bg-yellow btn-circle'>Special</span>";

       $updated_date=!empty($val['updated_at'])?date('m-d-Y H:i',strtotime($val['updated_at'])):'Not updated';

        	$action='';
			if ($session['access']['specialNumber']['access_update']){
    			$action='<button type="button" data_id="'.$val['id'].'" class="edit yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-edit"></i></button>';
			}
			if ($session['access']['specialNumber']['access_delete'])
				$action.='<button type="button" data_id="'.$val['id'].'" class="delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';
    	
			if (empty($action))
				$action='<button title="Not Authorized" type="button" data_id="'.$val['id'].'" class="red btn-circle btn-sm btn" href="javascript:;"> <i class="fa fa-ban" ></i>  Not Authorized</button>';	

            $output['aaData'][]=array(($key+1),
            		
            		$val['number'],
            		 date('m-d-Y H:i',strtotime($val['created_at'])),
            	    $updated_date,
            		 $action,
				);
        }
        echo json_encode($output);
        die;
}
public function get_records_vip(){
	 	$sLimit = "";
        $lenght = $_GET['iDisplayLength'];
        $str_point = $_GET['iDisplayStart'];
        
        $col_sort = array("v.id",'v.number','v.created_at','v.updated_at');
      		
  		$select="v.id,v.number,v.created_at,v.updated_at";
		
		$order_by = "v.id";
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
        $where .= "(v.id REGEXP v.id)";

        $result = $this->cnc_model->getDatanew('vip_number v',$select,$where,$order_by,$order,$lenght,$str_point);
       

        $total_record = $this->cnc_model->getRowCountnew('vip_number v',$select,$where,$order_by,$order);

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );
        
        $session=$this->session->userdata();
		
		foreach ($result as $key=>$val) {
			
				$status="<span class='label bg-blue-chambray btn-circle'>Vip</span>";

        $updated_date=!empty($val['updated_at'])?date('m-d-Y H:i',strtotime($val['updated_at'])):'Not updated';

        	$action='';
			if ($session['access']['specialNumber']['access_update']){
    			$action='<button type="button" data_id="'.$val['id'].'" class="vip_edit yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-edit"></i></button>';
			}
			if ($session['access']['specialNumber']['access_delete'])
				$action.='<button type="button" data_id="'.$val['id'].'" class="vip_delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';
    	
			if (empty($action))
				$action='<button title="Not Authorized" type="button" data_id="'.$val['id'].'" class="red btn-circle btn-sm btn" href="javascript:;"> <i class="fa fa-ban" ></i>  Not Authorized</button>';	

            $output['aaData'][]=array(($key+1),
            		
            		$val['number'],
            		date('m-d-Y H:i',strtotime($val['created_at'])),
            		$updated_date,
            		$action,
				);
        }
        echo json_encode($output);
        die;
}

public function get_records_super_special(){
	 	$sLimit = "";
        $lenght = $_GET['iDisplayLength'];
        $str_point = $_GET['iDisplayStart'];
        
        $col_sort = array("id",'number','created_at','updated_at');
      		
  		$select="id,number,created_at,updated_at";
		
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

        $result = $this->cnc_model->getDatanew('super_special_number ',$select,$where,$order_by,$order,$lenght,$str_point);
       
        $total_record = $this->cnc_model->getRowCountnew('super_special_number',$select,$where,$order_by,$order);

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );
        
        $session=$this->session->userdata();
		
		foreach ($result as $key=>$val) {
			
				$status="<span class='label bg-blue-chambray btn-circle'>Vip</span>";

        $updated_date=!empty($val['updated_at'])?date('m-d-Y H:i',strtotime($val['updated_at'])):'Not updated';

        	$action='';
			if ($session['access']['specialNumber']['access_update']){
    			$action='<button type="button" data_id="'.$val['id'].'" class="super_special_edit yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-edit"></i></button>';
			}
			if ($session['access']['specialNumber']['access_delete'])
				$action.='<button type="button" data_id="'.$val['id'].'" class="super_special_delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';
    	
			if (empty($action))
				$action='<button title="Not Authorized" type="button" data_id="'.$val['id'].'" class="red btn-circle btn-sm btn" href="javascript:;"> <i class="fa fa-ban" ></i>  Not Authorized</button>';	

            $output['aaData'][]=array(($key+1),
            		
            		$val['number'],
            		date('m-d-Y H:i',strtotime($val['created_at'])),
            		$updated_date,
            		$action,
				);
        }
        echo json_encode($output);
        die;
}

function save_records(){
	$post=$this->input->post();
	 // echo"<pre>";
	 //            print_r($post);die('ok');
	if(!empty($post)){
		if(!empty($post['specialnumber'])){
			
			foreach ($post['specialnumber'] as $key => $value) {
				if (!empty($post['specialnumber'][$key])){
	                $insert_data['number']=$post['specialnumber'][$key];
					$insert_data['created_at']=date('Y-m-d H:i:s');

					$res=$this->cnc_model->getData('special_number','*',['number'=>$post['specialnumber'][$key]]);

					if (empty($res)){
						$insert_id=$this->cnc_model->rowInsert('special_number',$insert_data);
					}
					else{
						unset($insert_data['number']);
						unset($insert_data['created_at']);
						$insert_data['updated_at']=date('Y-m-d H:i:s');
						$insert_id=$this->cnc_model->rowUpdate('special_number',$insert_data,['number'=>$post['specialnumber'][$key]]);
					}
                }
            }
		}

		if(!empty($post['vipnumber'])){
			
			foreach ($post['vipnumber'] as $key => $value) {
				if (!empty($post['vipnumber'][$key])){
	                $insert_data['number']=$post['vipnumber'][$key];
					$insert_data['created_at']=date('Y-m-d H:i:s');

					$res=$this->cnc_model->getData('vip_number','*',['number'=>$post['vipnumber'][$key]]);

					if (empty($res)){
						$insert_id=$this->cnc_model->rowInsert('vip_number',$insert_data);
					}
					else{
						unset($insert_data['number']);
						unset($insert_data['created_at']);
						$insert_data['updated_at']=date('Y-m-d H:i:s');
						$insert_id=$this->cnc_model->rowUpdate('vip_number',$insert_data,['number'=>$post['vipnumber'][$key]]);
					}
			    } 
			}
		}
		if(!empty($post['superspecialnumber'])){
			
			foreach ($post['superspecialnumber'] as $key => $value) {
				if (!empty($post['superspecialnumber'][$key])){
	                $insert_data['number']=$post['superspecialnumber'][$key];
					$insert_data['created_at']=date('Y-m-d H:i:s');

					$res=$this->cnc_model->getData('super_special_number','*',['number'=>$post['superspecialnumber'][$key]]);

					if (empty($res)){
						$insert_id=$this->cnc_model->rowInsert('super_special_number',$insert_data);
					}
					else{
						unset($insert_data['number']);
						unset($insert_data['created_at']);
						$insert_data['updated_at']=date('Y-m-d H:i:s');
						$insert_id=$this->cnc_model->rowUpdate('super_special_number',$insert_data,['number'=>$post['superspecialnumber'][$key]]);
					}
                }
            }
		}
        if ($insert_id) {
			$this->session->set_flashdata('success', 'All Records successfully inserted');
			 redirect('specialNumber'); 
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('specialNumber');
		}
	}else{
		$this->session->set_flashdata('error', 'All fields are required');
			 redirect('specialNumber');
	}
}

function update_records(){
	$post=$this->input->post();

	if (!empty($post)) {
		$id=$post['id'];
		$post['updated_at']=date('Y-m-d H:i:s');
		unset($post['id']);
		$res=$this->cnc_model->rowUpdate('special_number',$post,['id'=>$id]);
		if ($res) {
			$this->session->set_flashdata('success', 'Records successfully Updated');
			 redirect('specialNumber'); 
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('specialNumber');
		}
	}else{
		$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('specialNumber');
	}
}

function vip_update_records(){
	$post=$this->input->post();
	if (!empty($post)) {
		$id=$post['id'];
		$post['updated_at']=date('Y-m-d H:i:s');
		unset($post['id']);
		$res=$this->cnc_model->rowUpdate('vip_number',$post,['id'=>$id]);
		if ($res) {
			$this->session->set_flashdata('success', 'Records successfully Updated');
			 redirect('specialNumber'); 
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('specialNumber');
		}
	}else{
		$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('specialNumber');
	}
}

function super_special_update_records(){
	$post=$this->input->post();
	if (!empty($post)) {
		$id=$post['id'];
		$post['updated_at']=date('Y-m-d H:i:s');
		unset($post['id']);
		$res=$this->cnc_model->rowUpdate('super_special_number',$post,['id'=>$id]);
		if ($res) {
			$this->session->set_flashdata('success', 'Records successfully Updated');
			 redirect('specialNumber'); 
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('specialNumber');
		}
	}else{
		$this->session->set_flashdata('error', 'Something went wrong');
			 redirect('specialNumber');
	}
}


function delete_record(){
	$id=$this->input->post('id');
	$this->cnc_model->rowsDelete('special_number',array('id'=>$id));
	$this->session->set_flashdata('success', 'Records Successfully Deleted');
	echo "true";		 
}

function vip_delete_record(){
	$id=$this->input->post('id');
	$this->cnc_model->rowsDelete('vip_number',array('id'=>$id));
	$this->session->set_flashdata('success', 'Records Successfully Deleted');
	echo "true";		 
}

function super_special_delete_record(){
	$id=$this->input->post('id');
	$this->cnc_model->rowsDelete('super_special_number',array('id'=>$id));
	$this->session->set_flashdata('success', 'Records Successfully Deleted');
	echo "true";		 
}

function getRecordsById(){
	$id=$this->input->post('id');
	$select="s.id,number,s.created_at,s.updated_at";
	$res=$this->cnc_model->getData('special_number s',$select,['s.id'=>$id]);
	$records=$res[0];
	echo json_encode($records);die();
}

function vip_getRecordsById(){
	$id=$this->input->post('id');
	$select="v.id,number,v.created_at,v.updated_at";
	$res=$this->cnc_model->getData('vip_number v',$select,['v.id'=>$id]);
	$records=$res[0];
	echo json_encode($records);die();
}

function super_special_getRecordsById(){
	$id=$this->input->post('id');
	$select="id,number,created_at,updated_at";
	$res=$this->cnc_model->getData('super_special_number ',$select,['id'=>$id]);
	$records=$res[0];
	echo json_encode($records);die();
}

function import(){
	$file=$_FILES['file'];
	$status=$this->input->post('status');
	if (!empty($file)) {
		$allowed = array('csv');
		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
		if (in_array($ext, $allowed)) {
		    $file = fopen($file['tmp_name'],"r");
			$i=1;
			$count=0;
			$failed=0;
			while(! feof($file))
			{	
			    $fdata=fgetcsv($file);
			    if ($i > 2 && is_array($fdata)) {
					
					if ($status==1) {
			    		
			    		$res=$this->cnc_model->getData('special_number','*',['number'=>$fdata[0]]);

			    		$data['number']=$fdata[0];
			    		$data['created_at']=date('Y-m-d H:i:s');
			    			
			    			if (empty($res)){
			    				$this->cnc_model->rowInsert('special_number',$data);
			    			}
			    			else{
			    				
			    				unset($data['number']);
			    				unset($data['created_at']);
			    				$data['updated_at']=date('Y-m-d H:i:s');
			    				$this->cnc_model->rowUpdate('special_number',$data,['number'=>$fdata[0]]);
			    			}
			    			$count++;
			    		
			    	}

			    	if ($status==2) {
			    		
			    		$res=$this->cnc_model->getData('vip_number','*',['number'=>$fdata[0]]);

			    		$data['number']=$fdata[0];
			    		$data['created_at']=date('Y-m-d H:i:s');
			    			
			    			if (empty($res)){
			    				$this->cnc_model->rowInsert('vip_number',$data);
			    			}
			    			else{
			    				
			    				unset($data['number']);
			    				unset($data['created_at']);
			    				$data['updated_at']=date('Y-m-d H:i:s');
			    				$this->cnc_model->rowUpdate('vip_number',$data,['number'=>$fdata[0]]);
			    			}
			    			$count++;
			    		
			    	}
                }
			    $i++;
			}
			if ($count>0) {
				
					 				
				$this->session->set_flashdata('success', $count.' Record successfully inserted');
				redirect('specialNumber');
			}else{
				$this->session->set_flashdata('error', 'Something went wrong');
			 	redirect('specialNumber');
			}
		}else{
			$this->session->set_flashdata('error', 'Please upload valid excel file');
			 redirect('specialNumber');
		}
	}else{
		$this->session->set_flashdata('error', 'File is required to upload');
			 redirect('specialNumber');
	}
}

public function checkNumber(){

	$this->slug='specialNumber';
	$this->load('checkNumber');
}


public function get_exist_data($no=""){
    $res ='';
		$clm_count=get_clmno_count('customer')/2;
 			
        for ($i=1; $i <= $clm_count ; $i++) {
            $res=$this->cnc_model->getData('customer','*',['no'.$i=>$no,'status'=>'in progress']);
              foreach ($res as $key => $value) {
            	$array[]=["id"=>$value['id'],'status'=>$value['status'],'cat'=>$value['cat'.$i],'no'=>$value['no'.$i]];	
    	      }
    	}
    	if(!empty($array)){
    		return $array;
    	} 
}

public function check_number(){
	$post = $this->input->post();

	$add_number = '<div class="col-md-offset-3 col-md-4 add_no">
					<a href='.base_url("check_add_number/").base64_encode($post['name'])."/".$post['number'].' >
					    <button  type="button" class="btn btn-circle yellow-casablanca" href="javascript:;">Add Number</button></a>
				     </div>';

    $no = '<div class="col-md-offset-3 col-md-4 no_btn"><button  type="button" class="btn btn-circle yellow-casablanca" href="javascript:;">No</button></div>';

    $check_number = '<div class="col-md-offset-3 col-md-4 alert bg-grey btn-circle res" style="text-align: center;font-size: 15px">'."Check:&nbsp;".$post['name']."&nbsp;".$post['number'].'</div>';

    $special = '<div class="col-md-offset-3 col-md-4 alert bg-yellow btn-circle res" style="text-align: center;font-size: 15px">Special</div>';

    $vip ='<div class="col-md-offset-3 col-md-4 alert bg-blue-chambray btn-circle res" style="text-align: center;font-size: 15px">Vip</div>';

    $duplicate = '<div class="col-md-offset-3 col-md-4 alert bg-red btn-circle res" style="text-align: center;font-size: 15px">Duplicate</div>';

    $super_special ='<div class="col-md-offset-3 col-md-4 alert btn btn-primary btn-circle res" style="text-align: center;font-size: 15px">Super Special</div>';

	$ok = '<div class="col-md-offset-3 col-md-4 alert bg-green-jungle btn-circle " style="text-align: center;font-size: 15px">ok</div>';

	$new_str ='';

	$combo = $this->permute($post['number']);
	
	$key = array_search ($post['number'],$combo);
	   
	unset($combo[$key]);   

	$check_substitute = implode(',',$combo);
	
	 $final_res = [];

	if(!empty($check_substitute)){

			foreach ($combo as $key => $value) {

				 $final_res[trim($value)]['discount'] = '';
				 $final_res[trim($value)]['status'] = '';
				 $final_res[trim($value)]['category'] = '';
				 $final_res[trim($value)]['number'] = trim($value);
				 $final_res[trim($value)]['all_cat'] = "";

				$all_where = array('a.number' => trim($value));

				$allnumber = $this->cnc_model->getData('allnumbers a','a.*',$all_where);
				if(!empty($allnumber)){
					foreach ($allnumber as $key => $value1) {
                         $final_res[trim($value)]['discount'] = trim($value1['resultdata']);
                          $final_res[trim($value)]['category'] = $post['name'];
			         }  
	            }

	            $allvip = $this->cnc_model->getData('vip_number a','a.*',$all_where);
	            if(!empty($allvip)){
					foreach ($allvip as $keys => $vips) {
						$final_res[trim($value)]['status'] = "vip";
						$final_res[trim($value)]['category'] = $post['name'];
						continue;
			        }  
	            }
	           
	            $cat_res = $this->get_exist_data($value);
	           
	            if(!empty($cat_res)){
                  	foreach ($cat_res as $key => $cat) {
                  	   $final_res[trim($value)]['all_cat'] .= ' ,'.$cat['cat'];
                  	   $final_res[trim($value)]['category'] = $post['name'];
	                }
	            }

			}	 
	}

    $data = [];
    $cus_res='';
    $new_res='';
    $s_where = array('s.number'=>$post['number']);
    $s_res = $this->cnc_model->getData('special_number s','s.*',$s_where);

    if (!empty($s_res)){

        $clm=get_clm('customer');

            $where=" ( ";
			for($i=15; $i < count($clm); $i++){
				$flag=false;
				if (strpos($clm[$i],'cat') !== false) {
			    	$where.=" ( $clm[$i] = '".$post['name']."'";
			    }
			    if (strpos($clm[$i],'no') !== false) {
			    	$where.=" and $clm[$i] = ".$post['number']." and $clm[1] = 'in progress') ";

			    	$flag=true;
			    }
			    if ($i+1 != count($clm) && $flag) {

			    	 $where .= " OR ";
			    }
			}
			$where.=" ) ";
			
            $res=$this->cnc_model->getData('customer','*',$where);

	        if (!empty($res)){
	        	$cus_res=$this->get_exist_data($post['number']);
	        	$data['customerdata']=$cus_res;
	        	$data['check_number']=$check_number;
	        	$data['special']=$special;
	        	$data['duplicate']=$duplicate;
	        	$data['no']=$no;
	        } 
	        else{

	        	$where=" ( ";
			    for($i=15; $i < count($clm); $i++){
				 $flag=false;
				    if (strpos($clm[$i],'no') !== false) {
					    $where.=" ($clm[$i] = ".$post['number']." and $clm[1] = 'in progress') ";

					    	$flag=true;
					}
					if ($i+1 != count($clm) && $flag) {
                        $where .= " OR ";
					}
				}
			    $where.=" ) ";

                $res=$this->cnc_model->getData('customer','*',$where);
                if (!empty($res)){
	        	    $cus_res=$this->get_exist_data($post['number']);
	        	    $data['customerdata']=$cus_res;
	        	    $data['check_number']=$check_number;
	        	    $data['add_number']=$add_number;
	        	    $data['special']=$special;
	        	    $data['duplicate']=$duplicate;
                }
                else{
	        	    $data['check_number']=$check_number;
	        	    $data['add_number']=$add_number;
	        	    $data['special']=$special;
	            }
	        }
    }
    else{

    	$v_res=$this->cnc_model->getData('vip_number s','s.*',$s_where);
        if (!empty($v_res)){
           $data['check_number']=$check_number;
	       $data['vip']=$vip;
	       $data['no']=$no;
        }
        else{
        	 $clm=get_clm('customer');

            $where=" ( ";
			for($i=15; $i < count($clm); $i++){
				$flag=false;
				if (strpos($clm[$i],'cat') !== false) {
			    	$where.=" ( $clm[$i] = '".$post['name']."'";
			    }
			    if (strpos($clm[$i],'no') !== false) {
			    	$where.=" and $clm[$i] = ".$post['number']." and $clm[1] = 'in progress') ";

			    	$flag=true;
			    }
			    if ($i+1 != count($clm) && $flag) {

			    	 $where .= " OR ";
			    }
			}
			$where.=" ) ";
			
            $res=$this->cnc_model->getData('customer','*',$where);
            
	        if (!empty($res)){
	        	$cus_res=$this->get_exist_data($post['number']);
	        	$data['customerdata']=$cus_res;
	        	$data['check_number']=$check_number;
                $data['duplicate']=$duplicate;
                $data['no']=$no;
	        }
            else{

	        	$where=" ( ";
			    for($i=15; $i < count($clm); $i++){
				 $flag=false;
				    if (strpos($clm[$i],'no') !== false) {
					    $where.=" ($clm[$i] = ".$post['number']." and $clm[1] = 'in progress') ";

					    	$flag=true;
					}
					if ($i+1 != count($clm) && $flag) {
                        $where .= " OR ";
					}
				}
			    $where.=" ) ";
			    $cus_where = $where;

                $res=$this->cnc_model->getData('customer','*',$where);
                if (!empty($res)){
                    $cus_res=$this->get_exist_data($post['number']);
                    $data['customerdata']=$cus_res;
                    $data['check_number']=$check_number;
	        	    $data['add_number']=$add_number;
                    $data['duplicate']=$duplicate;
                }
                else{
	        	    $data['check_number']=$check_number;
	        	    $data['add_number']=$add_number;
	        	    $data['ok']=$ok;
	            }
	        }
        }
    }
    if (!empty($s_where)) {
    	$s_res=$this->cnc_model->getData('super_special_number s','s.*',$s_where);
        if (!empty($s_res)){
            $data['super_special']=$super_special;
	    }
	    
	    $allnumber=$this->cnc_model->getData('allnumbers s','s.*',$s_where);
        if(!empty($allnumber)){
	    	$data['allnumber']='<div class="col-md-offset-3 col-md-4 alert btn-circle  ss_blue" style="text-align: center;font-size: 15px">'.$allnumber[0]['resultdata'].'</div>';
	    	$data['discount'] = $allnumber[0]['resultdata'];
	    }
    }

    $res = $this->history->getData('check_record_time',array('number'=>$post['number']));

    if(!empty($res)){
    	 	$id = $res[0]['id'];
    		$number = $res[0]['number'];
    		$time_checked = $res[0]['time_checked']+1;
    	
    	$update_res = $this->history->update_record_time('check_record_time',array('time_checked'=>$time_checked),['id'=>$id]);
    }
    else{
    	
    	$insert_res = $this->history->insertdata('check_record_time',array('number'=>$post['number'],'time_checked'=>1));
    }

    if (isset($data['check_number']) && !empty($data['check_number'])) {
     	$check_n_d = $data['check_number'];
    }else{
   	   $check_n_d = '';
    }
    if (isset($data['duplicate']) && !empty($data['duplicate'])) {
   	  $dup_d = $data['duplicate'];
    }else{
   	 $dup_d = '';
    }
    if (isset($data['add_number']) && !empty($data['add_number'])) {
   	  $add_n_d = $data['add_number'];
    }else{
    	$add_n_d = '';
    }
    if (isset($data['special']) && !empty($data['special'])) {
   	  $special_d = $data['special'];
    }else{
   	  $special_d = '';
    }
    if (isset($data['vip']) && !empty($data['vip'])) {
   	  $vip_d = $data['vip'];
    }else{
   	  $vip_d = '';
    }
    if (isset($data['ok']) && !empty($data['ok'])) {
   	  $ok_d = $data['ok'];
    }else{
    	$ok_d = '';
    }
    if (isset($data['super_special']) && !empty($data['super_special'])) {
     	$check_super_special = $data['super_special'];
    }else{
   	   $check_super_special = '';
    }

    if (isset($data['allnumber']) && !empty($data['allnumber'])) {
     	$allnumber_d = $data['allnumber'];
    }else{
   	   $allnumber_d = '';
    }
   
    if (isset($final_res) && !empty($final_res)) {
     	$final_d = $final_res;
    }else{
   	   $final_d = '';
    }
    if (isset($data['no']) && !empty($data['no'])) {
   	  $no_d = $data['no'];
    }else{
   	 $no_d = '';
    }
    if (isset($data['customerdata']) && !empty($data['customerdata'])) {
     	$cust_d = $data['customerdata'];
    }
    else{
   	   $cust_d = '';
    }
    if(isset($data['discount'])&& !empty($data['discount'])){
        $discount_d = $data['discount'];
    }else{
    	$discount_d = '';
    }

    $result = array("duplicate"=>$dup_d,"check_number"=>$check_n_d,"add_number"=>$add_n_d,'special'=>$special_d,'vip'=>$vip_d,'ok'=>$ok_d,'super_special'=>$check_super_special,'allnumber' => $allnumber_d,'customerdata'=>$cust_d,'final_res' => $final_d,'no'=>$no_d,'number'=>$post['number'],'cat'=>$post['name'],'discount'=>$discount_d);
 
    echo json_encode($result);
    die();
}

public function permute($arg){

    $array = is_string($arg) ? str_split($arg) : $arg;
    if(1 === count($array))
        return $array;
    $result = array();
    foreach($array as $key => $item)
        foreach($this->permute(array_diff_key($array, array($key => $item))) as $p)
            $result[] = $item . $p;
    return $result;
}

public function get_number_list(){
	
	//First truncate temp number table
	$this->db->truncate('temp_number');
	//Get all number and insert them to table
	$customer = $this->cnc_model->getData('customer','*');
    $no= 1; 
	foreach ($customer as $cust_key => $cust) {
		$clm_count=get_clmno_count('customer')/2;
 		for ($i=1; $i <= $clm_count ; $i++) {
            if (!empty($cust['no'.$i])) {
            	$numb_catg[$no]['number'] = $cust['no'.$i];
				$numb_catg[$no]['category'] = $cust['cat'.$i];
				$no++;
            }
    	}
	}
	//Insert into table
	$this->db->insert_batch('temp_number', $numb_catg);

	//Get no of catg
	$all_numbers = $this->db->select('count(*) as no_count,number')
							->group_by('number')
							->get('temp_number')
							->result();

	//truncat  temp_no_count table if record exist	
	$this->db->truncate('temp_no_count');
	$this->db->insert_batch('temp_no_count', $all_numbers);

	//Datatable start
	$input = $this->input->get();
	$limit = $input['iDisplayLength'];
	$offset = $input['iDisplayStart'];
	
	if ($input['iSortCol_0'])
		$order_by = 'no_count';	
	else
		$order_by = 'number';
	
	$order_type = $input['sSortDir_0'];
	$where =[];
	if (!empty($input['sSearch'])) 
		$where = ['number'=>$input['sSearch']];	
	
	$data = $this->db->select('number,no_count')
					->from('temp_no_count')
					->where($where)
					->order_by($order_by,$order_type)
					->limit($limit,$offset)
					->get()
					->result(); 

	$count = $this->db->select('number,no_count')
					->from('temp_no_count')
					->where($where)
					->count_all_results(); 					

    foreach ($data as $key => $value) {
		$aaData[]=array($value->number,$value->no_count);
	}				
	$results = array(
	"sEcho" => 0,
	"iTotalRecords" => $count,
	"iTotalDisplayRecords" => $count,
	  "aaData"=>$aaData);
	
	//print_r($results);die();
	echo json_encode($results);
}

public function check2digit(){
	$this->slug = 'check2digit';

	$final_res = [];

	for($i = 1; $i < 100; $i++){

        $final_res[$i]['all_cat'] = "";
        $final_res[$i]['discount'] = "";
        $final_res[$i]['no'] = $i;

		$allnumber = $this->cnc_model->getData('allnumbers a','a.*',['a.number'=>$i]);
			if(!empty($allnumber)){
			    foreach ($allnumber as $key => $value1) {
                    $final_res[$i]['discount'] = $value1['resultdata'];
			    }  
	        }

		$cat_res = $this->get_exist_data($i);  
        if(!empty($cat_res)){
            foreach ($cat_res as $key => $cat) {
              $final_res[$i]['all_cat'] .= ' ,'.$cat['cat'];
            }
        }   
    }
    $data['pretext'] = $this->pretext_2digit($final_res);
	if (!empty($final_res)) {
		$data['list'] = $final_res;  
    }else{
    	$data['list'] = '';
    }
    $this->load('check2digit',$data);     		    
}

public function pretext_2digit($digit){

	$final_result = [];
	if($digit){
		foreach ($digit as $key => $fine) {

			$discount = str_replace(' ', '', $fine['discount']);
			if($discount !="เลขประมูล" && $discount !="เลขล็อค" && strpos($fine['all_cat'], 'xx') == false){

		    //if(strpos($fine['discount'], 'เลขประมูล') == false && strpos($fine['discount'], 'เลขล็อค') == false && strpos($fine['all_cat'], 'xx') == false){

		    	$final_result[$key]['new_discount'] = $fine['discount'];
		    	$final_result[$key]['number'] = $fine['no'];

		    	$category = preg_replace('/,/', '',  $fine['all_cat'], 1);

		    	$final_result[$key]['new_all_cat'] = $category;
		    	if($category){
		    		$arr_cat = count(explode(",", $category));
		    		$final_result[$key]['count'] = $arr_cat;  	
		    	}else{
		    		$final_result[$key]['count'] = 0;
		    	}	
		    }
		}
	}
	if($final_result){
	  return $final_result;
	}
}

public function export2digit(){

	$this->slug = 'check2digit';

	$final_res = [];

	$delimiter = ",";
	$filename = "Fasttabiencheck2digit".date('m-d-Y H:i').".csv";
    $f = fopen('php://memory', 'w');

    for($i = 1; $i < 100; $i++){

        $final_res[$i]['all_cat'] = "";
        $final_res[$i]['discount'] = "";
        $final_res[$i]['no'] = $i;

		$allnumber = $this->cnc_model->getData('allnumbers a','a.*',['a.number'=>$i]);
			if(!empty($allnumber)){
			    foreach ($allnumber as $key => $value1) {
                    $final_res[$i]['discount'] = $value1['resultdata'];
			    }  
	        }
	        
		$cat_res = $this->get_exist_data($i);  
        if(!empty($cat_res)){
            foreach ($cat_res as $key => $cat) {
              $final_res[$i]['all_cat'] .= ' ,'.$cat['cat'];
            }
        }   
    }
    
    $fields = array('no','discount','all_cat');

	fputcsv($f, $fields, $delimiter);

	foreach ($final_res as $key => $value) {
	    $twodigit_data = array($value['no'],$value['discount'],preg_replace('/,/', '', $value['all_cat'], 1));
	    fputcsv($f, $twodigit_data, $delimiter);
	}
	
	fseek($f, 0);
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '";');
	fpassthru($f);
    exit;
}

public function checkAllNumbers($range){

	if(!empty($range)){

		$first = explode('-', $range);

	    $final_res = [];

	    for($i = $first[0]; $i <= $first[1]; $i++){	

	        $final_res[$i]['all_cat'] = "";
	        $final_res[$i]['discount'] = "";
	        $final_res[$i]['no'] = $i;
	       
	        $allnumber = $this->cnc_model->getData('allnumbers a','a.*',['a.number'=>$i]);
			if(!empty($allnumber)){
				foreach ($allnumber as $key => $value) {
	                $final_res[$i]['discount'] = $value['resultdata'];
				}  
		    }

			$clm_count = get_clmno_count('customer')/2;
			for ($j=1; $j <= $clm_count ; $j++) {
			    $res = $this->cnc_model->getData('customer','*',['no'.$j=>$i,'status'=>'in progress']);
			    if(!empty($res)){
			        foreach ($res as $key => $value) {
			            $final_res[$i]['all_cat'] .= ' ,'.$value['cat'.$j];
			    	}
			    }    
			} 

		}
	}

	if (!empty($final_res)){
		$this->session->set_userdata('allnumlist', $final_res);
		$data['allnumlist'] = $final_res; 
		//$data['range'] = $range; 

    }else{
    	$data['allnumlist'] = '';
    }

	$this->load('checkallnumbers',$data);
}


public function export_all_numbers(){
	
	$result = $this->session->userdata('allnumlist');

	if(!empty($result)){
	    $delimiter = ",";
	    $filename = "Fasttabienallnumbers".date('m-d-Y H:i').".csv";
	    $f = fopen('php://memory', 'w');

	    $fields = array('no','discount','all_cat');
	 
	    fputcsv($f, $fields, $delimiter);
	    foreach ($result as $key => $value) {
	    	
		    $bulk_data = array($value['no'],$value['discount'],preg_replace('/,/', '', $value['all_cat'], 1));
		    fputcsv($f, $bulk_data, $delimiter);
		}
	    fseek($f, 0);
	    header('Content-Type: text/csv');
	    header('Content-Disposition: attachment; filename="' . $filename . '";');
	    fpassthru($f);
    }
  
    exit;

}


public function exportAll(){

	$session=$this->session->userdata();
	$this->slug='specialNumber';
    $select='*';
    $result = $this->cnc_model->getData('temp_no_count',$select);

   if(!empty($result)){
    $delimiter = ",";
    $filename = "Fasttabien_number_count".date('m-d-Y H:i').".csv";
    $f = fopen('php://memory', 'w');
    $fields = array('id','number','no_count'); 
 
    fputcsv($f, $fields, $delimiter);
    foreach ($result as $key => $value) {
    	$customer_data = array($value['id'], $value['number'],$value['no_count']);
    	/*echo"<pre>";
	print_r($customer_data);*/
	
    	fputcsv($f, $customer_data, $delimiter);
    }
    //die('ok'); 
    fseek($f, 0);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
 }
  exit;
}

public function check_multi_number(){
	$this->slug = 'specialNumber';
	$this->load('check_multi_number');
}

public function pretext_bulk($digit){

	$final_result = [];
	if($digit){
		foreach ($digit as $key => $fine) {
			
			$discount = str_replace(' ', '', $fine['discount']);
			if($discount !="เลขประมูล" && $discount !="เลขล็อค" && strpos($fine['all_cat'], 'xx') == false){
		    //if(strpos($fine['discount'], 'เลขประมูล') == false && strpos($fine['discount'], 'เลขล็อค') == false && strpos($fine['all_cat'], 'xx') == false){

		    	$final_result[$key]['new_discount'] = $fine['discount'];
		    	$final_result[$key]['number'] = $fine['no'];

		    	$category = preg_replace('/,/', '',  $fine['all_cat'], 1);

		    	$final_result[$key]['new_all_cat'] = $category;
		    	if($category){
		    		$arr_cat = count(explode(",", $category));
		    		$final_result[$key]['count'] = $arr_cat;  	
		    	}else{
		    		$final_result[$key]['count'] = 0;
		    	}	
		    }
		}
	}
	if($final_result){
	  return $final_result;
	}
}

public function check_bulknumber(){
	$this->slug = 'specialNumber';

	$post = $this->input->post();
	
	if (!empty($post)) {

		//$new_group = $this->create_group($post['number'],$post['number_optional']);

		$str = implode(", ", preg_split("/[\s]+/", $post['number']));
		$str_new = str_replace(',', '', $str);
	    $new_group = explode(" ",$str_new);

		$final_res = [];

		foreach($new_group as $key => $value ){

			$final_res[$key]['all_cat'] = "";
	        $final_res[$key]['discount'] = "";
	        $final_res[$key]['no'] = $value;

	        $allnumber = $this->cnc_model->getData('allnumbers a','a.*',['a.number'=>$value]);
			if(!empty($allnumber)){
				foreach ($allnumber as $key1 => $value1) {
	                $final_res[$key]['discount'] = $value1['resultdata'];
				}  
		    }
		    $cat_res = $this->get_exist_data($value);  
	        if(!empty($cat_res)){
	            foreach ($cat_res as $key2 => $cat) {
	              $final_res[$key]['all_cat'] .= ' ,'.$cat['cat'];
	            }
	        }  
	    }

        $data['bulk_pretext'] = $this->pretext_bulk($final_res);

		if (!empty($final_res)) {
			$this->session->set_userdata('bulk_list', $final_res);
			$data['bulk_list'] = $final_res;  
	    }else{
	    	$data['bulk_list'] = '';
	    }
	}

	echo json_encode($data);
	die();
}


public function exportbulk(){

	$result = $this->session->userdata('bulk_list');

	if(!empty($result)){
	    $delimiter = ",";
	    $filename = "Fasttabienbulkcheck".date('m-d-Y H:i').".csv";
	    $f = fopen('php://memory', 'w');

	    $fields = array('no','discount','all_cat');
	 
	    fputcsv($f, $fields, $delimiter);
	    foreach ($result as $key => $value) {
	    	
		    $bulk_data = array($value['no'],$value['discount'],preg_replace('/,/', '', $value['all_cat'], 1));
		    fputcsv($f, $bulk_data, $delimiter);
		}
	    fseek($f, 0);
	    header('Content-Type: text/csv');
	    header('Content-Disposition: attachment; filename="' . $filename . '";');
	    fpassthru($f);
    }
    else{
          redirect('check_multi_number');
    }
    exit;
}




}                                