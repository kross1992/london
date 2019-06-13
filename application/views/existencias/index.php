<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-search"></i>
            <h3 class="box-title">Lista de Ventas</h3>
        </div>
        <div class="box-body">
            <center>
                <table id='tabla_datos' border='1'>
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <!-- <th class='titulos'>CODIGO</th> -->
                            <th class='titulos'>REFERENCIA</th>
                            <th class='titulos'>ITEM</th>
                            <th class='titulos'>CANTIDAD</th>
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($existencias as $existencias_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $existencias_item['codigo']; ?></td>
                                <td><?php echo $existencias_item['descripcion']; ?></td>
                                <td><?php echo $existencias_item['cantidad']; ?></td>
                                <!-- <td><a href="<?php //echo base_url('existencias/'.$existencias_item['codigo']); ?>"><i class="ni ni-scissors"></i></a></td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="box-footer">
            <div class="row" align="center">
                <div class="col-md-6">
                    <a href="<?php echo base_url('entradas/create');?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Nueva Entrada</a>
                </div>
                <div class="col-md-6">
                    <a href="<?php echo base_url('salidas/create');?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Nueva Salida</a>
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