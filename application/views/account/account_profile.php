<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang('profile_page_name'); ?> </title>
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
            <?php echo lang('profile_page_name'); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('account_info_title'); ?></li>
            <li class="active"><?php echo lang('profile_page_name'); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            <?php echo lang('profile_instructions'); ?>
          </div>
        </div>
		
		<?php if (isset($profile_info))	{?>
            <div class="pad margin no-print alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $profile_info; ?>
            </div>
		<?php } ?>
			
        <!-- Main content -->
        <section class="content">
          
           <!-- Horizontal Form -->
		   
		   <?php echo form_open_multipart(uri_string(), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>
		   
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo lang('profile_page_name'); ?></h3>
                </div><!-- /.box-header -->
				
                <!-- form start -->
                  <div class="box-body">
                    <div class="form-group <?php echo ((form_error('profile_username')) || (isset($profile_username_error))) ? 'has-error' : ''; ?>">
                      <label for="username" class="col-sm-2 control-label"><?php echo lang('profile_username'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('profile_username') || isset($profile_username_error))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('profile_username',' ',' ');
							echo isset($profile_username_error) ? $profile_username_error : '';
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('profile_username'),'class'=>'form-control' ,'name' => 'profile_username', 'id' => 'profile_username', 'value' => set_value('profile_username') ? set_value('profile_username') : (isset($account->username) ? $account->username : ''), 'maxlength' => '24')); ?>
												
                      </div>
                    </div>
                    <div class="form-group <?php echo (form_error('profile_picture_error')) ? 'has-error' : ''; ?>">
                      <label for="inputPassword3" class="col-sm-2 control-label"><?php echo lang('profile_picture'); ?></label>
                      <div class="col-sm-10">
                       	<?php if (isset($profile_picture_error))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php echo $profile_picture_error; ?>
						</label>
						<?php } ?>
							
						<?php if (isset($account_details->picture) && strlen(trim($account_details->picture)) > 0) : ?>
						<?php echo showPhoto($account_details->picture, array('class'=>'img-circle')); ?> &nbsp;
						<?php echo anchor('account/account_profile/index/delete', '<i class="icon-trash"></i> '.lang('profile_delete_picture'), 'class="btn"'); ?>
						<?php else : ?>
							
							<div class="accountPicSelect clearfix">
								<div class="pull-left">
									<input type="radio" name="pic_selection" value="custom" checked="true" />
									<?php echo showPhoto(null,array('class'=>'img-circle')); ?>
								</div>
								<div class="pull-left">
									<p><?php echo lang('profile_custom_upload_picture'); ?><br>
										<?php echo form_upload(array('name' => 'account_picture_upload', 'id' => 'account_picture_upload')); ?><br>
										<p class="help-block">(<?php echo lang('profile_picture_guidelines'); ?>)</p>
									</p>
								</div>
							</div>

							<div class="accountPicSelect clearfix">
								<div class="pull-left">
									<input type="radio" name="pic_selection" value="gravatar" />
									<?php echo showPhoto( $gravatar , array('class'=>'img-circle')); ?>
								</div>
								<div class="pull-left">
									<p>
										<p class="help-block"><a href="http://gravatar.com/" target="_blank">Gravatar</a></p>
									</p>
								</div>
							</div>
						
						<?php endif; ?>
						
						<?php if ( ! isset($account_details->picture)) : ?>
							<?php endif; ?>

                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn btn-primary"><?php echo lang('profile_save'); ?></button>
                  </div><!-- /.box-footer -->
              </div><!-- /.box -->

			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php echo $this->load->view('footer'); ?>
      <?php echo $this->load->view('aside_r'); ?>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <?php echo $this->load->view('footer_js'); ?>
	
  </body>
</html>
