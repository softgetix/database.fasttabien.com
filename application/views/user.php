<?php $session=$this->session->userdata();?>
<style type="text/css">
.add-row,.remove-row{margin-top:18%}
.category-data{display: none}
</style>
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->
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
					User
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		User <small></small>
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
			<div class="col-md-12">
					<div class="portlet box yellow-casablanca">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-user"></i>Users
							</div>
							<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
						</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-hover table-bordered" id="category_table">
							<thead>
							<tr>
								<th>
									 No
								</th>
								<th>
									 Name
								</th>
								<th>
									 Email
								</th>
								<th>
									 Account
								</th>
								<th>
									 Created On
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
		 <?php if($session['access']['user']['access_insert']){?>	
			<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-plus"></i>Create new
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
						</div>
					</div>
					<div class="portlet-body form">
						<form action="<?php echo base_url('Admin_controller/add_user')?>" class="form-horizontal" method="post" id="form">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Name</label>
									<div class="col-md-4">
										<input type="text" name="name"  class="form-control input-circle" placeholder="Enter name">
										
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Email</label>
									<div class="col-md-4">
										<input  type='text' name="email" id="email" class="form-control input-circle" placeholder="Enter email" autocomplete="new-email" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Password</label>
									<div class="col-md-4">
										<input type="password" name="password" class="form-control input-circle" placeholder="Enter password" autocomplete="new-password">
									</div>
								</div>	
								<div class="form-group">
									<label class="col-md-3 control-label">Choose account</label>
									<div class="col-md-4">
										<select class="form-control input-circle" name="access_level_id">
										<?php foreach ($access_level as $key => $value) {
											if($value['access_level_id'] > 1){
										 ?>
										 <option value="<?php echo $value['access_level_id'] ?>">
										 	<?php echo $value['access_level_name']; ?>
										 </option>
										<? } }?>
										</select>
									</div>
								</div>								
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
				</div>
			</div>
			</div>
		 <?php } ?>	
		</div>
		<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="form2" method="post" action="<?php echo base_url('Admin_controller/update_user'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Edit User</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<input type="hidden" id="user_id" name="id">
								<div class="form-group col-md-12">
									<label class="col-md-3 control-label">Name</label>
									<div class="col-md-7">
										<input type="text" name="name" id="name2" class="form-control input-circle" placeholder="Enter name">
										
									</div>
								</div>
								<div class="form-group col-md-12">
									<label class="col-md-3 control-label">Email</label>
									<div class="col-md-7">
										<input  type='text' name="email" id="email2" class="form-control input-circle" placeholder="Enter email" autocomplete="new-email" />
									</div>
								</div>
								<div class="form-group col-md-12">
									<label class="col-md-3 control-label">Account</label>
									<div class="col-md-7">
										<select class="form-control input-circle" id="account2" name="access_level_id">
										<?php foreach ($access_level as $key => $value) {
											if($value['access_level_id'] > 1){
										 ?>
										 <option value="<?php echo $value['access_level_id'] ?>">
										 	<?php echo $value['access_level_name']; ?>
										 </option>
										<?php } }?>
										</select>
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
				<div class="modal-dialog">
					<div class="modal-content">
						<form id="form3" method="post" action="<?php echo base_url('Admin_controller/change_password'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Change Password</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<input type="hidden" id="user_id2" name="id">
								<div class="form-group col-md-12">
									<label class="col-md-4 control-label">New password</label>
									<div class="col-md-6">
										<input type="password" name="password" id='password' class="form-control input-circle" placeholder="Enter password">
										
									</div>
								</div>
								<div class="form-group col-md-12">
									<label class="col-md-4 control-label">Confirm password</label>
									<div class="col-md-6">
										<input  type='password' name="confirm_password" class="form-control input-circle" placeholder="Confirm password" autocomplete="new-email">
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

	</div>
</div>
</div>
<?php include 'common/footer.php'?>
<script type="text/javascript">
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
                messages: {
                    email: {
	                    remote: "Email already exist",
	                },
	            },
                rules: {
                    email: {
                       	required: true,
                       	email:true,
                       	remote: {
	                        url: base_url+"/Admin_controller/check_email",
	                        type: "post",
	                        data: {
	                          email: function() {
	                            return $( "#form #email" ).val();
	                          }
	                        }
                      	}  
                    },
                    name: {
                        required: true
                    },
                    password:{
                    	required: true,
                    	minlength: 4
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
                    form.submit(); 
                }
            });
    }
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
                    email: {
	                    remote: "Email already exist",
	                }
                },
                rules: {
                    name: {
                       	required: true,
                    },
                    email: {
                       	required: true,
                       	email:true,
                       	remote: {
	                        url: base_url+"/Admin_controller/check_email",
	                        type: "post",
	                        data: {
	                          email: function() {
	                            return $( "#form2 #email2" ).val();
	                          },
	                          id:function(){
	                          	return $( "#form2 #user_id" ).val();
	                          }
	                        }
                      	}  
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
                    email: {
	                    remote: "Email already exist",
	                }
                },
                rules: {
                    password: {
                       	required: true,
                       	minlength:4
                    },
                    confirm_password: {
                       	required: true,
                       	minlength:4,
                       	equalTo: "#password"
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
	return {
        init: function () {
        	handleValidation1();
        	handleValidation2();
        	handleValidation3();
        }

    };

}();


var TableManaged = function () {

      var handleTable = function () {

    	var table = $('#category_table');

        var oTable = table.dataTable({
			"oLanguage": {
                "sProcessing": "Loading"},
       		"sAjaxSource": base_url+ "Admin_controller/get_user",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
            "aoColumnDefs": [
                { "aTargets": [0], orderable: false},
                { "aTargets": [5], orderable: false},
                
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
        }

    };

}();


$(document).on('click','.edit',function(){
	var id=$(this).attr('data_id');
	$.ajax({
		type:'post',
		url:base_url+'Admin_controller/getUserById',
		dataType:'Json',
		data:{'id':id},
		success:function(res){
			$('#form2 #user_id').val(res.id);
			$('#form2 #name2').val(res.name);
			$('#form2 #email2').val(res.email);
			$('#form2 #account2').val(res.access_level_id);
		}
	})
	$('#basic').modal('show');
})

$(document).on('click','.delete',function(){
	var id=$(this).attr('data_id');
	bootbox.confirm({
	size:"small",		
    message: "Are you sure, you are about to delete user?",
    buttons: {
	        confirm: {
	            label: 'Yes',
	            className: 'btn btn-circle yellow btn-sm'
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
					url:base_url+'Admin_controller/delete_user',
					data:{'id':id},
					success:function(){
							window.location.reload();
					}
				})
	     	}   
	    }
	});
})
$(document).on('click','.change_password',function(){
	var id=$(this).attr('data_id');
	$('#form3 #user_id2').val(id);
	$('#basic2').modal('show');
})
</script>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); 
   Layout.init(); 
   FormValidation.init();
   TableManaged.init();
 });
</script>

