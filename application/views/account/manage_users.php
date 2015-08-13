<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang('users_page_name'); ?> </title>
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
            <?php echo lang('users_page_name'); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('admin_panel_title'); ?></li>
            <li class="active"><?php echo lang('users_page_name'); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
             <?php echo lang('users_description'); ?>
          </div>
        </div>
		
		<!-- Main content -->
        <section class="content">
          
           <!-- Horizontal Form -->
          <?php if( count($all_accounts) > 0 ) : ?>
		  <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('users_page_name'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?php echo lang('users_username'); ?></th>
                        <th><?php echo lang('settings_email'); ?></th>
						<th><?php echo lang('settings_firstname'); ?></th>
						<th><?php echo lang('settings_lastname'); ?></th>
						 <th>
							<?php if( $this->authorization->is_permitted('create_users') ): ?>
							  <?php echo anchor('account/manage_users/save',lang('website_create'),'class="btn btn-primary btn-small"'); ?>
							<?php endif; ?>
						  </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach( $all_accounts as $acc ) : ?>
					  <tr>
						<td><?php echo $acc['id']; ?></td>
						<td>
						  <?php echo $acc['username']; ?>
						  <?php if( $acc['is_banned'] ): ?>
							<span class="label label-important"><?php echo lang('users_banned'); ?></span>
						  <?php elseif( $acc['is_admin'] ): ?>
							<span class="label label-info"><?php echo lang('users_admin'); ?></span>
						  <?php endif; ?>
						</td>
						<td><?php echo $acc['email']; ?></td>
						<td><?php echo $acc['firstname']; ?></td>
						<td><?php echo $acc['lastname']; ?></td>
						<td>
						  <?php if( $this->authorization->is_permitted('update_users') ): ?>
							<?php echo anchor('account/manage_users/save/'.$acc['id'],lang('website_update'),'class="btn btn-small"'); ?>
						  <?php endif; ?>
						</td>
					  </tr>
					<?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			   <?php endif; ?>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php echo $this->load->view('footer'); ?>
      <?php echo $this->load->view('aside_r'); ?>

      
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <?php echo $this->load->view('footer_js'); ?>
	
	<!-- DATA TABES SCRIPT -->
	<script src="../../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

	<script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
