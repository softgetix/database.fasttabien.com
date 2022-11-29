<?php $session=$this->session->userdata();?>
<style type="text/css">
.ss_form_body{ margin-left: 8px;}
.form-group{ margin-left: 0px!important;}
.update_cust{margin-left: -1px;}
.add-row,.remove-row{margin-top:13%}
.records-data{display: none}
.record-div{margin-top: 20px}
.category-data{display: none}
.result {display: none};
.res{text-align: center;font-size: 15px}
.portlet-title{min-height: 55px !important;}
.help-block-error{color: #a94442 !important}
#dup_no{display: none}
.error{color:#F00;}
.error.true{color:#6bc900;}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 21px !important;
}
.select2-container--default .select2-selection--single{
	border-radius: 25px !important;
    height: 34px !important;
    padding: 6px 12px;
    background-color: #fff;
    border: 1px solid #e5e5e5;
}
</style>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->
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
					Update Customer
				</li>
			</ul>		
		</div>
		<h4 class="page-title">
		Update Customer <small></small>
		</h4>
		<?php
		if( null !== $this->session->flashdata('warning') ){ ?>
		<div class="note note-warning">
			<button class="close" data-close="alert"></button>
			<span><?php echo $this->session->flashdata('warning');?></span>
		</div>
		<?php }?>
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
			<?php if($session['access']['addCustomer']['access_view']){ 
				 ?>
			<div class="col-md-12">	
				<div class="portlet-body">
					<div class="portlet box yellow-casablanca">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-check"></i>Update Customer
							</div>
							<div class="tools">
								<a href="<?php echo base_url('viewCustomer');?>"><button class="btn btn-circle red-flamingo"><i class="icon-eye"></i> View Customer
								</button></a>
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="<?php echo base_url('Customer_controller/update_customer');?>" class="form-horizontal" method="post" id="form">
							    <input type="hidden" name="id" value="<?php echo $result[0]["id"]?>" id="customer_id">
						

								<div class="form-body ss_form_body">
									<div class="row" style=" padding: 10px">
									    <div class="form-group col-md-6 ss_new">
		                                    <label for="status" style="display:block; ">Status</label>
		                                    <select class="form-control input-circle" name="status" id="status">
		                                	  <option value="in progress" <?php echo ($result[0]['status'] == 'In progress')?"selected":"" ?> >In progress</option> 
		                                
		                                	   <option value="cancel" <?php echo ($result[0]['status'] == 'cancel')?"selected":"" ?> >Cancel</option>
		                                	   <option value="completed" <?php echo ($result[0]['status'] == 'completed')?"selected":"" ?>>Completed</option>

		                                	   <option value="waiting" <?php echo ($result[0]['status'] == 'waiting')?"selected":"" ?>>Waiting</option>
		                                    </select>
		                                </div>
		   
	                                    <div class="form-group col-md-6" >
		                            	   <label for="chatname">Chat Name</label>
		                                    <?php echo "<input type='text' name='chat_name' placeholder='Chat Name' class='form-control input-circle' value='".htmlspecialchars($result[0]['chat_name'], ENT_QUOTES)."'>";?>
		                                </div>
		                            </div>
		                            <div class="row" style=" padding: 10px">
		                                <div class="form-group col-md-6 ss_new">
		                                    <label for="type" style="display:block; ">Type</label>
		                                        <select class="form-control input-circle" name="type" id="type">
		                                	       <option value="">Select Type</option>
		                                	       <option value="ขาว" <?php echo ($result[0]['type'] == 'ขาว')?"selected":"" ?> >ขาว</option>
		                                	       <option value="แดง" <?php echo ($result[0]['type'] == 'แดง')?"selected":"" ?> >แดง</option>
		                                        </select>
		                                </div>
									    <div class="form-group col-md-6 ">
		                                    <label for="type" style="display:block; ">Source</label>
		                                        <select class="form-control input-circle" name="price" id="price">
		                                	      <option value="">Select Source</option>
		                                	      <option value="Line@" <?php echo ($result[0]['price'] == 'Line@')?"selected":"" ?> >Line@</option>
		                                	      <option value="Facebook" <?php echo ($result[0]['price'] == 'Facebook')?"selected":"" ?> >Facebook</option>
		                                	      <option value="Shopee"  <?php echo ($result[0]['price'] == 'Shopee')?"selected":"" ?> >Shopee</option>
		                                        </select>
		                                </div>
		                            </div> 
		                            <div class="row" style=" padding: 10px">  
		                                <div class="form-group col-md-6 ss_new">
		                                    <label for="type" style="display:block; ">Car Type</label>
		                                        <select class="form-control input-circle" name="car_type" id="type">
		                                	       <option value="">Select Car Type</option>
		                                	       <option value="เก๋ง"  <?php echo ($result[0]['car_type'] == 'เก๋ง')?"selected":"" ?> >เก๋ง</option>
		                                	       <option value="ตู้" <?php echo ($result[0]['car_type'] == 'ตู้')?"selected":"" ?>   >ตู้</option>
		                                	       <option value="กระบะ"  <?php echo ($result[0]['car_type'] == 'กระบะ')?"selected":"" ?>>กระบะ</option>
		                                        </select> 
		                                </div>   
		                                <div class="form-group col-md-6 ss_new">
		                            	   <label for="chatname">Customer Name</label>
		                            	     <input type="text" name="customer_name" placeholder="Customer Name" class="form-control input-circle" value="<?php echo $result[0]["customer_name"]?>">
		                                </div>
		                            </div>
		                            <div class="row" style=" padding: 10px">
		                                <div class="form-group col-md-6 ss_new">
		                            	    <label for="id">ID</label>
		                            	      <input type="text" name="brand_id" placeholder="Enter Id" class="form-control input-circle" id="brand_id" value="<?php echo $result[0]["brand_id"]?>">
		                            	      <span class="error"></span><br>
		                            	      <span style="color: green;" id="id_count"></span>
		                                </div>
		                                <div class="form-group col-md-6 ss_new">
		                            	    <label for="chassis">Chassis</label>
		                            	    <input type="text" name="chassis" placeholder="Enter Chassis" class="form-control input-circle" id="chassis" value="<?php echo $result[0]["chassis"]?>">
		                            	    <span style="color: green;" id="chas_count"></span>
		                                </div>
		                            </div>
		                        <div class="row" style=" padding: 10px">
		                            <div class="form-group col-md-6 ss_new">
		                                <label for="brand" style="display:block; ">Brand</label>
		                                <select class="form-control input-circle" name="brand" id="brand">
	                                        <option value="">Select Brand</option>
	                                        <?php  for($i=0; $i<count($car_names);$i++){?>

	                                        	<option value="<?php echo $car_names[$i]['car_name']?>"<?php if($result[0]['brand'] == $car_names[$i]['car_name']) echo "selected" ?>><?php echo $car_names[$i]['car_name'];?></option>

	                                        <?php if($i==28){?>
	                                         	 <optgroup label="------------------------------------------------------------">
	                                        <?php } } ?>
	                                        </optgroup>
		                                </select> 
		                            </div> 
		                            <div class="form-group col-md-6" >
		                            	<label for="phone">Phone</label>
		                            	<input type="text" name="phone" placeholder="Enter Phone number" class="form-control input-circle" value="<?php echo $result[0]["phone"]?>" id="phone_no">
		                            </div>
		                        </div>
		                          
		                        </div>
		                        <div id="dup_no">
		                        	<div class="note note-warning">
										<button class="close" data-close="alert"></button>
										<span class="msg">Warning! duplicate number</span>
									</div>
		                        </div>
		                        <div class="row record-div update_cust">
								  	<div class="col-sm-12">
								  	    <div class="col-sm-3">
											<label class="control-label"> Category</label>
											<input type="text" name="cat1" class="form-control input-circle" placeholder="Enter Category" value="<?php echo $result[0]["cat1"]?>" >
										</div>
										<?php if($result[0]["no1"] == 0){?>

								        <div class="col-sm-3">
											<label class="control-label"> Number</label>
											<input type="text" name="no1" class="form-control input-circle" placeholder="Enter Number">
										</div>
									    <?php } else { ?>
										<div class="col-sm-3">
											<label class="control-label"> Number</label>
											<input type="text" name="no1" class="form-control input-circle" placeholder="Enter Number" value="<?php echo $result[0]["no1"]?>">
										</div>
	                                    <?php } ?>
										<div class="col-sm-3 btn-div">
											<button type="button" class="btn add-row yellow-casablanca btn-circle btn-sm" disabled ><i class="fa fa-plus"></i></button>
										</div>
									</div>	 
								<?php 

				                   $table_clm['clm_name'] = get_clm('customer');

				                    foreach ($result as $key=>$val) {

	                                    $j=0;
	                                    for($i=17; $i < count($val); $i++)
			                            {

			                              $customer_data[] = $val[$table_clm['clm_name'][$i]];

			                                if (strpos($table_clm['clm_name'][$i],'cat') !== false) {
			                              	  echo "
				                                <div class='col-sm-12'>
				                                  <div class='col-sm-3'>
											       <label class='control-label'>Category</label>
											       <input type='text' id='cat".$i."' name='cat_optional[]'
											         class='form-control input-circle' placeholder='Enter Category' value=".$customer_data[$j]." >
										        </div>";
	                                        }
			                                if (strpos($table_clm['clm_name'][$i],'no') !== false) {

			                                  if($customer_data[$j]==0){
			                                  	
			                                	echo "<div class='col-sm-3'>
												<label class='control-label'> Number</label>
												<input type='text' id='no".$i."' name='no_optional[]' class='form-control input-circle' placeholder='Enter Number'>
	                                               </div>
											     <div class='col-sm-3 btn-div'>
											       <button type='button' class='btn add-row yellow-casablanca btn-circle btn-sm' disabled><i class='fa fa-plus'></i></button><button type='button' class='btn remove-row yellow-casablanca btn-circle btn-sm'><i class='fa fa-minus'></i></button>
										          </div>
										        </div>";
										      }else{
			                              	   echo "<div class='col-sm-3'>
												<label class='control-label'> Number</label>
												<input type='text' id='no".$i."' name='no_optional[]' class='form-control input-circle' placeholder='Enter Number' value=".$customer_data[$j].">
	                                               </div>
											     <div class='col-sm-3 btn-div'>
											       <button type='button' class='btn add-row yellow-casablanca btn-circle btn-sm' disabled><i class='fa fa-plus'></i></button><button type='button' class='btn remove-row yellow-casablanca btn-circle btn-sm'><i class='fa fa-minus'></i></button>
										          </div>
										        </div>";
	                                           }
			                                }
	                                      $j++;
	                                    }
	                                }?>
	                             </div>
	                            <div class="records-data">
				                    <div class="col-sm-12">	
				                     	<div class="col-sm-3">
											<label class="control-label">Category</label>
											<input type="text"  name="cat_optional[]" class="form-control input-circle sample_cat" placeholder="Enter Category">
										</div>
										<div class="col-sm-3">
											<label class="control-label"> Number</label>
											<input type="text" name="no_optional[]" class="form-control input-circle sample_no" placeholder="Enter Number">
										</div>
										<div class="col-sm-3 btn-div">
											<button type="button" class="btn add-row yellow-casablanca btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button><button type="button" class="btn remove-row yellow-casablanca btn-circle btn-sm"><i class="fa fa-minus"></i></button>
										</div>
				                    </div>	 	
			                    </div>
	                                										
								<div class="form-group add-data-div"></div>

								<div class="row" style="padding:20px">

								    <div id="error_checked" style=" display: none; color:red"> Please checked all checkboxes .</div>

								    <div class="form-group"><b> Please Confirm </b></div>

					                  <div style="display:flex;">
					                  	<input type="checkbox" class="check_true" >
					                      <label style="margin-left:23px;position: absolute;"> ชื่อ ไม่เว้นวรรคผิด / 2557 / ชื่อเก่า</label>   
					                  </div>

					                  <div style="display:flex;">
					                  	<input type="checkbox" class="check_true1" >
					                      <label style="margin-left:23px;position: absolute;"> ไม่มี 2ขx / เลขไม่ผิดแน่ๆ</label>
					                  </div>

					                  <div style="display:flex;">
					                  	<input type="checkbox" class="check_true2" >
					                      <label style="margin-left:23px;position: absolute;"> เลขถังไม่มีโอ / ครบ 12/17 หลัก?</label>
					                  </div>

					                  <div style="display:flex;">
					                  	<input type="checkbox" class="check_true3" >
					                      <label style="margin-left:23px;position: absolute;"> เลขบัตร 13 หลัก ไม่ขึ้นผิด</label>
					                  </div>

					                  <div style="display:flex;">
					                  	<input type="checkbox" class="check_true4" >
					                      <label style="margin-left:23px;position: absolute;"> หลัง save จะ cf+copy ยืนยัน</label>
					                  </div>
					                  <div style="display:flex;">
					                  	<input type="checkbox" class="check_true5" >
					                      <label style="margin-left:23px;position: absolute;"> cf เลขอีกรอบ / เลขสำรองชอบทุกเลข</label>
					                  </div>
					                  <div style="display:flex;">
					                  	<input type="checkbox" class="check_true6" >
					                      <label style="margin-left:23px;position: absolute;"> รีเนมชื่อ + สถานะแล้ว</label>
					                  </div>
						        </div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-circle yellow-casablanca">update</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>	
		</div>
	</div>
</div>

<script type='text/javascript' src='https://code.jquery.com/jquery-1.12.4.min.js' crossorigin="anonymous"></script>

<?php $this->load->view('common/footer');?>

<script type="text/javascript">
	$("#brand").select2();

	var chassis = $("#chassis").val();
	if(chassis){
		var len = chassis.length;
		$('#chas_count').html("Character Count : "+len);
	}

	var brand_id = $("#brand_id").val();
	if(brand_id){
		var len = brand_id.length;
		$('#id_count').html("Brand ID Count : "+len);
	}

$(document).on('click','.remove-row',function(){
	$(this).parent().parent().remove();
})

$('#brand_id').on('keyup',function(){
    if($.trim($(this).val()) != '' && $(this).val().length == 13){
      id = $(this).val().replace(/-/g,"");
      var result = Script_checkID(id);
      console.log(result);
      if(result === false){
        $('span.error').removeClass('true').text('เลขบัตรผิด');
      }else{
        $('span.error').addClass('true').text('เลขบัตรถูกต้อง');
      }
    }else{
      $('span.error').removeClass('true').text('');
    }
});

function Script_checkID(id){
    if(! IsNumeric(id)) return false;
    if(id.substring(0,1)== 0) return false;
    if(id.length != 13) return false;
    for(i=0, sum=0; i < 12; i++)
        sum += parseFloat(id.charAt(i))*(13-i);
    if((11-sum%11)%10!=parseFloat(id.charAt(12))) return false;
    return true;
}

function IsNumeric(input){
    var RE = /^-?(0|INF|(0[1-7][0-7]*)|(0x[0-9a-fA-F]+)|((0|[1-9][0-9]*|(?=[\.,]))([\.,][0-9]+)?([eE]-?\d+)?))$/;
    return (RE.test(input));
}

$('#brand_id').keyup(function() {
	var string = this.value.toLowerCase().replace(/[^a-zA-Z0-9]/g, '');
	var len = string.length;
	$('#id_count').html("Brand ID Count : "+len);
	$('#brand_id').val(string);
})

$('#chassis').keyup(function() {
	var string = this.value.toLowerCase().replace(/[^a-zA-Z0-9]/g, '');
	var len = string.length;
  $('#chas_count').html("Character Count : "+len);
	$('#chassis').val(string);
})

$('#phone_no').keyup(function() {
	var string = this.value.toLowerCase().replace(/[^0-9]/g, '');
	var len = string.length;
	$('#phone_no').val(string);
})

var FormValidation = function () {

   	var handleValidation1 = function() {
        	var form1 = $('#form');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            jQuery.validator.addMethod("hyphen", function(value, element) {
            return this.optional(element) || /^[^\\-\s]*$/i.test(value);
            }, "hypen and space not allow");
           

            jQuery.validator.addMethod('lowercasesymbols', function(value) {
            return value.match(/^[a-z0-9]+$/);
            }, 'You must use only lowercase letters and numbers');


            jQuery.validator.addMethod('mobile', function(value) {
            return value.match(/^(\+\d{1,3}[- ]?)?\d{10}$/);
            }, 'Not allow more than 10 digit number');

            jQuery.validator.addMethod('noDoubleSpace', function(value) {
            return value.match(/^((?!\s\s).)*$/);
            }, 'Double space is not allowed!');

            jQuery.validator.addMethod('catOptions', function(value) {
              if(value == "ขx") return false;
                return true;
            },"This category is not allowed!");

            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",
                messages: {
                    brand_id: {
	                    remote: "Id already exist",
	                },
	                chassis:{
	                	remote:'chassis already exist'
	                },
	            },  
               	rules: {
                   	chat_name: {
                        required: true
                    },
                    type:{
                    	required: true,
                   	},
                   	price:{
                    	required: true,
                   	},
                   	car_type:{
                    	required: true,
                   	},
                   	customer_name:{
                    	required: true,
                    	noDoubleSpace:true
                   	},
                   	brand_id:{
                		required: true,
                		hyphen:true,
                		//maxlength: 13
                	},
                   	chassis:{
                		required: true,
                		//maxlength: 18,
                		//hyphen:true,
                		//lowercasesymbols:true,	
                	},   
                   	brand:{
                    	required: true,
                   	},
                   	phone:{
                    	required: true,
                    	number:true,
                    	mobile:true,
                   	},
                   	cat1:{
                    	hyphen:true,
                    	catOptions:true
                	},
                   	no1:{
                    	number:true,
                   	},
                   	'no_optional[]': {
                         number:true,
                    },
                   	'cat_optional[]': {
                         hyphen:true,
                         catOptions:true
                    },
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

                submitHandler: function (form) {
                	var brand_id= $("#brand_id").val();
                    var length=brand_id.length;
                    var status= $("#status").val();
	                var flag=false;
                    success1.show();
                    error1.hide();
                    formattr = $(form).serializeArray();
                    formattr.push({name: "type", value:"edit"});

                    if($(".check_true").is(':checked') == false){
				      $("#error_checked").show();
				      return false;
				    }

				    if($(".check_true1").is(':checked') == false){
				      $("#error_checked").show();
				      return false;
				    }

				    if($(".check_true2").is(':checked') == false){
				      $("#error_checked").show();
				      return false;
				    }

				    if($(".check_true3").is(':checked') == false){
				      $("#error_checked").show();
				      return false;
				    }

				    if($(".check_true4").is(':checked') == false){
				      $("#error_checked").show();
				      return false;
				    }

				    if($(".check_true5").is(':checked') == false){
				      $("#error_checked").show();
				      return false;
				    }
				    
				    if($(".check_true6").is(':checked') == false){
				      $("#error_checked").show();
				      return false;
				    }


                    $.ajax({
                    	type:'post',
                    	url: base_url+'Customer_controller/js_validate_no',
                    	data: formattr,
                    	success:function(res){
                    		res=JSON.parse(res);
                    		if(res.status)
                    			//form.submit();
                    			if(status != 'in progress'){
		                        	if(confirm("status is not in progress please check!")){
                                        flag=true;
			        	            }
		                        }
		                        else{
		                        	form.submit();
		                        }
		                        
		                        
		                        if(flag == true)
		                        {
		                        	form.submit();
		                        }
		                        
                    		else{
                    			$('#dup_no .note .msg').html(res.msg);
                    			$('#dup_no').show();
                    		}
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
</script>

