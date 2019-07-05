<style>
td:nth-child(2) {
  width: 100%;
}
</style>
<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-search"></i>
            <h3 class="box-title">Lista De Inventario</h3>
        </div>
        <div class="box-body">
            <center>
                <table id='tabla_datos' class="table" border="1">
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
              exportOptions: {
                  columns: [ 0, 1, 2 ]
              }
          },
          {
              extend: 'csvHtml5',
              exportOptions: {
                  columns: [ 0, 1, 2 ]
              }
          },
          {
              extend: 'pdfHtml5',
              footer: true,
              title: 'INVENTARIO HASTA LA FECHA',
              exportOptions: {
                  columns: [ 0, 1, 2 ]
              },
              customize: function (doc) {

                var tblBody = doc.content[1].table.body;
                // ***
                //This section creates a grid border layout
                // ***
                doc.content[1].layout = {
                hLineWidth: function(i, node) {
                    return (i === 0 || i === node.table.body.length) ? 1 : 1;},
                vLineWidth: function(i, node) {
                    return (i === 0 || i === node.table.widths.length) ? 1 : 1;},
                hLineColor: function(i, node) {
                    return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';},
                vLineColor: function(i, node) {
                    return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';}
                };
                // ***
                //This section loops thru each row in table looking for where either
                //the second or third cell is empty.
                //If both cells empty changes rows background color to '#FFF9C4'
                //if only the third cell is empty changes background color to '#FFFDE7'
                // ***
                doc.content[1].table.widths =  Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                $('#tabla_datos').find('tr').each(function (ix, row) {
                    var index = ix;
                    var rowElt = row;
                    $(row).find('td').each(function (ind, elt) {
                        if (tblBody[index][1].text == '' && tblBody[index][2].text == '') {
                            delete tblBody[index][ind].style;
                            tblBody[index][ind].fillColor = '#FFF9C4';
                        }
                        else
                        {
                            if (tblBody[index][2].text == '') {
                                delete tblBody[index][ind].style;
                                tblBody[index][ind].fillColor = '#FFFDE7';
                            }
                        }
                    });
                });
            }
          }
        ]
    } );

</script>
