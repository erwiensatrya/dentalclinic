<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang("users_{$action}_page_name"); ?> </title>
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
            <?php echo lang("users_{$action}_page_name"); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('admin_panel_title'); ?></li>
            <li class="active"><?php echo lang("users_{$action}_page_name"); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            <?php echo lang("users_{$action}_description"); ?>
          </div>
        </div>
		
		<?php if (isset($settings_info)) {	?>
		 <div class="pad margin no-print alert alert-success fade in">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $settings_info; ?>
		</div>
		<?php } ?>
	
        <!-- Main content -->
        <section class="content">
          
           <!-- Horizontal Form -->
		   
		   <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
		   
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo lang("users_{$action}_page_name"); ?></h3>
                </div><!-- /.box-header -->
				
                <!-- form start -->
                  <div class="box-body">
					<div class="form-group <?php  echo (form_error('users_username')|| isset($users_username_error)) ? 'has-error' : ''; ?>">
                      <label for="users_username" class="col-sm-2 control-label"><?php echo lang('profile_username'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('users_username')|| isset($users_username_error))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('users_username');
							echo isset($users_username_error) ? $users_username_error : '';
						?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('users_username'),'class'=>'form-control' ,'name' => 'users_username', 'id' => 'users_username', 'value' => set_value('users_username') ? set_value('users_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160)); ?>
	
                      </div>
                    </div>
                    <div class="form-group <?php  echo (form_error('users_email') || isset($settings_email_error)) ? 'has-error' : ''; ?>">
                      <label for="users_email" class="col-sm-2 control-label"><?php echo lang('settings_email'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('users_email') || isset($settings_email_error))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('users_email');
							echo isset($settings_email_error) ? $settings_email_error : '';
							?>
						</label>
						<?php } ?>
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<?php echo form_input(array('placeholder'=>lang('users_email'),'class'=>'form-control' ,'name' => 'users_email', 'id' => 'users_email', 'value' => set_value('users_email') ? set_value('users_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>
						</div>
	
                      </div>
                    </div> 
					<div class="form-group <?php  echo (form_error('users_fullname')) ? 'has-error' : ''; ?>">
                      <label for="users_fullname" class="col-sm-2 control-label"><?php echo lang('settings_fullname'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('users_fullname'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('users_fullname');
						?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('users_fullname'),'class'=>'form-control' ,'name' => 'users_fullname', 'id' => 'users_fullname', 'value' => set_value('users_fullname') ? set_value('users_fullname') : (isset($update_account_details->fullname) ? $update_account_details->fullname : ''), 'maxlength' => 160)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('users_firstname')) ? 'has-error' : ''; ?>">
                      <label for="users_firstname" class="col-sm-2 control-label"><?php echo lang('settings_firstname'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('users_firstname'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('users_firstname');
						?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('users_firstname'),'class'=>'form-control' ,'name' => 'users_firstname', 'id' => 'users_firstname', 'value' => set_value('users_firstname') ? set_value('users_firstname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('users_lastname')) ? 'has-error' : ''; ?>">
                      <label for="users_lastname" class="col-sm-2 control-label"><?php echo lang('settings_lastname'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('users_lastname'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('users_lastname');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('users_lastname'),'class'=>'form-control' ,'name' => 'users_lastname', 'id' => 'users_lastname', 'value' => set_value('users_lastname') ? set_value('users_lastname') : (isset($update_account_details->lastname) ? $update_account_details->lastname : ''), 'maxlength' => 80)); ?>
	
                      </div>
                    </div>
								 
					 <div class="form-group">
					  <label for="settings_fullname" class="col-sm-2 control-label"><?php echo lang('users_roles'); ?></label>
                      <div class="col-sm-10">
                      <div class="checkbox">                
						  <?php foreach($roles as $role) : ?>
							<?php 
							$check_it = FALSE;
							
							if( isset($update_account_roles) ) 
							{
							  foreach($update_account_roles as $acrole) 
							  {
								if($role->id == $acrole->id)
								{
								  $check_it = TRUE; break;
								}
							  }
							}
							?>
							<label class="checkbox">
							  <?php echo form_checkbox("account_role_{$role->id}", 'apply', $check_it); ?>
							  <?php echo $role->name; ?>
							</label>
						  <?php endforeach; ?>
						</div>
					</div>
                   </div>
				   
                  </div><!-- /.box-body -->
                  <div class="box-footer">
						<?php echo form_submit('manage_user_submit', lang('settings_save'), 'class="btn btn-primary"'); ?>
						<?php echo anchor('account/manage_users', lang('website_cancel'), 'class="btn btn-default"'); ?>
						<?php if( $this->authorization->is_permitted('ban_users') && $action == 'update' ): ?>
						  <span><?php echo lang('admin_or');?></span>
						  <?php if( isset($update_account->suspendedon) ): ?>
							<?php echo form_submit('manage_user_unban', lang('users_unban'), 'class="btn btn-danger"'); ?>
						  <?php else: ?>
							<?php echo form_submit('manage_user_ban', lang('users_ban'), 'class="btn btn-danger"'); ?>
						  <?php endif; ?>
						<?php endif; ?>
					  
                  </div><!-- /.box-footer -->
              </div><!-- /.box -->

			<?php echo form_close(); ?>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php echo $this->load->view('footer'); ?>
      <?php echo $this->load->view('aside_r'); ?>

      
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <?php echo $this->load->view('footer_js'); ?>
	
  </body>
</html>
