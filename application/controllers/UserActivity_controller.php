<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserActivity_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->slug='user activity';
        $this->load('UserActivity/activity');
    }

   public function viewActivity(){

        $filter_by_year = $this->input->get('filter_by_year');

        $sLimit = "";

        $lenght = $_GET['iDisplayLength'];
        $str_point = $_GET['iDisplayStart'];
       
        $select = "al.access_level_id,al.access_level_name,u.name,c.*";
        
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

        $where = "al.access_level_id != 1";

        if( $filter_by_year){
            $where .= " AND YEAR(`c`.`created_at`) = ".$filter_by_year."";
        }
        $order_by = "al.access_level_id";
        $order = 'asc';

        $total_record = $this->cnc_model->getData('customer as c',$select,$where,$join,$order_by,$order,false,false,false,'c.created_by');

        $count = count($total_record );

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => count($total_record),
            "iTotalDisplayRecords" => count($total_record),
            "aaData" => array()
        );

        $jantotal = 0;
        $febtotal = 0;
        $martotal = 0;
        $aprtotal = 0;
        $maytotal = 0;
        $juntotal = 0;
        $julytotal = 0;
        $augtotal = 0;
        $septotal = 0;
        $octtotal = 0;
        $novtotal = 0;
        $dectotal = 0;
        $modjantotal = 0;
        $modfebtotal = 0;
        $modmartotal = 0;
        $modaprtotal = 0;
        $modmaytotal = 0;
        $modjuntotal = 0;
        $modjulytotal = 0;
        $modaugtotal = 0;
        $modseptotal = 0;
        $modocttotal = 0;
        $modnovtotal = 0;
        $moddectotal = 0;

        $jancount = 0;
        $modjancount = 0;
        $febcount = 0;
        $modfebcount = 0;
        $marcount = 0;
        $modmarcount = 0;
        $aprcount = 0;
        $modaprcount = 0;
        $maycount = 0;
        $modmaycount = 0;
        $juncount = 0;
        $modjuncount = 0;
        $julycount = 0;
        $modjulycount = 0;
        $augcount = 0;
        $modaugcount = 0;
        $sepcount = 0;
        $modsepcount = 0;
        $octcount = 0;
        $modoctcount = 0;
        $novcount = 0;
        $modnovcount = 0;
        $deccount = 0;
        $moddeccount = 0;

        if(!empty($filter_by_year)){
           $year  =  $filter_by_year;
        }

        foreach ($total_record as $key=>$val) {

            $jan = 0; $feb = 0; $mar = 0; $apr = 0; $may = 0; $jun = 0; $july = 0; $aug = 0; $sep = 0; $oct = 0; $nov = 0; $dec = 0;

            $modjan = 0; $modfeb = 0; $modmar = 0; $modapr = 0; $modmay = 0; $modjun = 0; $modjuly = 0; $modaug = 0; $modsep = 0; $modoct = 0; $modnov = 0; $moddec = 0;

            $getjan = ''; $getfeb = ''; $getmar = ''; $getapr = ''; $getmay = ''; $getjun = ''; $getjuly = ''; $getaug = ''; $getsep = ''; $getoct = ''; $getnov = ''; $getdec = '';

            $janfinal=''; $febfinal = ''; $marfinal = ''; $aprfinal = ''; $mayfinal = ''; $junfinal = ''; $julyfinal = ''; $augfinal = ''; $sepfinal = ''; $octfinal = ''; $novfinal = ''; $decfinal = '';

            
            $added = $this->cnc_model->getData('customer as c','YEAR(`c`.`created_at`) as year,`u`.`name`,`c`.`created_by`, `al`.`access_level_id`, `al`.`access_level_name`,MONTH(c.created_at) AS addedMonth,count(c.created_at) as case_added,',"c.created_by = '".$val['created_by']."' AND YEAR(`c`.`created_at`) = '".$year."' ",$join,false,false,false,false,false,'addedMonth');


            foreach($added as $key1 => $val1){

                if($val1['addedMonth'] == 1){
                    $jan = $val1['case_added'];
                    if(!empty($jan)){
                        $jantotal += $val1['case_added'];
                        if($jantotal){
                          $jancount = $jantotal * $count;
                        }
                    }else{
                        $jan = 0;
                    }   
                }
                if($val1['addedMonth'] == 2){
                   $feb = $val1['case_added'];
                    if(!empty($feb)){
                        $febtotal += $val1['case_added'];
                        if($febtotal){
                          $febcount = $febtotal * $count;
                        }
                    }else{
                        $feb = 0;
                    }
                }

                if($val1['addedMonth'] == 3){
                   $mar = $val1['case_added'];
                    if(!empty($mar)){
                        $martotal += $val1['case_added'];
                        if($martotal){
                            $marcount = $martotal * $count;
                        }
                    }else{
                        $mar = 0;
                    }
                }

                if($val1['addedMonth'] == 4){
                    $apr = $val1['case_added'];
                    if(!empty($apr)){
                        $aprtotal += $val1['case_added'];
                        if($aprtotal){
                            $aprcount = $aprtotal * $count;
                        }
                    }else{
                        $apr = 0;
                    }
                }
                if($val1['addedMonth'] == 5){
                   $may = $val1['case_added'];
                    if(!empty($may)){
                        $maytotal += $val1['case_added'];
                        if($maytotal){
                            $maycount = $maytotal * $count;
                        }
                    }else{
                        $may = 0;
                    }
                }
                if($val1['addedMonth'] == 6){
                   $jun = $val1['case_added'];
                    if(!empty($jun)){
                        $juntotal += $val1['case_added'];
                        if($juntotal){
                            $juncount = $juntotal * $count;
                        }
                    }else{
                        $jun = 0;
                    }
                }
                if($val1['addedMonth'] == 7){
                    $july = $val1['case_added'];
                    if(!empty($july)){
                        $julytotal += $val1['case_added'];
                        if($julytotal){
                            $julycount = $julytotal * $count;
                        }
                    }else{
                        $july = 0;
                    }
                }
                if($val1['addedMonth'] == 8){
                    $aug = $val1['case_added'];
                    if(!empty($aug)){
                        $augtotal += $val1['case_added'];
                        if($augtotal){
                            $augcount = $augtotal * $count;
                        }
                    }else{
                        $aug = 0;
                    }
                }
                if($val1['addedMonth'] == 9){
                    $sep = $val1['case_added'];
                    if(!empty($sep)){
                        $septotal += $val1['case_added'];
                        if($septotal){
                            $sepcount = $septotal * $count;
                        }
                    }else{
                        $sep = 0;
                    }
                }
                if($val1['addedMonth'] == 10){
                    $oct = $val1['case_added'];
                    if(!empty($oct)){
                        $octtotal += $val1['case_added'];
                        if($octtotal){
                            $octcount = $octtotal * $count;
                        }
                    }else{
                        $oct = 0;
                    }
                }
                if($val1['addedMonth'] == 11){
                   $nov = $val1['case_added'];
                    if(!empty($nov)){
                        $novtotal += $val1['case_added'];
                        if($novtotal){
                            $novcount = $novtotal * $count;
                        }
                    }else{
                        $nov = 0;
                    }
                }
                if($val1['addedMonth'] == 12){
                   $dec = $val1['case_added'];
                    if(!empty($dec)){
                        $dectotal += $val1['case_added'];
                        if($dectotal){
                            $deccount = $dectotal * $count;
                        }
                    }else{
                        $dec = 0;
                    }
                }
            }

            $modify = $this->cnc_model->getData('customer as c','YEAR(`c`.`updated_at`) as modyear,`u`.`name`,`c`.`created_by`,`al`.`access_level_id`, `al`.`access_level_name`, MONTH(c.updated_at) AS modifyMonth,count(c.updated_at) as case_modify',"c.created_by= '".$val['created_by']."' AND YEAR(`c`.`updated_at`) = '".$year."'",$join,false,false,false,false,false,'modifyMonth');

            foreach($modify as $key2=>$val2){

                if($val2['modifyMonth'] == 1){
                    $modjan = $val2['case_modify'];
                    if(!empty($modjan)){
                        $modjantotal += $val2['case_modify'];
                        if($modjantotal){
                            $modjancount = $modjantotal*$count;
                        }
                    }else{
                        $modjan = 0;
                    }   
                }

                if($val2['modifyMonth'] == 2){
                    $modfeb = $val2['case_modify'];
                    if(!empty($modfeb)){
                        $modfebtotal += $val2['case_modify'];
                        if($modfebtotal){
                            $modfebcount = $modfebtotal*$count;
                        }
                    }else{
                        $modfeb = 0;
                    }   
                }
                if($val2['modifyMonth'] == 3){
                    $modmar = $val2['case_modify'];
                    if(!empty($modmar)){
                        $modmartotal += $val2['case_modify'];
                        if($modmartotal){
                            $modmarcount = $modmartotal*$count;
                        }
                    }else{
                        $modmar = 0;
                    }   
                }
                if($val2['modifyMonth'] == 4){
                    $modapr = $val2['case_modify'];
                    if(!empty($modapr)){
                        $modaprtotal += $val2['case_modify'];
                        if($modaprtotal){
                            $modaprcount = $modaprtotal*$count;
                        }
                    }else{
                        $modapr = 0;
                    }   
                }
                if($val2['modifyMonth'] == 5){
                    $modmay = $val2['case_modify'];
                    if(!empty($modmay)){
                        $modmaytotal += $val2['case_modify'];
                        if($modmaytotal){
                            $modmaycount = $modmaytotal*$count;
                        }
                    }else{
                        $modmay = 0;
                    }   
                }
                if($val2['modifyMonth'] == 6){
                    $modjun = $val2['case_modify'];
                    if(!empty($modjun)){
                        $modjuntotal += $val2['case_modify'];
                        if($modjuntotal){
                            $modjuncount = $modjuntotal*$count;
                        }
                    }else{
                        $modjun = 0;
                    }   
                }

                if($val2['modifyMonth'] == 7){
                    $modjuly = $val2['case_modify'];
                    if(!empty($modjuly)){
                        $modjulytotal += $val2['case_modify'];
                        if($modjulytotal){
                            $modjulycount = $modjulytotal*$count;
                        }
                    }else{
                        $modjuly = 0;
                    }   
                }
                if($val2['modifyMonth'] == 8){
                    $modaug = $val2['case_modify'];
                    if(!empty($modaug)){
                        $modaugtotal += $val2['case_modify'];
                        if($modaugtotal){
                            $modaugcount = $modaugtotal*$count;
                        }
                    }else{
                        $modaug = 0;
                    }   
                }
                if($val2['modifyMonth'] == 9){
                    $modsep = $val2['case_modify'];
                    if(!empty($modsep)){
                        $modseptotal += $val2['case_modify'];
                        if($modseptotal){
                            $modsepcount = $modseptotal*$count;
                        }
                    }else{
                        $modsep = 0;
                    }   
                }
                if($val2['modifyMonth'] == 10){
                    $modoct = $val2['case_modify'];
                    if(!empty($modoct)){
                        $modocttotal += $val2['case_modify'];
                        if($modocttotal){
                            $modoctcount = $modocttotal*$count;
                        }
                    }else{
                        $modoct = 0;
                    }   
                }

                if($val2['modifyMonth'] == 11){
                    $modnov = $val2['case_modify'];
                    if(!empty($modnov)){
                        $modnovtotal += $val2['case_modify'];
                        if($modnovtotal){
                            $modnovcount = $modnovtotal*$count;
                        }
                    }else{
                        $modnov = 0;
                    }   
                }
                if($val2['modifyMonth'] == 12){
                    $moddec = $val2['case_modify'];
                    if(!empty($moddec)){
                        $moddectotal += $val2['case_modify'];
                        if($moddectotal){
                            $moddeccount = $moddectotal*$count;
                        }
                    }else{
                        $moddec = 0;
                    }   
                }  
            }

            if($jan || $modjan) $getjan = $jan.'('.$modjan.')';
            if($feb || $modfeb) $getfeb = $feb.'('.$modfeb.')';
            if($mar || $modmar) $getmar = $mar.'('.$modmar.')'; 
            if($apr || $modapr) $getapr = $apr.'('.$modapr.')';
            if($may || $modmay) $getmay = $may.'('.$modmay.')';
            if($jun || $modjun) $getjun = $jun.'('.$modjun.')';
            if($july || $modjuly) $getjuly = $july.'('.$modjuly.')';
            if($aug || $modaug) $getaug = $aug.'('.$modaug.')';
            if($sep || $modsep) $getsep = $sep.'('.$modsep.')';
            if($oct || $modoct) $getoct = $oct.'('.$modoct.')';
            if($nov || $modnov) $getnov = $nov.'('.$modnov.')';
            if($dec || $moddec) $getdec = $dec.'('.$moddec.')';
        
            if($jancount || $modjancount) $janfinal = $jancount.'('.$modjancount.')';
            if($febcount || $modfebcount) $febfinal = $febcount.'('.$modfebcount.')';
            if($marcount || $modmarcount) $marfinal = $marcount.'('.$modmarcount.')';
            if($aprcount || $modaprcount) $aprfinal = $aprcount.'('.$modaprcount.')';
            if($maycount || $modmaycount) $mayfinal = $maycount.'('.$modmaycount.')';
            if($juncount || $modjuncount) $junfinal = $juncount.'('.$modjuncount.')';
            if($julycount || $modjulycount) $julyfinal = $julycount.'('.$modjulycount.')';
            if($augcount || $modaugcount) $augfinal = $augcount.'('.$modaugcount.')';
            if($sepcount || $modsepcount) $sepfinal = $sepcount.'('.$modsepcount.')';
            if($octcount || $modoctcount) $octfinal = $octcount.'('.$modoctcount.')';
            if($novcount || $modnovcount) $novfinal = $novcount.'('.$modnovcount.')';
            if($deccount || $moddeccount) $decfinal = $deccount.'('.$moddeccount.')';

            $account_name = $val['name'].'('.$val['access_level_name'] .')'; 
        
            $data = array(
                  ($key+1),
                    $account_name,
                    $getjan,
                    $getfeb,
                    $getmar,
                    $getapr,
                    $getmay,
                    $getjun,
                    $getjuly,
                    $getaug,
                    $getsep,
                    $getoct,
                    $getnov,
                    $getdec,   
                );

            $output['aaData'][] = $data;
        }

            $data = array(
                    '', 
                   'Total',
                    $janfinal,
                    $febfinal,
                    $marfinal,
                    $aprfinal,
                    $mayfinal,
                    $junfinal,
                    $julyfinal,
                    $augfinal,
                    $sepfinal,
                    $octfinal,
                    $novfinal,
                    $decfinal,
                );

            $output['aaData'][] = $data;

        echo json_encode($output);
        die;   
    }

}

