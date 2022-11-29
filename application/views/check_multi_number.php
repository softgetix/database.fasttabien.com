<?php $session=$this->session->userdata();?>
<style type="text/css">
.btn-sm, .btn-xs {padding: 2px 7px 3px 9px;font-size: 13px;line-height: 1.5;}
.btn-div {margin-top: -20px}
.col-sm-2{width: 22%}
.col-sm-3{margin-left: -22px;}
.form-control{margin-top: 10px;}
.help-block {margin-left: -12px !important;}
.add-row,.remove-row{margin-top:57%}
.records-data{display: none}
.record-div{margin-top: 20px}
.category-data{display: none}
.result {display: none};
.res{text-align: center;font-size: 15px}
.portlet-title{min-height: 55px !important;}
.help-block-error{color: #a94442 !important}
.save_row{margin-left: 18%;}
@media(max-width: 1280px){
	.add-row{margin-top: 78%;}
}
@media(max-width: 1024px){
	.col-sm-2{width: 27%;}
	.col-sm-3{margin-left: -26px;}
	.add-row{margin-top: 137%;}
}
@media(max-width: 991px){
	.col-sm-2{width: 25%;}
	.add-row{margin-top: 88%;}
}
@media(max-width: 800px){
  .add-row{margin-top: 128%;}
}
@media(max-width: 767px){
  .col-sm-2{width: unset;}
	.col-sm-3{margin-left: unset;}
	.add-row{margin-top: 3%;}
}
@media(max-width: 447px){
  .tools{padding: 12px 0 20px 0!important;}
}
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
					Check Multi Number
				</li>
			</ul>	
		</div>
		<h4 class="page-title">
		Check Multi Number<small></small>
		</h4>
		<div class="row">
		    <?php if($session['access']['specialNumber']['access_view']){?>	
			<div class="col-md-12">	
				<div class="portlet-body">
					<div class="portlet box yellow-casablanca">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-plus"></i>Check Multi Number
							</div>
							<div class="tools">
								
								<a href="<?php echo base_url('specialNumber');?>"><button class="btn btn-circle red-flamingo"><i class="fa fa-arrow-left"></i> Back
									</button></a>
								<a href="javascript:;" class="collapse">
								</a>
						   </div>
						</div>
						
						<div class="portlet-body form1">
							<form action="<?php echo base_url('check_bulknumber')?>" class="form-horizontal" method="post" id="form1">

								<div class="form-body">
								    <div class="row record-div">
									    <div class="form-group">
											<label class="col-md-3 control-label">Enter Number</label>
											<div class="col-md-4">
												<textarea  cols="30" rows="10" name="number" id="number" class="form-control" placeholder="Enter number"></textarea>
											</div>
										</div>
								    </div>									 
								</div>

								<div class="form-actions">
									<div class="row save_row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-circle yellow-casablanca">Save</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12">	
				<div class="portlet-body">
					<div class="portlet box yellow-casablanca">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-check"></i>Bulk check number
							</div>
							<div class="tools">
								<a href="<?php echo base_url('exportbulk');?>">
									<button type="button" class="btn red-flamingo btn-circle bulk_cust">
									<i class="fa fa-download"></i>Export All
									</button>
								</a>

								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>

						<div class="portlet-body">
							<div class="row">
								<div class="col-md-6">
									<table class="table table-striped table-hover table-bordered" id="pre_clip">
								        <thead>
											<tr>
												<th>เลขสองหลักที่ยังว่างในตอนนี้จะมีเป็นเลข ดังนี้ครับ</th>
										   </tr>
										</thead>
									   
		                                <tbody id="bulk_pretext"></tbody>
								   </table>	
								</div>
 
								<div class="col-md-6">
									<table class="table table-striped table-hover table-bordered" id="digit_table">
									   <thead>
											<tr>
												<th style="text-align: center;">Number</th>
												<th style="text-align: center;">Price
												<th style="text-align: center;">Existing category
										   </tr>
										</thead>
		                                <tbody id="bulk_category"></tbody>
								      
								   </table>	
								</div>
								
							</div>	
				      </div>
					</div>
				</div>	
			</div>
			<?php } ?>
		</div>
    </div>
</div>

 <?php $this->load->view('common/footer');?>

 <script type="text/javascript">

    var FormValidation = function () {

   	    var handleValidation1 = function() {
        	var form1 = $('#form1');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "", 
               	rules: {
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
                submitHandler: function (form) {
                    success1.show();
                    error1.hide();

                    var response_data = "";
                    var response_data1 = "";
                    

                    $.ajax({
	                    type:'post',
	                    dataType:"json",
	                    data:{number:$('#number').val()},
	                    url:base_url+'check_bulknumber',
	                    success:function(res){
	                    	if(res.bulk_list){
 	                    
		                    	$.each(res.bulk_list,function(key,value){
		                    		
		                    		response_data += "<tr class='exe_cus'><td style='text-align: center;'>"+value['no']+"</td><td style='text-align: center;'>"+value['discount']+"</td><td style='text-align: center;'>"+value['all_cat'].replace(",", "")+"</td></tr>";
		                    		
				                    $("#bulk_category").html(response_data);
				                })
			                }

			                if(res.bulk_pretext){

			                	$.each(res.bulk_pretext,function(key,value){
			                		response_data1 += "<tr>";

			                	 	if(value['new_all_cat'] == ""){

			                	 		response_data1 += "<td>"+value['number']+" &nbsp; ว่าง</td>";

			                	 	} else if(value['count'] <= 2){
                                        response_data1 += "<td> "+value['number']+"  ว่าง  &nbsp;(ยกเว้น "+value['new_all_cat']+" )</td>";
			                	 	}
			                	 	response_data1 += "</tr>";

			                	 	$("#bulk_pretext").html(response_data1);
			                    })
			                }
	                    }
	                });
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
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   FormValidation.init();
});
</script>


