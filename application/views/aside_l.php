<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
			   <?php if (isset($account_details->picture) && strlen(trim($account_details->picture)) > 0) { echo showPhoto($account_details->picture, array('class'=>'img-circle')); }else{ echo showPhoto(null,array('class'=>'img-circle')); } ?>
            </div>
            <div class="pull-left info">
              <p><?php echo ($account_details->fullname)? $account_details->fullname:$account->username;  ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..." />
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span><?php echo lang('dashboard_title'); ?></span> 
              </a>
            </li>
			<li class="<?php echo (isset($accountinfo))? 'active':''?> treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span><?php echo lang('account_info_title'); ?></span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo (isset($accountprofile))? 'active':''?>" ><a href="<?php echo base_url(); ?>account/account_profile"><i class="fa fa-circle-o"></i>  <?php echo lang('account_info_profile'); ?></a></li>
                <li class="<?php echo (isset($accountsettings))? 'active':''?>"><a href="<?php echo base_url(); ?>account/account_settings"><i class="fa fa-circle-o"></i> <?php echo lang('account_info_account'); ?></a></li>
				<?php if ($account->password) : ?>
				<li class="<?php echo (isset($accountpassword))? 'active':''?>"><a href="<?php echo base_url(); ?>account/account_password"><i class="fa fa-circle-o"></i> <?php echo lang('account_info_password'); ?></a></li>
				<?php endif; ?>
				<li class="<?php echo (isset($accountlinked))? 'active':''?>"><a href="<?php echo base_url(); ?>account/account_linked"><i class="fa fa-circle-o"></i> <?php echo lang('account_info_linked'); ?></a></li>
			  </ul>
            </li>
			<?php if ($this->authorization->is_permitted( array('retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
			<li class="<?php echo (isset($adminpanel))? 'active':''?> treeview">
              <a href="#">
                <i class="fa fa-edit "></i> <span><?php echo lang('admin_panel_title'); ?></span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<?php if ($this->authorization->is_permitted('retrieve_users')) : ?>
                <li class="<?php echo (isset($manageuser))? 'active':''?>"><a href="<?php echo base_url(); ?>account/manage_users"><i class="fa fa-circle-o"></i>  <?php echo lang('admin_panel_manage_users'); ?></a></li>
				<?php endif; ?>

				<?php if ($this->authorization->is_permitted('retrieve_roles')) : ?>
				<li class="<?php echo (isset($manageroles))? 'active':''?>"><a href="<?php echo base_url(); ?>account/manage_roles"><i class="fa fa-circle-o"></i>  <?php echo lang('admin_panel_manage_roles'); ?></a></li>
				<?php endif; ?>

				<?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
				<li class="<?php echo (isset($managepermissions))? 'active':''?>"><a href="<?php echo base_url(); ?>account/manage_permissions"><i class="fa fa-circle-o"></i>  <?php echo lang('admin_panel_manage_permissions'); ?></a></li>
				<?php endif; ?>
								
				<?php if ($this->authorization->is_permitted('retrieve_mailbox')) : ?>
				<li class="<?php echo (isset($managemailbox))? 'active':''?>"><a href="<?php echo base_url(); ?>account/manage_mailbox"><i class="fa fa-circle-o"></i>  <?php echo lang('admin_panel_manage_mailbox'); ?></a></li>
				<?php endif; ?>
			 </ul>
            </li>
			<?php endif; ?>
			 <li class="<?php echo (isset($accountprofile))? 'active':''?>">
              <a href="<?php echo base_url(); ?>calendar">
                <i class="fa fa-calendar"></i> <span><?php echo lang('calendar_title'); ?></span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
			<li class="<?php echo (isset($filefolder))? 'active':''?>">
              <a href="<?php echo base_url(); ?>file">
                <i class="fa fa-folder"></i> <span><?php echo lang('file_title'); ?></span>
              </a>
            </li>
			<li class="<?php echo (isset($qrcodescanner))? 'active':''?>">
              <a href="<?php echo base_url(); ?>qrscanner">
                <i class="fa fa-qrcode"></i> <span><?php echo lang('qrscanner_title'); ?></span>
              </a>
            </li>
			<li class="<?php echo (isset($mail))? 'active':''?>">
              <a href="<?php echo base_url(); ?>mail">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <?php if(isset($mailboxInfo['unread'])){ echo '<small class="label pull-right bg-red">'.$mailboxInfo['unread'].'</small>'; } ?>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>