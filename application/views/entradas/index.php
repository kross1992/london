<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-search"></i>
            <h3 class="box-title">Lista de Entradas</h3>
        </div>
        <div class="box-body">
            <center>
                <table id='tabla_datos' border='1'>
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <th class='titulos'>REFERENCIA</th>
                            <th class='titulos'>FACTURA</th>
                            <th class='titulos'>PROVEEDOR</th>
                            <th class='titulos'>DESCRIPCION</th>
                            <th class='titulos'>CANTIDAD</th>
                            <th class='titulos'>VER</th>
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($entradas as $entradas_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $entradas_item['id']; ?></td>
                                <td><?php echo $entradas_item['factura']; ?></td>
                                <td><?php echo $entradas_item['nom_proveedor']; ?></td>
                                <td><?php echo $entradas_item['nom_item']; ?></td>
                                <td><?php echo $entradas_item['cantidad']; ?></td>
                                <td><a href="<?php echo base_url('entradas/'.$entradas_item['id']); ?>"><i class="fa fa-search fa-2x"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="box-footer">
            <div class="row" align="center">
                <div class="col-md-12">
                    <a href="<?php echo base_url('entradas/create')?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Nuevo</a>
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