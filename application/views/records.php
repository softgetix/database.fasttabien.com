<?php $session=$this->session->userdata();?>
<style type="text/css">
.add-row,.remove-row{margin-top:6%}
.records-data{display: none}
.record-div{margin-top: 20px}
.sold-label{width: 100%;text-align: left !important;}
.btn-div{padding-left: 0px !important;padding-top: 14px}
.sold-div .checker{padding-top: 5px !important;}
div.checker input {cursor: pointer;}
.check-title{min-height: 55px !important;} 
@media(max-width: 700px){
	.btn{padding: 7px 12px;}
}
@media(max-width: 660px){
	.tools{padding: 12px 0px 19px 0px!important;}
}
@media(max-width: 565px){
	.import-vip,.sample{margin-top: 7px;}
}
@media(max-width: 445px){
	.import-vip,.import-special,.sample{margin-top: 15px;}
}
@media(max-width: 360px){
	.sample{margin-top: 5px;}
}
.loader{    
	position: absolute;
    top: 214px;
    left: 721px; 
    display: none;
}

.check_btn{padding: 7px 12px !important; }

.all_tool{ float: none !important;
    display: flex !important;
    justify-content: flex-end;
    flex-wrap: wrap;}

#select_all_range{margin-right: 6px;}

.all_range{display: flex;
    justify-content: flex-end;
    margin-top: 15px;}
    
