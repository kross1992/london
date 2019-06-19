<style type="text/css">
    thead input {
        width: 100%;
    }
</style>
<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-search"></i>
            <h3 class="box-title">Lista de Ventas</h3>
        </div>
        <div class="box-body">
            <center>
                <table id='tabla_datos' border='1' style="width:100%">
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <!-- <th class='titulos'>CODIGO</th> -->
                            <th class='titulos'>FACTURA</th>
                            <th class='titulos'>FECHA</th>
                            <th class='titulos'>CEDULA</th>
                            <th class='titulos'>CLIENTE</th>
                            <th class='titulos'>TIPO</th>
                            <th class='titulos'>VALOR TOTAL</th>
                            <th class='titulos'>ABONO</th>
                            <th class='titulos'>SALDO</th>
                            <th class='titulos'>ABONAR</th>
                            <th class='titulos'>HISTORIAL</th>
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($abonos as $abonos_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $abonos_item['codigo_venta']; ?></td>
                                <td><?php echo $abonos_item['fecha']; ?></td>
                                <td><?php echo $abonos_item['cedula']; ?></td>
                                <td><?php echo $abonos_item['nombres'].' '.$abonos_item['apellidos']; ?></td>
                                <td><?php echo $abonos_item['descripcion']; ?></td>
                                <td><?php echo '$'. number_format($abonos_item['costo_total']); ?></td>
                                <td><?php echo '$'. number_format($abonos_item['abono']); ?></td>
                                <td><?php echo '$'. number_format($abonos_item['saldo']); ?></td>
                                <td><?php if($abonos_item['saldo']>0){ ?> <a href="<?php echo base_url('abonos/edit/'.$abonos_item['id']); ?>"><i class="fa fa-money fa-2x"></i></a> <?php } ?></td>
                                <td> <a href="<?php echo base_url('abonos/detalles_abonos/'.$abonos_item['codigo_venta']); ?>"><i class="fa fa-money fa-2x"></i></a> </td>
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
    $('#tabla_datos thead tr').clone(true).appendTo( '#tabla_datos thead' );
    $('#tabla_datos thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        if(title != 'ABONAR' && title != 'HISTORIAL' ){
            $(this).html( '<input type="text" placeholder="'+title+'" />' );

            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        }else{
            $(this).html('');
        }

    } );

    var table = $('#tabla_datos').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        language: {
            url: "<?php echo base_url('assets/datatables/languages/Spanish.json'); ?>"
        },
        responsive: true
    } );

</script>
