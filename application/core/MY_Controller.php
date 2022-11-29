<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    	
	public $slug='';
	public $sub_menu='';

	public function __construct()
	{
        parent::__construct();
    	
        if($this->session->userdata('user_id') == '') { 
        	redirect();				
        }
        $data=$this->cnc_model->getData('user','*',array('id'=>$this->session->userdata('user_id')));
        if(empty($data)){
           session_destroy();
           redirect();
       }

	}

 	public function load($page='page',$data=[]){
		$side_menu=['slug'=>$this->slug,'sub_menu'=>$this->sub_menu];
		$this->load->view('common/header');
	    $this->load->view('common/sidebar',$side_menu);
	    $this->load->view($page,$data);
	}

}

