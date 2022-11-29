<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_controller extends CI_Controller {


public function __construct() {
    parent::__construct();
    $this->load->model('Admin_model','admin');
}
public function index(){
    
    if($this->session->userdata('user_id') == '') { 
	     
       $this->load->view('header');
       $this->load->view('login');
       $this->load->view('footer');
                 
    }else{
        redirect('user');
    }
}

public function login(){
	 
    if(isset($_POST['username']) && isset($_POST['password'])){
      
        $username=$this->input->post('username');
        $pwd=$this->input->post('password');
        
        $result=$this->cnc_model->getData('user','*',['user_name'=>$username]);
       
        if(!empty($result)){
                
                if(password_verify($pwd, $result[0]['password'])){

                  $role=$this->cnc_model->getData('access_level','*',['access_level_id'=>$result[0]['access_level_id']]);                

                  $this->session->set_userdata('user_id', $result[0]['id']);
                  $this->session->set_userdata('user_name', $result[0]['user_name']);
                  $this->session->set_userdata('name', $result[0]['name']);
                  $this->session->set_userdata('email', $result[0]['email']);
                  $this->session->set_userdata('role', $role[0]['access_level_name']);

                  $loginSessionData = array(
                   // 'permissions' => json_decode($result[0]['permissions'],true),
                    'access_level_id' => $result[0]['access_level_id'],
                    'access' => $this->getUserAccess($result[0]['access_level_id']),
                    );
                  $this->session->set_userdata($loginSessionData);
                  redirect('user');      
                    
              }else{
                
                  $this->session->set_flashdata('error', 'Password is not valid');   
                  redirect();
              }

        }else{

            $this->session->set_flashdata('error', 'Username is not valid');   
            redirect();     
        }
        
    }else{
        
        $this->session->set_flashdata('error', 'Invalid Username or Password');
        redirect();
    }
}

public function getUserAccess($user_access_level = 0) {
  $join = array(
              array(
                  "table" => 'module',
                  "on" => 'module.module_id = access.access_module_id'
              )
          );

  $select='access_module_id,access_view,access_insert,access_update,access_delete,module_link';
  $access_rights = $this->cnc_model->getData('access',$select, array('access_level_id' => $user_access_level),$join);
  //print_r( $access_rights);die;
    $accessData =  array();
  if(!empty($access_rights)){ 
      foreach ($access_rights as $key => $value) {
      $accessData[$value['module_link']] =  array(
                                  'access_view' => $value['access_view'],
                                  'access_insert' => $value['access_insert'],
                                  'access_update' => $value['access_update'],
                                  'access_delete' => $value['access_delete'],
                                  'module_name' => $value['module_link'],
                                  'access_module_id' => $value['access_module_id']
                                  );
      }
  } 
  return $accessData;
}

public function error404(){
  $this->load->view('404.php');
}

public function logout(){
    
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('email');
    $this->session->set_flashdata('success', 'You have successfully logged out.');
    redirect();
}

public function change_password($id){
   $idForChangePsw['id'] = $id;
   $post = $this->input->post();
  
    if (!empty($post)){
      $hashed_password   = password_hash($post['password'], PASSWORD_DEFAULT);
      $this->cnc_model->rowUpdate('user',['password'=>$hashed_password],['id'=>$id]);
      $this->session->set_flashdata('success', 'Password changed Successfully');
      redirect();
    }
    $this->load->view('header');
    $this->load->view('change_password',$idForChangePsw);
    $this->load->view('footer');
}


public function forget_password(){
  $email=$this->input->post('email');
  $result = $this->cnc_model->getData('user','*',array('email'=>$email));

  $id = $result[0]['id'];
  $name = $result[0]['name'];
    if(!empty($result)){
      
      $to =  $email;
      $subject = "Reset Password";
      $message = "
      <html>
        <head>
           <title>Reset Password</title>
        </head>
        <body>
            <a href='".base_url('change_password')."/".$id."'>Click To Reset password</a>
        </body>
      </html>
      ";
      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // More headers
      $headers .= 'From: <admin@database.fasttabien.com>' . "\r\n";
      //$headers .= 'Cc: admin@database.fasttabien.com' . "\r\n";
        if(mail($to,$subject,$message,$headers)){
          $this->session->set_flashdata('success', 'email sent successfully');
           redirect(); 
        }
        else{
          $this->session->set_flashdata('error', 'Something went wrong! error in sending email!');
           redirect();  
        }
        
    }
    
}

public function check_email(){  
  $email=$this->input->post('email');
  $res=$this->cnc_model->getData('user','*',['email'=>$email]);
  
  if (empty($res))
    echo 'false';
  else
    echo "true";

  die();
}




}