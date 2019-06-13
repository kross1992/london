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
            console.log(title);
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
            responsive: true
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