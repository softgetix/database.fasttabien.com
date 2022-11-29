<?php $session=$this->session->userdata();?>
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/> -->
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
					History
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		History <small></small>
		</h4>
		
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box yellow-casablanca ">
					<div class="portlet-title check-title">
						<div class="caption">
								<i class="fa fa-history"></i>History
						</div>
						<!-- <div class="tools">
							<a href="<?php //echo base_url('checkrecord');?>">
								<button type="button" class="btn red-flamingo btn-circle ">
								<i class="fa fa-check"></i> Check Record
								</button>
							</a>
							<a href="javascript:;" class="collapse"></a>
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
									 New/Edit
								</th>
								
								<th>
									Case No.
								</th>
								<th>
									Changes
								</th>
								<th>
									Changes history
								</th>
								<th>
									User Name
								</th>
					            <th>
									 Date
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

var TableManaged = function () {

      var handleTable = function () {

    	var table = $('#records_table');

        var oTable = table.dataTable({
			"oLanguage": {
            "sProcessing": "Loading"},
      		"sAjaxSource": base_url+ "get_history",
            "bProcessing": true,
            "bServerSide": true,
            "aLengthMenu": [[25, 50, 100], [25, 50, 100]],
            "iDisplayLength": 25,
            "responsive": true,
			"aoColumnDefs": [
                { "aTargets": [0], orderable: false},
                { "aTargets": [7], orderable: false},
                
            ],
            "order": [
                [0, "desc"]
            ] 
        });
    }
    
	return {
		init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            handleTable();
            
        }

    };

}();

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
					url:base_url+'History_controller/delete_history',
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
   TableManaged.init();
});
</script>


