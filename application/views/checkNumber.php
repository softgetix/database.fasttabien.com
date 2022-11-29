<?php $session=$this->session->userdata();?>

<style type="text/css">
.add-row,.remove-row{margin-top:18%}
.category-data{display: none}
.result {display: none};
.res{text-align: center;font-size: 15px}
.portlet-title{min-height: 55px !important;}
.add_no{margin-left: 32%;margin-top: -48px;}
.no_btn{margin-left: 34%;margin-top: -48px;}
.new_res{margin-right:0px!important;margin-left: 0px!important;}
#check_number{padding-right: 0px;padding-left: 8px;}

@media(max-width: 991px){
  .add_no,.no_btn{margin-left: 16%;margin-bottom: 10px;}
  .clip_text,.clip_text1,.clip_text2{margin-top: -26px!important;margin-left: 26%!important;}
}

#exe_table,#exe_table1,#exe_table2{width: 33%;max-width: 100%;margin-left: 25%;text-align: center;}
.result_s,.result_s1{display: none;margin-top: -9px!important;}

.ss_blue{border-color: #1b65af !important;background-color: #1f7cda !important;color: #FFFFFF !important;}
.loader{ position: absolute;top: 290px;left: 495px; display: none;}
.clip_text,.clip_text1,.clip_text2{width: 30%; max-width: 100%;border: 1px solid; margin-top: -171px; margin-left: 62%;padding: 5px 5px;}
</style>
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo base_url('user') ?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					Check Number
				</li>
			</ul>	
		</div>
		<h4 class="page-title">
		Check Number <small></small>
		</h4>
		<?php
		if( null !== $this->session->flashdata('error') ){ ?>
		<div class="note note-danger">
			<button class="close" data-close="alert"></button>
			<span><?php echo $this->session->flashdata('error');?></span>
		</div>
		<?php }?>
		<?php
		if( null !== $this->session->flashdata('success') ){ ?>
		<div class="note note-success">
			<button class="close" data-close="alert"></button>
			<span><?php echo $this->session->flashdata('success');?></span>
		</div>
		<?php }?>
		<div class="row">
		<?php if($session['access']['specialNumber']['access_view']){?>	
			<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>Check Number
						</div>
						<div class="tools">
							<a href="<?php echo base_url('specialNumber');?>"><button class="btn btn-circle red-flamingo"><i class="fa fa-arrow-left"></i> Back
							</button></a>
							<a href="javascript:;" class="collapse">
							</a>
						</div>
					</div>
					<div class="portlet-body form">
						<form action="javascript:void(0)" class="form-horizontal" method="post" id="form">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Category Name</label>
									<div class="col-md-4">
										<input type="text" name="name" id="name"class="form-control input-circle" placeholder="Enter name">			
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Number</label>
									<div class="col-md-4">
										<input  type='number' name="number" id="number" class="form-control input-circle" placeholder="Enter Number" autocomplete="new-number" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn btn-circle yellow-casablanca">Check</button>
									</div>
								</div>
								<div class="result form-group new_res"></div>
								<div class="clip_text" style="display:none"></div>
								<div class="clip_text1" style="display:none"></div>
								<div class="clip_text2" style="display:none"></div>
							</div>
						</form>
					
						<div class="result_s" style="padding: 5px 5px !important;">
						    <table class="table table-striped table-hover table-bordered" id="exe_table">
								<thead>
								<tr>
									<th style="text-align: center;">Existing Category</th>
									
							    </tr>
								</thead>
									<tbody id="customer_category"></tbody>
							</table>	
					    </div>
					    <div class="result_s1" style="padding:5px !important">
							<table class="table table-striped table-hover table-bordered" id="exe_table1">
								<thead>
									<tr>
										<th style="text-align: center;">Number</th>
										<th style="text-align: center;">Price</th>
										<th style="text-align: center;">Existing Category
								    </tr>
								</thead>
									<tbody id="no_of_category"></tbody>
							</table>
					    </div> 
				    </div>
				</div>
			</div>
			</div>
			<?php  if($session['access_level_id'] <= 2){?>
			<div class="col-md-12">
					<div class="portlet box yellow-casablanca ">
						<div class="portlet-title check-title">
							<div class="caption">
								<i class="icon-docs"></i>Number list
							</div>
							<div class="tools">
								<?php if($session['access']['import/export']['access_view']){ ?>

								<a href="<?php echo base_url('Data_controller/exportAll');?>">
									<button type="button" class="btn red-flamingo btn-circle add_cust">
										<i class="fa fa-download"></i>Export All
									</button>
								</a>
								<a href="javascript:;" class="collapse"></a>
								<?php } ?>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-hover table-bordered" id="number_list_table">
								<thead>
								    <tr>
								    	<th>Number</th>
								    	<th>No. of cat</th>
								    </tr> 
								</thead>
							</table>	
						</div>
					</div>
			    </div>
		 <?php } } ?>	
		</div>
	</div>
</div>
<div class="loader"><img src="<?php echo base_url('assets/img/index.svg');?>" style="width: 29px; height: 29px;"></div>

<?php $this->load->view('common/footer');?>

<script type="text/javascript">

function copytoclip() {
 
  var copyText = document.getElementById("text_div");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
}

var FormValidation = function () {

   	var handleValidation1 = function() {
        	var form1 = $('#form');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);
            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
               	rules: {
                   	name: {
                        required: true
                    },
                    number:{
                    	required: true,
                   	}
                },

                invalidHandler: function (event, validator) { 
                    success1.hide();
                    error1.show();
                },

                highlight: function (element) { 
                    $(element)
                        .closest('.form-group').addClass('has-error'); 
                },

                unhighlight: function (element) { 
                    $(element)
                        .closest('.form-group').removeClass('has-error'); 
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); 
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                    var response_data = "";
	                var response_data1 = "";
	                var response_data2 = "";
	                var array_no = [];
	                var array_cat = [];

                    $(".loader").show();

                    $.ajax({
                    	type:'post',
                    	dataType:"Json",
                    	data:{name:$('#name').val(),number:$('#number').val()},
                    	url:base_url+'Data_controller/check_number',
                    	beforeAjax:function(){
                    		$('.result').hide();
                    	},
                    	success:function(res){

                            $.each(res.final_res,function(key,value){

	                            response_data1 += "<tr class='exe_cus'><td>"+value['category']+"&nbsp;&nbsp;"+value['number']+"</td><td>"+value['status']+"&nbsp;&nbsp;"+value['discount']+"</td><td>"+value['all_cat'].replace(",", "")+"</td></tr>";
	                            $(".result_s1").css("display","block");
			                    $("#no_of_category").html(response_data1);
			                    if(value['all_cat'] == ""){
				            	   array_no.push(value['number']);
				                }    
			                })
                    		 	 	
	                        $.each(res.customerdata,function(key,value){
	                            response_data += "<tr class='exe_cus'><td>"+value['cat']+"&nbsp;&nbsp;"+value['no']+"</td></tr>";
	                            $(".result_s").css("display", "block");
			                    $("#customer_category").html(response_data);
			                    array_cat.push(value['cat']);  
			                })

			                if(array_cat.includes("xx") == false){
                               var count = array_cat.length;
                               var not_dups = true;	
                            }  

	                        if(res.ok){
	                        	
	                            $(".clip_text").css("display", "block");
	                            $(".clip_text1").css("display", "none");
	                            $(".clip_text2").css("display", "none");

	                            response_data2 +='<textarea id="text_div" class="form-control" rows="8" readonly="">'+res.cat+'&nbsp;'+res.number+'&nbsp หมายเลขนี้ยังว่างครับผม สามารถรับจองได้ครับ ค่าบริการอยู่ที่ '+res.discount+'&nbsp หมวดนี้คาดว่าจะเปิดจองใน .... หากลูกค้าสนใจจอง สามารถแจ้งได้เลยนะครับ \n \n หมายเลขนี้ยังว่างครับผม สามารถรับจองได้ครับ ค่าบริการอยู่ที่ '+res.discount+' &nbsp ครับ คาดว่าจะจองสำเร็จในช่วงหมวด .... (หมวดใดหมวดหนึ่ง) ระยะเวลาจองจนสำเร็จ ประมาณ 1-3 สัปดาห์ครับ หากลูกค้าสนใจจอง สามารถแจ้งได้เลยนะครับ \n \n เพิ่มเติม: หากเป็นเลขใกล้เคียงที่ยังว่างอยู่ในทุกหมวดจะมีเป็น '+array_no+' ด้วยนะครับ หากคุณลูกค้าสนใจ สามารถเพิ่มกลุ่มเลขดังกล่าวได้นะครับ </textarea><br><a href="javascript:;" class="btn btn-circle yellow-casablanca" onclick="copytoclip()" >Copy to clipboard</a>';

	                            $('.clip_text').html(response_data2);
	                        }

	                        if(count == 6 && res.customerdata != ''){

		                    	$(".clip_text").css("display", "none");
		                        $(".clip_text1").css("display", "none");
		                        $(".clip_text2").css("display", "block");

		                        response_data2 +='<textarea id="text_div" class="form-control" rows="9" readonly="">'+res.cat+'&nbsp;'+res.number+' &nbsp หมายเลขนี้จะติดจองแล้วนะครับ จะไม่สามารถรับจองได้เลยครับผม ต้องขออภัยด้วยนะครับ หากลูกค้ามีเลขอื่นๆ เพิ่มเติม สามารถแจ้งเข้ามาได้เลยนะครับ\n \n หากเป็นเลขใกล้เคียง ที่ยังว่างในทุกหมวดอยู่จะมีเป็นเลข: '+array_no+'&nbsp; ครับ</textarea><br><a href="javascript:;" class="btn btn-circle yellow-casablanca" onclick="copytoclip()" >Copy to clipboard</a>';

		                        $('.clip_text2').html(response_data2);
		                    }

		                    if(res.duplicate && count != 6){

		                       if(count < 4 && not_dups == true ){
			                       	
			                        $(".clip_text1").css("display", "block");
			                        $(".clip_text").css("display", "none");
			                        $(".clip_text2").css("display", "none");

			                        response_data2 +='<textarea id="text_div" class="form-control" rows="8" readonly="">'+res.cat+'&nbsp;'+res.number+' &nbsp หมายเลขนี้จะติดจองในบางหมวดแล้วนะครับ (ติดจองในหมวด '+array_cat+') หากเป็นหมวดอื่นๆ สามารถรับจองได้ครับ โดยหมวดที่ว่างเร็วที่สุด จะเป็นหมวด .... ที่คาดว่าจะเปิดจองในอีก ... สัปดาห์ครับ หากลูกค้าสนใจจอง สามารถแจ้งได้เลยนะครับ \n\n  *เพิ่มเติม หากเป็นเลขใกล้เคียง ที่ยังว่างในทุกหมวดอยู่จะมีเป็นเลข: '+array_no+'&nbsp; ครับ</textarea><br><a href="javascript:;" class="btn btn-circle yellow-casablanca" onclick="copytoclip()" >Copy to clipboard</a>';
			   
			                        $('.clip_text1').html(response_data2);
			                    }
			                    else{

				                    $(".clip_text1").css("display", "block");
				                    $(".clip_text").css("display", "none");
				                    $(".clip_text2").css("display", "none");

				                    response_data2 +='<textarea id="text_div" class="form-control" rows="8" readonly="">'+res.cat+'&nbsp;'+res.number+' หมายเลขนี้จะติดจองแล้วนะครับ จะไม่สามารถรับจองได้เลยครับผม ต้องขออภัยด้วยนะครับ หากลูกค้ามีเลขอื่นๆ เพิ่มเติม สามารถแจ้งเข้ามาได้เลยนะครับ\n\n หากเป็นเลขใกล้เคียง ที่ยังว่างในทุกหมวดอยู่ จะมีเป็นเลข: '+array_no+'&nbsp; ครับ</textarea><br><a href="javascript:;" class="btn btn-circle yellow-casablanca" onclick="copytoclip()">Copy to clipboard</a>';

				                    $('.clip_text1').html(response_data2);
				                }
				            }

		                    
                    		var result = '';

                    		if (res.add_number) {
                    			result += res.add_number;
                    		}
                    		if (res.no) {
                    			result += res.no;
                    		}
                    		if (res.check_number) {
                    			result += res.check_number;
                    		}
                    		if(res.duplicate){
                    			result += res.duplicate; 
                    		}
                    		if (res.special) {
                    			result += res.special;
                    		}
                    		if (res.vip) {
                    			result += res.vip;
                    		}
                    		if (res.ok) {
                    			result += res.ok;
                    		}
                    		if (res.super_special) {
                    			result += res.super_special;
                    		}
                    		if (res.allnumber) {
                               result += res.allnumber;
                            }
                            
                    		$('.result').show().html(result);

                            if(res.customerdata == ""){
                          	   $(".result_s").css("display", "none");
                          	   var result = '';
	                    		if (res.add_number) {
	                    			result += res.add_number;
	                    		}
	                    		if (res.no) {
	                    			result += res.no;
	                    		}
	                    		if (res.check_number) {
	                    			result += res.check_number;
	                    		}
	                    		if(res.duplicate){
	                    			result += res.duplicate; 
	                    		}
	                    		if (res.special) {
	                    			result += res.special;
	                    		}
	                    		if (res.vip) {
	                    			result += res.vip;
	                    		}
	                    		if (res.ok) {
	                    			result += res.ok;
	                    		}
	                    		if (res.super_special) {
	                    			result += res.super_special;
	                    		}
	                    		if (res.allnumber) {
	                               result += res.allnumber;
	                            }
	                    		$('.result').show().html(result);
                            } 
                            
                            $('.loader').hide();

                    	}
                    })
               	}
            });
    }
   	return {
        init: function () {
        	handleValidation1();
      	}
    };
}();
</script>

<script>
jQuery(document).ready(function() {    
   Metronic.init(); 
   Layout.init(); 
   FormValidation.init();
});

<?php  if($session['access_level_id'] <= 2){ ?>

var otable = $('#number_list_table').dataTable({
			"processing": true,
      		"sAjaxSource": base_url+ "/Data_controller/get_number_list",
         	"bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[5,10,15,20,50,100], [5,10,15,20,50,100]],
            "iDisplayLength": 10,
            "responsive": true,
           	"order": [
                [0, "asc"]
            ] 
		});
otable.destroy();
<?php } ?>
</script>