.check_all_range{padding-bottom: 39px;}
.back_repete{background-repeat: no-repeat;}
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
					Special Number
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		Special Number <small></small>
		</h4>
		<?php
		if( null !== $this->session->flashdata('success') ){ ?>
		<div class="note note-success">
			<button class="close" data-close="alert"></button>
			<span><?php echo $this->session->flashdata('success');?></span>
		</div>
		<?php }?>
		<?php
		if( null !== $this->session->flashdata('error') ){ ?>
		<div class="note note-danger">
			<button class="close" data-close="alert"></button>
			<span><?php echo $this->session->flashdata('error');?></span>
		</div>
		<?php }?>
		<div class="row">
						
			<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title" style="margin-bottom:10px;">
						<div class="caption">
							<i class="icon-plus"></i>Create new
						</div>
						<div class="tools all_tool">	

						<?php if($session['access']['check2digit']['access_view']){?>

							<a href="<?php echo base_url('check2digit');?>" class="check_all_range">
								<button type="button" class="btn red-flamingo btn-circle check_digit check_btn">
								<i class="fa fa-check"></i>check 2 digit
								</button>
							</a>
						<?php } ?>
						<?php if($session['access']['checktime']['access_view']){?>
							<a class="check_all_range" href="<?php echo base_url('checkrecord');?>">
								<button type="button" class="btn red-flamingo btn-circle check_btn">
								<i class="fa fa-check"></i> Check Time
								</button>
							</a>
						<?php } ?>
							<a class="check_all_range" href="<?php echo base_url('checkNumber');?>">
								<button type="button" class="btn red-flamingo btn-circle check_btn">
								<i class="fa fa-check"></i> Check Number
								</button>
							</a>
							<a href="<?php echo base_url('check_multi_number');?>" >
								<button type="button" class="btn red-flamingo btn-circle check_btn">
								<i class="fa fa-check"></i>Bulk check
								</button>
							</a>
						<?php if($session['access']['import/special/vip']['access_view']){?>
                            <a class="check_all_range">
							    <button type="button" class="btn btn-circle red-flamingo import-btn import-special check_btn" data-toggle="modal" data-target="#basic2" data-col='1' id="import_special">
								<i class="fa fa-upload"></i> Import special
							   </button>
						    </a>
                            <a class="check_all_range">
								<button type="button" class="btn btn-circle red-flamingo import-btn import-vip check_btn" data-toggle="modal" data-target="#basic2" id="import_vip" data-col='2'>
									<i class="fa fa-upload"></i> Import vip
								</button>
                            </a>
							<a class="check_all_range" href="<?php echo base_url('assets/sample.csv');?>" download>
								<button type="button" class="btn red-flamingo btn-circle sample check_btn">
									<i class="fa fa-download"></i> Sample
								</button>
							</a>
						<?php } ?>
						    <a href="javascript:;" class="collapse back_repete" ></a>
						</div>

						<?php  if($session['access_level_id'] <= 2){ ?>

							<div class="form-group all_range">

								<select class="bs-select input-small form-control ss_select input-circle" name="category" id="select_all_range">
									<option value>Select Range</option>
									<option value="1-2000">1-2000</option>
									<option value="2001-4000">2001-4000</option>
									<option value="4001-6000">4001-6000</option>
									<option value="6001-8000">6001-8000</option>
									<option value="8001-10000">8001-9999</option>	
							    </select>
						   	    <button type="button" class="btn yellow btn-circle check_all_num check_btn">
								  <i class="fa fa-check"></i>checkAllNumber
								</button> 
									
						   </div>
                        <?php  } ?> 
					</div>
					<?php if($session['access']['specialNumber']['access_insert']){?>
					<div class="portlet-body form">
						<form action="<?php echo base_url('save_records')?>" class="form-horizontal" method="post" id="form">
							<div class="form-body">
							  <div class="row record-div">
							  	
							  	<div class="col-sm-12">
						  	 	    <div class="col-sm-3">
										<label class="control-label"> Special Number</label>
										<input type="number" name="specialnumber[]" class="form-control input-circle" placeholder="Enter Number">
									</div>
							        <div class="col-sm-3">
										<label class="control-label"> Vip Number</label>
										<input type="number" name="vipnumber[]" class="form-control input-circle" placeholder="Enter Number">
									</div>
									<div class="col-sm-3">
										<label class="control-label"> Super Special Number</label>
										<input type="number" name="superspecialnumber[]" class="form-control input-circle" placeholder="Enter Number">
									</div>
									
									<div class="col-sm-3 btn-div">
										<button type="button" class="btn add-row yellow-casablanca btn-circle btn-sm" ><i class="fa fa-plus"></i></button>
									</div>
								</div>	 
							  </div>										
							<div class="form-group add-data-div"></div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn btn-circle yellow-casablanca">Save</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<?php } ?>
				</div>
			</div>
			</div>
		
			<!-- special number -->
				<div class="col-md-12">
					<div class="portlet box yellow-casablanca ">
						<div class="portlet-title check-title">
							<div class="caption">
								<i class="icon-docs"></i>Special Number
							</div>
							<div class="tools">
								<a href="<?php echo base_url('checkNumber');?>">
									<button type="button" class="btn red-flamingo btn-circle ">
									<i class="fa fa-check"></i> Check Number
									</button>
								</a>
								<a href="javascript:;" class="collapse"></a>
							</div>
						</div>
						<div class="portlet-body ">
							<table class="table table-striped table-hover table-bordered" id="records_table">
							<thead>
							<tr>
								<th>
									 No
								</th>
								
								<th>
									Special Number
								</th>
								<th>
									 Created On
								</th>
								<th>
									 Updated On
								</th>
								<th>
									 Action
								</th>
							</tr>
							</thead>
								<tbody></tbody>
							</table>	
						</div>
					</div>
			    </div>
		    <!-- /special number -->
		    <!-- Vip number -->
				<div class="col-md-12">
					<div class="portlet box yellow-casablanca ">
						<div class="portlet-title check-title">
							<div class="caption">
								<i class="icon-docs"></i>Vip Number
							</div>
							<div class="tools">
								<a href="<?php echo base_url('checkNumber');?>">
									<button type="button" class="btn red-flamingo btn-circle ">
									<i class="fa fa-check"></i> Check Number
									</button>
								</a>
								<a href="javascript:;" class="collapse"></a>
							</div>
						</div>
						<div class="portlet-body" >
							<table class="table table-striped table-hover table-bordered" id="records_table_vip">
							<thead>
							<tr>
								<th>
									 No
								</th>
								
								<th>
									Vip Number
								</th>
								<th>
									 Created On
								</th>
								<th>
									 Updated On
								</th>
								<th>
									 Action
								</th>
							</tr>
							</thead>
								<tbody></tbody>
							</table>	
						</div>
					</div>
			    </div>
            <!--/ Vip number -->
            <!-- Super Special number -->
			    <div class="col-md-12">
					<div class="portlet box yellow-casablanca ">
						<div class="portlet-title check-title">
							<div class="caption">
								<i class="icon-docs"></i>Super Special Number
							</div>
							<div class="tools">
								<a href="<?php echo base_url('checkNumber');?>">
									<button type="button" class="btn red-flamingo btn-circle ">
									<i class="fa fa-check"></i> Check Number
									</button>
								</a>
								<a href="javascript:;" class="collapse"></a>
							</div>
						</div>
						<div class="portlet-body" >
							<table class="table table-striped table-hover table-bordered" id="records_table_super_special">
							<thead>
							<tr>
								<th>
									 No
								</th>
								
								<th>
									Super Special Number
								</th>
								<th>
									 Created On
								</th>
								<th>
									 Updated On
								</th>
								<th>
									 Action
								</th>
							</tr>
							</thead>
								<tbody></tbody>
							</table>	
						</div>
					</div>
			    </div>
           <!-- Super Special number -->
		</div>

		<div class="records-data">
			<div class="col-sm-12">		
			 	 <div class="col-sm-3">
					<label class="control-label">Special Number</label>
					<input type="number" name="specialnumber[]" class="form-control input-circle" placeholder="Enter Number">
				</div>
				<div class="col-sm-3">
					<label class="control-label">Vip Number</label>
					<input type="number" name="vipnumber[]" class="form-control input-circle" placeholder="Enter Number">
				</div>
				<div class="col-sm-3">
					<label class="control-label"> Super Special Number</label>
				    <input type="number" name="superspecialnumber[]" class="form-control input-circle" placeholder="Enter Number">
				</div>
				
				<div class="col-sm-3 btn-div">
					<button type="button" class="btn add-row yellow-casablanca btn-circle btn-sm" ><i class="fa fa-plus"></i></button><button type="button" class="btn remove-row yellow-casablanca btn-circle btn-sm"><i class="fa fa-minus"></i></button>
				</div>
			</div>	 	
		</div>
			
		<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog ">
					<div class="modal-content">
						<form id="form2" method="post" action="<?php echo base_url('update_records'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Edit Records</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<input type="hidden" id="records_id" name="id">
									
									
									<div class="form-group col-md-12">
										<label class="col-md-3 control-label">Number</label>
										<div class="col-md-7">
											<input type="number" id="number" name="number" class="form-control input-circle" placeholder="Enter Number">
										</div>
									</div>
										
						</div></div>
						<div class="modal-footer">
							<button type="button" class="btn default btn-circle" data-dismiss="modal">Close</button>
							<button type="submit" class="btn yellow-casablanca btn-circle">Update</button>
						</div>
						</form>
					</div>
				</div>
		</div>

		<div class="modal fade" id="vip_basic" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog ">
					<div class="modal-content">
						<form  id="vip_form2" method="post" action="<?php echo base_url('vip_update_records'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title"> Vip Edit Records</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<input type="hidden" id="records_id" name="id">
									
									
									<div class="form-group col-md-12">
										<label class="col-md-3 control-label">Number</label>
										<div class="col-md-7">
											<input type="number" id="number" name="number" class="form-control input-circle" placeholder="Enter Number">
										</div>
									</div>
										
						</div>
					</div>
						<div class="modal-footer">
							<button type="button" class="btn default btn-circle" data-dismiss="modal">Close</button>
							<button type="submit" class="btn yellow-casablanca btn-circle">Update</button>
						</div>
						</form>
					</div>
				</div>
		</div>


		<div class="modal fade" id="super_special_basic" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog ">
					<div class="modal-content">
						<form  id="super_special_form2" method="post" action="<?php echo base_url('super_special_update_records'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title"> Super Special Edit Records</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<input type="hidden" id="records_id" name="id">
									
									<div class="form-group col-md-12">
										<label class="col-md-3 control-label">Number</label>
										<div class="col-md-7">
											<input type="number" id="number" name="number" class="form-control input-circle" placeholder="Enter Number">
										</div>
									</div>
							</div>
					    </div>
						<div class="modal-footer">
							<button type="button" class="btn default btn-circle" data-dismiss="modal">Close</button>
							<button type="submit" class="btn yellow-casablanca btn-circle">Update</button>
						</div>
						</form>
					</div>
				</div>
		</div>

        <div class="modal fade" id="basic2" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog ">
					<div class="modal-content">
						<form id="form3" enctype="multipart/form-data" method="post" action="<?php echo base_url('import'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Import csv</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<input type="hidden" name="status" id="status">
									<div class="form-group col-md-12">
										<input type="file" name="file" class="form-control input-circle">
									</div>
							</div>	
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default btn-circle" data-dismiss="modal">Close</button>
							<button type="submit" class="btn yellow-casablanca btn-circle">Import</button>
						</div>
						</form>
					</div>	
				</div>
		</div>
	</div>
</div>
<div class="loader"><img src="<?php echo base_url('assets/img/index.svg');?>"></div>

<?php include 'common/footer.php'?>
<script type="text/javascript">
var i=1;	
$(document).on('click','.add-row,.add-data',function(){
	$('.records-data .catg_id').attr('id','catg_'+i);
	$('.records-data .group_id').attr('id','group_'+i);
	$('.record-div').append($('.records-data').html());	
   	$('#catg_'+i).select2({
            placeholder: "Select",
            allowClear: true
    });
    $('#group_'+i).select2({
        placeholder: "Select",
        allowClear: true
    });	
    ++i;
})
$(document).on('click','.remove-row',function(){
	$(this).parent().parent().remove();
})

$(document).on('click','.check_digit',function(){
   $(".loader").show();
	   setTimeout(function (){
	      $('.loader').hide();
	   }, 120000);
})

/*$(document).on('click','.check_all_num',function(){
    $(".loader").show();
	setTimeout(function (){
	    $('.loader').hide();
	}, 3600 * 1000);
})*/

$(document).on('click','.check_all_num',function(){

    var range = $('#select_all_range').val();
    console.log(range);
    if(range !=''){

	    $(".loader").show();
		setTimeout(function (){
			$('.loader').hide();
		},3600 * 1000);

		var new_url = base_url+"checkallnumbers/"+range;
	    window.location.href = new_url;
	}
})

$(document).on('click','input[type="checkbox"]',function(){
	if ($(this).is(":checked"))
		$(this).parent().addClass('checked');
	else
		$(this).parent().removeClass('checked');
})	
var FormValidation = function () {

    var handleValidation2 = function() {
    	
        	var form1 = $('#form2');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
                messages: {
                   
	                number:{minlength:'Please enter at least 2 digit.'},
	            },
                rules: {
                    
                    number: {
                        required: true,
                        number:true,
                        minlength:2,
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

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); 
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                    form.submit(); 
                }
            });
    }
    
     var handleValidation3 = function() {
    	
        	var form1 = $('#form3');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
                messages: {
                	file:{
                		extension:"Please upload csv file",
                	}
                },
                rules: {
                    file: {
                      	required:true,
                        extension: "csv"
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

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); 
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                    form.submit(); 
                }
            });
    }
    var handleValidation4 = function() {
    	
        	var form2 = $('#vip_form2');
            var error2 = $('.alert-danger', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
                messages: {
                    
	                number:{minlength:'Please enter at least 2 digit.'},
	            },
                rules: {
                   
                    number: {
                        required: true,
                        number:true,
                        minlength:2,
                    },
                },

                invalidHandler: function (event, validator) { 
                    success2.hide();
                    error2.show();
                   
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
                    success2.show();
                    error2.hide();
                    form.submit(); 
                }
            });
    }

    var handleValidation5 = function() {
    	
        	var form2 = $('#super_special_form2');
            var error2 = $('.alert-danger', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
                messages: {
                    
	                number:{minlength:'Please enter at least 2 digit.'},
	            },
                rules: {
                    
                    number: {
                        required: true,
                        number:true,
                        minlength:2,
                    },
                },

                invalidHandler: function (event, validator) { 
                    success2.hide();
                    error2.show();
                   
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
                    success2.show();
                    error2.hide();
                    form.submit(); 
                }
            });
    }


	return {
        init: function () {
        
        	handleValidation2();
        	handleValidation3();
        	handleValidation4();
        	handleValidation5();
        }

    };

}();
var TableManaged = function () {

      var handleTable = function () {

    	var table = $('#records_table');

        var oTable = table.dataTable({
			"oLanguage": {
                "sProcessing": "Loading"},
      		"sAjaxSource": base_url+ "get_records",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
			"aoColumnDefs": [
                { "aTargets": [0], orderable: false},
                { "aTargets": [4], orderable: false},
                
            ],
            "order": [
                [1, "asc"]
            ] 
        });
    }
    var handleTable2 = function () {

    	var table = $('#records_table_vip');

        var oTable = table.dataTable({
			"oLanguage": {
                "sProcessing": "Loading"},
      		"sAjaxSource": base_url+ "get_records_vip",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
			"aoColumnDefs": [
                { "aTargets": [0], orderable: false},
                { "aTargets": [4], orderable: false},
                
            ],
            "order": [
                [1, "asc"]
            ] 
        });
    }
    var handleTable3 = function () {

    	var table = $('#records_table_super_special');

        var oTable = table.dataTable({
			"oLanguage": {
                "sProcessing": "Loading"},
      		"sAjaxSource": base_url+ "get_records_super_special",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
			"aoColumnDefs": [
                { "aTargets": [0], orderable: false},
                { "aTargets": [4], orderable: false},
                
            ],
            "order": [
                [1, "asc"]
            ] 
        });
    }
	return {
		init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            handleTable();
            handleTable2();
            handleTable3();
        }

    };

}();

