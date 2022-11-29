<?php $session=$this->session->userdata();?>
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

 
<style type="text/css">
.add-row,.remove-row{margin-top:6%}
.records-data{display: none}
.record-div{margin-top: 20px}
.sold-label{width: 100%;text-align: left !important;}
.btn-div{padding-left: 0px !important;padding-top: 14px}
.sold-div .checker{padding-top: 5px !important;}
div.checker input {cursor: pointer;}
.check-title{min-height: 55px !important;} 
.s_data{float: right;margin-top: 10px;}
.ss_select{width: 221px !important;max-width: 100%}
.table-bordered > tbody > tr > td{white-space: nowrap;}
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
					Auction List
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		Auction List <small></small>
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
				<div class="portlet box yellow-casablanca ">
					<div class="portlet-title check-title">
						<div class="caption">
								<i class="fa fa-gavel"></i>Auction List
						</div>
						
						<div class="tools">
							<a href="<?php echo base_url('addAuction');?>"><button class="btn btn-circle red-flamingo"><i class="fa fa-gavel"></i> add Auction
							</button></a>
							<a href="javascript:;" class="collapse">
							</a>
						</div>
						<div class="form-group s_data">

							<select class="bs-select form-control input-small ss_select input-circle" data-style="btn-warning">
								<option>Select Day</option>
								<option value="full_list">view All</option>
								<option value="next 7days from yesterday">next 7days from Yesterday</option>
								<option value="yesterday">Yesterday</option>
								<option value="today">Today</option>
							    <option value="tomorrow">Tomorrow</option>
								
							</select>
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
									Auction Date
								</th>
								
								<th>
									Category
								</th>
								<th>
									Number
								</th>
								<th>
									No of customer
								</th>
								<th>
									 Action
								</th>
							</tr>
						</thead>
						<tbody></tbody>
						</table>	
					</div>

			<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog ">
					<div class="modal-content">
						<form id="form2" method="post" action="<?php echo base_url('update_auction'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Edit Auction List</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<input type="hidden" id="auction_id" name="id">
									<div class="form-group col-md-12">
										<label class="col-md-3 control-label">Auction Date</label>
										<div class="col-md-7">
				                           <input type="date" class="form-control input-circle " name="auction_date" id="auction_date">
										</div>
									</div>
									<div class="form-group col-md-12">
										<label class="col-md-3 control-label">Category</label>
										<div class="col-md-7">
											<input type="text" id="category" name="category" class="form-control input-circle" placeholder="Enter Category">
										</div>
									</div>
									<div class="form-group col-md-12">
										<label class="col-md-3 control-label">Start Number</label>
										<div class="col-md-7">
											<input type="number" id="startnumber" name="start_number" class="form-control input-circle" placeholder="Enter Start Number">
										</div>
									</div>
									<div class="form-group col-md-12">
										<label class="col-md-3 control-label">End Number</label>
										<div class="col-md-7">
											<input type="number" id="endnumber" name="end_number" class="form-control input-circle" placeholder="Enter End Number">
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
			</div>
		</div>
	</div>
</div>
 <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --> 
 
<?php $this->load->view('common/footer');?>

<script type="text/javascript">
	// $('body').on('focus',".datepicker", function(){
 //               $(this).datepicker();
 //        });

/*var TableManaged = function () {

      var handleTable = function () {

    	var table = $('#records_table');

        var oTable = table.dataTable({
			"oLanguage": {
            "sProcessing": "Loading"},
      		"sAjaxSource": base_url+ "get_auction",
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
        }
    };

}();*/

$(document).ready(function () {
	load_datatable();

    function load_datatable(filter_by_day='',filter_by_date=''){
	//console.log('x=',today);
	var table = $('#records_table');
	var oTable = table.dataTable({
			"oLanguage": {
                "sProcessing": "Loading"},
      		"sAjaxSource": base_url+ "get_auction",
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
               aoData.push( { "name": "filter_by_day", "value": filter_by_day } );
               aoData.push( { "name": "filter_by_date", "value": filter_by_date } );
               
            },
            "order": [
                [0, "desc"]
            ] 
        });
    }

    $(document).on('change','.ss_select',function(){
    	var filter_by_day = $(this).val();

    	if(filter_by_day == 'today'){
    		var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); 
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            console.log(today); 
            load_datatable(filter_by_day,today);
    	}
    	if(filter_by_day == 'tomorrow'){
    		var date = new Date();
	        var mnth = ("0" + (date.getMonth()+1)).slice(-2);
	        var day  = ("0" + (date.getDate()+1)).slice(-2);
	        tomorrow = date.getFullYear()+"-"+mnth+"-"+day;
	         console.log(tomorrow);
	        load_datatable(filter_by_day,tomorrow); 
    	}
    	if(filter_by_day == 'yesterday'){
	    	var date = new Date();
	        var mnth = ("0" + (date.getMonth()+1)).slice(-2);
	        var day  = ("0" + (date.getDate()-1)).slice(-2);
	        yesterday = date.getFullYear()+"-"+mnth+"-"+day;
	        console.log(yesterday);
	        load_datatable(filter_by_day,yesterday);	
    	}
    	if(filter_by_day == 'next 7days from yesterday'){
	    	var date = new Date();
	        var mnth = ("0" + (date.getMonth()+1)).slice(-2);
	        var day  = ("0" + (date.getDate()+6)).slice(-2);
	        var next_7days = date.getFullYear()+"-"+mnth+"-"+day;
	        console.log(next_7days);
	        load_datatable(filter_by_day,next_7days);		
    	}
    	if(filter_by_day == 'full_list'){
    		load_datatable(filter_by_day);
    	}

    });
});


$(document).on('click','.edit',function(){
	var id=$(this).attr('data_id');
	$.ajax({
		type:'post',
		url:base_url+'Auction_controller/getAuctionById',
		dataType:'Json',
		data:{'id':id},
		success:function(res){
			 console.log(res);
            $('#form2 #auction_id').val(id);
            $('#form2 #auction_date').val(res.auction_date);
			$('#form2 #category').val(res.category);
			$('#form2 #startnumber').val(res.start_number);
			$('#form2 #endnumber').val(res.end_number);
			
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
					url:base_url+'Auction_controller/delete_auction',
					data:{'id':id},
					success:function(){
							window.location.reload();
					}
				})
	     	}   
	    }
	});
})

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
                    
	            },  
               	rules: {
               		auction_date:{
                      required: true,
               		},
               		category:{
               			required: true,
               		},
                    start_number:{
                    	required: true,
                   	},
                   	end_number:{
                    	required: true,
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

</script>

<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   //TableManaged.init();
   FormValidation.init();
});
</script>


