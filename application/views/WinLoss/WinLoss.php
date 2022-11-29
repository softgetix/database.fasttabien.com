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
					Win Loss Probability
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		Win Loss Probability <small></small>
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
								<i class="fa fa-bar-chart"></i>Win Loss Probability
						</div>
						<div class="tools">

							<button type="button" class="btn btn-circle red-flamingo import-btn v_btn" data-toggle="modal" data-target="#basic" data-col='1' id="import_prob">
								<i class="fa fa-upload"></i> Import
							</button>

							<a href="<?php echo base_url('assets/winloss_sample.csv');?>" download>
								<button type="button" class="btn red-flamingo btn-circle v_btn">
									<i class="fa fa-download"></i> Sample
								</button>
							</a>

							<a href="javascript:;" class="collapse"></a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="winloss_table">
						<thead>
							<tr>
								<th>
									 No
								</th>
								<th>
									Number
								</th>
								<th>
									 win/loss status
								</th>
								
								<th>
									win/loss probability
								</th>
                                <th>
									 Created At
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
		</div>


		<!-- winloss status csv import -->
		<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="form1" enctype="multipart/form-data" method="post" action="<?php echo base_url('winloss_csv'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Import WinLoss csv</h4>
						</div>
						<div class="modal-body">
							<div class="row">
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
		<!-- winloss status  csv import -->
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
	    return {
            init: function () {
        	  handleValidation1();
            }
        };
}();

$(document).ready(function () {

	load_datatable();

	function load_datatable(){
       
        var table = $('#winloss_table');
        var oTable = table.dataTable({
		    "oLanguage": {
            "sProcessing": "Loading"},
      	    "sAjaxSource": base_url+ "get_winloss",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
            "bDestroy": true,
            "searching": false,
			
            "order": [
                [1, "asc"]
            ] 
        });  
    }
});

$(document).on('click','.delete',function(){
	var id = $(this).attr('data_id');

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
					url:base_url+'remove_prob',
					dataType:'Json',
					data:{'id':id},
				    success:function(res){
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
   FormValidation.init();
   
});
</script>



