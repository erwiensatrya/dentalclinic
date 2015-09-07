<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang('permissions_page_name'); ?> </title>
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
            <?php echo lang('permissions_page_name'); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('admin_panel_title'); ?></li>
            <li class="active"><?php echo lang('permissions_page_name'); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
             <?php echo lang('permissions_page_description'); ?>
          </div>
        </div>
		
		<!-- Main content -->
        <section class="content">
          
           <!-- Horizontal Form -->
        
		  <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('permissions_page_name'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
						<th><?php echo lang('permissions_column_permission'); ?></th>
						<th><?php echo lang('permissions_description'); ?></th>
						<th><?php echo lang('permissions_column_inroles'); ?></th>
						<th>
						  <?php if( $this->authorization->is_permitted('create_users') ): ?>
							<?php echo anchor('account/manage_permissions/save',lang('website_create'),'class="btn btn-primary btn-small"'); ?>
						  <?php endif; ?>
						</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php foreach( $permissions as $perm ) : ?>
						<tr>
						  <td><?php echo $perm['id']; ?></td>
						  <td>
							<?php echo $perm['key']; ?>
							<?php if( $perm['is_disabled'] ): ?>
							  <span class="label label-important"><?php echo lang('permissions_banned'); ?></span>
							<?php endif; ?>
						  </td>
						  <td><?php echo $perm['description']; ?></td>
						  <td>
							<?php if( count($perm['role_list']) == 0 ) : ?>
							  <span class="label">None</span>
							<?php else : ?>
								<?php foreach( $perm['role_list'] as $itm ) : ?>
								  <?php echo anchor('account/manage_roles/save/'.$itm['id'], '<span class="label label-info">'.$itm['name'].'</span>', 'title="'.$itm['title'].'"'); ?>
								
								<?php endforeach; ?>
							<?php endif; ?>
						  </td>
						  <td>
							<?php if( $this->authorization->is_permitted('update_permissions') ): ?>
							  <?php echo anchor('account/manage_permissions/save/'.$perm['id'], lang('website_update'), 'class="btn btn-small"'); ?>
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
			 

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php echo $this->load->view('footer'); ?>
      <?php echo $this->load->view('aside_r'); ?>

      
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <?php echo $this->load->view('footer_js'); ?>
	
	<script type="text/javascript">
      jQuery(function () {
        jQuery("#example1").DataTable();
        jQuery('#example2').DataTable({
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
