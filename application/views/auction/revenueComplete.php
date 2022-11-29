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
					Revenue
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		Revenue<small></small>
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
		<?php if($session['access']['revenueComplete']['access_view']){ ?>	
		<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>Revenue By Date
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
									 Date
								</th>
								<th>
									No of cases
								</th>
					            <th>
									 Revenue
								</th>
								<th>
									 Line@  Revenue
								</th>
								<th>
									Facebook Revenue
								</th>
							</tr>
						</thead>
						<tbody></tbody>
						</table>	
					</div>
                </div>
			</div>
		</div>
		<!--  revenue by month-->

		<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>Revenue By Month
						</div> 
                    </div>
					
					<div class="portlet-body ">
						<table class="table table-striped table-hover table-bordered" id="records_table_month">
						<thead>
							<tr>
								<th>
									 No
								</th>
								<th>
									Month
								</th>
								<th>
									No of cases
								</th>
					            <th>
									 Revenue
								</th>
								<th>
									 Line@  Revenue
								</th>
								<th>
									Facebook Revenue
								</th>
							</tr>
						</thead>
						<tbody></tbody>
						</table>	
					</div>
                </div>
			</div>
		</div>
		<!--  revenue by year-->

		<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>Revenue By Year
						</div> 
                    </div>
					
					<div class="portlet-body ">
						<table class="table table-striped table-hover table-bordered" id="records_table_year">
						<thead>
							<tr>
								<th>
									 No
								</th>
								<th>
									Year
								</th>
								<th>
									No of cases
								</th>
					            <th>
									 Revenue
								</th>
								<th>
									 Line@  Revenue
								</th>
								<th>
									Facebook Revenue
								</th>
							</tr>
						</thead>
						<tbody></tbody>
						</table>	
					</div>
                </div>
			</div>
		</div>

		<!--  Bank  Revenue -->
		<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>Revenue By Bank Account By Month
						</div> 
                    </div>
					
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="bank_revenue">
						<thead>
							<tr>
								<th>
									 No
								</th>
								<th>
									Account Name
								</th>

								<th>
									january - <?php echo date('Y') ?>
								</th>
								<th>
									February - <?php echo date('Y') ?>
								</th>
								<th>
									March - <?php echo date('Y') ?>
								</th>
								<th>
									April - <?php echo date('Y') ?>
								</th>
								<th>
									May - <?php echo date('Y') ?>
								</th>
								<th>
									June - <?php echo date('Y') ?>
								</th>
								<th>
									July - <?php echo date('Y') ?>
								</th>
								<th>
									Auguest - <?php echo date('Y') ?>
								</th>
								<th>
									September - <?php echo date('Y') ?>
								</th>
								<th>
									October - <?php echo date('Y') ?>
								</th>
								<th>
									November - <?php echo date('Y') ?>
								</th>
								<th>
									December - <?php echo date('Y') ?>
								</th>
								<th>
									Total month Sum
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
      	    "sAjaxSource": base_url+ "Auction_controller/get_revenueComplete",
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


        var table = $('#records_table_month');
        var oTable = table.dataTable({
		    "oLanguage": {
            "sProcessing": "Loading"},
      	    "sAjaxSource": base_url+ "Auction_controller/get_revenueByMonth",
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

        var table = $('#records_table_year');
        var oTable = table.dataTable({
		    "oLanguage": {
            "sProcessing": "Loading"},
      	    "sAjaxSource": base_url+ "Auction_controller/get_revenueByYear",
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
        
        var table = $('#bank_revenue');
        var oTable = table.dataTable({
		    "oLanguage": {
            "sProcessing": "Loading"},
      	    "sAjaxSource": base_url+ "Auction_controller/bank_revenue",
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
