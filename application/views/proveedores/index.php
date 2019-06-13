<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-search"></i>
            <h3 class="box-title">Lista de Proveedores</h3>
        </div>
        <div class="box-body">
            <center>
                <table id='tabla_datos' border='1'>
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <th class='titulos'>IDENTIFICACION</th>
                            <th class='titulos'>NOMBRE</th>
                            <th class='titulos'>DIRECCION</th>
                            <th class='titulos'>TELEFONO</th>
                            <th class='titulos'>CELULAR</th>
                            <th class='titulos'>EDITAR</th>
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($proveedores as $proveedores_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $proveedores_item['identificacion']; ?></td>
                                <td><?php echo $proveedores_item['nombres'].' '.$proveedores_item['apellidos']; ?></td>
                                <td><?php echo $proveedores_item['direccion']; ?></td>
                                <td><?php echo $proveedores_item['telefono']; ?></td>
                                <td><?php echo $proveedores_item['celular']; ?></td>
                                <td><a href="<?php echo base_url('proveedores/edit/'.$proveedores_item['id']); ?>"><i class="fa fa-edit fa-2x"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="box-footer">
            <div class="row" align="center">
                <div class="col-md-12">
                    <a href="<?php echo base_url('proveedores/create')?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Nuevo</a>
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