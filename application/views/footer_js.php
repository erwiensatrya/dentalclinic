	<!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
   <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    
	<!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
     <!-- jvectormap -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--<script src="<?php //echo base_url().RES_DIR; ?>/adminlte/dist/js/pages/dashboard2.js" type="text/javascript"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/dist/js/demo.js" type="text/javascript"></script>
	
	<?php if(isset($datatable)){ ?>
	<!-- DATA TABES SCRIPT -->
	<script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
	<?php } ?>
	
	<?php if(isset($calendar)){ ?>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
	<?php } ?>