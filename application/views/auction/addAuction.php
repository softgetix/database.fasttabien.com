<?php $session=$this->session->userdata();?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
 -->
 <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
  
<style type="text/css">
.btn-sm, .btn-xs {padding: 2px 7px 3px 9px;font-size: 13px;line-height: 1.5;}
.btn-div {padding-left: 0px !important;}
.col-sm-2{width: 22%}
.col-sm-3{margin-left: -22px;}
.form-control{margin-top: 10px;}
.help-block {margin-left: -12px !important;}
.add-row,.remove-row{margin-top:60%}
.records-data{display: none}
.record-div{margin-top: 20px}
.category-data{display: none}
.result {display: none};
.res{text-align: center;font-size: 15px}
.portlet-title{min-height: 55px !important;}
.help-block-error{color: #a94442 !important}
.save_row{margin-left: 18%;}
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
					Auction Number
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		Auction Number <small></small>
		</h4>
		<?php
		if( null !== $this->session->flashdata('warning') ){ ?>
		<div class="note note-warning">
			<button class="close" data-close="alert"></button>
			<span><?php echo $this->session->flashdata('warning');?></span>
		</div>
		<?php }?>
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
					<?php if($session['access']['addAuction']['access_insert']){?>	
			<div class="col-md-12">	
			<div class="portlet-body">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-plus"></i>Create Auction Number List
						</div>
						<div class="tools">
							<a href="<?php echo base_url('viewAuction');?>"><button class="btn btn-circle red-flamingo"><i class="fa fa-gavel"></i> view Auction
							</button></a>
							<a href="javascript:;" class="collapse">
							</a>
					</div>
					</div>
					
					
					<div class="portlet-body form">
						<form action="<?php echo base_url('save_auction');?>" class="form-horizontal" method="post" id="form">
							<div class="form-body">
							    <div class="row record-div">
							  	
								    <div class="col-sm-12">
								  		<div class="col-sm-2">
											<label class="control-label"> Date</label>
								  		    <input type="date"  class="form-control input-circle" name="auction_date">
                                        </div>

								  		<div class="col-sm-3">
											<label class="control-label"> Category</label>
											<input type="text" name="category" class="form-control input-circle" placeholder="Enter Category">
										</div>

							  	 	    <div class="col-sm-3">
											<label class="control-label"> Start Number</label>
											<input type="number" name="startnumber" class="form-control input-circle" placeholder="Enter Start No. ">
										</div>

								        <div class="col-sm-3">
											<label class="control-label"> End Number</label>
											<input type="number" name="endnumber" class="form-control input-circle" placeholder="Enter End No">
										</div>
									
										<div class="col-sm-1 btn-div">
											<button type="button" class="btn add-row yellow-casablanca btn-circle btn-sm" ><i class="fa fa-plus"></i></button>
										</div>
								    </div>

							    </div>

							    <div class="records-data">
			                        <div class="col-sm-12">	
			                    	    <div class="col-sm-2">
											<label class="control-label"> Date</label>
								  		    <input type="date" class="form-control input-circle datepicker" name="auction_date1[]">
									    </div>
								  		<div class="col-sm-3">
											<label class="control-label"> Category</label>
											<input type="text" name="category1[]" class="form-control input-circle" placeholder="Enter Category">
										</div>

							  	 	    <div class="col-sm-3">
											<label class="control-label"> Start Number</label>
											<input type="number" name="startnumber1[]" class="form-control input-circle" placeholder="Enter Start No. ">
										</div>
								        <div class="col-sm-3">
											<label class="control-label"> End Number</label>
											<input type="number" name="endnumber1[]" class="form-control input-circle" placeholder="Enter End No">
										</div>
									   <div class="col-sm-1 btn-div">
										<button type="button" class="btn add-row yellow-casablanca btn-circle btn-sm" ><i class="fa fa-plus"></i></button><button type="button" class="btn remove-row yellow-casablanca btn-circle btn-sm"><i class="fa fa-minus"></i></button>
									    </div>
			                        </div>	 	
		                        </div>									  

		                        <div class="form-group add-data-div"></div>
							</div>

							<div class="form-actions">
								<div class="row save_row">
									<div class="col-md-offset-3 col-md-9">
										<button type="submit" class="btn btn-circle yellow-casablanca">Save</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			</div>
		<?php } ?>
	</div>
</div>
</div>

<!-- <script type="text/javascript" src="<?php echo base_url()?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
 -->
 <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
 <?php $this->load->view('common/footer');?>

 <script type="text/javascript">
 	$(document).ready(function() {
        //$( ".datepicker" ).datepicker();
        // $('body').on('focus',".datepicker", function(){
        //        $(this).datepicker();
        // });

        $(document).on('click','.add-row',function(){
	       $('.record-div').append($('.records-data').html());	
	      
        })

        $(document).on('click','.remove-row',function(){
	        $(this).parent().parent().remove();
        })
    });

    var FormValidation = function () {

   	var handleValidation1 = function() {
        	var form1 = $('#form');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",
                messages: {
                    
	            },  
               	rules: {
               		auction_date:{
                      required: true,
               		},
               		category:{
               			required: true,
               		},
                    startnumber:{
                    	required: true,
                   	},
                   	endnumber:{
                    	required: true,
                   	},
                },

                invalidHandler: function (event, validator) { 
                    success1.hide();
                    error1.show();
                },

                highlight: function (element) { 
                    $(element)
                        .closest('.form-group').addClass('has-error'); 
                },

                unhighlight: function (element) { 
                    $(element)
                        .closest('.form-group').removeClass('has-error'); 
                },

                // success: function (label) {
                //     label
                //         .closest('.form-group').removeClass('has-error'); 
                // },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                    form.submit(); 
               	}
            });
    }
   	return {
        init: function () {
        	handleValidation1();
      	}

    };

}();
</script>

<script>
jQuery(document).ready(function() {   

   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   FormValidation.init();
   //TableManaged.init();

});
</script>


