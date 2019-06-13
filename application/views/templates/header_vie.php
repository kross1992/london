<html>
        <head>  
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                
                <title>London Tienda de Ropa</title>
                <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/logo.png');?>">
                
                <!-- Icons -->
                <!--<link href="<?php //echo base_url('assets/argon-design-system-v1.0.1/assets/vendor/nucleo/css/nucleo.css');?>" rel="stylesheet">
                <link href="<?php //echo base_url('assets/argon-design-system-v1.0.1/assets/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">-->
                <!-- CSS Files -->
                <!--<link type="text/css" href="<?php //echo base_url('assets/argon-design-system-v1.0.1/assets/css/argon.min.css');?>" rel="stylesheet">-->
                <link type="text/css" href="<?php echo base_url('assets/css/dataTableTheme.scss');?>" rel="stylesheet">
                <link type="text/css" href="<?php echo base_url('assets/css/dataTableTheme.css');?>" rel="stylesheet">

                <link type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css');?>" rel="stylesheet">

                <link type="text/css" href="<?php echo base_url('assets/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet">
                <!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">-->
                <script src="<?php echo base_url('assets/jQuery/jquery-2.2.3.min.js');?>"></script>
                <script src="<?php echo base_url('assets/datatables/jquery.dataTables.min.js');?>"></script>

                <script src="<?php echo base_url('assets/sweetalert/sweetalert.min.js');?>"></script>
                
                <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url('assets/material-kit-html-v2.0.4/assets/css/material-kit.css?v=2.0.4');?>"> -->       
        </head>
        <body>
          <?php
            if ($this->session->has_userdata('logged_in')){
          ?>
            <header class="header-global">
              <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
                <div class="container">
                  <a class="navbar-brand mr-lg-5" href="<?php echo site_url('home')?>">
                    <img src="<?php echo base_url('assets/images/logo.png');?>">
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="navbar-collapse collapse" id="navbar_global">
                    <div class="navbar-collapse-header">
                      <div class="row">
                        <div class="col-6 collapse-brand">
                          <a href="<?php echo site_url('home')?>">
                            <img src="<?php echo base_url('assets/images/logo.png');?>">
                          </a>
                        </div>
                        <div class="col-6 collapse-close">
                          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                          </button>
                        </div>
                      </div>
                    </div>
                    <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                      <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                          <i class="ni ni-ui-04 d-lg-none"></i>
                          <span class="nav-link-inner--text">Modulos</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl">
                          <div class="dropdown-menu-inner">
                            <a href="<?php echo base_url('ventas')?>" class="media d-flex align-items-center">
                              <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                                <i class="ni ni-cart"></i>
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="heading text-primary mb-md-1">Ventas</h6>
                                <p class="description d-none d-md-inline-block mb-0">Modulo de ventas</p>
                              </div>
                            </a>
                            <a href="<?php echo base_url('abonos')?>" class="media d-flex align-items-center">
                              <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
                                <i class="ni ni-credit-card"></i>
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="heading text-primary mb-md-1">Abonos</h6>
                                <p class="description d-none d-md-inline-block mb-0">Modulo de abonos a ventas</p>
                              </div>
                            </a>
                            <a href="<?php echo base_url('clientes')?>" class="media d-flex align-items-center">
                              <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                                <i class="ni ni-single-02"></i>
                              </div>
                              <div class="media-body ml-3">
                                <h6 class="heading text-primary mb-md-1">Clientes</h6>
                                <p class="description d-none d-md-inline-block mb-0">Modulo de clientes</p>
                              </div>
                            </a>
                            
                          </div>
                        </div>
                      </li>
                      <?php
                        if ($this->session->userdata('rol') == 0){
                      ?>
                        <li class="nav-item dropdown">
                          <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                            <i class="ni ni-collection d-lg-none"></i>
                            <span class="nav-link-inner--text">Administrador</span>
                          </a>
                          <div class="dropdown-menu">
                            <a href="<?php echo base_url('proveedores')?>" class="dropdown-item">Proveedores</a>
                            <a href="<?php echo base_url('categorias')?>" class="dropdown-item">Categorias</a>
                            <a href="<?php echo base_url('items')?>" class="dropdown-item">Productos</a>
                            <a href="<?php echo base_url('existencias')?>" class="dropdown-item">Inventario</a>
                            <a href="<?php echo base_url('usuarios')?>" class="dropdown-item">Usuarios</a>
                          </div>
                        </li>
                      <?php }?>
                    </ul>
                    <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                      <li class="nav-item d-none d-lg-block ml-lg-4">
                        <a  href="<?php echo base_url('login/cerrar')?>" class="btn btn-neutral btn-icon">
                          <span class="btn-inner--icon">
                            <i class="ni ni-button-power mr-2"></i>
                          </span>
                          <span class="nav-link-inner--text">Cerrar Sesión</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            </header>
          <?php } else {header('Location:'.base_url('login'));}?>
                <section class="section-profile-cover section-shaped my-0">
                <!--<section class="section section-lg section-hero section-shaped">-->
                <!--<section class="section section-shaped section-lg">-->
                  <!-- Circles background-->
                  <div class="shape shape-style-1 shape-default alpha-4">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                  <div class="container shape-container d-flex align-items-center ">
                   <div class="col px-0">
                    <div class="row align-items-center justify-content-center">
                      <div class="col-lg-6 text-center">
                        <!-- <img src="<?php //echo base_url('assets/img/logo.png');?>" style="width: 150px;" class="img-fluid"> -->
                        <h1 class="text-white"><?php echo $title; ?></h1>
                      </div>
                    </div>
                   </div>
                  </div>
                  <!-- SVG separator -->
                  <div class="separator separator-bottom separator-skew">
                    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                      <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                  </div>
                </section>
                

                