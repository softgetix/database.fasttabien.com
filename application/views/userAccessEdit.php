<style type="text/css">
.add-row,.remove-row{margin-top:18%}
.category-data{display: none}
 .access_view_table .checker {display: none; }
table.access_view_table .row-span.access-label {background: #ddd;}
#selectRole {margin-bottom: 15px}
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
							  <?php 
                        $access_id = !empty($accessEdit[0]) && !empty($accessEdit[0]['access_id']) ? $accessEdit[0]['access_id']: 0;
                        $access_level_id = !empty($accessEdit[0]) && !empty($accessEdit[0]['access_level_id']) ? $accessEdit[0]['access_level_id']: 0;
                      ?>
                      <form action="<?php echo base_url("userAccess/update/$access_id");?>" method="POST">
                      <input type="hidden" name="access_level_id" id="access_level_id" value="<?php echo $access_level_id; ?>">
                       <table class="user table table-hover table-bordered" style="text-align:center;">
                          <tr>

                            <td colspan="6">User Role : <b><?php echo !empty($accessEdit[0]) && !empty($accessEdit[0]['access_level_name']) ? ucfirst($accessEdit[0]['access_level_name']):'';?></b></td>

                            
                         </tr>
                          <tr class="row-span">
                            <td rowspan="2"> <b>Module Name</b></td>
                            <td colspan="5"> <b>Access</b> </td>
                          </tr>
                          <tr class="row-span">
                            <td>View</td>
                            <td>Add</td>
                            <td>Update</td>
                            <td>Delete</td>
                            <td></td>
                         </tr>
                         <?php if(!empty($accessEdit)){
                            foreach ($accessEdit as $key => $accessData) { 
                              $access_id = !empty($accessData['access_id']) ? $accessData['access_id']: 0
                               ?> 
                         <tr>
                            <td><?php echo !empty($accessData['module_name']) ? ucfirst($accessData['module_name']):'';?>
                               <input type="hidden" class="access_module_id" name="access_module_id" value="<?php echo !empty($accessData['access_module_id']) ? $accessData['access_module_id']: 0 ;?>">
                               <input type="hidden" class="access_id" name="access_id" value="<?php echo !empty($accessData['access_id']) ? $accessData['access_id']: 0 ;?>">
                            </td>
                            <td class="access_view">
                             <?php if(isset($accessData['access_view']) && $accessData['access_view'] != 2) {?>
                              <input type="checkbox"  class="access-check-box check_view" value="1" name="access_checkbox" <?php echo !empty($accessData['access_view']) && $accessData['access_view'] == 1 ? "checked":'';?> >
                            <?php }else
                            {
                              echo '<input type="hidden" name="access_checkbox" value="'.$accessData['access_view'].'" />';
                              echo '<span class="not-sign">NA</span>';
                            }?>
                            </td>
                            <td class="access_insert">
                            <?php if(isset($accessData['access_insert']) && $accessData['access_insert'] != 2) {?>  
                             <input type="checkbox" title="To allow Add Permission you must allow View Permission" class="access-check-box check_insert" value="1" name="insert_checkbox" <?php echo !empty($accessData['access_insert']) && $accessData['access_insert'] == 1 ? "checked":'';?> >
                            <?php }else
                              {
                                echo '<input type="hidden" name="insert_checkbox" value="'.$accessData['access_insert'].'" />';
                                echo '<span class="not-sign">NA</span>';
                              }?>
                           </td>
                            <td class="access_update">
                            <?php if(isset($accessData['access_update']) && $accessData['access_update'] != 2) {?> 
                               <input type="checkbox" title="To allow Add Permission you must allow View Permission" class="access-check-box" value="1" name="update_checkbox" <?php echo !empty($accessData['access_update']) && $accessData['access_update'] == 1 ? "checked":'';?> >
                               <?php }else
                              {
                                echo '<input type="hidden" name="update_checkbox" value="'.$accessData['access_update'].'" />';
                                echo '<span class="not-sign">NA</span>';
                              }?>
                            </td>
                            <td class="access_delete">
                            <?php if(isset($accessData['access_delete']) && $accessData['access_delete'] != 2) {?> 
                               <input type="checkbox" class="access-check-box access_delete" value="1" name="delete_checkbox"  <?php echo !empty($accessData['access_delete']) && $accessData['access_delete'] == 1 ? "checked":'';?> >
                             <?php }else
                              {
                               echo '<input type="hidden" name="delete_checkbox" value="'.$accessData['access_delete'].'" />';
                                echo '<span class="not-sign">NA</span>';
                              }?>   
                            </td>
                            <td>
                               <button type="submit" class="add-more-btn editAccess btn btn-primary" style="background: #3b8cbb;color: #fff;padding: 5px 10px 6px;">Update</button>
                               <a href='<?php echo base_url("userAccess/?userRole=$access_level_id");?>' class="add-more-btn editAccess btn btn-danger" style="padding: 5px 10px 6px;">Cancel</span>
                            </td>
                         </tr>
                        <?php }
                       }?> 
                       </table>
                    </form>
             		
        
						</div>
					</div>
			</div>
			
		</div>
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

