<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
    <title><?php echo lang('website_title'); ?> | <?php echo lang('website_sign_in'); ?></title>
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
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url(); ?>"><?php echo lang('website_title'); ?> <b><?php echo lang('website_sign_in'); ?></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
       
		<?php echo form_open(uri_string().($this->input->get('continue') ? '/?continue='.urlencode($this->input->get('continue')) : ''), 'class="form-horizontal"'); ?>
		<?php echo form_fieldset(); ?>
			
		<?php if (isset($sign_in_error)) : ?>
           	<div class="form_error"><?php echo $sign_in_error; ?></div>
		<?php endif; ?>
				
          <div class="form-group has-feedback <?php echo (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) ? 'has-error' : ''; ?>">
            <?php if (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) :?>
				<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
				<?php echo form_error('sign_in_username_email'); ?>
				<?php if (isset($sign_in_username_email_error)) : ?>
					<span class="field_error"><?php echo $sign_in_username_email_error; ?></span>
				<?php endif; ?>
				</label>
			<?php endif; ?>
			<?php echo form_input(array('class'=>'form-control','placeholder'=> lang('sign_in_username_email'),'name' => 'sign_in_username_email', 'id' => 'sign_in_username_email', 'value' => set_value('sign_in_username_email'), 'maxlength' => '24')); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback <?php echo form_error('sign_in_password') ? 'has-error' : ''; ?>">
			<?php if (form_error('sign_in_password')) : ?>
				<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i><?php echo form_error('sign_in_password'); ?></label>
			<?php endif; ?>
			<?php echo form_password(array('class'=>'form-control','placeholder'=> lang('sign_in_password'),'name' => 'sign_in_password', 'id' => 'sign_in_password', 'value' => set_value('sign_in_password'))); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  
		  <?php if (isset($recaptcha)) : ?>
		  <div class="form-group">
			<?php echo $recaptcha; ?>
			<?php if (isset($sign_in_recaptcha_error)) : ?>
				<span class="field_error"><?php echo $sign_in_recaptcha_error; ?></span>
			<?php endif; ?>
		  </div>
		  <?php endif; ?>
		  
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
				<?php echo form_checkbox(array('name' => 'sign_in_remember', 'id' => 'sign_in_remember', 'value' => 'checked', 'checked' => $this->input->post('sign_in_remember'),)); ?>
				<?php echo lang('sign_in_remember_me'); ?>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('sign_in_sign_in'); ?></button>
            </div><!-- /.col -->
          </div>
		  
        <?php echo form_fieldset_close(); ?>
		<?php echo form_close(); ?>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
		  <?php foreach ($this->config->item('third_party_auth_providers') as $provider) : 
			if($provider == 'google'){ ?>
				<?php echo anchor('account/connect_'.$provider, '<i class="fa fa-'.$provider.'-plus"></i> Sign in using '.$provider, array('class'=>'btn btn-block btn-social btn-flat btn-'.$provider.'-plus', 'title' => sprintf(lang('sign_in_with'), lang('connect_'.$provider)))); ?>
		  <?php	
			}else{
		  ?>
				<?php echo anchor('account/connect_'.$provider, '<i class="fa fa-'.$provider.'"></i> Sign in using '.$provider, array('class'=>'btn btn-block btn-social btn-flat btn-'.$provider, 'title' => sprintf(lang('sign_in_with'), lang('connect_'.$provider)))); ?>
		  <?php }
			 endforeach; ?>
        </div><!-- /.social-auth-links -->
		<?php echo anchor('account/forgot_password', lang('sign_in_forgot_your_password')); ?><br>
		<?php echo anchor('account/sign_up', lang('sign_in_dont_have_account')); ?>
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
	
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
