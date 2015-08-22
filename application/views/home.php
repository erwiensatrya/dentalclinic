<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?></title>
   <?php echo $this->load->view('head'); ?>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="#" class="navbar-brand"><i class="flaticon-tooth19"></i> <b><?php echo lang('website_title'); ?></b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" id="navbar-search-input" placeholder="Search" />
                </div>
              </form>
            </div><!-- /.navbar-collapse -->
			
			 <?php if ($this->authentication->is_signed_in()) { ?>
			 
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-envelope-o"></i>
                      <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 4 messages</li>
                      <li>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                          <li><!-- start message -->
                            <a href="#">
                              <div class="pull-left">
                                <!-- User Image -->
                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                              </div>
                              <!-- Message title and timestamp -->
                              <h4>
                                Support Team
                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                              </h4>
                              <!-- The message -->
                              <p>Why not buy a new awesome theme?</p>
                            </a>
                          </li><!-- end message -->
                        </ul><!-- /.menu -->
                      </li>
                      <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                  </li><!-- /.messages-menu -->

                  <!-- Notifications Menu -->
                  <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 10 notifications</li>
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                          <li><!-- start notification -->
                            <a href="#">
                              <i class="fa fa-users text-aqua"></i> 5 new members joined today
                            </a>
                          </li><!-- end notification -->
                        </ul>
                      </li>
                      <li class="footer"><a href="#">View all</a></li>
                    </ul>
                  </li>
                  <!-- Tasks Menu -->
                  <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-flag-o"></i>
                      <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">You have 9 tasks</li>
                      <li>
                        <!-- Inner menu: contains the tasks -->
                        <ul class="menu">
                          <li><!-- Task item -->
                            <a href="#">
                              <!-- Task title and progress text -->
                              <h3>
                                Design some buttons
                                <small class="pull-right">20%</small>
                              </h3>
                              <!-- The progress bar -->
                              <div class="progress xs">
                                <!-- Change the css width attribute to simulate progress -->
                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                  <span class="sr-only">20% Complete</span>
                                </div>
                              </div>
                            </a>
                          </li><!-- end task item -->
                        </ul>
                      </li>
                      <li class="footer">
                        <a href="#">View all tasks</a>
                      </li>
                    </ul>
                  </li>
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <?php if ((isset($account_details->picture)) && (strlen(trim($account_details->picture))  > 0)) { echo showPhoto($account_details->picture, array('class'=>'user-image')); }else{ echo showPhoto(null,array('class'=>'user-image')); } ?>
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                       <span class="hidden-xs"><?php if ((isset($account_details->picture)) && ($account_details->fullname)){ echo $account_details->fullname; }else{ echo $account->username; }  ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                     <li class="user-header">
                   
					<?php if (isset($account_details->picture) && strlen(trim($account_details->picture)) > 0) { echo showPhoto($account_details->picture, array('class'=>'img-circle')); }else{ echo showPhoto(null,array('class'=>'img-circle')); } ?>
					<p>
                      <?php echo ($account_details->fullname)? $account_details->fullname:$account->username;  ?>
                      <small>Member since <?php echo ($account->createdon)? date_parse($account->createdon)['year']:"";  ?></small>
                    </p>
                  </li>
                      <!-- Menu Body -->
                      <li class="user-body">
                        <div class="col-xs-4 text-center">
                          <a href="#">Followers</a>
                        </div>
                        <div class="col-xs-4 text-center">
                          <a href="#">Sales</a>
                        </div>
                        <div class="col-xs-4 text-center">
                          <a href="#">Friends</a>
                        </div>
                      </li>
                      <!-- Menu Footer-->
                     <li class="user-footer">
                    <div class="pull-left">
                      <?php echo anchor('dashboard', lang('website_my_profile'),array('class' => 'btn btn-default btn-flat')); ?>
                    </div>
                    <div class="pull-right">
					  <?php echo anchor('account/sign_out', lang('website_sign_out'),array('class' => 'btn btn-default btn-flat')); ?>
                    </div>
                  </li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
			  <?php }else{ ?>
			   <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <li class="dropdown messages-menu">
                    <!-- Menu toggle button -->
                    <a target="_self" href="<?php echo base_url()."account/sign_in";?>">
                      <i class="fa fa-user"></i> <?php echo lang('website_sign_in'); ?>
                    </a>
					</li>
					</ul>
					</div>
			  <?php } ?>
          </div><!-- /.container-fluid -->
        </nav>
      </header>
	  
      <!-- Full Width Column -->
      <div class="content-wrapper" style="background-image:url('<?php echo base_url().RES_DIR.'/img/2.jpg'; ?>');">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content">
		 
		  
		  <!-- START CAROUSEL-->
                    
		  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width:900px;margin:auto;">
			<ol class="carousel-indicators">
			  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
			  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
			</ol>
			<div class="carousel-inner">
			  <div class="item active">
				<img width="900" height="500" src="<?php echo base_url().RES_DIR.'/img/colgate-toothpaste-commercial-lollypop.jpg'; ?>" alt="lolypop">
				<div class="carousel-caption">
				  First Slide
				</div>
			  </div>
			  <div class="item">
				<img height="500" src="<?php echo base_url().RES_DIR.'/img/colgate-toothpaste-commercial-cottoncandy.jpg'; ?>" alt="cotton candy">
				<div class="carousel-caption">
				  Second Slide
				</div>
			  </div>
			  <div class="item">
				<img height="500" src="<?php echo base_url().RES_DIR.'/img/colgate-toothpaste-commercial-icecream.jpg'; ?>" alt="ice cream">
				<div class="carousel-caption">
				  Third Slide
				</div>
			  </div>
			</div>
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
			  <span class="fa fa-angle-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
			  <span class="fa fa-angle-right"></span>
			</a>
		  </div>
          </section>    
          <!-- Main content -->
          <section class="content text-center">
            <div class="alert alert-success alert-dismissable">
			  Dont forget to brush your teeth and visit us every six month<br/>
               Smile and the world will smile with you!
          </section><!-- /.content -->  
		  
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     <?php echo $this->load->view('footer'); ?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
