<?php $session=$this->session->userdata();?>
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
					New Cases
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		New Cases<small></small>
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
		<?php if($session['access']['newcases']['access_view']){ ?>	
		<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>New Cases
						</div> 
						<!-- <div class="tools">
							<a href="<?php //echo base_url('viewCustomer');?>"><button class="btn btn-circle red-flamingo"><i class="fa fa-arrow-left"></i> Back
							</button></a>
							<a href="javascript:;" class="collapse">
							</a>
						</div> -->
                    </div>
					
					<div class="portlet-body ">
						<table class="table table-striped table-hover table-bordered" id="records_table">
						<thead>
							<tr>
								<th>
									 No
								</th>
								<th>
									 Date
								</th>
								<th>
									New Cases
								</th>
								<th>
									From Line@
								</th>
					            <th>
									 From Facebook
								</th>
						        <!-- <th>
									 Action
								</th> -->
							</tr>
						</thead>
						<tbody></tbody>
						</table>	
					</div>
                </div>
			</div>
		</div>

		<!--  newcases by month-->

		<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>New Cases By Month
						</div> 
                    </div>
					
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="newcase_by_month">
						<thead>
							<tr>
								<th>
									 No
								</th>
								<th>
									 Month
								</th>
								<th>
									 New Cases
								</th>
								<th>
									From Line@
								</th>
					            <th>
									 From Facebook
								</th>
							</tr>
						</thead>
						<tbody></tbody>
						</table>	
					</div>
                </div>
			</div>
		</div>

		<!-- newcases by year -->
		<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>New Cases By Year
						</div> 
                    </div>
					
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="newcase_by_year">
						<thead>
							<tr>
								<th>
									 No
								</th>
								<th>
									 Year
								</th>
								<th>
									 New Cases
								</th>
								<th>
									From Line@
								</th>
					            <th>
									 From Facebook
								</th>
							</tr>
						</thead>
						<tbody></tbody>
						</table>	
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
<script type="text/javascript">
$(document).ready(function () {
	load_datatable();
	 function load_datatable(){
       
        var table = $('#records_table');
        var oTable = table.dataTable({
			"oLanguage": {
            "sProcessing": "Loading"},
      		"sAjaxSource": base_url+ "Customer_controller/get_newcases",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
            "bDestroy": true,
            "ordering": false,
            "searching": false,
			
            "order": [
                [1, "desc"]
            ] 
        });

         var table = $('#newcase_by_month');
        var oTable = table.dataTable({
		    "oLanguage": {
            "sProcessing": "Loading"},
      	    "sAjaxSource": base_url+ "Customer_controller/newcase_by_month",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
            "bDestroy": true,
            "ordering": false,
            "searching": false,
			
            "order": [
                [1, "desc"]
            ] 
        });

        var table = $('#newcase_by_year');
        var oTable = table.dataTable({
		    "oLanguage": {
            "sProcessing": "Loading"},
      	    "sAjaxSource": base_url+ "Customer_controller/newcase_by_year",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
            "bDestroy": true,
            "ordering": false,
            "searching": false,
			
            "order": [
                [1, "desc"]
            ] 
        });
    }

});
</script>

<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
  // TableManaged.init();
  //FormValidation.init();
});
</script>