$(document).on('click','.edit',function(){
	var id=$(this).attr('data_id');
// alert(id);
	$.ajax({
		type:'post',
		url:base_url+'Data_controller/getRecordsById',
		dataType:'Json',
		data:{'id':id},
		success:function(res){
			$('#form2 #records_id').val(id);
		    $('#form2 #number').val(res.number);
		}
	})
	$('#basic').modal('show');
})

$(document).on('click','.vip_edit',function(){

	var id=$(this).attr('data_id');
 
    console.log(id);
	$.ajax({
		type:'post',
		url:base_url+'Data_controller/vip_getRecordsById',
		dataType:'Json',
		data:{'id':id},
		success:function(res){
			$('#vip_form2 #records_id').val(id);
		    $('#vip_form2 #number').val(res.number);
		}
	})
	$('#vip_basic').modal('show');
})

$(document).on('click','.super_special_edit',function(){
    var id=$(this).attr('data_id');
    console.log(id);
	$.ajax({
		type:'post',
		url:base_url+'Data_controller/super_special_getRecordsById',
		dataType:'Json',
		data:{'id':id},
		success:function(res){
			$('#super_special_form2 #records_id').val(id);
		    $('#super_special_form2 #number').val(res.number);
		}
	})
	$('#super_special_basic').modal('show');
})

