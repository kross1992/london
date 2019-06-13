<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Modulos</li>
        <!-- Optionally, you can add icons to the links -->
          <li class="treeview">
          <a href="#">
            <i class="fa fa-cart-plus"></i><span>Ventas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('ventas/create1')?>">Crear Nueva Venta</a></li>
            <li><a href="<?php echo base_url('ventas')?>">Lista Facturas</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('abonos')?>"><i class="fa fa-money"></i> <span>Abonos</span></a></li>
        <li><a href="<?php echo base_url('notas')?>"><i class="fa fa-key"></i> <span>Notas</span></a></li>
        <li><a href="<?php echo base_url('clientes')?>"><i class="fa fa-users"></i> <span>Clientes</span></a></li>
        <?php if ($this->session->userdata('rol') == 0){ ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Administrador</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('proveedores')?>">Proveedores</a></li>
            <li><a href="<?php echo base_url('categorias')?>">Categorias</a></li>
            <li><a href="<?php echo base_url('items')?>">Items</a></li>
            <li><a href="<?php echo base_url('existencias')?>">Inventario</a></li>
            <li><a href="<?php echo base_url('usuarios')?>">Usuarios</a></li>        
            <li><a href="<?php echo base_url('Ventas/get_ventas_anuladas')?>">Ventas Anuladas</a></li>        
          </ul>
        </li>
        <?php }?>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>-->
    </section>