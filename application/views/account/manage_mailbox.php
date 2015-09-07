<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang("admin_panel_manage_mailbox"); ?> </title>
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
            <?php echo lang("mailbox_page_name"); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('admin_panel_title'); ?></li>
            <li class="active"><?php echo lang("mailbox_page_name"); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            <?php echo lang("mailbox_description"); ?>
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
                  <h3 class="box-title"><?php echo lang("admin_panel_manage_mailbox"); ?></h3>
                </div><!-- /.box-header -->
				
                <!-- form start -->
                  <div class="box-body">
					<div class="form-group <?php  echo (form_error('mailbox_name')) ? 'has-error' : ''; ?>">
                      <label for="mailbox_name" class="col-sm-2 control-label"><?php echo lang('mailbox_name'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('mailbox_name'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('mailbox_name',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('mailbox_name'),'class'=>'form-control' ,'name' => 'mailbox_name', 'id' => 'mailbox_name', 'value' => set_value('mailbox_name') ? set_value('mailbox_name') : (isset($mailbox->name) ? $mailbox->name : ''), 'maxlength' => 160)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('mailbox_email')) ? 'has-error' : ''; ?>">
                      <label for="mailbox_email" class="col-sm-2 control-label"><?php echo lang('mailbox_email'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('mailbox_email'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('mailbox_email',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('mailbox_email'),'class'=>'form-control' ,'name' => 'mailbox_email', 'id' => 'mailbox_email', 'value' => set_value('mailbox_email') ? set_value('mailbox_email') : (isset($mailbox->email) ? $mailbox->email : ''), 'maxlength' => 160)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('mailbox_password')) ? 'has-error' : ''; ?>">
                      <label for="mailbox_password" class="col-sm-2 control-label"><?php echo lang('mailbox_password'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('mailbox_password'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('mailbox_password',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_password(array('placeholder'=>lang('mailbox_password'),'class'=>'form-control' ,'name' => 'mailbox_password', 'id' => 'mailbox_password', 'value' => set_value('mailbox_password') ? set_value('mailbox_password') : (isset($mailbox->password) ? $mailbox->password : ''), 'maxlength' => 160)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('mailbox_mail_server')) ? 'has-error' : ''; ?>">
                      <label for="mailbox_mail_server" class="col-sm-2 control-label"><?php echo lang('mailbox_mail_server'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('mailbox_mail_server'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('mailbox_mail_server',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('mailbox_mail_server'),'class'=>'form-control' ,'name' => 'mailbox_mail_server', 'id' => 'mailbox_mail_server', 'value' => set_value('mailbox_mail_server') ? set_value('mailbox_mail_server') : (isset($mailbox->mail_server) ? $mailbox->mail_server : ''), 'maxlength' => 160)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('mailbox_mailbox')) ? 'has-error' : ''; ?>">
                      <label for="mailbox_mailbox" class="col-sm-2 control-label"><?php echo lang('mailbox_mailbox'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('mailbox_mailbox'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('mailbox_mailbox',' ',' ');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('mailbox_mailbox'),'class'=>'form-control' ,'name' => 'mailbox_mailbox', 'id' => 'mailbox_mailbox', 'value' => set_value('mailbox_mailbox') ? set_value('mailbox_mailbox') : (isset($mailbox->mailbox) ? $mailbox->mailbox : ''), 'maxlength' => 80)); ?>
	
                      </div>
                    </div>
					
					
					<div class="form-group">
					<label class="col-sm-2 control-label"></label>
                      <div class="col-sm-10">
						<a class="btn btn-default" onclick="test_connection()">
							<i style="display:none;" id="test_connection_btn_load" class="fa fa-refresh fa-spin"></i><i id="test_connection_btn" class="fa fa-exchange" ></i>&nbsp;&nbsp;&nbsp;<?php echo lang('mailbox_test_connection'); ?>
						
						</a>
						
						<div class="overlay">
						  
						</div>
				
                      </div>
                    </div>
													 			   
                  </div><!-- /.box-body -->
                  <div class="box-footer">		
						<?php echo form_submit('manage_role_submit', lang('settings_save'), 'class="btn btn-primary"'); ?>
						<?php echo anchor('account/manage_mailbox', lang('website_cancel'), 'class="btn btn-default"'); ?>				  
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
	<script type="text/javascript">
		
		function test_connection(){
			var decoded = encodeURIComponent($('#mailbox_mail_server').val());
			decoded = decoded+";"+encodeURIComponent($('#mailbox_mailbox').val());
			decoded = decoded+";"+encodeURIComponent($('#mailbox_email').val());
			decoded = decoded+";"+encodeURIComponent($('#mailbox_password').val());
			
			$('#test_connection_btn').hide();
			$('#test_connection_btn_load').show();
			
			$.getJSON("<?php echo base_url()."account/manage_mailbox/testConnection/?query="; ?>"+decoded,function(data) {
				if(data.error !== ''){
					alert(data.status+"\n"+data.error);
				}else{
					alert(data.status);
				}
				$('#test_connection_btn').show();
				$('#test_connection_btn_load').hide();
			}).fail(function(jqXHR, status, error){
				if(status == 'parseerror'){
					//not valid json
					alert('Connection Error, Invalid json');
				} else {
					alert('Connection Error');
				}
				$('#test_connection_btn').show();
				$('#test_connection_btn_load').hide();
			});
		}
	</script>
  </body>
</html>
