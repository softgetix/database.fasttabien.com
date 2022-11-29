<?php $session=$this->session->userdata();?>
<style type="text/css">
.portlet-title{min-height: 55px !important;}
.add_no{margin-left: 10px;}
#exealldigit_table{width: 33%;max-width: 100%;margin-left: 25%;text-align: center;}
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
					Check All Numbers
				</li>
			</ul>	
		</div>
		<h4 class="page-title">Check All Numbers </h4>
		<div class="row">
		   <?php if($session['access']['specialNumber']['access_view']){?>	
			<div class="col-md-12">	
				<div class="portlet-body">
					<div class="portlet box yellow-casablanca">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-check"></i>Check All Numbers
							</div>
							<div class="tools">
								<a href="<?php echo base_url('export_all_numbers');?>">
									<button type="button" class="btn red-flamingo btn-circle add_cust v_btn">
									<i class="fa fa-download"></i>Export All
									</button>
								</a>

								<a href="<?php echo base_url('specialNumber');?>"><button class="btn btn-circle red-flamingo"><i class="fa fa-arrow-left"></i> Back
								</button></a>
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>

						<div class="portlet-body">
						    <table class="table table-striped table-hover table-bordered" id="exealldigit_table">
								<thead>
									<tr>
										<th style="text-align: center;">Number</th>
										<th style="text-align: center;">Price
										<th style="text-align: center;">Existing category
								    </tr>
							    </thead>

							    <?php if(!empty($allnumlist)){   
							    	 foreach ($allnumlist as $key => $digit) {?>
								<tbody>
									<tr>
										<td><?php echo $digit['no'];?></td>
										<td><?php echo $digit['discount'];?></td>
										<td><?php echo preg_replace('/,/', '', $digit['all_cat'], 1); ?></td>
									</tr>	
								</tbody>
							<?php } }?>
							</table>	
				        </div>
					</div>
				</div>	
			</div>
		  <?php }  ?>
		</div>
	</div>
</div>

<?php include 'common/footer.php'?>

<script>
jQuery(document).ready(function() {    
   Metronic.init(); 
   Layout.init(); 
});
</script>

