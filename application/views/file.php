<!DOCTYPE html>
<html>
  <head>
   <title><?php echo lang('website_title'); ?> | <?php echo lang('file_title'); ?> </title>
  <?php echo $this->load->view('head'); ?>
  <!-- Theme style -->
  <!-- jQuery and jQuery UI (REQUIRED) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/elfinder/js/jquery-ui.css">
	<script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/elfinder/js/jquery.min.js"></script>
	<script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/jQueryUI/jquery-ui.min.js"></script>
	
	
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/elfinder/js/elfinder.full.js"></script>

	<!-- Mac OS X Finder style for jQuery UI smoothness theme (OPTIONAL) -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/elfinder/css/elfinder.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/elfinder/css/theme.css">
   
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
		<div class="row">
		<div class="col-md-12">
		<script type="text/javascript" charset="utf-8">
			$().ready(function() {
				var elf = $('#elfinder').elfinder({
					// lang: 'ru',             // language (OPTIONAL)
					url : '<?php echo base_url().'file/elfinder_init/'.$account->id; ?>' // connector URL (REQUIRED)
				}).elfinder('instance');            
			});
		</script>

		<div class="box box-info">
			  <div class="box-header with-border">
              </div><!-- /.box-header -->
                <div class="box-body text-center">
					
					<!-- Element where elFinder will be created (REQUIRED) -->
					<div id="elfinder"></div>		
				
                </div><!-- /.box-body -->
              </div>
			  
		</div>
		</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php echo $this->load->view('footer'); ?>
	  
    </div><!-- ./wrapper -->
	 <?php //echo $this->load->view('footer_js'); ?>
	 <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
	  <!-- AdminLTE App -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/dist/js/app.min.js" type="text/javascript"></script>
	  <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/dist/js/demo.js" type="text/javascript"></script>
	 
  </body>
</html>
