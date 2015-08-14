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
				
				<?php if ($this->authorization->is_permitted('retrieve_files')) : ?>
				<li class="<?php echo (isset($managefiles))? 'active':''?>"><a href="<?php echo base_url(); ?>account/manage_files"><i class="fa fa-circle-o"></i>  <?php echo lang('admin_panel_manage_files'); ?></a></li>
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
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>