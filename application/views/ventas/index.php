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
        <div class="row" align="center">

        </div>
        <div class="box-body" id="todo">
            <center>
                <table id='tabla_datos' border='1' class="display" style="width:100%">
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <th class='titulos'>CODIGO</th>
                            <th class='titulos'>FECHA</th>
                            <th class='titulos'>CEDULA</th>
                            <th class='titulos'>CLIENTE</th>
                            <th class='titulos'>TIPO VENTA</th>
                            <th class='titulos'>PRECIO</th>
                            <th class='titulos'>VER</th>
                            <th class='titulos'>ANULAR</th>
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($ventas as $ventas_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $ventas_item['codigo_venta']; ?></td>
                                <td><?php echo $ventas_item['fecha']; ?></td>
                                <td><?php echo $ventas_item['cedula']; ?></td>
                                <td><?php echo $ventas_item['nombres'].' '.$ventas_item['apellidos']; ?></td>
                                <td><?php echo $ventas_item['tipo']; ?></td>
                                <td><?php echo '$'. number_format($ventas_item['costo_total'], 2 ,',','.' ); ?></td>
                                 <td><a href="<?php echo base_url('Ventas/get_detalles_venta/'.$ventas_item['codigo_venta']); ?>"><i class="fa fa-eye"></i></a></td>
                                 <td><a id="<?php echo $ventas_item['codigo_venta']; ?>" href="#" onclick="anular(this.id);"><i class="fa fa-times"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                       <tr>
                           <th colspan="5" style="text-align:right">Total:</th>
                           <th colspan="3"></th>
                       </tr>
                   </tfoot>
                </table>
            </center>
        </div>
        <div class="box-footer">
            <div class="row text-center" align="center">
              <div class="col-md-3 "></div>
                <div class="col-md-3 ">
                    <a href="<?php echo base_url('clientes/create')?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Nuevo Cliente</a>
                </div>
                <div class="col-md-3 ">
                    <a href="<?php echo base_url('ventas/create')?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Nueva Venta</a>
                </div>
                <div class="col-md-3 "></div>
            </div>
        </div>
    </div>
    <div style="display: none">
        <div id="content-div" style="width: 400px;">
            ddd
        </div>
    </div>
</div>
<script type="text/javascript">

        $(document).ready(function() {

        });

        $('#tabla_datos thead tr').clone(true).appendTo( '#tabla_datos thead' );
        $('#tabla_datos thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            if(title != 'VER' && title != 'ANULAR'){
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
            dom: 'lBfrtip',
            buttons: [
              {
                  extend: 'copyHtml5',
                  exportOptions: {
                      columns: [ 0, ':visible' ]
                  }
              },
              {
                  extend: 'excelHtml5',
                  footer: true,
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4, 5 ]
                  }
              },
              {
                  extend: 'csvHtml5',
                  footer: true,
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4, 5 ]
                  }
              },
              {
                  extend: 'pdfHtml5',
                  footer: true,
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4, 5 ]
                  }
              },
              'colvis'
            ],
            order: [[ 0, "desc" ]],
            responsive: true,
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                total = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        var s = a + '';
                        s = s.replace('.', '');
                        s = parseInt(s);

                        var w = b + '';
                        w = w.replace('.', '');
                        w = w.replace('$', '');
                        w = parseInt(w);
                        return intVal(s) + intVal(w);
                    }, 0 );

                // Total over this page
                pageTotal = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                      var s = a + '';
                      s = s.replace('.', '');
                      s = parseInt(s);

                      var w = b + '';
                      w = w.replace('.', '');
                      w = w.replace('$', '');
                      w = parseInt(w);
                      return intVal(s) + intVal(w);
                    }, 0 );

                // Update footer
                $( api.column( 5 ).footer() ).html(
                    '$'+new Intl.NumberFormat("de-DE").format(Math.round(pageTotal)) +' ( $'+ new Intl.NumberFormat("de-DE").format(Math.round(total)) +' Total Ventas)'
                );
            }
        } );



        function anular(id) {
        swal({
        title: "Desea Anular esta venta?",
        text: "Por favor verifique, despues de confirmar no podrá devolver el cambio",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Confirmar",
        closeOnConfirm: false
    },
    function(isConfirm){
        if (isConfirm) {
            $.ajax({
            url: "<?php echo base_url(); ?>Ventas/anular",
            type: 'POST',
            data: {id: id},
            success: function (data) {
                if(data ==="1"){
                    swal("", 'Anulada', "success");
                $("#todo").load(location.href + " #todo");
                }else{
                    swal("Cancelled", "", "error");
                }

            }
        });
        } else
        {
            swal("Cancelled", "", "error");
        }
    });
      return false;
    }

</script>
