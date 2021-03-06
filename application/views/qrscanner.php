<!DOCTYPE html>
<html>
  <head>
   <title><?php echo lang('website_title'); ?> | <?php echo lang('qrscanner_title'); ?> </title>
   <?php echo $this->load->view('head'); ?>
 
	<!-- jQuery 2.1.4 -->
	<script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/qrcode/llqrcode.js" type="text/javascript"></script>
	<script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/qrcode/script.js" type="text/javascript"></script>
	<script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/qrcode/qrcode.js" type="text/javascript"></script>
	
  </head>
  <body class="skin-blue sidebar-mini" onload="load()">
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
            <?php echo lang('qrscanner_title'); ?>
            <small><?php //echo lang('file_management'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo lang('qrscanner_title'); ?></li>
          </ol>
        </section>

		<div class="pad margin no-print" id="erroralert" style="display:none;">
          <div class="alert alert-danger alert-dismissable" style="margin-bottom: 0!important;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i> Alert!</h4>
			<p id="mainbody"></p>
		</div>
		</div>
		
        <!-- Main content -->
        <section class="content">
  	  
		  <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- TABLE: Personal Details -->
              <div class="box box-info">
			  <div class="box-header with-border text-center">
                <span class="btn btn-app" id="webcamimg" onclick="setwebcam()"><i class="fa fa-video-camera"></i> scan from camera </span>
				<span class="btn btn-app hidden" id="qrimg" onclick="setimg()"><i class="fa fa-image"></i> scan from image </span>
                </div><!-- /.box-header -->
                <div class="box-body text-center">
				<div id="outdiv">
				<p class="helptext2">select webcam or image scanning</p>
				</div>
				<canvas id="qr-canvas" style="width: 800px; height: 600px; display:none;" width="800" height="600"></canvas>
				<div id="result"></div>
				
				
				
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div>
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php echo $this->load->view('footer'); ?>
	 
    </div><!-- ./wrapper -->
    <?php echo $this->load->view('footer_js'); ?>
	 <script type="text/javascript">
		$(document).ready(function() { setwebcam(); });
	  </script>
  </body>
</html>
