<?php $session=$this->session->userdata();?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style type="text/css">
.add-row,.remove-row{margin-top:18%}
.category-data{display: none}
.result {display: none};
.res{text-align: center;font-size: 15px}
.portlet-title{min-height: 55px !important;}
.vn_data{float: right;margin-top: 12px;}
#s_lable{padding-left: 20px !important;}
.bootstrap-switch {border-radius: 20px!important;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/global/css/plugins.css"/> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/> -->
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
					Number List
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		Number List <small></small>
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
		<?php if($session['access']['viewCustomer']['access_view']){ ?>	
		<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>Number List
						</div> 
						<div class="tools">
							<a href="<?php echo base_url('viewCustomer');?>"><button class="btn btn-circle red-flamingo"><i class="fa fa-arrow-left"></i> Back
							</button></a>
							<a href="javascript:;" class="collapse">
							</a>
						</div>
						<div class="form-group vn_data">
                            <label for="title" style="margin-right: 10px;"id="s_lable"> Filter Today  </label>
                                <input type="checkbox" id="switch" name="add_toggle" class="make-switch"  data-on-color="warning" data-off-color="danger"> 
                        </div>
                    </div>
					<input type="hidden" name="id" value="<?php echo $result[0]['id']?>" id="customer_id">
					<div class="portlet-body ">
						<table class="table table-striped table-hover table-bordered" id="records_table">
						<thead>
							<tr>
								<th>
									 No
								</th>
								<th>
									 customer Name
								</th>
								<th>
									Status
								</th>
					            <th>
									 Category
								</th>
								<th>
									 Number
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
			<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog ">
					<div class="modal-content">
						<form id="form2" method="post" action="<?php echo base_url('update_numberList'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Edit Number List</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<input type="hidden" id="customer_number_id" name="id">

								<div class="form-group col-md-12">
										<label class="col-md-3 control-label">Category</label>
										<div class="col-md-7">
											<input type="text" id="category" name="category" class="form-control input-circle" placeholder="Enter Category">
										</div>
									</div>
									
									
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
		</div>
		 <?php } ?>	
		</div>
	</div>
</div>
</div>
<?php $this->load->view('common/footer');?>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	load_datatable();
	 function load_datatable(today=''){
       
        var table = $('#records_table');
    	var customer_id=$("#customer_id").val();


        var oTable = table.dataTable({
			"oLanguage": {
            "sProcessing": "Loading"},
      		"sAjaxSource": base_url+ "get_listnumber/"+customer_id,
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
            "bDestroy": true,
			"aoColumnDefs": [
                { "aTargets": [0], orderable: false},
                { "aTargets": [5], orderable: false},
                
            ],
            "fnServerParams": function ( aoData ) {
               aoData.push( { "name": "today", "value": today } );
               
            }
            // "order": [
            //     [1, "asc"]
            // ] 
        });
    }

    //$("#add_toggle").change(function(){
    $('#switch').on('switchChange.bootstrapSwitch', function (event, state) {

		var new_today;
	    if($(this).prop("checked") == true){
	       new_today = "off";
	    }else{
	      new_today = "on";
	    }
	    load_datatable(new_today);
    });
});


// var TableManaged = function () {

//       var handleTable = function () {

//     	var table = $('#records_table');
//     	var customer_id=$("#customer_id").val();


//         var oTable = table.dataTable({
// 			"oLanguage": {
//             "sProcessing": "Loading"},
//       		"sAjaxSource": base_url+ "get_listnumber/"+customer_id,
//             "bProcessing": true,
//             "bServerSide": true,
//             "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
//             "iDisplayLength": 25,
//             "responsive": true,
// 			"aoColumnDefs": [
//                 { "aTargets": [0], orderable: false},
//                 { "aTargets": [5], orderable: false},
                
//             ],
//             "order": [
//                 [1, "asc"]
//             ] 
//         });
//     }
    
// 	return {
// 		init: function () {
//             if (!jQuery().dataTable) {
//                 return;
//             }

//             handleTable();
            
//         }

//     };

// }();

var FormValidation = function () {

   	var handleValidation1 = function() {
    	
        	var form1 = $('#form2');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
                messages: {
                    number:{
                    	remote: "Number already exist"},
	            },
                rules: {
                    category:{
                		required:true,
                	},
                    number: {
                        required: true,
                        number:true,
                        remote: {
	                        url: base_url+"Customer_controller/is_customer_number_exist",
	                        type: "post",
	                        data: {
	                          number: function() {
	                            return $( "#form2 #number" ).val();
	                          },
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
    return {
        init: function () {
        	handleValidation1();
        }

    };

}();


$(document).on('click','.edit',function(){
	var id=$(this).attr('data_id');
	$.ajax({
		type:'post',
		url:base_url+'Customer_controller/getcustomer_Number_ByID',
		dataType:'Json',
		data:{'id':id},
		success:function(res){
			 console.log(res);
             $('#form2 #customer_number_id').val(id);
             $('#form2 #category').val(res.category);
			 $('#form2 #number').val(res.number);
	    }
	})
	$('#basic').modal('show');
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
					url:base_url+'Customer_controller/delete_customer_number',
					data:{'id':id},
					success:function(){
							window.location.reload();
					}
				})
	     	}   
	    }
	});
})

</script>

<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
  // TableManaged.init();
   FormValidation.init();
});
</script>
