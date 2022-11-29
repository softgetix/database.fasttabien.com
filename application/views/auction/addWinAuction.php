<?php $session=$this->session->userdata(); ?>
<style type="text/css">
.ss_form_body{ margin-left: 8px;}
.form-group{ margin-left: 0px!important;}
.update_cust{margin-left: -1px;}
.add-row,.remove-row{margin-top:13%}
.records-data{display: none}
.record-div{margin-top: 20px}
.category-data{display: none}
.result {display: none};
.res{text-align: center;font-size: 15px}
.portlet-title{min-height: 55px !important;}
.help-block-error{color: #a94442 !important}
.n_save{margin-left: 24%;}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 21px !important;
}
.select2-container--default .select2-selection--single{
	border-radius: 25px !important;
    height: 34px !important;
    padding: 6px 12px;
    background-color: #fff;
    border: 1px solid #e5e5e5;
}
    
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/css/newtimepicker.css" />

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
					Add Winning Auction
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		Add Winning Auction <small></small>
		</h4>
		<?php
		if( null !== $this->session->flashdata('warning') ){ ?>
		<div class="note note-warning">
			<button class="close" data-close="alert"></button>
			<span><?php echo $this->session->flashdata('warning');?></span>
		</div>
		<?php }?>
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
		    <?php if($session['access']['addWinAuction']['access_insert']){ 
			 ?>
			<div class="col-md-12">	
				<div class="portlet-body">
					<div class="portlet box yellow-casablanca">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-check"></i>Add Winning Auction
							</div>
							<div class="tools">
								<a href="<?php echo base_url('winning_auction');?>"><button class="btn btn-circle red-flamingo"><i class="icon-eye"></i> Winning Auction List
								</button></a>
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="<?php echo base_url('save_WinAuction');?>" class="form-horizontal" method="post" id="form">
							  
								<div class="form-body ss_form_body">

									<div class="row" style="padding:10px">
		                            	<div class="form-group col-md-6">
                                           <label for="Chat Name">Chat Name </label>
		                            	   <input type="text" name="chat_name" class="form-control input-circle" placeholder="Chat Name">
		                                </div>
		                            
		                            	<div class="form-group col-md-6">
		                            	   <label for="Completed Date">Completed Date</label>
                                          <input type="date" name="completed_date" class="form-control input-circle" >  
                                        </div> 
		                            </div>

		                            <div class="row" style="padding:10px">
		                            	<div class="form-group col-md-6">
                                           <label for="Payment ID">Payment ID </label>
		                            	   <input type="text" name="payment_id" class="form-control input-circle" placeholder="Payment ID">
		                                </div>
		                            
		                            	<div class="form-group col-md-6">
		                            	   <label for="Customer Name">Customer Name</label>
                                           <select class="form-control" id="cust_id" name="cust_id" ></select> 
                                        </div> 
		                            </div>

									<div class="row" style="padding:10px">
		                            	<div class="form-group col-md-6" >
                                           <label for="paymentdate">payment Date</label>
		                            	   <input type="date" name="payment_date" class="form-control input-circle" >
		                                </div>
		                            
		                            	<div class="form-group col-md-6" >
		                            	   <label for="paymenttime">payment Time</label>
                                           <input type="text" name="payment_time" id="remind_time" placeholder="Task Time" class="form-control input-circle ui-timepicker-input">  
                                        </div> 
		                            </div>
		                            <div class="row" style="padding: 10px">
		                            	<div class="form-group col-md-6" >
		                            	   <label for="Price">Price</label>
		                            	   <input type="text" name="price" placeholder="Price" class="form-control input-circle">
		                            	</div>
		                            	<div class="form-group col-md-6" >
		                            	   <label for="winningnumber">Winning Number</label>
		                                   <input type="text" name="winning_number" placeholder="Winning Number" class="form-control input-circle"> 
		                            	</div>
		                            </div>
		                            <div class="row" style="padding: 10px">
		                            	<div class="form-group col-md-6" >
		                            	   <label for="remark">Remark</label>
		                                    <input type="text" name="remark" placeholder="Remark" class="form-control input-circle"> 
		                                </div>

		                                <div class="form-group col-md-6">
		                            	   <label for="type" style="display:block;">Account Name</label>

			                                <select class="form-control input-circle" name="account_name" id="account_name">
			                                	<option value="">Select Account Name</option>
		                            	        <option value="Ksher">Ksher</option>
			                                	<option value="Gbprimepay">Gbprimepay</option>
			                                	<option value="Aigotech">Aigotech</option>
			                                	<option value="Siwakorn">Siwakorn</option>
			                                	<option value="Chawanrat">Chawanrat</option>
			                                	<option value="Vichakorn">Vichakorn</option>
			                                	<option value="Jiranan">Jiranan</option>
			                                </select> 
		                            	</div>
                                    </div>
                                    <div class="row" style="padding: 10px">
		                            	
		                                <div class="form-group col-md-6">
		                            	    <label for="type" style="display:block;">Received Bank Account</label>
			                                <select class="form-control input-circle" name="received_bank_account" id="received_bank_account">
			                                	<option value="">Received Bank Account</option>
			                                	<option value="Ksher">Ksher</option>
			                                	<option value="Gbprimepay">Gbprimepay</option>
			                                	<option value="Kbank">Kbank</option>
			                                	<option value="Scb">Scb</option>
			                                	<option value="BBL">BBL</option>
			                                	<option value="Krungsri">Krungsri</option>
			                                	<option value="Thanachat">Thanachat</option>
			                                	<option value="Krungthai">Krungthai</option>
			                                </select>  
		                            	</div>
                                    </div>	
		                        </div>
		                        <div class="form-group add-data-div"></div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-circle yellow-casablanca n_save">Save</button>
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
</div>


<?php $this->load->view('common/footer');?>
<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url()?>/assets/js/newtimepicker.js"></script>

<script type="text/javascript">
   
    $("#remind_time").timepicker({ timeFormat: 'H:i','step': 15});

    $('#cust_id').select2({
	  placeholder: 'search Customer',
	  ajax: {
	    url: base_url+'search_customer',
	    dataType: 'json',
	    delay: 250,
	    processResults: function (data) {
	    	return {
               results:  $.map(data, function (item) {
               	console.log(item);
                  return {
                    text: item.customer_name,
                    id: item.id
                  }
               })
            };
	    },
	    cache: true
	  }
    });

    $('#cust_id').on('select2:selecting', function() {
		$(this).parent().find('.help-block-error').remove();
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
                    cust_id: {
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

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); 
                },

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
   Metronic.init(); 
   Layout.init(); 
   FormValidation.init();
});

</script>



