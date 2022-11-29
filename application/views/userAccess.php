<style type="text/css">
.add-row,.remove-row{margin-top:18%}
.category-data{display: none}
 .access_view_table .checker {display: none; }
table.access_view_table .row-span.access-label {background: #ddd;}
#selectRole {margin-bottom: 15px}
</style>
<?php $access_level_id = !empty($access[0]) && !empty($access[0]['access_level_id']) ? $access[0]['access_level_id'] : 0; 
?>
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
					User Access
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		User <small>Access</small>
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
								<i class="icon-key"></i>User Access
							</div>
							<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
						</div>
						</div>
						<div class="portlet-body">
							 
             			<form action="<?php echo base_url("userAccess"); ?>" method="get" id="role_form">
             			<div class="col-md-4"></div>
                          <div class="text-center col-md-4">
                              <label><strong>Select User Type</strong></label>
                             	<select id="selectRole" name="userRole" class="form-control">
                                <?php
                                if(!empty($access_level)){
                                	
								 foreach ($access_level as $key => $value) { 
								 	?>
                                 
                                    <option value="<?php echo $value['access_level_id'];?>" <?php echo $access_level_id == $value['access_level_id'] ? 'selected':'';?> ><?php echo ucfirst($value['access_level_name']);?></option>
                                 
                              <?php   }
                                }
                                ?>
                              </select>
                            </div>
                            <div class="col-md-4"></div>     
                        </form>
                        <table class="access_view_table table table-hover table-bordered" style="text-align:center;">
                            <tr>
                              <td colspan="6"><span>User Role: </span> <b><?php echo !empty($access[0]) && !empty($access[0]['access_level_name']) ? ucfirst($access[0]['access_level_name']):'';?></b></td> 
                           </tr>
                            <tr class="row-span">
                              <td rowspan="2"> <b>Module Name</b></td>
                              <td colspan="5"> <b>Access</b> </td>
                            </tr>
                            <tr class="row-span access-label">
                              <td>View</td>
                              <td>Add</td>
                              <td>Update</td>
                              <td>Delete</td>
                            <?php if(isset($this->session->userdata('access')['access']) && isset($this->session->userdata('access')['access']['access_update']) && $this->session->userdata('access')['access']['access_update'] == 1 ){ ?>  
                              <td></td>
                           <?php } ?>   
                           </tr>
                           <?php if(!empty($access)){
                              foreach ($access as $key => $accessData) { 
                                $access_id = !empty($accessData['access_id']) ? $accessData['access_id']: 0
                                 ?> 
                           <tr>
                              <td><?php echo !empty($accessData['module_name']) ? ucfirst($accessData['module_name']):'';?>
                                 <input type="hidden" class="access_module_id" name="access_module_id" value="<?php echo !empty($accessData['access_module_id']) ? $accessData['access_module_id']: 0 ;?>">
                                 <input type="hidden" class="access_id" name="access_id" value="<?php echo !empty($accessData['access_id']) ? $accessData['access_id']: 0 ;?>">
                              </td>
                              <td class="access_view">
                                <input type="checkbox" class="access-check-box check_view" value="<?php echo $accessData['access_view']?>" name="" <?php echo !empty($accessData['access_view']) && $accessData['access_view'] == 1 ? "checked":'';?> >
                                <?php 
                                if(isset($accessData['access_view']) && $accessData['access_view'] != 2)
                                {
                                  echo !empty($accessData['access_view']) && $accessData['access_view'] == 1 ? '<img src="'.site_url("assets/img/green.png").'">': '<img src="'.site_url("assets/img/red.png").'">';
                                }else
                                {
                                 echo '<span class="not-sign">NA</span>';
                                } ?>
                              </td>
                              <td class="access_insert">
                               <input type="checkbox" class="access-check-box check_insert" value="<?php echo $accessData['access_insert']?>" name="" <?php echo !empty($accessData['access_insert']) && $accessData['access_insert'] == 1 ? "checked":'';?> >
                                <?php 
                                if(isset($accessData['access_insert']) && $accessData['access_insert'] != 2)
                                {
                                 echo !empty($accessData['access_insert']) && $accessData['access_insert'] == 1 ? '<img src="'.site_url("assets/img/green.png").'">': '<img src="'.site_url("assets/img/red.png").'">';
                                  }else{
                                   echo '<span class="not-sign">NA</span>';
                                  } ?>

                             </td>
                              <td class="access_update"> 
                                 <input type="checkbox" class="access-check-box" value="<?php echo $accessData['access_update']?>" name="" <?php echo !empty($accessData['access_update']) && $accessData['access_update'] == 1 ? "checked":'';?> >
                                 <?php 
                                if(isset($accessData['access_update']) && $accessData['access_update'] != 2){
                                  echo !empty($accessData['access_update']) && $accessData['access_update'] == 1 ? '<img src="'.site_url("assets/img/green.png").'">':'<img src="'.site_url("assets/img/red.png").'">';
                                  }else{
                                   echo '<span class="not-sign">NA</span>';
                                  } ?>
                              </td>
                              <td class="access_delete"> 
                                 <input type="checkbox" class="access-check-box" value="<?php echo $accessData['access_delete']?>" name=""  <?php echo !empty($accessData['access_delete']) && $accessData['access_delete'] == 1 ? "checked":'';?> >
                                <?php 
                                if(isset($accessData['access_delete']) && $accessData['access_delete'] != 2){
                                   echo !empty($accessData['access_delete']) && $accessData['access_delete'] == 1 ? '<img src="'.site_url("assets/img/green.png").'">': '<img src="'.site_url("assets/img/red.png").'">';
                                   }else{
                                   echo '<span class="not-sign">NA</span>';
                                  } ?>
                             <?php if(isset($this->session->userdata('access')['userAccess']) && isset($this->session->userdata('access')['userAccess']['access_update']) && $this->session->userdata('access')['userAccess']['access_update'] == 1 && $access_level_id > 1){ ?>     
                              <td>
                                  <a href='<?php echo site_url("userAccess/edit/$access_id");?>' class="btn yellow-casablanca btn-sm"><span>Change Permission</span></a>
                              </td>
                            <?php } ?>
                           </tr>
                          <?php }
                         }?> 
                         </table>
        
						</div>
					</div>
			</div>
			
		</div>
	</div>
</div>
</div>
<?php include 'common/footer.php'?>
<script type="text/javascript">
$('#role_form').on('change', function(){
    $(this).closest('form').submit();
});
</script>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); 
   Layout.init(); 
});
</script>

