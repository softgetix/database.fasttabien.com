<?php $session=$this->session->userdata();?>
<style type="text/css">
.topsidebar-toggle{
	position: absolute;
    top: -36px;
    z-index: 99999;
    right: 0px;
}	
</style>

<div class="page-container">
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
				<div class="sidebar-toggler-wrapper topsidebar-toggle">
					<div class="sidebar-toggler">
					</div>
				</div>
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
		  	<?php if($session['access']['user']['access_view']){?>
				<li class="start <?php echo ($slug=='user')?'active open':'';?>">
					<a href="<?php echo base_url('user') ?>">
						<i class="icon-user"></i>
						<span class="title">User</span>
						<span class="selected"></span>
					</a>
				</li>
		 	<?php } if($session['access']['userAccess']['access_view']){?>	
				<li class="start <?php echo ($slug=='userAccess')?'active open':'';?>">
					<a href="<?php echo base_url('userAccess') ?>">
						<i class="icon-key"></i>
						<span class="title">User Access</span>
						<span class="selected"></span>
					</a>
				</li>
			<?php } if($session['access']['specialNumber']['access_view']){?>
				<li class="start <?php echo ($slug=='specialNumber')?'active open':'';?>">
					<a href="<?php echo base_url('specialNumber') ?>">
						<i class="icon-docs"></i>
						<span class="title">Special Number</span>
						<span class="selected"></span>
					</a>
				</li>
			<?php } if($session['access']['addCustomer']['access_view'] OR $session['access']['viewCustomer']['access_view'] ){?>
				<li class="start <?php echo ($slug=='customer')?'active open':'';?>">
					<a href="javascript:;">
						<i class="icon-users"></i>
						<span class="title">Customer</span>
						<span class="selected"></span>
						<span class="arrow <?php echo ($slug=='customer')?'open':'';?>"></span>
					</a>
					<ul class="sub-menu">
						<?php  if($session['access']['addCustomer']['access_view']){?>
							<li class="<?php echo ($sub_menu=='addCustomer')?'active':'';?>">
								<a href="<?php echo base_url('addCustomer') ?>">
								<i class="icon-user-follow"></i>
								Add Customer</a>
							</li>
							<?php }if($session['access']['viewCustomer']['access_view'] ){?>
							<li class="<?php echo ($sub_menu=='viewCustomer')?'active':'';?>">
								<a href="<?php echo base_url('viewCustomer')?>">
								<i class="icon-eye"></i>
								View Customer</a>
							</li>
                        <?php } if($session['access']['newcases']['access_view'] ){?>
                        	<li class="<?php echo ($sub_menu=='newcases')?'active':'';?>">
								<a href="<?php echo base_url('newcases')?>">
								<i class="icon-eye"></i>
								New Cases</a>
							</li>

                        <?php } ?>
					</ul> 
				</li>
			<?php }if($session['access']['history']['access_view']){?>
			<li class="start <?php echo ($slug=='history')?'active open':'';?>">
					<a href="<?php echo base_url('viewHistory') ?>">
						<i class="fa fa-history"></i>
						<span class="title">History</span>
						<span class="selected"></span>
					</a>
				</li>
			<?php } if($session['access']['addAuction']['access_view'] OR $session['access']['viewAuction']['access_view'] ){?>
				<li class="start <?php echo ($slug=='auction')?'active open':'';?>">
					<a href="javascript:;">
						<i class="icon-list"></i>
						<span class="title">Auction List</span>
						<span class="selected"></span>
						<span class="arrow <?php echo ($slug=='auction')?'open':'';?>"></span>
					</a>
					<ul class="sub-menu">
						<?php  if($session['access']['addAuction']['access_view']){?>
							<li class="<?php echo ($sub_menu=='addAuction')?'active':'';?>">
								<a href="<?php echo base_url('addAuction') ?>">
								<i class="fa fa-gavel"></i>
								Add Auction</a>
							</li>
						<?php }if($session['access']['viewAuction']['access_view'] ){?>
							<li class="<?php echo ($sub_menu=='viewAuction')?'active':'';?>">
								<a href="<?php echo base_url('viewAuction')?>">
								<i class="icon-eye"></i>
								View Auction</a>
							</li>
						<?php } if($session['access']['addWinAuction']['access_view'] ){?>
                        	<li class="<?php echo ($sub_menu=='addWinAuction')?'active':'';?>">
								<a href="<?php echo base_url('addWinAuction')?>">
								<i class="fa fa-gavel"></i>
								Add Win Auction</a>
							</li>
                        <?php } if($session['access']['completed']['access_view'] ){?>
                        	<li class="<?php echo ($sub_menu=='completed')?'active':'';?>">
								<a href="<?php echo base_url('winning_auction')?>">
								<i class="fa fa-tasks"></i>
								Completed</a>
							</li>
						<?php }if($session['access']['revenueComplete']['access_view'] ){?>
							<li class="<?php echo ($sub_menu=='revenueComplete')?'active':'';?>">
								<a href="<?php echo base_url('revenueComplete')?>">
								<i class="icon-eye"></i>
								Revenue </a>
							</li>
						<?php } ?>
					</ul> 
				</li>
				<?php }
				    if($session['access_level_id'] <= 2){
						if($session['access']['win/loss probability']['access_view']){?>
						    <li class="start <?php echo ($slug=='win/loss probability')?'active open':'';?>">
								<a href="<?php echo base_url('viewWinLoss') ?>">
									<i class="fa fa-bar-chart"></i>
									<span class="title">win/loss</span>
									<span class="selected"></span>
								</a>
							</li>
				<?php } } if($session['access']['user activity']['access_view']){?>
			    <li class="start <?php echo ($slug == 'user activity')?'active open':'';?>">
					<a href="<?php echo base_url('UserActivity') ?>">
						<i class="icon-user"></i>
						<span class="title">User Activities</span>
						<span class="selected"></span>
					</a>
				</li> 
			<?php } ?>
			</ul>
		</div>
	</div>
	