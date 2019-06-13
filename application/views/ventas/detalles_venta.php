<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="<?php echo base_url(); ?>Ventas/index" ><h4><i class="fa fa-arrow-circle-left"></i> Volver</a><br></h4>  
            <h3 class="box-title">Detalles Venta</h3>
        </div>
        <div class="box-body">
            <center>
                <table id='tabla_datos' border='1'>
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <th class='titulos'>CODIGO</th>
                            <th class='titulos'>DESCRIPCION</th>
                            <th class='titulos'>CANTIDAD</th>
                            <th class='titulos'>COSTO UNIT</th>
                            <th class='titulos'>COSTO TOTAL</th>
                            <!-- <th class='titulos'>VER</th> -->
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($detalles_venta as $ventas_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $ventas_item['codigo']; ?></td>
                                <td><?php echo $ventas_item['descripcion']; ?></td>
                                <td><?php echo number_format($ventas_item['cantidad']); ?></td>
                                <td><?php echo number_format($ventas_item['costo_unidad']); ?></td>
                                <td><?php echo number_format($ventas_item['costo_total']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
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