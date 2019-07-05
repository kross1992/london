<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-search"></i>
            <h3 class="box-title">Lista de Salidas</h3>
        </div>
        <div class="box-body">
            <center>
                <table id='tabla_datos' border='1'>
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <th class='titulos'>CODIGO</th>
                            <th class='titulos'>PROVEEDOR</th>
                            <th class='titulos'>ITEM</th>
                            <th class='titulos'>CANTIDAD</th>
                            <th class='titulos'>EDITAR</th>
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($salidas as $salidas_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $salidas_item['id']; ?></td>
                                <td><?php echo $salidas_item['proveedor']; ?></td>
                                <td><?php echo $salidas_item['item']; ?></td>
                                <td><?php echo $salidas_item['cantidad']; ?></td>
                                <td><a href="<?php echo base_url('salidas/'.$salidas_item['id']); ?>"><i class="fa fa-edit fa-2x"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="box-footer">
            <div class="row" align="center">
                <div class="col-md-12">
                    <a href="<?php echo base_url('salidas/create')?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Nuevo</a>
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
