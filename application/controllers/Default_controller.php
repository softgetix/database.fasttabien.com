<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Default_controller extends CI_Controller {


public function __construct() {
    parent::__construct();
}

public function index(){
	$category=$this->cnc_model->getData('category','*',['star_category'=>1]);
	if (!empty($category)) {
		$join=array(
				array(
					'table'=>'group_table g',
					'on'=>'g.id=r.group_id',
				),
				array(
					'table'=>'category c',
					'on'=>'c.id=r.catg_id',
				),		
			);
			
			$group=$this->cnc_model->getData('records r','g.*',['r.catg_id'=>$category[0]['id']],$join,false,'DESC',false,false,false,'r.group_id');

			$select="r.id,c.name as cname,price,data,number,is_sold,g.is_featured,r.created_at,r.updated_at";
			if (!empty($group)) {
				foreach ($group as $key => $value) {
					$records=$this->cnc_model->getData('records r',$select,['r.catg_id'=>$category[0]['id'],'r.group_id'=>$value['id']],$join);
					$group[$key]['records']=$records;
				}
			}
			$data['category']=$category[0];
			$data['data']=$group;
			$this->load->view('frontend/category',$data);
	}else
		header("Location: https://fasttabien.com");
	
}
public function error404(){
	$this->load->view('404.php');
}

public function homescreen($catg=''){

	list(,$catg)=explode('/',$_SERVER['REDIRECT_QUERY_STRING']);
	
	if (!empty($catg)) {
		$url=base_url().$catg;	
		$category=$this->cnc_model->getData('category','*',['url'=>$url]);
		if (!empty($category)) {
			$join=array(
				array(
					'table'=>'group_table g',
					'on'=>'g.id=r.group_id',
				),
				array(
					'table'=>'category c',
					'on'=>'c.id=r.catg_id',
				),		
			);
			
			$group=$this->cnc_model->getData('records r','g.*',['r.catg_id'=>$category[0]['id']],$join,false,'DESC',false,false,false,'r.group_id');

			$select="r.id,c.name as cname,price,data,number,is_sold,g.is_featured,r.created_at,r.updated_at";
			if (!empty($group)) {
				foreach ($group as $key => $value) {
					$records=$this->cnc_model->getData('records r',$select,['r.catg_id'=>$category[0]['id'],'r.group_id'=>$value['id']],$join);
					$group[$key]['records']=$records;
				}
			}
			$data['category']=$category[0];
			$data['data']=$group;
			//echo '<pre>';
			//print_r($group);die();	
			$this->load->view('frontend/category',$data);
		}
		else
			redirect();			
	}else
		redirect();
}


}
