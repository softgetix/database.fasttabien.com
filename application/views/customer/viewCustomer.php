<?php $session=$this->session->userdata(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<style type="text/css">
.add-row,.remove-row{margin-top:18%}
.records-data{display: none}
.record-div{margin-top: 20px}
.sold-label{width: 100%;text-align: left !important;}
.btn-div{padding-left: 0px !important;padding-top: 14px}
.sold-div .checker{padding-top: 5px !important;}
div.checker input {cursor: pointer;}
.check-title{min-height: 55px !important;} 
.table-bordered > tbody > tr > td{white-space: nowrap;}
.c_data{float: right;margin-top: 12px;margin-right: 10px;}
#s_lable{padding-left: 20px !important;}
.bootstrap-switch {border-radius: 20px!important;}
.s_data{float: right;margin-top: 10px;padding-right: 10px;}
.ss_select{width: 221px !important;max-width: 100%}
.buttons-csv{margin-left: 10px;}
#my_table{width:550px; max-width: 100%;}
@media(max-width: 446px){
.add_cust{padding-left: 10px;}
}
@media(max-width: 400px){
.s_data{float: right;margin-top: 10px;padding-right: 0px;}
.add_cust{margin-top: 10px;}
}
.dataTables_length{ display: inline-block;}
.dt-buttons{display: inline-block;margin-left: 10px;}
/*resizable table css start */

.table-resizable {
	&.resizing {
		cursor: col-resize;
		user-select: none;
	}
	
	th {
		position: relative;

		// Show resize curson when hovering over column borders
		&::before {
			@extend .table-resizable.resizing;
			content: '';
			display: block;
			height: 100%;
			position: absolute;
			right: 0;
			top: 0;
			width: 1em;
		}

		&:last-of-type::before {
			display: none;
		}
	}

	// Add `th` to the selector below to allow shrinking a column all the way
	td {
		max-width: 0;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
}

/*resizable table css end */
/*multiselect box css start*/
.btn.dropdown-toggle, .btn-group .btn.dropdown-toggle, .btn:hover, .btn:disabled, .btn[disabled], .btn:focus, .btn:active, .btn.active {
    outline: none !important;
    background-image: none !important;
    filter: none;
    text-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    border-radius: 25px !important;
}

.multiselect-container{
	height: 200px;
    overflow-y: scroll;
    left:auto;
    right:0;
    float:right;
}
.multiple_check button span{
margin-right:15px;
}
.multiple_check button{
	min-width: 100px;
	margin-right: 10px;
}
.multiple_check .btn .caret {
    position: absolute;
    margin-left: auto;
    right: 15px;
    top: 45%;
}

.v_btn{padding: 7px 4px !important;}

.example .search_case {
  border: 1px solid grey;
  float: left;
  width: 84%;
  background: #f1f1f1;
}

.example button {
    width: 16%;
    padding: 7px;
    background: #ee4836;
    color: white;
    border: 1px solid grey;
    cursor: pointer;
}

.example button:hover {
  background: #ee4836;
}

.example::after {
  content: "";
  clear: both;
  display: table;
}

#chat_name-error{color: red!important;}

<?php if(empty($session['access']['import/export']['access_view'])){?>
.buttons-excel{display: none;}
<?php } ?>
/*multiselect box css end*/
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
					View Customer
				</li>
			</ul>
			
		</div>
		<h4 class="page-title">
		View Customer <small></small>
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
			<div class="col-md-12">
				<div class="portlet box yellow-casablanca">
					<div class="portlet-title check-title">
						<div class="caption">
							<i class="icon-eye"></i>View
            </div>

            <div class="tools">
                            
              <?php if($session['access']['import/export']['access_view']){?>
								<button type="button" class="btn btn-circle red-flamingo import-btn v_btn" data-toggle="modal" data-target="#basic2" data-col='1' id="import_special">
								<i class="fa fa-upload"></i> Import customer
							    </button>

							    <a href="<?php echo base_url('assets/customer_sample.csv');?>" download>
								<button type="button" class="btn red-flamingo btn-circle v_btn">
									<i class="fa fa-download"></i> Sample
								</button>
							    </a>

							    <button type="button" class="btn btn-circle red-flamingo import-btn v_btn" data-toggle="modal" data-target="#basic3" data-col='1' id="import_status">
								<i class="fa fa-upload"></i> Import status
							    </button>

							    <a href="<?php echo base_url('assets/status.csv');?>" download>
								<button type="button" class="btn red-flamingo btn-circle v_btn">
									<i class="fa fa-download"></i> Status Sample
								</button>
							    </a>

							    <a href="<?php echo base_url('exportAll');?>">
									<button type="button" class="btn red-flamingo btn-circle add_cust v_btn">
									<i class="fa fa-download"></i>Export All
									</button>
								</a>

								<button type="button" class="btn btn-circle red-flamingo v_btn" data-toggle="modal" data-target="#basic4" data-col='1' id="import_chat">
								   <i class="fa fa-upload"></i> Import chatname
							  </button>

							  <a href="<?php echo base_url('assets/chatname.csv');?>" download>
								  <button type="button" class="btn red-flamingo btn-circle v_btn">
									  <i class="fa fa-download"></i> Sample chatname
								  </button>
							  </a>
              <?php } ?>

							<a href="<?php echo base_url('addCustomer');?>">
									<button type="button" class="btn red-flamingo btn-circle add_cust v_btn">
									<i class="icon-user-follow"></i> Add Customer
									</button>
								</a>
						</div>
          </div>

            <div class="form-group s_data example">
               <input type="text" placeholder="Search Case Number" name="case_number" class="form-control search_case" autocomplete="off"> 
                <button type="submit" class="case_search"><i class="fa fa-search"></i></button>
            </div>

            <div class="form-group c_data">
              <label for="title" id="s_lable"> in progress </label>
              <input type="checkbox" id="switch" name="add_toggle" class="make-switch" checked data-on-color="warning" data-off-color="success">
            </div>

            <div class="form-group s_data multiple_check">
                <select  class="bs-select form-control input-small input-circle" data-style="btn-warning" id="multiple-checkboxes" name='hide_columns[]' multiple="multiple">

                    <option value="id_1">Case No</option> 	
                    <option value="status_2">Status</option>
                    <option value="created_at_3">Date Time</option>
                    <option value="chat_name_4">Chat Name</option>
                    <option value="type_5">Type</option>
                    <option value="price_6">Source</option>
                    <option value="car_type_7">Car Type</option>
                    <option value="customer_name_8">Customer Name</option>
                    <option value="brand_id_9">Id</option>
                    <option value="chassis_10">Chassis</option>
                    <option value="brand_11">Brand</option>
                    <option value="phone_12">Phone</option>
                    <option value="role_13">Account added</option>
                    <option value="updated_at_14">Last modified</option>
                    <option value="cat1_15">cat1</option>
                    <option value="no1_16">no 1 </option>

                    
                    <?php 
                    for($i=17; $i < count($clm_name); $i++){
                  $col_name = $clm_name[$i];
                  $col_nm = $col_name."_".$i;
                 	echo "<option value='$col_nm'>$col_name </option>";
                    }?> 
                </select>
                <input type="button" id="but_showhide" class="btn red-flamingo btn-circle" value='Show/Hide'> 
            </div>

            <div class="form-group s_data">
						  <select class="bs-select form-control input-small ss_select input-circle" data-style="btn-warning">
								<option  value="full_list" selected>All Day</option>
								<option value="today" >Today</option>
								<option value="yesterday">Yesterday</option>
								<option value="tomorrow">Tomorrow</option>
                <option value="next 7days from yesterday">next 7days from Yesterday</option>
							</select>
						</div>
						
					<div class="portlet-body">
						<table class="table table-striped table-hover table-bordered table-resizable" id="records_table">
						    <thead>
							    <tr>
	                  <th nowrap="true">
										 Action
									</th>
									<th>
										 Case No
									</th>
									<th>
										 Status
									</th>
									<th>
										 Date time
									</th>
									<th>
										 Chat name
									</th>
									<th>
										 Type
									</th>
									<th>
										 Source
									</th>
									<th>
										 Car Type
									</th>
									<th>
										 Customer Name
									</th>
									<th>
										 id
									</th>
									<th>
										 Chassis
									</th>
									<th>
										 Brand
									</th>
									<th>
										 Phone
									</th>
									<th>
										Account Added
									</th>
									<th>
										 Last Modified
									</th>
									<th>
										 cat1
									</th>
									<th>
										 no1
									</th>

									<?php 
	                                for($i=17; $i < count($clm_name); $i++){
			                        $col_name = $clm_name[$i];
			                       	echo "<th> $col_name </th>";
	                                }?> 
								</tr>
							</thead>
							<tbody></tbody>
						</table>	
					</div>
				</div>
			</div>
		</div>
		<!-- delete multiple column -->
        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog ">
				<div class="modal-content">
					<form id="form2" method="post" action="#">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Delete Number</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<input type="hidden" id="customer_id" name="id">
                                    <div class="portlet-body"> 
										<table class="table table-bordered" id="my_table" align="center">
											<tbody id="delete_category"></tbody>
										</table>	
						            </div>
							</div>
					    </div>
						<div class="modal-footer">
							<input type="checkbox" id="master">
							<label for="master"> Select All</label>
							<a type="button" class="btn red-flamingo btn-circle delete_all">Delete Selected</a>
							<button type="button" class="btn default btn-circle " data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
        <!-- delete multiple column -->

        <!--  copy customer details-->

	    <div class="modal fade" id="basic_copy" tabindex="-1" role="basic" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4> Copy Customer Data</h4>
						</div>
						<div class="modal-body copy_modal">
						  	
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default btn-circle" data-dismiss="modal">Close</button>
							<a href='javascript:;' class='btn btn-circle yellow-casablanca' onclick='copytoclip()' >Copy to clipboard</a>
						</div>	
					</div>
				</div>
			</div>
        <!-- copy customer details -->

        <!-- customer csv import -->
		<div class="modal fade" id="basic2" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog ">
				<div class="modal-content">
					<form id="form3" enctype="multipart/form-data" method="post" action="<?php echo base_url('customer_import'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Import csv</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group col-md-12">
									<input type="file" name="file" class="form-control input-circle">
								</div>
							</div>	
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default btn-circle" data-dismiss="modal">Close</button>
							<button type="submit" class="btn yellow-casablanca btn-circle">Import</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- customer csv import -->

		<!-- customer status csv import -->
		<div class="modal fade" id="basic3" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="form4" enctype="multipart/form-data" method="post" action="<?php echo base_url('update_multiple_status'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Import status csv</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group col-md-12">
									<input type="file" name="file" class="form-control input-circle">
								</div>
							</div>	
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default btn-circle" data-dismiss="modal">Close</button>
							<button type="submit" class="btn yellow-casablanca btn-circle">Import</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- customer status  csv import -->

		<!-- Chatname status csv import -->
		<div class="modal fade" id="basic4" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="form5" enctype="multipart/form-data" method="post" action="<?php echo base_url('import_chatname'); ?>">	
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Import Chatname csv</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group col-md-12">
									<input type="file" name="file" class="form-control input-circle">
								</div>
							</div>	
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default btn-circle" data-dismiss="modal">Close</button>
							<button type="submit" class="btn yellow-casablanca btn-circle">Import</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Chatname status csv import -->

		<!--  change chatname customer details-->

    <div class="modal fade" id="change_chat" tabindex="-1" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="form6" enctype="multipart/form-data" method="post" action="<?php echo base_url('change_chatname'); ?>">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4> Change chat name</h4>
						</div>
						<div class="modal-body change_modal">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default btn-circle" data-dismiss="modal">Close</button>
							<button type="submit" class="btn yellow-casablanca btn-circle">save</button>
						</div>
					</form>	
				</div>
			</div>
		</div>
    <!-- change chatname customer  details -->


	</div>
</div>
<?php $this->load->view('common/footer');?>
<!-- my new js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/datatables/buttons.html5.min.js"></script>

<script type="text/javascript">
var buttonCommon = {
  exportOptions: {
    format: {
      body: function(data, column, row) {
        data = data.replace(/<br\s*\/?>/ig, "\r\n");
        data = data.replace(/<.*?>/g, "");
        data = data.replace("&amp;", "&");
        data = data.replace("&nbsp;", "");
        data = data.replace("&nbsp;", "");
        return data;
      }
    }
  }
};
$.extend(true, $.fn.dataTable.defaults, {
  "lengthChange": false,
  "pageLength": 5000,
  "orderClasses": false,
  "stripeClasses": [],
  dom: 'Bfrtip',
  buttons: [
    $.extend(true, {}, buttonCommon, {
      extend: 'excel',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5]
      },
      customize: function(xlsx) {
        var sheet = xlsx.xl.worksheets['sheet1.xml'];
        $('row c[r^="A"]', sheet).attr( 's', '50' ); //<-- left aligned text
        $('row c[r^="C"]', sheet).attr( 's', '55' ); //<-- wrapped text
        $('row:first c', sheet).attr( 's', '32' );
      }
    }),
      { // default PDF and customized PDF
     extend: 'pdfHtml5',
     title: 'Test', // report header/title
     orientation: 'landscape',
     pageSize: 'A4',
     pageMargins: [ 0, 0, 0, 0 ], // try #1 setting margins
     margin: [ 0, 0, 0, 0 ], // try #2 setting margins
     text: '<u>E</u>xport Page (PDF)',
     key: { // press E for export PDF
         key: 'e',
         altKey: false
     }
     , content: [{ style: 'fullWidth' }]
     , styles: { // style for printing PDF body
          fullWidth: { fontSize: 18, bold: true, alignment: 'right', margin: [0,0,0,0] }
     },
     bProcessing: true,
              bServerSide: true,
              aLengthMenu: [[10,25, 50, 100,500], [10,25, 50, 100,500]],
              iDisplayLength: 10,
              responsive: true,
              bDestroy: true,
        aoColumnDefs: [
                { aTargets: [0], orderable: false},
                  
              ],
     download: 'download',
     exportOptions: {
         modifier: {
             pageMargins: [ 0, 0, 0, 0 ], // try #3 setting margins
             margin: [ 0, 0, 0, 0 ], // try #4 setting margins
             alignment: 'center'
         }
         , body : {margin: [ 0, 0, 0, 0 ], pageMargins: [ 0, 0, 0, 0 ]} // try #5 setting margins         
         , columns: [0,1] //column id visible in PDF    
         , columnGap: 1 // optional space between columns
     }
 }
  ]
});

