<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang('settings_page_name'); ?> </title>
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
            <?php echo lang('settings_page_name'); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('account_info_title'); ?></li>
            <li class="active"><?php echo lang('settings_page_name'); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            <?php echo sprintf(lang('settings_privacy_statement'), anchor('page/privacy-policy', lang('settings_privacy_policy'))); ?>
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
                  <h3 class="box-title"><?php echo lang('settings_page_name'); ?></h3>
                </div><!-- /.box-header -->
				
                <!-- form start -->
                  <div class="box-body">
                    <div class="form-group <?php  echo (form_error('settings_email') || isset($settings_email_error)) ? 'has-error' : ''; ?>">
                      <label for="settings_email" class="col-sm-2 control-label"><?php echo lang('settings_email'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('settings_email') || isset($settings_email_error))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('settings_email');
							echo isset($settings_email_error) ? $settings_email_error : '';
							?>
						</label>
						<?php } ?>
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<?php echo form_input(array('placeholder'=>lang('settings_email'),'class'=>'form-control' ,'name' => 'settings_email', 'id' => 'settings_email', 'value' => set_value('settings_email') ? set_value('settings_email') : (isset($account->email) ? $account->email : ''), 'maxlength' => 160)); ?>
						</div>
	
                      </div>
                    </div> 
					<div class="form-group <?php  echo (form_error('settings_fullname')) ? 'has-error' : ''; ?>">
                      <label for="settings_fullname" class="col-sm-2 control-label"><?php echo lang('settings_fullname'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('settings_fullname'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('settings_fullname');
						?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('settings_fullname'),'class'=>'form-control' ,'name' => 'settings_fullname', 'id' => 'settings_fullname', 'value' => set_value('settings_fullname') ? set_value('settings_fullname') : (isset($account_details->fullname) ? $account_details->fullname : ''), 'maxlength' => 160)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('settings_firstname')) ? 'has-error' : ''; ?>">
                      <label for="settings_firstname" class="col-sm-2 control-label"><?php echo lang('settings_firstname'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('settings_firstname'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('settings_firstname');
						?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('settings_firstname'),'class'=>'form-control' ,'name' => 'settings_firstname', 'id' => 'settings_firstname', 'value' => set_value('settings_firstname') ? set_value('settings_firstname') : (isset($account_details->firstname) ? $account_details->firstname : ''), 'maxlength' => 80)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php  echo (form_error('settings_lastname')) ? 'has-error' : ''; ?>">
                      <label for="settings_lastname" class="col-sm-2 control-label"><?php echo lang('settings_lastname'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('settings_lastname'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('settings_lastname');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('settings_lastname'),'class'=>'form-control' ,'name' => 'settings_lastname', 'id' => 'settings_lastname', 'value' => set_value('settings_lastname') ? set_value('settings_lastname') : (isset($account_details->lastname) ? $account_details->lastname : ''), 'maxlength' => 80)); ?>
	
                      </div>
                    </div>
					<div class="form-group <?php echo isset($settings_dob_error) ? 'has-error' : ''; ?>">
                      <label for="settings_dateofbirth" class="col-sm-2 control-label"><?php echo lang('settings_dateofbirth'); ?></label>
                      <div class="col-sm-10">
					  
						<?php if (isset($settings_dob_error)) {	?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
							<?php echo $settings_dob_error; ?>
						</label>
						<?php } ?>
						
						<div class="row">
						<div class="col-xs-3">
						<?php $m = $this->input->post('settings_dob_month') ? $this->input->post('settings_dob_month') : (isset($account_details->dob_month) ? $account_details->dob_month : ''); ?>
						<select name="settings_dob_month" class="form-control">
							<option value=""><?php echo lang('dateofbirth_month'); ?></option>
							<option value="1"<?php if ($m == 1) echo ' selected="selected"'; ?>><?php echo lang('month_jan'); ?></option>
							<option value="2"<?php if ($m == 2) echo ' selected="selected"'; ?>><?php echo lang('month_feb'); ?></option>
							<option value="3"<?php if ($m == 3) echo ' selected="selected"'; ?>><?php echo lang('month_mar'); ?></option>
							<option value="4"<?php if ($m == 4) echo ' selected="selected"'; ?>><?php echo lang('month_apr'); ?></option>
							<option value="5"<?php if ($m == 5) echo ' selected="selected"'; ?>><?php echo lang('month_may'); ?></option>
							<option value="6"<?php if ($m == 6) echo ' selected="selected"'; ?>><?php echo lang('month_jun'); ?></option>
							<option value="7"<?php if ($m == 7) echo ' selected="selected"'; ?>><?php echo lang('month_jul'); ?></option>
							<option value="8"<?php if ($m == 8) echo ' selected="selected"'; ?>><?php echo lang('month_aug'); ?></option>
							<option value="9"<?php if ($m == 9) echo ' selected="selected"'; ?>><?php echo lang('month_sep'); ?></option>
							<option value="10"<?php if ($m == 10) echo ' selected="selected"'; ?>><?php echo lang('month_oct'); ?></option>
							<option value="11"<?php if ($m == 11) echo ' selected="selected"'; ?>><?php echo lang('month_nov'); ?></option>
							<option value="12"<?php if ($m == 12) echo ' selected="selected"'; ?>><?php echo lang('month_dec'); ?></option>
						</select>
						</div>
						<div class="col-xs-3">
						<?php $d = $this->input->post('settings_dob_day') ? $this->input->post('settings_dob_day') : (isset($account_details->dob_day) ? $account_details->dob_day : ''); ?>
						<select name="settings_dob_day" class="form-control">
							<option value="" selected="selected"><?php echo lang('dateofbirth_day'); ?></option>
							<?php for ($i = 1; $i < 32; $i ++) : ?>
							<option value="<?php echo $i; ?>"<?php if ($d == $i) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
							<?php endfor; ?>
						</select>
						</div>
						<div class="col-xs-3">
						<?php $y = $this->input->post('settings_dob_year') ? $this->input->post('settings_dob_year') : (isset($account_details->dob_year) ? $account_details->dob_year : ''); ?>
						<select name="settings_dob_year" class="form-control">
							<option value=""><?php echo lang('dateofbirth_year'); ?></option>
							<?php $year = mdate('%Y', now()); for ($i = $year; $i > 1900; $i --) : ?>
							<option value="<?php echo $i; ?>"<?php if ($y == $i) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
							<?php endfor; ?>
						</select>
						</div>
						</div>
					
                      </div>
                    </div>
                    <div class="form-group <?php  echo (form_error('settings_gender')) ? 'has-error' : ''; ?>">
                      <label for="settings_gender" class="col-sm-2 control-label"><?php echo lang('settings_gender'); ?></label>
                      <div class="col-sm-10">
					  <div class="row">
					  <div class="col-xs-3">
						<?php $s = ($this->input->post('settings_gender') ? $this->input->post('settings_gender') : (isset($account_details->gender) ? $account_details->gender : '')); ?>
						<select name="settings_gender" class="form-control">
							<option value=""><?php echo lang('settings_select'); ?></option>
							<option value="m"<?php if ($s == 'm') echo ' selected="selected"'; ?>><?php echo lang('gender_male'); ?></option>
							<option value="f"<?php if ($s == 'f') echo ' selected="selected"'; ?>><?php echo lang('gender_female'); ?></option>
						</select>
                      </div>
                      </div>
                      </div>
                    </div>
                    <div class="form-group <?php  echo (form_error('settings_postalcode')) ? 'has-error' : ''; ?>">
                      <label for="settings_postalcode" class="col-sm-2 control-label"><?php echo lang('settings_postalcode'); ?></label>
                      <div class="col-sm-10">
                
						<?php if (form_error('settings_postalcode'))
						{
						?>
						<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
						<?php
							echo form_error('settings_postalcode');
							?>
						</label>
						<?php } ?>
							
						<?php echo form_input(array('placeholder'=>lang('settings_postalcode'),'class'=>'form-control' ,'name' => 'settings_postalcode', 'id' => 'settings_postalcode', 'value' => set_value('settings_postalcode') ? set_value('settings_postalcode') : (isset($account_details->postalcode) ? $account_details->postalcode : ''), 'maxlength' => 40)); ?>
	
                      </div>
                     </div>
				     <div class="form-group <?php  echo (form_error('settings_country')) ? 'has-error' : ''; ?>">
                      <label for="settings_country" class="col-sm-2 control-label"><?php echo lang('settings_country'); ?></label>
                      <div class="col-sm-10">
						<div class="row">
						<div class="col-xs-3">
						<?php $account_country = ($this->input->post('settings_country') ? $this->input->post('settings_country') : (isset($account_details->country) ? $account_details->country : '')); ?>
						<select id="settings_country" name="settings_country" class="form-control">
							<option value=""><?php echo lang('settings_select'); ?></option>
							<?php foreach ($countries as $country) : ?>
							<option value="<?php echo $country->alpha2; ?>"<?php if ($account_country == $country->alpha2) echo ' selected="selected"'; ?>>
								<?php echo $country->country; ?>
							</option>
							<?php endforeach; ?>
						</select>
						</div>
						</div>
						
                      </div>
                     </div>
					 <div class="form-group <?php  echo (form_error('settings_language')) ? 'has-error' : ''; ?>">
                      <label for="settings_country" class="col-sm-2 control-label"><?php echo lang('settings_language'); ?></label>
                      <div class="col-sm-10">
						<div class="row">
						<div class="col-xs-3">
						<?php $account_language = ($this->input->post('settings_language') ? $this->input->post('settings_language') : (isset($account_details->language) ? $account_details->language : '')); ?>
						<select id="settings_language" name="settings_language" class="form-control">
							<option value=""><?php echo lang('settings_select'); ?></option>
							<?php foreach ($languages as $language) : ?>
							<option value="<?php echo $language->one; ?>"<?php if ($account_language == $language->one) echo ' selected="selected"'; ?>>
								<?php echo $language->language; ?><?php if ($language->native && $language->native != $language->language) echo ' ('.$language->native.')'; ?>
							</option>
							<?php endforeach; ?>
						</select>
						</div>
						</div>
						
                      </div>
                     </div>
					 <div class="form-group <?php  echo (form_error('settings_timezone')) ? 'has-error' : ''; ?>">
                      <label for="settings_country" class="col-sm-2 control-label"><?php echo lang('settings_timezone'); ?></label>
                      <div class="col-sm-10">
						<div class="row">
						<div class="col-xs-3">
						<?php $account_timezone = ($this->input->post('settings_timezone') ? $this->input->post('settings_timezone') : (isset($account_details->timezone) ? $account_details->timezone : '')); ?>
						<select id="settings_timezone" name="settings_timezone" class="form-control">
							<option value=""><?php echo lang('settings_select'); ?></option>
							<?php foreach ($zoneinfos as $zoneinfo) : ?>
							<option value="<?php echo $zoneinfo->zoneinfo; ?>"<?php if ($account_timezone == $zoneinfo->zoneinfo) echo ' selected="selected"'; ?>>
								<?php echo $zoneinfo->zoneinfo; ?><?php if ($zoneinfo->offset) echo ' ('.$zoneinfo->offset.')'; ?>
							</option>
							<?php endforeach; ?>
						</select>
						</div>
						</div>
						
                      </div>
                     </div>
				   
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn btn-primary"><?php echo lang('settings_save'); ?></button>
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
