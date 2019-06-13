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
                            <th class='titulos'>CODIGO</th>
                            <th class='titulos'>FECHA</th>
                            <th class='titulos'>CLIENTE</th>
                            <th class='titulos'>TIPO VENTA</th>
                            <th class='titulos'>PRECIO</th>
                             <th class='titulos'>VER</th> 
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($ventas as $ventas_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $ventas_item['codigo_venta']; ?></td>
                                <td><?php echo $ventas_item['fecha']; ?></td>
                                <td><?php echo $ventas_item['nombres'].' '.$ventas_item['apellidos']; ?></td>
                                <td><?php echo $ventas_item['tipo']; ?></td>
                                <td><?php echo number_format($ventas_item['costo_total']); ?></td>
                                <td><a href="<?php echo base_url('Ventas/get_detalles_venta/'.$ventas_item['codigo_venta']); ?>"><i class="fa fa-eye"></i></a></td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="box-footer">
            <div class="row" align="center">
                <div class="col-md-12">
                    <a href="<?php echo base_url('ventas/create')?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Nueva Venta</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   $('#tabla_datos').DataTable({
   	    "scrollCollapse": true,
            "order": [[ 1, "desc" ]],
   	    "language": {
   	        url: "<?php echo base_url('assets/datatables/languages/Spanish.json'); ?>"
   	    },
   	    responsive: true
   	});
	
</script>