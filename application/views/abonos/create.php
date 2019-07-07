<style type="text/css">
    thead input {
        width: 100%;
    }
</style>
<div class="container">
    <form id="form-abono" action="" method="post" accept-charset="utf-8">
      <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-plus"></i>
            <h3 class="box-title">REALIZAR ABONO</h3>
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
                          <th class='titulos'>SELECCIONAR</th>
                      </tr>
                  </thead>
                  <tbody id='contenido_datos'>
                      <?php foreach ($abonos as $abonos_item): ?>
                        <?php if (number_format($abonos_item['saldo']) > 0):  ?>
                          <tr style='text-align: center;'>
                              <td><?php echo $abonos_item['codigo_venta']; ?></td>
                              <td><?php echo $abonos_item['fecha']; ?></td>
                              <td><?php echo $abonos_item['cedula']; ?></td>
                              <td><?php echo $abonos_item['nombres'].' '.$abonos_item['apellidos']; ?></td>
                              <td><?php echo $abonos_item['descripcion']; ?></td>
                              <td><?php echo '$'. number_format($abonos_item['costo_total']); ?></td>
                              <td><?php echo '$'. number_format($abonos_item['abono']); ?></td>
                              <td><?php echo '$'. number_format($abonos_item['saldo']); ?></td>
                              <td><input id="selecciona-saldo-<?php echo $abonos_item['id'] ?>" class="check-total" type="checkbox" name="<?php $abonos_item['codigo_venta'] ?>" value="<?php echo $abonos_item['id'] ?>" ></td>
                          </tr>
                        <?php endif; ?>
                      <?php endforeach; ?>
                  </tbody>
              </table>
          </center>
          <!--  inicio bloque -->
          <div class="row">
            <div class="col-md-4">
              <label for="factura">FACTURA</label>
              <input type="text" name="factura" id="factura" class="form-control form-control-alternative" value="" readonly/>
            </div>
            <div class="col-md-4">
              <label for="cedula">CEDULA</label>
              <input type="text" name="cedula" id="cedula" class="form-control form-control-alternative" value="" readonly/>
            </div>
            <div class="col-md-4">
              <label for="cliente">CLIENTE</label>
              <input type="text" name="cliente" id="cliente" class="form-control form-control-alternative" value="" readonly/>
            </div>
          </div>
          <BR>

          <div class="row">
              <div class="col-md-4">
                <label for="abonado">ABONADO</label>
                <div class='input-group' >
                      <span class="input-group-addon">
                          $
                      </span>
                      <input type="text" name="abonado" id="abonado" class="form-control form-control-alternative" value="" readonly/>
                  </div>
              </div>
              <div class="col-md-4">
                <label for="abono">ABONO</label>
                 <div class='input-group' >
                      <span class="input-group-addon">
                          $
                      </span>
                      <input type="text" name="abono" id="abono" class="form-control form-control-alternative" placeholder="0" onchange="changeSaldo();" max="" onkeyup="maximo(this);" required/>
                  </div>
              </div>
              <div class="col-md-4">
                <label for="saldo">SALDO</label>
                <div class='input-group' >
                      <span class="input-group-addon">
                          $
                      </span>
                      <input type="text" name="saldo" id="saldo" class="form-control form-control-alternative" value="" readonly/>
                  </div>
              </div>
          </div>
          <BR>
          <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="fecha">FECHA</label>
                      <input type="date" name="fecha" id="fecha" class="form-control form-control-alternative" required="" value="<?php echo date("Y-m-d"); ?>"/>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label for="tipo_pago">TIPO PAGO</label>
                      <select class="form-control form-control-alternative" id="tipo_pago" name="tipo_pago" required="">
                          <option value="">SELECCIONE</option>
                          <?php foreach($tipo_pago as $row){ ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                          <?php } ?>
                      </select>
                  </div>
              </div>
          </div>
        </div>
        <div class="box-footer">
        <div class="row" align="center">
            <div class="col-md-12">
                <button id="new-report" data-id="0" onclick="newReport()" type="submit" name="submit" class="btn btn-primary">Crear</button>
            </div>
        </div>
        </div>

        <!-- fin bloque -->
    </div>
    </form>
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
        if(title != 'SELECCIONAR' ){
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

    function changeSaldo(){
        abonado = $('#abonado').val();
        abono = $('#abono').val();
        saldo = $('#saldo').val();
        nuevo = saldo - abono;
        $('#saldo').val(nuevo);

    }

    function maximo(item) {

        if ($(item).val() > $(item).attr('max')*1) {
            $(item).val($(item).attr('max'));
        }
    }

    function newReport(id){
      window.open('<?php echo base_url('reporte') ?>'+'/'+$("#new-report").data('id'), '_blank');
    }

    $('input.check-total').on('change', function() {
        $('input.check-total').not(this).prop('checked', false);
        var id = $(this).val();
        var url = "<?php echo base_url('/abonos/get_saldo'); ?>";
        $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             url: url,
             data:{id:id},
             success:function(response)
             {
                 $("#abono").val(0);
                 var url_form = "<?php echo base_url('/abonos/edit/'); ?>";
                 $("#new-report").attr("data-id",response[0].codigo_venta);
                 $("#abonado").val(response[0].abono);
                 $("#abono").attr({
                   "max" : response[0].saldo
                 });
                 $("#saldo").val(response[0].saldo);
                 $("#factura").val(response[0].codigo_venta);
                 $("#cedula").val(response[0].cedula);
                 $("#cliente").val(response[0].nombres+' '+response[0].apellidos);
                 $('#form-abono').attr('action', url_form+response[0].id).submit();
             }
           });
         });


</script>
