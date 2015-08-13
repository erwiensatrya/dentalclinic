<!DOCTYPE html>
<html>
  <head>
   <title><?php echo lang('website_title'); ?> | <?php echo lang('file_title'); ?> </title>
  <?php echo $this->load->view('head'); ?>
	
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
	
	<?php echo $this->load->view('header'); ?>
	<!-- Left side column. contains the logo and sidebar -->
	<?php echo $this->load->view('aside_l'); ?>
	<!-- /.sidebar -->
	
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo lang('file_title'); ?>
            <small><?php echo lang('file_management'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo lang('file_title'); ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php echo $this->load->view('footer'); ?>
	  
    </div><!-- ./wrapper -->
    <?php echo $this->load->view('footer_js'); ?>
  </body>
</html>