$(document).on('click','.delete',function(){
	var id=$(this).attr('data_id');
	bootbox.confirm({
	size:"small",		
    message: "Are you sure?",
    buttons: {
	        confirm: {
	            label: 'Yes',
	            className: 'btn btn-circle yellow-casablanca btn-sm'
	        },
	        cancel: {
	            label: 'No',
	            className: 'btn btn-circle default btn-sm'
	        }
	    },
	    callback: function (result) {
	     	if (result) {
	     		$.ajax({
					type:'post',
					url:base_url+'Data_controller/delete_record',
					data:{'id':id},
					success:function(){
							window.location.reload();
					}
				})
	     	}   
	    }
	});
})
$(document).on('click','.vip_delete',function(){
	var id=$(this).attr('data_id');
	bootbox.confirm({
	size:"small",		
    message: "Are you sure?",
    buttons: {
	        confirm: {
	            label: 'Yes',
	            className: 'btn btn-circle yellow-casablanca btn-sm'
	        },
	        cancel: {
	            label: 'No',
	            className: 'btn btn-circle default btn-sm'
	        }
	    },
	    callback: function (result) {
	     	if (result) {
	     		$.ajax({
					type:'post',
					url:base_url+'Data_controller/vip_delete_record',
					data:{'id':id},
					success:function(){
							window.location.reload();
					}
				})
	     	}   
	    }
	});
})

$(document).on('click','.super_special_delete',function(){
	var id=$(this).attr('data_id');
	bootbox.confirm({
	size:"small",		
    message: "Are you sure?",
    buttons: {
	        confirm: {
	            label: 'Yes',
	            className: 'btn btn-circle yellow-casablanca btn-sm'
	        },
	        cancel: {
	            label: 'No',
	            className: 'btn btn-circle default btn-sm'
	        }
	    },
	    callback: function (result) {
	     	if (result) {
	     		$.ajax({
					type:'post',
					url:base_url+'Data_controller/super_special_delete_record',
					data:{'id':id},
					success:function(){
							window.location.reload();
					}
				})
	     	}   
	    }
	});
})



$(document).on('click','#import_vip,#import_special',function(){
	status=$(this).attr('data-col');
	$('#status').val(status);
})

</script>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   FormValidation.init();
   TableManaged.init();
});
</script>
<script type="text/javascript">
$('#form #catg_id').select2({
    placeholder: "Select",
    allowClear: true
});
$('#form #group_id').select2({
    placeholder: "Select",
    allowClear: true
});
</script>

