<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-search"></i>
            <h3 class="box-title">Lista de Usuarios</h3>
        </div>
        <div class="box-body">
            <center>
                <table id='tabla_datos' border='1'>
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <th class='titulos'>USUARIO</th>
                            <th class='titulos'>NOMBRE</th>
                            <th class='titulos'>ROL</th>
                            <th class='titulos'>ESTADO</th>
                            <th class='titulos'>EDITAR</th>
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($usuarios as $usuarios_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $usuarios_item['usuario']; ?></td>
                                <td><?php echo $usuarios_item['nombre']; ?></td>
                                <td><?php echo $usuarios_item['rol'] == 0 ? 'Administrador': 'General'; ?></td>
                                <td><?php echo $usuarios_item['estado'] == 0 ? 'Inactivo': 'Activo'; ?></td>
                                <td><a href="<?php echo base_url('usuarios/edit/'.$usuarios_item['id']); ?>"><i class="fa fa-edit fa-2x"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="box-footer">
            <div class="row" align="center">
                <div class="col-md-12">
                    <a href="<?php echo base_url('usuarios/create')?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Nuevo</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   $('#tabla_datos').DataTable({
   	    "scrollCollapse": true,
   	    "language": {
   	        url: "<?php echo base_url('assets/datatables/languages/Spanish.json'); ?>"
   	    },
   	    responsive: true
   	});
	
</script>