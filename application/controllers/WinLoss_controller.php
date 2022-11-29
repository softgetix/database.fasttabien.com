<?php

defined('BASEPATH') or exit('No direct script access allowed');

class WinLoss_controller extends MY_Controller {

    public function __construct() {
    	parent::__construct();
    }

    public function index(){
    	$this->slug='win/loss probability';
    	$this->load('WinLoss/WinLoss');
    }

    public function import_winloss_csv(){

        $file = $_FILES['file'];

        if (!empty($file)) {
            $allowed = array('csv');
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            if (in_array($ext, $allowed)) {
                $file = fopen($file['tmp_name'],"r");
                $i = 1;
                $count = 0;
                 $prob ='';
                while(! feof($file))
                {   
                    $fdata = fgetcsv($file);

                    if ($i >1 && is_array($fdata)) {

                        $get_prob = $this->cnc_model->getData('win_loss_prob','*',['number'=>$fdata[0]]);

                        if(isset($get_prob) && !empty($get_prob)){

                            $status = $fdata[1];


                            if($get_prob[0]['status'] != $fdata[1]){
                                $prob = '50%';
                            }
                            else if($get_prob[0]['status'] == 'win'){
                                $prob = '100%';
                            } 
                            else if($get_prob[0]['status'] == 'loss'){
                               $prob = '0%';
                            }

                            // if(!empty($get_prob[0]['status']) && empty($fdata[1])){
                            //    $status  = 'null';
                            //    $prob = 'null'; 
                            // }
                            // else if($get_prob[0]['status'] == 'null'){
                            //     $status  = 'null';
                            //     $prob = 'null';
                            // }

                            $probability = $this->cnc_model->rowUpdate('win_loss_prob',array('status' => $status,'win_loss_prob'=> $prob,'updated_at'=> date('Y-m-d H:i')),['id'=>$get_prob[0]['id']]);
                        }
                        else{

                            if($fdata[1] == 'win'){
                            $prob = '100%';
                            }
                            else if($fdata[1] == 'loss'){
                                $prob = '0%';
                            }
                            // else if(empty($fdata[1])){
                            //     $status  = 'null';
                            //     $prob = 'null';  
                            // }

                            $data = array('number'=>$fdata[0],'status'=> $fdata[1],'win_loss_prob'=> $prob,'created_at'=>date('Y-m-d H:i'));

                            $probability = $this->cnc_model->rowInsert('win_loss_prob',$data);
                        }

                        $count++;
                    }

                   $i++;
                }

                // die('ok');

                if ($count>0) {
                    
                    $this->session->set_flashdata('success', $count.'File uploaded successfully!');
                    redirect('viewWinLoss');
                }else{
                    $this->session->set_flashdata('error', 'Something went wrong');
                    redirect('viewWinLoss');
                }
            }else{
                $this->session->set_flashdata('error', 'Please upload valid csv file');
                 redirect('viewWinLoss');
            }
        }else{
            $this->session->set_flashdata('error', 'File is required to upload');
                 redirect('viewWinLoss');
        }
    }

    public function get_winloss(){

        $sLimit = "";

        $lenght = $_GET['iDisplayLength'];
        $str_point = $_GET['iDisplayStart'];
        
        $col_sort = array("id",'number','status','win_loss_prob','created_at');
       
        $select = "*";
        
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

        $result = $this->cnc_model->getDatanew('win_loss_prob',$select,$where,$order_by,$order,$lenght,$str_point);
        
        $total_record = $this->cnc_model->getRowCountnew('win_loss_prob',$select,$where,$order_by,$order);

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );
        
        $session = $this->session->userdata();
        
        foreach ($result as $key=>$val) {

            $action = '';
            
            if ($session['access']['win/loss probability']['access_delete'])
                $action.='<button type="button" data_id="'.$val['id'].'" class="delete yellow-casablanca btn-circle btn-sm btn" href="javascript:;"><i class="fa fa-trash"></i></button>';

            if($val['status'] == 'null'){
                $status = '-';
            }
            else{
               $status = $val['status'];
            }

            if($val['win_loss_prob'] == 'null')
            {
               $prob = '-';
            }
            else{
               $prob = $val['win_loss_prob'];
            }

            $output['aaData'][]=array(($key+1),
                    
                    $val['number'],
                    $status,
                    $prob,
                    date('m-d-Y',strtotime($val['created_at'])),
                    $action,
                );
        }
        echo json_encode($output);
        die;
    }

    public function remove_prob(){
        $id = $this->input->post('id');
        $this->cnc_model->rowsDelete('win_loss_prob',array('id'=>$id));
        $this->session->set_flashdata('success', 'Record Successfully Deleted!!');
        echo "true";
    }

}