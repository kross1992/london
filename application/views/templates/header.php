<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <title>LONDON | Tienda de Ropa</title>
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/logo.png');?>">
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css');?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css');?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.5/dist/css/AdminLTE.min.css');?>">
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.5/dist/css/skins/skin-blue-light.min.css');?>">

        <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');?>">
        
        <link type="text/css" href="<?php echo base_url('assets/AdminLTE-2.4.5/plugins/iCheck/all.css');?>" rel="stylesheet">
        
        <link type="text/css" href="<?php echo base_url('assets/css/dataTableTheme.css');?>" rel="stylesheet">

        <link type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css');?>" rel="stylesheet">

        <link type="text/css" href="<?php echo base_url('assets/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet">
        
        <script src="<?php echo base_url('assets/jQuery/jquery-2.2.3.min.js');?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js');?>"></script>
        
        <script src="<?php echo base_url('assets/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>

        <script src="<?php echo base_url('assets/sweetalert/sweetalert.min.js');?>"></script>
        
        <script src="<?php echo base_url('assets/AdminLTE-2.4.5/plugins/iCheck/iCheck.min.js');?>"></script>
        
        <!-- SELECT LIST AUTO COMPLETABLE DEL BOOTSTRAP-->
        <link href="<?php echo base_url(); ?>css/select2.min.css" rel="stylesheet" />
        <!-- <script src="<?php echo base_url(); ?>js/select2.min.js"></script> -->
    
        <!-- Tema Personalizado DataTable -->
        <!--<link type="text/css" href="<?php //echo base_url('assets/css/dataTableTheme.scss');?>" rel="stylesheet">
        <link type="text/css" href="<?php //echo base_url('assets/css/dataTableTheme.css');?>" rel="stylesheet">  -->
    </head>
    <?php if ($this->session->has_userdata('logged_in')){} else {header('Location:'.base_url('login'));} ?>
    <body class="hold-transition skin-blue-light sidebar-collapse sidebar-mini">
        <div class="wrapper">

          <!-- Main Header -->
          <header class="main-header">

            <!-- Logo -->
            <a href="<?php echo site_url('home')?>" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>LS</b></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>London</b> Store</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
              <!-- Sidebar toggle button-->
              <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
              </a>
              <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="<?php echo base_url('assets/images/user.png');?>" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?php echo $this->session->userdata('user'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="<?php echo base_url('assets/images/user.png');?>" class="img-circle" alt="User Image">
                        <p>
                            <?php echo $this->session->userdata('user'); ?>
                          <small><?php if ($this->session->userdata('rol') == 0){echo 'Administrador';} else {echo 'General';}?></small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <!--<li class="user-body">
                        <div class="row">
                          <div class="col-xs-4 text-center">
                            <a href="#">1</a>
                          </div>
                          <div class="col-xs-4 text-center">
                            <a href="#">2</a>
                          </div>
                          <div class="col-xs-4 text-center">
                            <a href="#">3</a>
                          </div>
                        </div>
                      </li>-->
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <!--<div class="pull-left">
                          <a href="#" class="btn btn-default btn-flat">Info</a>
                        </div>-->
                        <div class="pull-right">
                          <a href="<?php echo base_url('login/cerrar')?>" class="btn btn-default btn-flat">Cerrar Sesión</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <!-- Control Sidebar Toggle Button -->
                  <!--<li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                  </li>-->
                </ul>
              </div>
            </nav>
          </header>

          
            