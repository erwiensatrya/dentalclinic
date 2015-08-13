<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
	<title><?php echo lang('website_title'); ?> | <?php echo lang('website_sign_up'); ?></title>
	<!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="register-page">
  
		<?php if (! ($this->config->item("sign_up_enabled"))): ?>
		<div class="alert alert-warning alert-dismissable">
		   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		   <h4><i class="icon fa fa-warning"></i> <?php echo lang('sign_up_notice'); ?> </h4>
		   <?php echo lang('sign_up_registration_disabled'); ?>
		</div>
		<?php endif;?>
		
    <div class="register-box">
      <div class="register-logo">
        <a href="<?php echo base_url(); ?>"><b><?php echo lang('website_title'); ?></b></a>
      </div>

	  <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
	  <?php echo form_fieldset(); ?>
				
      <div class="register-box-body">
        <p class="login-box-msg"><?php echo lang('sign_up_heading'); ?></p>
          <div class="form-group has-feedback <?php echo (form_error('sign_up_username') || isset($sign_up_username_error)) ? 'has-error' : ''; ?>">
            
			<?php if (form_error('sign_up_username') || isset($sign_up_username_error)) : ?>
				<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
				<?php echo form_error('sign_up_username'); ?>
				<?php if (isset($sign_up_username_error)) : ?>
					<span class="field_error"><?php echo $sign_up_username_error; ?></span>
				<?php endif; ?>
				</label>
			<?php endif; ?>
			
			<?php echo form_input(array('class'=>'form-control','placeholder'=> lang('sign_up_username'),'name' => 'sign_up_username', 'id' => 'sign_up_username', 'value' => set_value('sign_up_username'), 'maxlength' => '24')); ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback <?php echo (form_error('sign_up_email') || isset($sign_up_email_error)) ? 'has-error' : ''; ?>">
            
			<?php if (form_error('sign_up_email') || isset($sign_up_email_error)) : ?>
				<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
				<?php echo form_error('sign_up_email'); ?>
				<?php if (isset($sign_up_email_error)) : ?>
					<span class="field_error"><?php echo $sign_up_email_error; ?></span>
				<?php endif; ?>
				</label>
			<?php endif; ?>
							
			<?php echo form_input(array('class'=>'form-control','placeholder'=> lang('sign_up_email'), 'name' => 'sign_up_email', 'id' => 'sign_up_email', 'value' => set_value('sign_up_email'), 'maxlength' => '160')); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback <?php echo (form_error('sign_up_password')) ? 'has-error' : ''; ?>">
           
		   <?php if (form_error('sign_up_password')) : ?>
				<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
				<?php echo form_error('sign_up_password'); ?>
				</label>
			<?php endif; ?>
			
		    <?php echo form_password(array('class'=>'form-control','placeholder'=> lang('sign_up_password'),'name' => 'sign_up_password', 'id' => 'sign_up_password', 'value' => set_value('sign_up_password'))); ?>
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retype password" />
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('sign_up_create_my_account'); ?></button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
		  <?php foreach ($this->config->item('third_party_auth_providers') as $provider) : 
			if($provider == 'google'){ ?>
				<?php echo anchor('account/connect_'.$provider, '<i class="fa fa-'.$provider.'-plus"></i> Sign up using '.$provider, array('class'=>'btn btn-block btn-social btn-flat btn-'.$provider.'-plus', 'title' => sprintf(lang('sign_up_with'), lang('connect_'.$provider)))); ?>
		  <?php	
			}else{
		  ?>
				<?php echo anchor('account/connect_'.$provider, '<i class="fa fa-'.$provider.'"></i> Sign up using '.$provider, array('class'=>'btn btn-block btn-social btn-flat btn-'.$provider, 'title' => sprintf(lang('sign_up_with'), lang('connect_'.$provider)))); ?>
		  <?php }
			 endforeach; ?>
        </div>

        <a href="<?php echo base_url().'account/';?>sign_in" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
	  
	<?php echo form_fieldset_close(); ?>
	<?php echo form_close(); ?>
	
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      jQuery(function () {
        jQuery('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
