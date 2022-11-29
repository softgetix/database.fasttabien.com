<?php $session=$this->session->userdata();?>

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
					User Activity
				</li>
			</ul>
		</div>
		<h4 class="page-title">
		User Activity<small></small>
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
		<?php if($session['access']['user activity']['access_view']){ ?>	
		
       <!-- user activity -->
		<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-check"></i>User Activity By Month
						</div> 

						<div class="tools">
							<div class="form-group">
						      <select class="bs-select form-control input-small input-circle select_year" data-style="btn-warning">
								 
									<?php for($i= date('Y'); $i >= 2020; $i--){?>
				                  <option value="<?php  echo $i;?>" > <?php  echo $i;?></option>
		                    <?php }?> 
							</select>
					</div>
						</div>
               </div>
					
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered" id="activity">
							<thead class="res_year">
								<tr>
								   <th>
										 No
									</th>
									<th>
										Account Name
									</th>

									<th>
										january 
									</th>
									<th >
										February 
									</th>
									<th>
										March 
									</th>
									<th >
										April 
									</th>
									<th >
										May 
									</th>
									<th >
										June 
									</th>
									<th >
										July
									</th>
									<th >
										Auguest 
									</th>
									<th>
										September 
									</th>
									<th >
										October 
									</th>
									<th >
										November 
									</th>
									<th>
										December 
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

	var sel_year = new Date().getFullYear();

	load_datatable(sel_year);

	function load_datatable(sel_year=""){

		var filter_by_year = $('.select_year').val();

      var table = $('#activity');
      var oTable = table.dataTable({
		   "oLanguage": {
            "sProcessing": "Loading"},
      	    "sAjaxSource": base_url+ "viewActivity",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
            "bDestroy": true,
            "ordering": false,
            "searching": false,
            "fnServerParams": function ( aoData ) {
	              aoData.push( { "name": "filter_by_year", "value": filter_by_year });    
	            },
            "order": [
                [1, "desc"]
            ],
         });
   }

   $(document).on('change','.select_year',function(){
      load_datatable();
   });
});


</script>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
});
</script>
