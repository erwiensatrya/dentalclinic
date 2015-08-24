<header class="main-header">

        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="flaticon-tooth19"></i>D</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><i class="flaticon-tooth19"></i>  <b><?php echo lang('website_title'); ?></b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
		  
		  <?php if ($this->authentication->is_signed_in()) { ?>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
				  <?php if((isset($mailboxInfo['unread'])) && ($mailboxInfo['unread']>0)){ echo '<span class="label label-danger">'.$mailboxInfo['unread'].'</span>'; } ?>
                </a>
				<?php if((isset($mailboxInfo['unread']))&&($mailboxInfo['unread']>0)){ ?>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $mailboxInfo['unread']; ?> messages</li>
				  
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
						 
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
					
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                    </ul>
                  </li>
                  <li class="footer"><a href="<?php echo base_url()."mail"; ?>">See All Messages</a></li>
                </ul>
				<?php } ?>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-danger">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				 <?php if ((isset($account_details->picture)) && (strlen(trim($account_details->picture))  > 0)) { echo showPhoto($account_details->picture, array('class'=>'user-image')); }else{ echo showPhoto(null,array('class'=>'user-image')); } ?>
                  <span class="hidden-xs"><?php if ((isset($account_details->picture)) && ($account_details->fullname)){ echo $account_details->fullname; }else{ echo $account->username; }  ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                   
					<?php if (isset($account_details->picture) && strlen(trim($account_details->picture)) > 0) { echo showPhoto($account_details->picture, array('class'=>'img-circle')); }else{ echo showPhoto(null,array('class'=>'img-circle')); } ?>
					<p>
                      <?php echo ($account_details->fullname)? $account_details->fullname:$account->username;  ?>
                      <small>Member since <?php echo ($account->createdon)? date_parse($account->createdon)['year']:"";  ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?php echo anchor(base_url().'account/dashboard', lang('website_my_profile'),array('class' => 'btn btn-default btn-flat')); ?>
                    </div>
                    <div class="pull-right">
					  <?php echo anchor(base_url().'account/sign_out', lang('website_sign_out'),array('class' => 'btn btn-default btn-flat')); ?>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
		  <?php } ?>
        </nav>
      </header>