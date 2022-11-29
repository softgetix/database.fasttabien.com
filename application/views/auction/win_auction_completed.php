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
.s_data{float: right;margin-top: 10px;}
.ss_select{width: 221px !important;max-width: 100%}
.c_data{float: right;margin-top: 12px;margin-right: 10px;}
.bootstrap-switch {border-radius: 20px!important;}
.table-bordered > tbody > tr > td{white-space: nowrap;}
.v_btn{ padding: 7px 5px!important;}
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
					Auction Completed List
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		Auction Completed List <small></small>
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
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title check-title">
						<div class="caption">
								<i class="fa fa-gavel"></i>Auction Completed List
						</div>
						
						<div class="tools">
							<a href="<?php echo base_url('addWinAuction');?>"><button class="btn btn-circle red-flamingo v_btn"><i class="fa fa-gavel"></i> Add Win Auction
							</button></a>

                     <?php if($session['access']['winAuctionExport']['access_view']){?>
							 <a href="<?php echo base_url('exportAuction');?>">
									<button type="button" class="btn red-flamingo btn-circle v_btn">
									<i class="fa fa-download"></i>Export
									</button>
								</a>
						   <?php }?>

							<a href="javascript:;" class="collapse"></a>
						</div>
						<div class="form-group s_data">

                     <select class="bs-select form-control input-small revenue input-circle" data-style="btn-warning">
								<option>Select Revenue</option>
								<option value="viewall">view All</option>
								<option value="week">This Week</option>
								<option value="month">This Month</option>
							</select>
						</div>

						<div class="form-group s_data">
                     <select class="bs-select form-control input-small no_payment input-circle" data-style="btn-warning">
								<option>Select value</option>
								<option value="no_payment">No payment Id </option>
							</select>
						</div>

						<div class="form-group c_data">
                     <label for="title" style="margin-right: 10px;"id="s_lable"> Filter Unpaid  </label>
                     <input type="checkbox" id="switch" name="add_toggle" class="make-switch" data-on-color="warning" data-off-color="danger" >
                  </div>	
					</div>
					<div class="portlet-body table-responsive">
						<table class="table table-striped table-hover table-bordered" id="records_table">
						<thead>
							<tr>
								<th>
									 Case No
								</th>
								<th>
									Completed Date
								</th>
								
								<th>
									Payment Date
								</th>
								<th>
									Payment Time
								</th>
								<th>
									Payment ID
								</th>
								<th>
									Price
								</th>
								<th>
									Chat Name
								</th>
								<th>
									Winning Name
								</th>
								<th>
									Account Name
								</th>
								<th>
									Received Bank Account
								</th>
								<th>
									Remark
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
		</div>
	</div>
</div>
 <?php $this->load->view('common/footer');?>
<script type="text/javascript">
$(document).ready(function () {
	load_datatable();

    function load_datatable(){

    	if($("#switch").prop("checked") == true){
	       var unpaid = "on";
	    }else{
	      var unpaid = "off";
	    }

   	if($(".revenue").val()!=''){
          var revenue = $(".revenue").val();
   	}else{
   		var revenue ='';
   	}

   	if($(".no_payment").val()!=''){
          var no_payment = $(".no_payment").val();
   	}else{
   		var no_payment ='';
   	}

	   var table = $('#records_table');
	   var oTable = table.dataTable({
			"oLanguage": {
                "sProcessing": "Loading"},
      		"sAjaxSource": base_url+ "get_completed_auction",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
            "bDestroy": true,
			"aoColumnDefs": [
                { "aTargets": [0], orderable: false},
                { "aTargets": [13], orderable: false},
            ],
            "fnServerParams": function ( aoData ) {
               aoData.push( { "name": "unpaid", "value": unpaid });
               aoData.push( { "name": "revenue", "value": revenue });
               aoData.push( { "name": "no_payment", "value": no_payment });
            },
            "order": [
                [0, "desc"]
            ] 
      });

	   $('#switch').on('switchChange.bootstrapSwitch', function (event,state) {
         load_datatable();
      });
      $(document).on('change','.revenue',function(){
 	    load_datatable();
      });

      $(document).on('change','.no_payment',function(){
 	     load_datatable();
      });
   }

});

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
					url:base_url+'Auction_controller/delete_win_number',
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
   //TableManaged.init();
   // FormValidation.init();
});
</script>


