<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang('password_page_name'); ?> </title>
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
            <?php echo lang('password_page_name'); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('account_info_title'); ?></li>
            <li class="active"><?php echo lang('password_page_name'); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            <?php echo lang('password_safe_guard_your_account'); ?>
          </div>
        </div>
				
		<?php if ($this->session->flashdata('password_info')) : ?>
            <div class="pad margin no-print alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('password_info'); ?>
            </div>
		<?php endif; ?>
			
        <!-- Main content -->
        <section class="content">
          
           <!-- Horizontal Form -->
		   
		   <?php echo form_open_multipart(uri_string(), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>
		   
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo lang('password_page_name'); ?></h3>
                </div><!-- /.box-header -->
				
                <!-- form start -->
                  <div class="box-body">
                    <div class="form-group <?php echo (form_error('password_new_password')) ? 'has-error' : ''; ?>">
                      <label for="password_new_password" class="col-sm-2 control-label"><?php echo lang('password_new_password'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('password_new_password'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('password_new_password',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_password(array('placeholder'=>lang('password_new_password'),'class'=>'form-control' ,'name' => 'password_new_password', 'id' => 'password_new_password', 'value' => set_value('password_new_password'), 'autocomplete' => 'off')); ?>
												
                      </div>
                    </div>
					<div class="form-group <?php echo (form_error('password_retype_new_password')) ? 'has-error' : ''; ?>">
                      <label for="password_retype_new_password" class="col-sm-2 control-label"><?php echo lang('password_retype_new_password'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('password_retype_new_password'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('password_retype_new_password',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_password(array('placeholder'=>lang('password_retype_new_password'),'class'=>'form-control' ,'name' => 'password_retype_new_password', 'id' => 'password_retype_new_password', 'value' => set_value('password_retype_new_password'), 'autocomplete' => 'off')); ?>
												
                      </div>
                    </div>
                    
                   
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn btn-primary"><?php echo lang('password_change_my_password'); ?></button>
                  </div><!-- /.box-footer -->
              </div><!-- /.box -->

			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php echo $this->load->view('footer'); ?>
      <?php echo $this->load->view('aside_r'); ?>

      <!-- Control Sidebar -->
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <?php echo $this->load->view('footer_js'); ?>
	
  </body>
</html>
