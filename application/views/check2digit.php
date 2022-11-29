<?php $session=$this->session->userdata();?>
<style type="text/css">
.portlet-title{min-height: 55px !important;}
.add_no{margin-left: 10px;}
#exe2digit_table{width: 35%;max-width: 100%;margin-left: 56%;text-align: center; margin-top: -273px;}
.copy_clip{width: 45%;background-color: #f5f5f5;margin-top: 39px;margin-left: 38px; border: 1px solid;}
.clip_text{padding: 12px 15px;}
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
					Check 2 digit
				</li>
			</ul>	
		</div>
		<h4 class="page-title">Check 2 digit </h4>
		<div class="row">
		   <?php if($session['access']['specialNumber']['access_view']){?>	
			<div class="col-md-12">	
				<div class="portlet-body">
					<div class="portlet box yellow-casablanca">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-check"></i>Check 2 digit
							</div>
							<div class="tools">
								<a href="<?php echo base_url('export2digit');?>">
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
							<div class="copy_clip">
								<div class="clip_text">
									<h4>เลขสองหลักที่ยังว่างในตอนนี้จะมีเป็นเลข ดังนี้ครับ</h4>

									<?php if(!empty($pretext)){   
									   foreach ($pretext as $key => $text) {?>

									   	<?php if(empty($text['new_all_cat'])) { ?>
									   		
										 	   <span><?php echo $text['number'];'&nbsp;'?> ว่าง</span><br>
										      
										   <?php } elseif($text['count'] <= 2) { ?>
									   		
										 	      <span><?php echo $text['number'];?>  ว่าง  &nbsp;(ยกเว้น <?php echo $text['new_all_cat'];?> )</span><br>
										      
										   <?php } ?>
									
							      <?php } }?>
							   </div>
							</div>

						   <table class="table table-striped table-hover table-bordered" id="exe2digit_table">
								<thead>
									<tr>
										<th style="text-align: center;">Number</th>
										<th style="text-align: center;">Price
										<th style="text-align: center;">Existing category
								    </tr>
							    </thead>

							    <?php if(!empty($list)){   
							    	 foreach ($list as $key => $digit) {?>
								<tbody id="2digittable">
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