var FormValidation = function () {

   	var handleValidation1 = function() {
    		
    		var form1 = $('#form3');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
                messages: {
                	file:{
                		extension:"Please upload csv file",
                	}
                },
                rules: {
                    file: {
                      	required:true,
                        extension: "csv"
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

    var handleValidation2 = function() {
    		
    		var form1 = $('#form4');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
                messages: {
                	file:{
                		extension:"Please upload csv file",
                	}
                },
                rules: {
                    file: {
                      	required:true,
                        extension: "csv"
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

    var handleValidation3 = function() {
    		
    		var form1 = $('#form5');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
                messages: {
                	file:{
                		extension:"Please upload csv file",
                	}
                },
                rules: {
                    file: {
                      	required:true,
                        extension: "csv"
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

    var handleValidation4 = function() {
    		
    		var form2 = $('#form6');
            var error2 = $('.alert-danger', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', 
                errorClass: 'help-block help-block-error', 
                focusInvalid: false, 
                ignore: "",  
                
                rules: {
                    chat_name: {
                      	required:true,
                        
                    },
               	},

                invalidHandler: function (event, validator) { 
                    success2.hide();
                    error2.show();
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
                    success2.show();
                    error2.hide();
                    form.submit(); 
                }
            });
    }


	return {
        init: function () {
        	handleValidation1();
        	handleValidation2();
        	handleValidation3();
        	handleValidation4();
        }
    };

}();

$(document).ready(function () {
	  load_datatable('full_list');

	  $("#Test").click(function(){
      $(".buttons-excel").click();
    })

    function load_datatable(){

    	if( $('.search_case').val() !=''){
    		var case_search = $('.search_case').val();
    	  console.log(case_search);
    	}
    	
    	var filter_by_day = $('.ss_select').val();
		 	if($('#switch').is(':checked'))
		 		var status ='on';
		 	else
	 		var status ='off';

	    var seession = sessionStorage.getItem("unchecked_arr");
			var clm_count ="<?php echo get_clmno_count('customer');?>";
			var count=[2,3,4,5,6,7,8,9,10,11,12,13,14];
			var j=15;
			for(i=0;i<clm_count;i++){
				count.push(j);
				j++;
			}
		  var table = $('#records_table');
        $('#records_table').dataTable({
				"oLanguage": {
	                "sProcessing": "Loading"},
	      		"sAjaxSource": base_url+ "Customer_controller/get_customer",
	            "bProcessing": true,
	            "bServerSide": true,
	            "sServerMethod": "POST",
	            "aLengthMenu": [[25, 50,100,500], [25, 50,100,500]],
	            "iDisplayLength": 50,
	            "responsive": true,
	            "bDestroy": true,
				"aoColumnDefs": [
	                { "aTargets": [0], orderable: false},   
	            ],

	            "order": [
	                [0, "desc"]
	            ], 
	            "fnServerParams": function ( aoData ) {
	              aoData.push( { "name": "filter_by_day", "value": filter_by_day } );
	              aoData.push( { "name": "status", "value": status });
	              aoData.push( { "name": "seession", "value": seession });
	              aoData.push( { "name": "case_search", "value": case_search });
	            },
	            dom: "<'row'<'col-md-6 col-sm-12'lB><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

	        <?php if(!empty($session['access']['import/export']['access_view'])){?>
	            "buttons": [
	            {
	                extend: 'excel',
	                text: 'Export',
	                exportOptions: {
	                     columns: ':visible'
	              	},
	              	customize: function(xlsx) {
				        var sheet = xlsx.xl.worksheets['sheet1.xml'];
				        $('row c[r^="A"]', sheet).attr( 's', '50' ); //<-- left aligned text
				        $('row c[r^="C"]', sheet).attr( 's', '55' ); //<-- wrapped text
				        $('row:first c', sheet).attr( 's', '32' );
				      },
	                className: "btn red-flamingo input-circle", 
	            }, 

	           ],

	        <?php }?>      
	    });
		display();
    }

    /*$(document).on('click','.case_search',function(){
        load_datatable();
    });*/

    $(document).on('keyup','.search_case',function(){
      load_datatable();
    });

    $(document).on('change','.ss_select',function(){
        load_datatable();
     });
	
	  $('#switch').on('switchChange.bootstrapSwitch', function (event,state) {
      load_datatable();
	  });

		$('#multiple-checkboxes').multiselect({
      includeSelectAllOption: false,
	  });
 // Hide & show columns
    $('#but_showhide').click(function(){
         var checked_arr = [];
         var checked_arr_val = [];
         var unchecked_arr = [];
         var unchecked_arr_val = [];
        
         // Read all checked checkboxes
        
         $.each($('input[type="checkbox"]:checked'), function (key, value) {
         	
         	var val = this.value;
         	if(val != 'on'){
             	var dbcol_name = val.slice(0, val.lastIndexOf('_'));
             	var index = val.lastIndexOf("_");
    			var result = val.substr(index+1);
                checked_arr_val.push(result);
                checked_arr.push(dbcol_name);
         	}

         });
         
		  localStorage.setItem("checked_arr_val", JSON.stringify(checked_arr_val));
		  
         // Read all unchecked checkboxes
         $.each($('input[type="checkbox"]:not(:checked)'), function (key, value) {
         	var val = this.value;
         	if(val != 'on'){
             	var dbcol_name = val.slice(0, val.lastIndexOf('_'));
             	var index = val.lastIndexOf("_");
    			var result = val.substr(index+1);
                unchecked_arr_val.push(result);
                unchecked_arr.push(dbcol_name);
         	}
         });
         
         sessionStorage.setItem("unchecked_arr", unchecked_arr);
         var seession = sessionStorage.getItem("unchecked_arr");
         // console.log('seession',seession);
         load_datatable('',seession);

         localStorage.setItem("unchecked_arr_val", unchecked_arr_val);
         // Hide the checked columns
         var table = $('#records_table').DataTable();   	
         table.columns(checked_arr_val).visible(false);
         // Show the unchecked columns
         table.columns(unchecked_arr_val).visible(true);
         //display();
    });
    display();
    function display(){
    	var checkedValue = JSON.parse(localStorage.getItem("checked_arr_val"));
         if(checkedValue){
	     	var results = checkedValue;

			$.each($('input[type="checkbox"]'), function (key, value) {
	         	var val = this.value;
	         	if(val != 'on'){
			        var dbcol_name = val.slice(0, val.lastIndexOf('_'));
			        var index = val.lastIndexOf("_");
					var result = val.substr(index+1);
					var count_col = $('#multiple-checkboxes option').length;
		
					for(var r=0; r < count_col; r++ ){

						if(jQuery.inArray(r, results)) {
							var x = dbcol_name+"_"+results[r];
							$('input[value="'+dbcol_name+"_"+results[r]+'"]').prop('checked', true);
						}else{
							console.log("is NOT in array");
						}
					}
				}
					
	        });
			  
			var table = $('#records_table').DataTable(); 
	        table.columns(results).visible(false);
        }
	}

});

function copytoclip() {

  /* Get the text field */
  var copyText = document.getElementById("text_div");
  console.log(copyText);

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
}


$(document).on('click','.copy',function(){
	var id = $(this).attr('data_id');
  var response_data = "";
  $.ajax({
		type:'post',
		url:base_url+'copy_customer',
		dataType:'Json',
		data:{'id':id},
	  success:function(res){
	  	var copy = res.copy;
	    if(!res){
	    	$('#basic_copy').modal('hide');
	    }
	    else{

	    	  var p_no1='';
	    	  var p_no2='';
	    	  var p_no3='';
	    	  var p_no4='';
	    	  var p_no5='';
	    	  var p_no6='';
	    	  var p_no7='';
	    	  var p_no8='';
	    	  var p_no9='';

	        $.each(res.price,function(key,value){

	        	if(copy.no1 == value['number'])
	        		p_no1 = value['amount'];
            if(copy.no2 == value['number'])
            	p_no2 = value['amount'];
            if(copy.no3 == value['number'])
	        		p_no3 = value['amount'];
            if(copy.no4 == value['number'])
            	p_no4 = value['amount'];
	        	if(copy.no5 == value['number'])
	        		p_no5 = value['amount'];
            if(copy.no6 == value['number'])
            	p_no6 = value['amount'];
            if(copy.no7 == value['number'])
	        		p_no7=value['amount'];
            if(copy.no8 == value['number'])
              p_no8 = value['amount'];
            if(copy.no9 == value['number'])
            	p_no9 = value['amount'];
	        })

					response_data += "<textarea id='text_div' readonly='' rows='20' style='width:100%' >สำคัญมาก !!\n \nรบกวนคุณลูกค้าตรวจสอบความถูกต้องของข้อมูลอีกรอบนะครับ หากข้อมูลผิด จะไม่สามารถนำไปจดทะเบียนได้นะครับ\n \n ป้ายปัจจุบันของรถคันนี้: "+copy.type+"\n ประเภทรถยนต์: "+copy.car_type+"\n ชื่อ นามสกุล: "+copy.customer_name+"\n เลขบัตรประชาชน/นิติบุคคล: "+copy.brand_id+"\n เลขตัวถังรถ: "+copy.chassis+"\n ยี่ห้อรถยนต์: "+copy.brand+" \n เบอร์โทรศัพท์: "+copy.phone+"\n \n ";

           response_data += "(กรณีรถยังอยู่ในไฟแนนซ์ ใช้เป็นชื่อผู้ซื้อรถนะครับ ไม่ใช้ชื่อไฟแนนซ์ // กรณีซื้อรถมือสอง ใช้ชื่อเจ้าของใหม่ที่ซื้อรถ ไม่ใช่เจ้าของเก่าครับ)\n \n";

           response_data += "เลขทะเบียนที่ต้องการ (ต้องชอบทุกเลข ทุกเลขมีโอกาสจองสำเร็จทั้งหมด และ สามารถจองสำเร็จเพียงเลขเดียวเท่านั้น อาจจะเป็นเลขใดเลขนึงในนี้ก็ได้)\n \n";

          if(copy.cat1 && copy.no1)
           	response_data +="ลำดับที่1: "+copy.cat1+" "+copy.no1+" ";if(p_no1)response_data +="("+p_no1+")\n";
	    	  if(copy.cat2 && copy.no2)
	    	  	response_data +="ลำดับที่2: "+copy.cat2+" "+copy.no2+" ";if(p_no2)response_data +="("+p_no2+")\n";
	    	  if(copy.cat3 && copy.no3)
	    	  	response_data +="ลำดับที่3: "+copy.cat3+" "+copy.no3+" ";if(p_no3)response_data +="("+p_no3+")\n";
	    	  if(copy.cat4 && copy.no4)
	    	  	response_data +="ลำดับที่4: "+copy.cat4+" "+copy.no4+" ";if(p_no4)response_data +="("+p_no4+")\n";
	    	  if(copy.cat5 && copy.no5)
	    	  	response_data +="ลำดับที่5: "+copy.cat5+" "+copy.no5+" ";if(p_no5)response_data +="("+p_no5+")\n";
	    	  if(copy.cat6 && copy.no6)
	    	  	response_data +="ลำดับที่6: "+copy.cat6+" "+copy.no6+" ";if(p_no6)response_data +="("+p_no6+")\n";
	    	  if(copy.cat7 && copy.no7)
	    	  	response_data +="ลำดับที่7: "+copy.cat7+" "+copy.no7+" ";if(p_no7)response_data +="("+p_no7+")\n";
	    	  if(copy.cat8 && copy.no8)
	    	  	response_data +="ลำดับที่8: "+copy.cat8+" "+copy.no8+" ";if(p_no8)response_data +="("+p_no8+")\n";
	    	  if(copy.cat9 && copy.no9)
	    	  	response_data +="ลำดับที่9: "+copy.cat9+" "+copy.no9+" ";if(p_no9)response_data +="("+p_no9+")\n";
	    	 response_data +="</textarea>";

	      $(".copy_modal").html(response_data);
	    	$('#basic_copy').modal('show');
	    }
	  }
	})
 
});

$(document).on('click','.change_chatname',function(){
	var id = $(this).attr('data_id');
    var response_data = "";
    $.ajax({
		type:'post',
		url:base_url+'get_chatname',
		dataType:'Json',
		data:{'id':id},
	    success:function(res){
		  	console.log(res);
		    if(!res){
		    	$('#change_chat').modal('hide');
		    }
		    else{
		    	response_data+='<div class="row"><div class="col-sm-5"><h5 style="font-weight: 600;word-break: break-all;">Current &nbsp;<span>'+res[0].chat_name+'</span></h5></div><div class="col-sm-2"><h5 style="font-weight: 600;">Change to</h5></div><div class="col-sm-5"><input type="hidden" name="id" value='+res[0].id+'><input type="text" name="chat_name" placeholder="Chat Name" class="form-control input-circle" autocomplete="off"></div></div>';
		    	$(".change_modal").html(response_data);

		    	$('#change_chat').modal('show');

		    }
		}
	})

});


$(document).on('click','.multiple_delete',function(){
	var id=$(this).attr('data_id');
    var response_data="";
	$.ajax({
		type:'post',
		url:base_url+'multiple_delete_number',
		dataType:'Json',
		data:{'id':id},
	    success:function(res){
	    	if(!res.data){
	    		$('#basic').modal('hide');
	    	}
	    	else{
	    		$('#form2 #customer_id').val(id);
	            $.each(res.data,function(key,value){
		             response_data += "<tr class='remove_row'><td>"+value['cat'+value.number]+"</td><td>"+value['no'+value.number]+"</td><td><button type='button' data_id="+res.id+" data_clm = "+value.number+" data_catg="+value['cat'+value.number]+" data_num ="+value['no'+value.number]+" class='delete_clm yellow-casablanca btn-circle btn-sm btn' href='javascript:;'>remove</button><input type='checkbox' class='sub_chk' name='col_checked'  data-id="+res.id+" 	data_catg="+value['cat'+value.number]+" data_num ="+value['no'+value.number]+" data_clm="+value.number+"></td></tr>";
	                $("#delete_category").html(response_data);
		    	})
		    	$('#basic').modal('show');
	    	}
	    }
	})
	
});

$('#master').on('click', function() {

	if($(this).is(':checked',true)){
		$(".sub_chk").prop('checked', true);
	}
	else{
		$(".sub_chk").prop('checked',false);
	}
});


$('.delete_all').on('click', function(e) {
	var allVals = [];
	var allcatg = [];
	var allnumber = [];
	var id;

	$(".sub_chk:checked").each(function() {
		id = $(this).attr('data-id');
		console.log("id",id);
		allVals.push($(this).attr('data_clm'));
		allcatg.push($(this).attr('data_catg'));
		allnumber.push($(this).attr('data_num'));
	});
	if(allVals.length <= 0)
	{
		alert("Please select row.");
	}
	else {
		WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
		var check = confirm(WRN_PROFILE_DELETE);
		if(check == true){
			//for server side
			
			var join_selected_values = allVals.join(",");
			var join_allcatg = allcatg.join(",");
			var join_allnum = allnumber.join(",");
			
			$.ajax({
				type: "POST",
				url: base_url+'remove_all_clm_data',
				dataType:'Json',
				data:{'id':id,'clm':join_selected_values,'catg':join_allcatg,'num':join_allnum},
				success: function(response)
				{
					window.location.reload();
					//referesh table
				}
			});
		}
	}
});

$(document).on('click','.delete_clm',function(){
	var id = $(this).attr('data_id');
	var clm = $(this).attr('data_clm');
	var catg = $(this).attr('data_catg');
  var number = $(this).attr('data_num');

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
					url:base_url+'remove_clm_data',
					dataType:'Json',
					data:{'id':id,'clm':clm,'catg':catg,'number':number},
				    success:function(res){
				    	window.location.reload();
				    }
			    })
	     	}   
	    }
	});
})

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
					url:base_url+'Customer_controller/delete_customer',
					data:{'id':id},
					success:function(){
					    window.location.reload();
					}
				})
	     	}   
	    }
	});
})

$(function() {
        var startX,
             startWidth,
             $handle,
             $table,
             pressed = false;
        
        $(document).on({
            mousemove: function(event) {
                if (pressed) {
                    $handle.width(startWidth + (event.pageX - startX));
                }
            },
            mouseup: function() {
                if (pressed) {
                    $table.removeClass('resizing');
                    pressed = false;
                }
            }
        }).on('mousedown', '.table-resizable th', function(event) {
            $handle = $(this);
            pressed = true;
            startX = event.pageX;
            startWidth = $handle.width();
            
            $table = $handle.closest('.table-resizable').addClass('resizing');
        }).on('dblclick', '.table-resizable thead', function() {
            // Reset column sizes on double click
            $(this).find('th[style]').css('width', '');
        });
});

</script>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   FormValidation.init();
   //TableManaged.init();
});
</script>
