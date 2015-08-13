<!DOCTYPE html>
<html>
  <head>
   <title><?php echo lang('website_title'); ?> | <?php echo lang('dashboard_title'); ?> </title>
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
            <?php echo lang('website_title'); ?>
            <small><?php echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo lang('dashboard_title'); ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">CPU Traffic</span>
                  <span class="info-box-number">90<small>%</small></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">41,410</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Sales</span>
                  <span class="info-box-number">760</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number">2,000</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <!-- TABLE: Personal Details -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Personal Detail</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php if ((isset($account_details->picture)) && (strlen(trim($account_details->picture))  > 0)) { echo showPhoto($account_details->picture, array('class'=>'img-circle')); }else{ echo showPhoto(null,array('class'=>'img-circle')); } ?>
                  <table class="table table-condensed">
                    <tbody>
					<tr><td><?php echo lang('dashboard_username'); ?></td><td>:</td><td><b><?php echo $account->username; ?></b></td></tr>
					<tr><td><?php echo lang('dashboard_email'); ?></td><td>:</td><td><b><?php echo $account->email; ?></b></td></tr>
					<tr><td><?php echo lang('dashboard_fullname'); ?></td><td>:</td><td><?php echo $account_details->fullname; ?></td></tr>
					<tr><td><?php echo lang('dashboard_firstname'); ?></td><td>:</td><td><?php echo $account_details->firstname; ?></td></tr>
					<tr><td><?php echo lang('dashboard_lastname'); ?></td><td>:</td><td><?php echo $account_details->lastname; ?></td></tr>
					<tr><td><?php echo lang('dashboard_dateofbirth'); ?></td><td>:</td><td><?php echo $account_details->dateofbirth; ?></td></tr>
					<tr><td><?php echo lang('dashboard_gender'); ?></td><td>:</td><td><?php echo $account_details->gender; ?></td></tr>
					<tr><td><?php echo lang('dashboard_postalcode'); ?></td><td>:</td><td><?php echo $account_details->postalcode; ?></td></tr>
					<tr><td><?php echo lang('dashboard_country'); ?></td><td>:</td><td><?php echo $account_details->country; ?></td></tr>
					<tr><td><?php echo lang('dashboard_language'); ?></td><td>:</td><td><?php echo $account_details->language; ?></td></tr>
					<tr><td><?php echo lang('dashboard_timezone'); ?></td><td>:</td><td><?php echo $account_details->timezone; ?></td></tr>
					</tbody>
				   </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-md-4">
              <!-- Dental Clinic Card -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="text-center"><b>Dental Clinic</b> member card</h3>
                </div><!-- /.box-header -->
                <div class="box-body text-center">
                   <img src="http://localhost/dentalclinic/resource/img/default-qrcode.png" title="User's Photo" alt="User's Photo" >
				   <h3>#1dfs9834hjvsd72</h3>
				   <hr/>
				   <?php echo $account->email; ?>
				   <br>
				   Member since <?php echo ($account->createdon)? date_parse($account->createdon)['year']:"";  ?>
				   <br>
				   <small>Smile, and the world smiles with you!</small>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="row no-print">
					<div class="col-xs-12">
					  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
					  <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
					</div>
				  </div>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php echo $this->load->view('footer'); ?>
	  
    </div><!-- ./wrapper -->
    <?php echo $this->load->view('footer_js'); ?>
  </body>
</html>
