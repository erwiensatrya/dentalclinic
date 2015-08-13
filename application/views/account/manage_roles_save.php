<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang("roles_{$action}_page_name"); ?> </title>
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
            <?php echo lang("roles_{$action}_page_name"); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('admin_panel_title'); ?></li>
            <li class="active"><?php echo lang("roles_{$action}_page_name"); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            <?php echo lang("roles_{$action}_description"); ?>
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
                  <h3 class="box-title"><?php echo lang("roles_{$action}_page_name"); ?></h3>
                </div><!-- /.box-header -->
				
                <!-- form start -->
                  <div class="box-body">
					<div class="form-group <?php  echo (form_error('role_name')|| isset($role_name_error)) ? 'has-error' : ''; ?>">
                      <label for="role_name" class="col-sm-2 control-label"><?php echo lang('roles_name'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('role_name')|| isset($role_name_error))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('role_name');
							echo isset($role_name_error) ? $role_name_error : '';
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('role_name'),'class'=>'form-control' ,'name' => 'role_name', 'id' => 'role_name', 'value' => set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : ''), 'maxlength' => 80)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('role_description')) ? 'has-error' : ''; ?>">
                      <label for="role_description" class="col-sm-2 control-label"><?php echo lang('roles_description'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('role_description'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('role_description');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_textarea(array('placeholder'=>lang('role_description'),'class'=>'form-control' ,'name' => 'role_description', 'id' => 'role_description', 'value' => set_value('role_description') ? set_value('role_description') : (isset($role->description) ? $role->description : ''), 'maxlength' =>160)); ?>
	
                      </div>
                    </div>
								 
					 <div class="form-group">
					  <label for="settings_fullname" class="col-sm-2 control-label"><?php echo lang('roles_permission'); ?></label>
                      <div class="col-sm-10">
                      <div class="checkbox">                
						  <?php foreach( $permissions as $perm ) : ?>
						  <?php
							$check_it = FALSE;

							if( isset($role_permissions) )
							{
							  foreach( $role_permissions as $rperm )
							  {
								if( $rperm->id == $perm->id )
								{
								  $check_it = TRUE; break;
								}
							  }
							}
						  ?>
						  <label class="checkbox">
							<?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it); ?>
							<?php echo $perm->key; ?>
						  </label>
						<?php endforeach; ?>
						</div>
					</div>
                   </div>
				   
                  </div><!-- /.box-body -->
                  <div class="box-footer">		
						<?php echo form_submit('manage_role_submit', lang('settings_save'), 'class="btn btn-primary"'); ?>
						<?php echo anchor('account/manage_roles', lang('website_cancel'), 'class="btn btn-default"'); ?>
						<?php if( $this->authorization->is_permitted('delete_roles') && $action == 'update' && ! $is_system ): ?>
						  <span><?php echo lang('admin_or');?></span>
						  <?php if( isset($role->suspendedon) ): ?>
							<?php echo form_submit('manage_role_unban', lang('roles_unban'), 'class="btn btn-danger"'); ?>
						  <?php else: ?>
							<?php echo form_submit('manage_role_ban', lang('roles_ban'), 'class="btn btn-danger"'); ?>
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
