<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-search"></i>
            <h3 class="box-title">Detalles Abonos</h3>
        </div>
        <div class="box-body">
            <center>
                <table id='tabla_datos' border='1'>
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <!-- <th class='titulos'>CODIGO</th> -->
                            <th class='titulos'>FECHA</th>
                            <th class='titulos'>TIPO PAGO</th>
                            <th class='titulos'>VALOR</th>
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($detalles_abonos as $row): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $row['fecha']; ?></td>
                                <td><?php echo $row['tipo_pago']; ?></td>
                                <td><?php echo number_format($row['valor']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
    </div>
    <!-- <div class="row" align="center">
        <div class="col-md-6">
            <a href="<?php //echo base_url('entradas/create');?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Nueva Entrada</a>
        </div>
    
    </div> -->
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