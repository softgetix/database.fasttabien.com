<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auction_controller extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Auction_model','auction');
	}

	public function addAuction(){
		$this->slug='auction';
		$this->sub_menu='addAuction';
		$this->load('auction/addAuction');
	}

	public function viewAuction(){

		$this->slug='auction';
		$this->sub_menu='viewAuction';
		$this->load('auction/viewAuction');
		
	}
	public function addWinAuction(){
		$this->slug='auction';
		$this->sub_menu='addWinAuction';
		$this->load('auction/addWinAuction');
	}

	public function winning_auction(){

		$this->slug='auction';
		$this->sub_menu='completed';
		$this->load('auction/win_auction_completed');
	}

	public function revenueComplete(){
		$this->slug='auction';
		$this->sub_menu='revenueComplete';
		$this->load('auction/revenueComplete');
	}

	public function save_auction(){
		$post=$this->input->post();
		$optional_number=false;
		if (!empty($post)) {

			if ($optional_number) {
				$auction_date1=$post['auction_date1'];
				$category1=$post['category1'];
				$startnumber1=$post['startnumber1'];
				$startnumber1=$post['startnumber1'];
				$endnumber1=$post['endnumber1'];
				unset($post['$auction_date1']);
				unset($post['category1']);
				unset($post['startnumber1']);
				unset($post['startnumber1']);
			}

            $auction_date=date('Y-m-d',strtotime($post['auction_date']));
			$category=$post['category'];
			$startnumber=$post['startnumber'];
			$endnumber=$post['endnumber'];
			unset($post['startnumber']);
			unset($post['endnumber']);

			$data=array('category'=>$category,'auction_date'=>$auction_date,'start_number'=>$startnumber,'end_number'=>$endnumber,'created_at'=>date('Y-m-d H:i'));		
				
			$this->auction->rowInsert('auction_list',$data);		

			if ($optional_number) {
				foreach ($category1 as $key => $value) {
					if (!empty($value) && !empty($category1[$key])) {

						$data=array('category'=>$category1[$key],'auction_date'=>date('Y-m-d',strtotime($auction_date1[$key])),'start_number'=>$startnumber1[$key],'end_number'=>$endnumber1[$key],'created_at'=>date('Y-m-d H:i'));

						$this->auction->rowInsert('auction_list',$data);	
					}
				}
			}
            $this->session->set_flashdata('success', 'Auction Record added successfully !!');
			redirect('addAuction');
		}else
			$this->session->set_flashdata('error', 'All fields are required !!');
			redirect('addAuction');
	}

	public function get_no_of_customer($value=[]){

		$where='';
		$clm_count=get_clmno_count('customer')/2;
		$where.= "(";
	        for($i=1; $i <= $clm_count; $i++){
	       
            $where .= "((cat"."$i = '".$value['category']."' OR cat"."$i = '".'xx'."')";
            $where.="and( no"."$i >= '".$value['start_number']."'  AND no"."$i <= '".$value['end_number']."')";
            $where .= "and (status ='in progress'))OR";
			}
            $whr= substr($where,-2);
            $new=trim($whr);
               	if ($new == 'OR') {
			     	$where = substr($where,0,-2);
			    }
        $where.=")";
        $total_record = $this->cnc_model->getData('customer','*',$where);
	    return count($total_record);
	}

	public function get_auction(){

		$filter_by_day = $this->input->get('filter_by_day');
		$filter_by_date = $this->input->get('filter_by_date');

		 	
		 	$sLimit = "";

	        $lenght = $_GET['iDisplayLength'];
	        $str_point = $_GET['iDisplayStart'];
	        
	        $col_sort = array("id",'category','start_number','end_number','auction_date');

	  		$select="id,category,start_number,end_number,auction_date";
			
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

	        if($filter_by_day == "today"){
	        	
	          $where .= "AND (DATE(auction_date) ='$filter_by_date')";

	          $result = $this->cnc_model->getDatanew('auction_list',$select,$where,$order_by,$order,$lenght,$str_point);

	        }elseif ($filter_by_day == "tomorrow") {

	        	$where .= "AND (DATE(auction_date) ='$filter_by_date')";

	          $result = $this->cnc_model->getDatanew('auction_list',$select,$where,$order_by,$order,$lenght,$str_point);
	        }
	        elseif($filter_by_day == "yesterday"){

	        	$where .= "AND (DATE(auction_date) ='$filter_by_date')";

	            $result = $this->cnc_model->getDatanew('auction_list',$select,$where,$order_by,$order,$lenght,$str_point);
	        }
	        elseif ($filter_by_day == "next 7days from yesterday") {
	        	$yesterday=date("Y-m-d",strtotime("-1 days"));
	        	
	        	$where .= "AND (DATE(auction_date) <='$filter_by_date')";
	        	$where .= "AND (DATE(auction_date) >='$yesterday')";

	            $result = $this->cnc_model->getDatanew('auction_list',$select,$where,$order_by,$order,$lenght,$str_point);
	        }
	        else{

	           $result = $this->cnc_model->getDatanew('auction_list',$select,$where,$order_by,$order,$lenght,$str_point);
	        }

	        $total_record = $this->cnc_model->getRowCountnew('auction_list',$select,$where,$order_by,$order);

	        $output = array(
	            "sEcho" => 0,
	            "iTotalRecords" => $total_record,
	            "iTotalDisplayRecords" => $total_record,
	            "aaData" => array()
	        );
	        
	        $session=$this->session->userdata();
			
			foreach ($result as $key=>$val) {
				$no_of_customer =$this->get_no_of_customer($val);
				if($no_of_customer == 0){
	               $customer_no = '';
	            }
	            else{
	            	$customer_no = $no_of_customer;
	            }
				
	        	$action='';
				 if ($session['access']['viewAuction']['access_update']){
	     			$action='<button type="button" data_id="'.$val['id'].'" class="edit yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-edit"></i></button>';
				 }
				if ($session['access']['viewAuction']['access_delete'])
					$action.='<button type="button" data_id="'.$val['id'].'" class="delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';
	    	
				if (empty($action))
					$action='<button title="Not Authorized" type="button" data_id="'.$val['id'].'" class="red btn-circle btn-sm btn" href="javascript:;"> <i class="fa fa-ban" ></i>  Not Authorized</button>';	

	            $output['aaData'][]=array(($key+1),

	            	date('d-m-Y',strtotime($val['auction_date'])),	
	            	$val['category'],
	                $val['start_number']."-".$val['end_number'],
	                $customer_no,
	                $action,
					);
	        }
	        echo json_encode($output);
	        die;
	}

	function delete_auction(){
		$id=$this->input->post('id');
		$this->cnc_model->rowsDelete('auction_list',array('id'=>$id));
		$this->session->set_flashdata('success', 'auction Successfully Deleted');
		echo "true";		 
	}

	function getAuctionById(){
	    $id=$this->input->post('id');
		$res=$this->cnc_model->getData('auction_list','*',['id'=>$id]);
		$records=$res[0];
	    echo json_encode($records);die();
	}

	function update_auction(){
	    $post=$this->input->post();
	    if (!empty($post)) {
			$id=$post['id'];
			$post['updated_at']=date('Y-m-d H:i:s');
			unset($post['id']);
			$res=$this->cnc_model->rowUpdate('auction_list',$post,['id'=>$id]);
			if ($res) {
				$this->session->set_flashdata('success', 'Auction List successfully Updated');
				 redirect('viewAuction'); 
			}else{
				$this->session->set_flashdata('error', 'Something went wrong');
				 redirect('viewAuction');
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong');
				 redirect('viewAuction');
		}
	}

	function search_customer(){

		$customer_name = $this->input->get("q");
		if(!empty($customer_name)){	
			$this->db->like('customer_name', $customer_name);
			$query = $this->db->select('id,customer_name')
						->get("customer");
		    $json = $query->result_array();
		    if(!empty($json))
            echo json_encode($json);
		}	
	}

	function save_WinAuction(){
		$post=$this->input->post();

		/*if (array_key_exists('cust_id', $post)) {
           $cust_id = $post['cust_id'];
        }else{
        	$cust_id = null;
        }*/
		
		$data = array(
			//'cust_id' =>$cust_id,
			'cust_id'=> $post['cust_id'],
			'completed_date'=> $post['completed_date'], 
			'payment_date'	=>$post['payment_date'], 
			'payment_time'=>$post['payment_time'],
			'payment_id'=> $post['payment_id'] ,
			'price' => $post['price'], 
			'chat_name'=>$post['chat_name'],
			'winning_number'=>$post['winning_number'] ,
			'remark'=> $post['remark'] ,
			'account_name'=>$post['account_name'] ,
			'received_bank_account'=>$post['received_bank_account'] ,
            'created_at'=>date('Y-m-d H:i')
		);

		$win_auction = $this->auction->rowInsert('winning_number',$data);
		if($win_auction){
			$this->session->set_flashdata('success', 'Winning Record added successfully !');
			redirect('addWinAuction');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong!');
		    redirect('addWinAuction');
		}
	}


	public function get_completed_auction(){

	    $filter_unpaid = $this->input->get('unpaid');
	    $revenue = $this->input->get('revenue');
	    $no_payment = $this->input->get('no_payment');

	    $sLimit = "";

	        $lenght = $_GET['iDisplayLength'];
	        $str_point = $_GET['iDisplayStart'];
	        
	        $col_sort = array('id','cust_id','completed_date','payment_date','payment_time','payment_id','price','chat_name','winning_number','account_name','received_bank_account','remark','created_at','updated_at');

	  		$select="*";
			
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

	        if($filter_unpaid == "on"){
	        	$where .= " AND (DATE(payment_date) is Null)";
	        }
	        if($no_payment == "no_payment"){
	        	$where .= " AND (payment_id is Null)";
	        }

	        if($revenue == "week"){

	        	$monday = strtotime("last monday");
				$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
				$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
				$this_week_sd = date("Y-m-d",$monday);
				$this_week_ed = date("Y-m-d",$sunday);

				$where .= " AND (DATE(payment_date) >='$this_week_sd')";

				$where .= " AND (DATE(payment_date) <='$this_week_ed')";
	        	

	        	$result = $this->cnc_model->getDatanew('winning_number',$select,$where,$order_by,$order,$lenght,$str_point);

	        }
	        else if($revenue == "month"){
	       
	            $first_day_this_month = date('Y-m-01'); 
	            $last_day_this_month  = date('Y-m-t');

	            $where .= " AND (DATE(payment_date) >='$first_day_this_month')";

				$where .= " AND (DATE(payment_date) <='$last_day_this_month')";

	        	$result = $this->cnc_model->getDatanew('winning_number',$select,$where,$order_by,$order,$lenght,$str_point);
	        }
	        else{

	        	$result = $this->cnc_model->getDatanew('winning_number',$select,$where,$order_by,$order,$lenght,$str_point);
	        }
	       
	        $total_record = $this->cnc_model->getRowCountnew('winning_number',$select,$where,$order_by,$order);

	        $output = array(
	            "sEcho" => 0,
	            "iTotalRecords" => $total_record,
	            "iTotalDisplayRecords" => $total_record,
	            "aaData" => array()
	        );
	        
	        $session=$this->session->userdata();
			
			foreach ($result as $key=>$val) {

				$created_at=!empty($val['created_at'])?date('m-d-Y H:i',strtotime($val['created_at'])):'Not created';
				
	            $updated_date=!empty($val['updated_at'])?date('m-d-Y H:i',strtotime($val['updated_at'])):'Not updated';

	        	$action='';
				if ($session['access']['completed']['access_update']){
	     			$action='<a href='.base_url("editWinAuction/".$val['id']."").'><button  type="button"  data_id="'.$val['id'].'" class=" edit yellow-casablanca btn-circle btn-sm btn"><i class="fa fa-edit" href="javascript:;"></i></button></a>';
				}
				if ($session['access']['completed']['access_delete']){
					$action.='<button type="button" data_id="'.$val['id'].'" class="delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';
				}
	    	
				if (empty($action)){
					$action='<button title="Not Authorized" type="button" data_id="'.$val['id'].'" class="red btn-circle btn-sm btn" href="javascript:;"> <i class="fa fa-ban" ></i>  Not Authorized</button>';	
				}

	            if($val['payment_date']== "0000-00-00"){
	                $payment_date = "Not Authorized";
	            }
	            else{
	                $payment_date = date('Y-m-d',strtotime($val['payment_date']));
	            }

	            if($val['completed_date']== "0000-00-00"){
	                $completed_date = "Not Authorized";
	            }
	            else{
	                $completed_date = date('Y-m-d',strtotime($val['completed_date']));
	            }

	            if($val['price'] == 0){
	               $price = '';
	            }
	            else{
	            	$price = $val['price'];
	            }

	            $output['aaData'][]=array(
	                $val['cust_id'],
	            	$completed_date,
	            	$payment_date,
	            	$val['payment_time'],	
	            	$val['payment_id'],	
	            	$price,
	            	$val['chat_name'],
	            	$val['winning_number'],
	            	$val['account_name'],
	            	$val['received_bank_account'],
	                $val['remark'],
	                $created_at,
	                $updated_date,
	                $action,
					);
	        }
	        echo json_encode($output);
	        die;
	}

	function editWinAuction($id){
		$res["result"]=$this->auction->getData('winning_number',['id'=>$id]);
		$this->slug='auction';
		$this->load('auction/Update_Win_Auction',$res);
	}

	function delete_win_number(){
		$id=$this->input->post('id');
		$this->cnc_model->rowsDelete('winning_number',array('id'=>$id));
		$this->session->set_flashdata('success', 'Auction Successfully Deleted');
		echo "true";
	}

	function update_WinAuction(){
		$post=$this->input->post();
		
		if (!empty($post)) {
			$id=$post['id'];
			$post['updated_at']=date('Y-m-d H:i:s');
			$new_res=$this->cnc_model->rowUpdate('winning_number',$post,['id'=>$id]);

	        if ($new_res) {
				$this->session->set_flashdata('success', 'Complete Auction List Updated successfully Updated !');
				 redirect('winning_auction'); 
			}else{
				$this->session->set_flashdata('error', 'Something went wrong ! ');

				 redirect('winning_auction');
			}
		}else{
			$this->session->set_flashdata('error', 'Something went wrong !');
				 redirect('winning_auction');
		}
	}


	public function export_Auction(){

	    $result = $this->cnc_model->getData('winning_number','*');    
	    if(!empty($result)){
		    $delimiter = ",";
		    $filename = "FasttabienWinAuction".date('m-d-Y H:i').".csv";
		    $f = fopen('php://memory', 'w');
		    $fields = array('id','cust_id','completed_date','payment_date','payment_time','	payment_id','price','chat_name','winning_number','remark','account_name','received_bank_account','created_at','updated_at');
		    fputcsv($f, $fields, $delimiter);
		    foreach ($result as $key => $value) {

		    	$customer_data = array($value['id'],$value['cust_id'],date('m-d-Y',strtotime($value['completed_date'])),date('m-d-Y',strtotime($value['payment_date'])),$value['payment_time'],$value['payment_id'], $value['price'], $value['chat_name'], $value['winning_number'], $value['remark'],$value['account_name'], $value['received_bank_account'],date('m-d-Y',strtotime($value['created_at'])),date('m-d-Y',strtotime($value['updated_at'])) );

		    	fputcsv($f, $customer_data, $delimiter);
		    }
		    fseek($f, 0);
		    header('Content-Type: text/csv');
		    header('Content-Disposition: attachment; filename="' . $filename . '";');
		    fpassthru($f);
	    }
	     exit;
    }

	public function get_revenueComplete(){

	    $sLimit = "";

	    $lenght = $_GET['iDisplayLength'];
	    $str_point = $_GET['iDisplayStart'];
	    
	    $total_record = $this->cnc_model->getData('winning_number','id,count(cust_id) as cust_id_of_customer,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%Y-%m-%d") as date',false,false,'completed_date','DESC',$lenght,$str_point,false,'date');
	  
	    $output = array(
	        "sEcho" => 0,
	        "iTotalRecords" => count($total_record),
	        "iTotalDisplayRecords" => count($total_record),
	        "aaData" => array()
	    );
	    
	    foreach ($total_record as $key=>$val) {

	        $query = "SELECT c.price as source,sum(wn.price) as amt,wn.* from winning_number wn join customer c on c.id=wn.cust_id where wn.completed_date= '".$val['date']."' GROUP BY c.price" ;

	        $result = $this->db->query($query)->result_array();
	        
	        $Facebook_amt='';
	        $Line_amt='';
	        foreach ($result as $key2 => $value) {

	        	if($value['source']=='Facebook'){
	        		
	        		if($value['amt'] == 0){
	        			$Facebook_amt='';
	        		}
	        		else{
	        			$Facebook_amt = $value['amt'];
	        		}
	        	}

	            if($value['source']=='Line@'){

	            	if($value['amt'] == 0){
	        			$Line_amt='';
	        		}
	        		else{
	                  $Line_amt = $value['amt'];
	        		}
	        		
	        	}
	        }


	    	$output['aaData'][]=array(($key+1),
	            date('d-m-Y',strtotime($val['date'])),
	            $val['cust_id_of_customer'],
	            $val['price_revenue_sum'],
	            $Line_amt,
	            $Facebook_amt,
	        );
	      
	    }
	    echo json_encode($output);
	    die;
	}

	public function get_revenueByMonth(){

	    $sLimit = "";
	    $lenght = $_GET['iDisplayLength'];
	    $str_point = $_GET['iDisplayStart'];

	    $total_record = $this->cnc_model->getData('winning_number','id,count(cust_id) as cust_id_of_customer,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m %Y") as month',false,false,'completed_date','DESC',$lenght,$str_point,false,'month');
	    
	    $output = array(
	        "sEcho" => 0,
	        "iTotalRecords" => count($total_record),
	        "iTotalDisplayRecords" => count($total_record),
	        "aaData" => array()
	    );
	    
	    foreach ($total_record as $key=>$val) {

	       $query = "SELECT c.price as source,sum(wn.price) as amt,wn.* from winning_number wn join customer c on c.id=wn.cust_id where DATE_FORMAT(wn.completed_date, '%m %Y')= '".$val['month']."' GROUP BY c.price" ;

	        $result = $this->db->query($query)->result_array();
	        $Facebook_amt='';
	        $Line_amt='';
	        foreach ($result as $key2 => $value) {

	            if($value['source']=='Facebook'){
	        		if($value['amt'] == 0){
	        			$Facebook_amt='';
	        		}
	        		else{
	        			$Facebook_amt = $value['amt'];
	        		}
	        	}

	        	if($value['source']=='Line@'){
	        		if($value['amt'] == 0){
	        			$Line_amt='';
	        		}
	        		else{
	        			$Line_amt= $value['amt'];
	        		}
	        	}
	        }

	        $dateObj   = DateTime::createFromFormat('!m', substr($val['month'], 0, 2));
	        $monthName = $dateObj->format('F');

	        $year = substr($val['month'], -4);

	        $final_month_year = $monthName.' '. $year;

	        $output['aaData'][]=array(($key+1),
	        	$final_month_year,
	            $val['cust_id_of_customer'],
	            $val['price_revenue_sum'],
	            $Line_amt,
	            $Facebook_amt,
	        );

	    }
	    echo json_encode($output);
	    die;
	}

	public function get_revenueByYear(){

	    $sLimit = "";

	    $lenght = $_GET['iDisplayLength'];
	    $str_point = $_GET['iDisplayStart'];

	    $total_record = $this->cnc_model->getData('winning_number','id,count(cust_id) as cust_id_of_customer,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%Y") as year',false,false,'completed_date','DESC',$lenght,$str_point,false,'year');

	    $output = array(
	        "sEcho" => 0,
	        "iTotalRecords" => count($total_record),
	        "iTotalDisplayRecords" => count($total_record),
	        "aaData" => array()
	    );
	    
	    foreach ($total_record as $key=>$val) {

	       $query = "SELECT c.price as source,sum(wn.price) as amt,wn.* from winning_number wn join customer c on c.id=wn.cust_id where DATE_FORMAT(wn.completed_date, '%Y')= '".$val['year']."' GROUP BY c.price" ;
	     
	        $result = $this->db->query($query)->result_array();
	        $Facebook_amt='';
	        $Line_amt='';
	        foreach ($result as $key2 => $value) {

	            if($value['source']=='Facebook'){
	        		if($value['amt'] == 0){
	        			$Facebook_amt='';
	        		}
	        		else{
	        			$Facebook_amt = $value['amt'];
	        		}
	        	}

	        	if($value['source']=='Line@'){
	        		if($value['amt'] == 0){
	        			$Line_amt='';
	        		}
	        		else{
	        			 $Line_amt = $value['amt'];
	        		}
	        	}
	        }

	        $output['aaData'][]=array(($key+1),
	            //date('Y',strtotime($val['year'])),
	            $val['year'],
	            $val['cust_id_of_customer'],
	            $val['price_revenue_sum'],
	            $Line_amt,
	            $Facebook_amt,
	        );

	    }
	    echo json_encode($output);
	    die;
	}

	public function bank_revenue(){

	    $sLimit = "";

	    $lenght = $_GET['iDisplayLength'];
	    $str_point = $_GET['iDisplayStart'];


	    $where ="account_name !='' AND received_bank_account!='' ";
	 
	    $total_record= $this->cnc_model->getData('winning_number','*',$where,false,'completed_date','DESC',$lenght,$str_point,false,'account_name,received_bank_account');
	    /*echo"<pre>";
	    print_r($this->db->last_query());
	    die('ok');*/
	    $output = array(
	        "sEcho" => 0,
	        "iTotalRecords" => count($total_record),
	        "iTotalDisplayRecords" => count($total_record),
	        "aaData" => array()
	    );

	    $account_name = '';
	    $totalSum = '';
	    $jantotalprice = 0;
	    $jantotalcount = 0;
	    $febtotalprice = 0;
	    $febtotalcount = 0;
	    $marchtotalprice = 0;
	    $marchtotalcount = 0;
	    $apriltotalprice = 0;
	    $apriltotalcount = 0;
	    $maytotalprice = 0;
	    $maytotalcount = 0;
	    $junetotalprice = 0;
	    $junetotalcount = 0;
	    $julytotalprice = 0;
	    $julytotalcount = 0;
	    $augtotalprice = 0;
	    $augtotalcount = 0;
	    $septotalprice = 0;
	    $septotalcount = 0;
	    $octtotalprice = 0;
	    $octtotalcount = 0;
	    $novtotalprice = 0;
	    $novtotalcount = 0;
	    $dectotalprice = 0;
	    $dectotalcount = 0;


	    foreach ($total_record as $key=>$val) {

	        $newjan = '';
	        $newfeb = '';
	        $newmar = '';
	        $newapr = '';
	        $newmay = '';
	        $newjun = '';
	        $newjul = '';
	        $newaug = '';
	        $newsep = '';
	        $newoct = '';
	        $newnov = '';
	        $newdec = '';
	        
	        $janpriceCount = 0;
	        $jantotalCount = 0; 
	        $febpriceCount = 0;
	        $febtotalCount = 0;
	        $marchpriceCount = 0;
	        $marchtotalCount = 0;
	        $aprilpriceCount = 0;
	        $apriltotalCount = 0;
	        $maypriceCount = 0;
	        $maytotalCount = 0;
	        $junepriceCount = 0;
	        $junetotalCount = 0;
	        $julypriceCount = 0;
	        $julytotalCount = 0;
	        $AugustpriceCount = 0;
	        $AugusttotalCount = 0;
	        $SeptemberpriceCount = 0;
	        $SeptembertotalCount = 0;
	        $octoberpriceCount = 0;
	        $octobertotalCount = 0;
	        $NovemberpriceCount = 0;
	        $NovembertotalCount = 0;
	        $DecemberpriceCount = 0;
	        $DecembertotalCount = 0;

	        $account_name = $val['account_name'].' - ' .$val['received_bank_account'];  

	        $jan = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=01"
	            ,false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');

	            if(!empty($jan)){

	                $janpriceCount = $janpriceCount+$jan[0]['price_revenue_sum'];
	                $jantotalCount = $jantotalCount+$jan[0]['total'];

	                if($janpriceCount!=0 &&  $jantotalCount !=0){
	                    
	                    $jantotalprice += $janpriceCount;
	                    $jantotalcount += $jantotalCount;
	                    $newjan = $jantotalprice. ' ( '.$jantotalcount.' ) ';
	                }
	                else{
	                  $newjan='';
	                }
	         
	                $jan = $jan[0]['price_revenue_sum'].  ' ( '.$jan[0]['total'].' )';   
	            }  
	  
	          
	        $feb = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=02",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');

	            if(!empty($feb)){
	                $febpriceCount = $febpriceCount+$feb[0]['price_revenue_sum'];
	                $febtotalCount = $febtotalCount+$feb[0]['total'];
	                if($febpriceCount!=0 &&  $febtotalCount !=0){
	                    
	                    $febtotalprice += $febpriceCount;
	                    $febtotalcount += $febtotalCount;
	                    $newfeb = $febtotalprice. ' ( '.$febtotalcount.' ) ';
	                }
	                else{
	                  $newfeb='';
	                }
	         
	                $feb = $feb[0]['price_revenue_sum'].  ' ( '.$feb[0]['total'].' )';      
	            }

	        $march = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=03",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	            if(!empty($march)){
	                 $marchpriceCount = $marchpriceCount+$march[0]['price_revenue_sum'];
	                 $marchtotalCount = $marchtotalCount+$march[0]['total'];
	                if($marchpriceCount!=0 &&  $marchtotalCount !=0){
	                    
	                    $marchtotalprice += $marchpriceCount;
	                    $marchtotalcount += $marchtotalCount;
	                    $newmar = $marchtotalprice. ' ( '.$marchtotalcount.' ) ';
	                }
	                else{
	                  $newmar='';
	                }
	                 $march = $march[0]['price_revenue_sum'].  ' ( '.$march[0]['total'].'  )';
	            }

	        $april = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=04",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	            if(!empty($april)){
	                $aprilpriceCount = $aprilpriceCount+$april[0]['price_revenue_sum'];
	                $apriltotalCount = $apriltotalCount+$april[0]['total'];
	                if($aprilpriceCount!=0 &&  $apriltotalCount !=0){

	                    $apriltotalprice += $aprilpriceCount;
	                    $apriltotalcount += $apriltotalCount;
	                    $newapr = $apriltotalprice. ' ( '.$apriltotalcount.' ) ';
	                }
	                else{
	                     $newapr='';
	                }
	                $april = $april[0]['price_revenue_sum'].  ' ( '.$april[0]['total'].' )';     
	            }

	        $may = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=05",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	             if(!empty($may)){
	                $maypriceCount = $maypriceCount+$may[0]['price_revenue_sum'];
	                $maytotalCount = $maytotalCount+$may[0]['total'];
	                if($maypriceCount!=0 &&  $maytotalCount !=0){
	                    
	                    $maytotalprice += $maypriceCount;
	                    $maytotalcount += $maytotalCount;
	                    $newmay = $maytotalprice. ' ( '.$maytotalcount.' ) ';
	                }
	                else{
	                  $newmay='';
	                }     
	                $may = $may[0]['price_revenue_sum'].  ' ( '.$may[0]['total'].' )';    
	            }

	        $june = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=06",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	            if(!empty($june)){
	                $junepriceCount = $junepriceCount+$june[0]['price_revenue_sum'];
	                $junetotalCount = $junetotalCount+$june[0]['total'];
	                 if($junepriceCount!=0 &&  $junetotalCount !=0){
	                    
	                    $junetotalprice += $junepriceCount;
	                    $junetotalcount += $junetotalCount;
	                    $newjun = $junetotalprice. ' ( '.$junetotalcount.' ) ';
	                }
	                else{
	                  $newjun='';
	                } 
	                $june = $june[0]['price_revenue_sum'].  ' ( '.$june[0]['total'].' )';       
	            }

	        $july = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=07",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	            if(!empty($july)){  
	                $julypriceCount = $julypriceCount+$july[0]['price_revenue_sum'];
	                $julytotalCount = $julytotalCount+$july[0]['total'];
	                if($julypriceCount != 0 &&  $julytotalCount != 0){
	                   
	                   $julytotalprice += $julypriceCount;
	                   $julytotalcount += $julytotalCount;
	                   $newjul = $julytotalprice. ' ( '.$julytotalcount.' ) ';
	                }
	                else{
	                  $newjul='';
	                } 
	                $july = $july[0]['price_revenue_sum'].  ' ( '.$july[0]['total'].' )';           
	            }

	        $August = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=08",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	            if(!empty($August)){
	                $AugustpriceCount = $AugustpriceCount+$August[0]['price_revenue_sum'];
	                $AugusttotalCount = $AugusttotalCount+$August[0]['total'];
	                if($AugustpriceCount != 0 &&  $AugusttotalCount != 0){
	                   
	                   $augtotalprice += $AugustpriceCount;
	                   $augtotalcount += $AugusttotalCount;
	                   $newaug = $augtotalprice. ' ( '.$augtotalcount.' ) ';
	                }
	                else{
	                  $newaug='';
	                } 
	                $August = $August[0]['price_revenue_sum'].  ' ( '.$August[0]['total'].' )';        
	            }

	        $September = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=09",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	             if(!empty($September)){
	                $SeptemberpriceCount = $SeptemberpriceCount+$September[0]['price_revenue_sum'];
	                $SeptembertotalCount = $SeptembertotalCount+$September[0]['total'];
	                if($SeptemberpriceCount != 0 &&  $SeptembertotalCount != 0){
	                    
	                    $septotalprice += $SeptemberpriceCount;
	                    $septotalcount += $SeptembertotalCount;
	                    $newsep = $septotalprice. ' ( '.$septotalcount.' ) ';
	                }
	                else{
	                  $newsep='';
	                } 
	                $September = $September[0]['price_revenue_sum'].  ' ( '.$September[0]['total'].' )';   
	            }

	        $october = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=10",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	            if(!empty($october)){ 
	                $octoberpriceCount = $octoberpriceCount+$october[0]['price_revenue_sum'];
	                $octobertotalCount = $octobertotalCount+$october[0]['total']; 
	                if($octoberpriceCount != 0 &&  $octobertotalCount != 0){
	                    
	                    $octtotalprice += $octoberpriceCount;
	                    $octtotalcount += $octobertotalCount;
	                    $newoct = $octtotalprice. ' ( '.$octtotalcount.' ) ';
	                }
	                else{
	                  $newoct='';
	                } 
	                $october = $october[0]['price_revenue_sum'].  ' ( '.$october[0]['total'].' )';
	            }

	        $November = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=11",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	            if(!empty($November)){ 
	                $NovemberpriceCount = $NovemberpriceCount+$November[0]['price_revenue_sum'];
	                $NovembertotalCount = $NovembertotalCount+$November[0]['total'];
	                if($NovemberpriceCount != 0 &&  $NovembertotalCount != 0){
	                    
	                    $novtotalprice += $NovemberpriceCount;
	                    $novtotalcount += $NovembertotalCount;
	                    $newnov = $novtotalprice. ' ( '.$novtotalcount.' ) ';
	                }
	                else{
	                  $newnov='';
	                } 
	                $November = $November[0]['price_revenue_sum'].  ' ( '.$November[0]['total'].' )';    
	            }

	        $December = $this->cnc_model->getData('winning_number','id,count(price) as total,account_name,received_bank_account,SUM(price) as price_revenue_sum,DATE_FORMAT(completed_date, "%m-%Y") as month',"account_name= '".$val['account_name']."' AND received_bank_account= '".$val['received_bank_account']."' AND month(completed_date)=12",false,'completed_date','DESC',false,false,false,'month,account_name,received_bank_account');
	            if(!empty($December)){
	               $DecemberpriceCount = $DecemberpriceCount+$December[0]['price_revenue_sum'];
	               $DecembertotalCount = $DecembertotalCount+$December[0]['total'];
	                if($DecemberpriceCount != 0 &&  $DecembertotalCount != 0){
	                    
	                    $dectotalprice += $DecemberpriceCount;
	                    $dectotalcount += $DecembertotalCount;
	                    $newdec = $dectotalprice. ' ( '.$dectotalcount.' ) ';
	                }
	                else{
	                  $newdec='';
	                } 
	               $December = $December[0]['price_revenue_sum'].  ' ( '.$December[0]['total'].' )';    
	             }

	            $TotalMonthSum = '';
	            $TotalSum ='';
	            $TotalCount='';

	            $TotalSum = $janpriceCount + $febpriceCount + $marchpriceCount + $aprilpriceCount + $maypriceCount + $junepriceCount + $julypriceCount + $AugustpriceCount + $SeptemberpriceCount + $octoberpriceCount + $NovemberpriceCount + $DecemberpriceCount;

	           $TotalCount = $jantotalCount + $febtotalCount + $marchtotalCount +  $apriltotalCount + $maytotalCount + $junetotalCount + $julytotalCount + $AugusttotalCount + $SeptembertotalCount + $octobertotalCount + $NovembertotalCount + $DecembertotalCount ;
	    
	            $TotalMonthSum = $TotalSum.' ( '.$TotalCount.' )';

	        $data= array( 
	                   ($key+1),
	                    $account_name,
	                    $jan,
	                    $feb,
	                    $march,
	                    $april,
	                    $may,
	                    $june,
	                    $july,
	                    $August,
	                    $September,
	                    $october,
	                    $November,
	                    $December,
	                    $TotalMonthSum
	                );
	    
	        $output['aaData'][]= $data;

	    }
	 
	    $data = array( 
	               'Total',
	               'Total Revenue',
	                $newjan,
	                $newfeb,
	                $newmar,
	                $newapr,
	                $newmay,
	                $newjun,
	                $newjul,
	                $newaug,
	                $newsep,
	                $newoct,
	                $newnov,
	                $newdec,
	                $totalSum,
	        );

	    $output['aaData'][]= $data;
	    echo json_encode($output);
	    die; 
	}




}