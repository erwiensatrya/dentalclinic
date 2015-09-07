	<meta charset="UTF-8">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/dist/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- flaticon -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/dist/fonts/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap 
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />-->
    <!-- Theme style -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	
	<?php if(isset($mail)){?>
	<!-- iCheck -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
	<!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url().RES_DIR; ?>/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <?php } ?>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->