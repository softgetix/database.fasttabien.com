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
					Update Winning Auction
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		Update Winning Auction <small></small>
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
		    <?php if($session['access']['completed']['access_view']){ 
			 ?>
			<div class="col-md-12">	
				<div class="portlet-body">
					<div class="portlet box yellow-casablanca">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-check"></i>Update Winning Auction
							</div>
							<div class="tools">
								<a href="<?php echo base_url('winning_auction');?>"><button class="btn btn-circle red-flamingo"><i class="icon-eye"></i> Winning Auction List
								</button></a>
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="<?php echo base_url('update_WinAuction');?>" class="form-horizontal" method="post" id="form">
							    <input type="hidden" name="id" value="<?php echo $result[0]["id"]?>" id="winning_number_id">
							  

								<div class="form-body ss_form_body">
									<div class="row" style=" padding: 10px">
										
		                            	<div class="form-group col-md-6" >
                                        <label for="paymentdate">payment Date</label>

                                        <?php if(!empty($result[0]["payment_date"])){?>

		                            	   <input type="date" name="payment_date"  class="form-control input-circle" value="<?php echo $result[0]["payment_date"]?>" >

		                            	   <?php } else { ?>
		                            	   	<input type="date" name="payment_date"class="form-control input-circle" >

		                            	<?php }?>
		                                </div>
		                            
		                            	<div class="form-group col-md-6" >
		                            	   <label for="paymenttime">payment Time</label>

		                            	   <?php if(!empty($result[0]["payment_time"])){?>

		                                   <input type="text" name="payment_time" id="remind_time" placeholder="Task Time" class="form-control input-circle ui-timepicker-input" value="<?php echo $result[0]["payment_time"]?>" >

		                                   <?php } else { ?>

		                                   	<input type="text" name="payment_time" id="remind_time" placeholder="Task Time" class="form-control input-circle ui-timepicker-input" >
		                                   <?php } ?>
                                        </div>
									   
		                            </div>
		                            <div class="row" style=" padding: 10px">
		                            	
		                            	<div class="form-group col-md-6" >
		                            	   <label for="Price">Price</label>
		                            	   <?php if(!empty($result[0]["price"])){?>
		                                    <input type="text" name="price" placeholder="Price" class="form-control input-circle" value="<?php echo $result[0]["price"]?>">

		                                    <?php } else { ?>

		                                    <input type="text" name="price" placeholder="Price" class="form-control input-circle">
		                                    <?php } ?>
		                            	</div>
		                            	<div class="form-group col-md-6" >
		                            	   <label for="winningnumber">Winning Number</label>
		                            	    <?php if(!empty($result[0]["winning_number"])){?>
		                                    <input type="text" name="winning_number" placeholder="Winning Number" class="form-control input-circle" value="<?php echo $result[0]["winning_number"]?>" >

		                                    <?php } else { ?>

		                                    <input type="text" name="winning_number" placeholder="Winning Number" class="form-control input-circle"  >
                                            <?php } ?>
		                            	</div>
		                            </div>
		                            <div class="row" style=" padding: 10px">
		                            	<div class="form-group col-md-6" >
		                            	   <label for="remark">Remark</label>
		                            	   <?php if(!empty($result[0]["remark"])){?>
		                                    <input type="text" name="remark" placeholder="Remark" class="form-control input-circle" value="<?php echo $result[0]["remark"]?>" >

                                            <?php } else { ?>

		                                    <input type="text" name="remark" placeholder="Remark" class="form-control input-circle"  >
                                            <?php } ?>
		                                </div>


		                                <div class="form-group col-md-6">
                                           <label for="Payment ID">Payment ID </label>

                                           <?php if(!empty($result[0]["payment_id"])){?>
		                                    <input type="text" name="payment_id" class="form-control input-circle" placeholder="Payment ID" value="<?php echo $result[0]["payment_id"]?>">

                                            <?php } else { ?>

		                                    <input type="text" name="payment_id" class="form-control input-circle" placeholder="Payment ID">
                                            <?php } ?> 
		                                </div> 
                                    </div>
                                    <div class="row" style=" padding: 10px">

		                                <div class="form-group col-md-6" >
		                            	   <label for="type" style="display:block;">Account Name</label>

			                                <select class="form-control input-circle" name="account_name" id="account_name">
			                                	<option value="">Select Account Name</option>
			                                	<?php if(!empty($result[0]["account_name"])){?>

			                                	<option value="Ksher" <?php echo ($result[0]['account_name'] == 'Ksher')?"selected":"" ?>>Ksher</option>

			                                	<option value="Gbprimepay" <?php echo ($result[0]['account_name'] == 'Gbprimepay')?"selected":"" ?>>Gbprimepay</option>
			                                	
			                                	<option value="Aigotech" <?php echo ($result[0]['account_name'] == 'Aigotech')?"selected":"" ?> >Aigotech</option>
			                                	<option value="Siwakorn" <?php echo ($result[0]['account_name'] == 'Siwakorn')?"selected":"" ?>>Siwakorn</option>
			                                	<option value="Chawanrat" <?php echo ($result[0]['account_name'] == 'Chawanrat')?"selected":"" ?>>Chawanrat</option>
			                                	<option value="Vichakorn" <?php echo ($result[0]['account_name'] == 'Vichakorn')?"selected":"" ?>>Vichakorn</option>
			                                	<option value="Jiranan" <?php echo ($result[0]['account_name'] == 'Jiranan')?"selected":"" ?>>Jiranan</option>
			                                
		                            	        <?php } else { ?>

			                                    <option value="Ksher">Ksher</option>
			                                	<option value="Gbprimepay">Gbprimepay</option>
			                                	<option value="Aigotech">Aigotech</option>
			                                	<option value="Siwakorn">Siwakorn</option>
			                                	<option value="Chawanrat">Chawanrat</option>
			                                	<option value="Vichakorn">Vichakorn</option>
			                                	<option value="Jiranan">Jiranan</option>
			                                	
			                                	<?php } ?>
			                                </select> 
		                            	</div>
		                            	
		                                <div class="form-group col-md-6" >
		                            	   <label for="type" style="display:block; ">Received Bank Account</label>
			                                <select class="form-control input-circle" name="received_bank_account" id="received_bank_account">
			                                	<option value="">Received Bank Account</option>
			                                	<?php if(!empty($result[0]["received_bank_account"])){?>

                                                <option value="Ksher" <?php echo ($result[0]['received_bank_account'] == 'Ksher')?"selected":"" ?>>Ksher</option>
                                                
			                                	<option value="Gbprimepay" <?php echo ($result[0]['received_bank_account'] == 'Gbprimepay')?"selected":"" ?>>Gbprimepay</option>
			                                	<option value="Kbank" <?php echo ($result[0]['received_bank_account'] == 'Kbank')?"selected":"" ?>>Kbank</option>
			                                	<option value="Scb" <?php echo ($result[0]['received_bank_account'] == 'Scb')?"selected":"" ?>>Scb</option>
			                                	<option value="BBL" <?php echo ($result[0]['received_bank_account'] == 'BBL')?"selected":"" ?>>BBL</option>
			                                	<option value="Krungsri" <?php echo ($result[0]['received_bank_account'] == 'Krungsri')?"selected":"" ?>>Krungsri</option>
			                                	<option value="Thanachat" <?php echo ($result[0]['received_bank_account'] == 'Thanachat')?"selected":"" ?>>Thanachat</option>
			                                	<option value="Krungthai" <?php echo ($result[0]['received_bank_account'] == 'Krungthai')?"selected":"" ?>>Krungthai</option>
			                                	

			                                	<?php } else { ?>

			                                	<option value="Ksher">Ksher</option>
			                                	<option value="Gbprimepay">Gbprimepay</option>
			                                	<option value="Kbank">Kbank</option>
			                                	<option value="Scb">Scb</option>
			                                	<option value="BBL">BBL</option>
			                                	<option value="Krungsri">Krungsri</option>
			                                	<option value="Thanachat">Thanachat</option>
			                                	<option value="Krungthai">Krungthai</option>
			                                	
			                                	<?php } ?>
			                                </select>
		                            	</div>
                                    </div>	
		                            	
		                        </div>
		                        <div class="form-group add-data-div"></div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-circle yellow-casablanca n_save">Update</button>
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
<script type="text/javascript" src="<?php echo base_url()?>/assets/js/newtimepicker.js"></script>
<script type="text/javascript">
    
    $("#remind_time").timepicker({ timeFormat: 'H:i','step': 15});

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
                   	payment_date: {
                        required: true,
                    },
                    payment_time: {
                        required: true,
                    },
                   	price:{
                    	required: true,
                   	},
                   	winning_number:{
                   		required: true,
                   	},
                    remark:{
                   		required: true,
                   	},
                   	account_name:{
                    	required: true,
                   	},
                   	received_bank_account:{
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

