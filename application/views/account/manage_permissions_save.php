<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang("permissions_{$action}_page_name"); ?> </title>
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
            <?php echo lang("permissions_{$action}_page_name"); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('admin_panel_title'); ?></li>
            <li class="active"><?php echo lang("permissions_{$action}_page_name"); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            <?php echo lang("permissions_{$action}_description"); ?>
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
                  <h3 class="box-title"><?php echo lang("permissions_{$action}_page_name"); ?></h3>
                </div><!-- /.box-header -->
				
                <!-- form start -->
                  <div class="box-body">
					<div class="form-group <?php  echo (form_error('permission_key')|| isset($permission_key_error)) ? 'has-error' : ''; ?>">
                      <label for="permission_key" class="col-sm-2 control-label"><?php echo lang('permissions_key'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('permission_key')|| isset($permission_key_error))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('permission_key',' ',' ');
							echo isset($permission_key_error) ? $permission_key_error : '';
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('permission_key'),'class'=>'form-control' ,'name' => 'permission_key', 'id' => 'permission_key', 'value' => set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : ''), 'maxlength' => 80)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('permission_description')) ? 'has-error' : ''; ?>">
                      <label for="permission_description" class="col-sm-2 control-label"><?php echo lang('roles_description'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('permission_description'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('permission_description',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_textarea(array('placeholder'=>lang('permission_description'),'class'=>'form-control' ,'name' => 'permission_description', 'id' => 'permission_description', 'value' => set_value('permission_description') ? set_value('permission_description') : (isset($permission->description) ? $permission->description : ''), 'maxlength' =>160)); ?>
	
                      </div>
                    </div>
								 
					 <div class="form-group">
					  <label for="permissions_role" class="col-sm-2 control-label"><?php echo lang('permissions_role'); ?></label>
                      <div class="col-sm-10">
                      <div class="checkbox">                
						  <?php foreach( $roles as $role ) : ?>
						  <?php
							$check_it = FALSE;

							if( isset($role_permissions) )
							{
							  foreach( $role_permissions as $rperm )
							  {
								if( $rperm->id == $role->id )
								{
								  $check_it = TRUE; break;
								}
							  }
							}
						  ?>
						  <label class="checkbox">
							<?php echo form_checkbox("role_permission_{$role->id}", 'apply', $check_it); ?>
							<?php echo $role->name; ?>
						  </label>
						<?php endforeach; ?>
						</div>
					</div>
                   </div>
				   
                  </div><!-- /.box-body -->
                  <div class="box-footer">		
						<?php echo form_submit('manage_permission_submit', lang('settings_save'), 'class="btn btn-primary"'); ?>
						<?php echo anchor('account/manage_permissions', lang('website_cancel'), 'class="btn btn-default"'); ?>

						<?php if( $this->authorization->is_permitted('delete_permissions') && $action == 'update' && ! $is_system ): ?>
						  <span><?php echo lang('admin_or');?></span>
						  <?php if( isset($permission->suspendedon) ): ?>
							<?php echo form_submit('manage_permission_unban', lang('permissions_unban'), 'class="btn btn-danger"'); ?>
						  <?php else: ?>
							<?php echo form_submit('manage_permission_ban', lang('permissions_ban'), 'class="btn btn-danger"'); ?>
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
