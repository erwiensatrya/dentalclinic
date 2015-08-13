<!DOCTYPE html>
<html>
  <head>
  <title><?php echo lang('website_title'); ?> | <?php echo lang('roles_page_name'); ?> </title>
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
            <?php echo lang('roles_page_name'); ?>
            <small><?php //echo lang('website_version'); ?></small>
          </h1>
          <ol class="breadcrumb">
            <li>
			<a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo lang('admin_panel_title'); ?></li>
            <li class="active"><?php echo lang('roles_page_name'); ?></li>
          </ol>
        </section>

		 <div class="pad margin no-print">
          <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
             <?php echo lang('roles_page_description'); ?>
          </div>
        </div>
		
		<!-- Main content -->
        <section class="content">
          
           <!-- Horizontal Form -->
        
		  <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo lang('roles_page_name'); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?php echo lang('roles_column_role'); ?></th>
                        <th><?php echo lang('roles_column_users'); ?></th>
						<th><?php echo lang('roles_permission'); ?></th>
						<th>
						  <?php if( $this->authorization->is_permitted('create_roles') ): ?>
							<?php echo anchor('account/manage_roles/save', lang('website_create'), 'class="btn btn-primary btn-small"'); ?>
						  <?php endif; ?>
						</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php foreach( $roles as $role ) : ?>
						<tr>
						  <td><?php echo $role['id']; ?></td>
						  <td>
							<?php echo $role['name']; ?>
							<?php if( $role['is_disabled'] ): ?>
							  <span class="label label-important"><?php echo lang('roles_banned'); ?></span>
							<?php endif; ?>
						  </td>
						  <td>
							<?php if( $role['user_count'] > 0 ) : ?>
							  <?php echo anchor('account/manage_users/filter/role/'.$role['id'], $role['user_count'], 'class="badge badge-info"'); ?>
							<?php else : ?>
							  <span class="badge">0</span>
							<?php endif; ?>
						  </td>
						  <td>
							<?php if( count($role['perm_list']) == 0 ) : ?>
							  <span class="label">No Permissions</span>
							<?php else : ?>
								<?php foreach( $role['perm_list'] as $itm ) : ?>
								  <?php echo anchor('account/manage_permissions/save/'.$itm['id'], '<span class="label label-info">'.$itm['key'].'</span>', 'title="'.$itm['title'].'"'); ?>
								<?php endforeach; ?>
							<?php endif; ?>
						  </td>
						  <td>
							<?php if( $this->authorization->is_permitted('update_roles') ): ?>
							  <?php echo anchor('account/manage_roles/save/'.$role['id'], lang('website_update'), 'class="btn btn-small"'); ?>
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
