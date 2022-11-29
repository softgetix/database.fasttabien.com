<style type="text/css">
.add-row,.remove-row{margin-top:18%}
.category-data{display: none}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-bar"></div>
		<h4 class="page-title">
		Not Authorized <small></small>
		</h4>
		<div class="note note-danger">
			<button class="close" data-close="alert"></button>
			<span>You are not authorize to view this page, please contact admin!</span>
		</div>
	</div>
</div>
</div>
<?php include 'common/footer.php'?>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); 
   Layout.init(); 
   FormValidation.init();
   TableManaged.init();
 });
</script>

