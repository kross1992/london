<div class="container">
  <div class="box box-primary">
    <div class="box-header with-border">
      <i class="fa fa-fw fa-search"></i>
      <h3 class="box-title">Lista de Notas</h3>
    </div>
    <div class="box-body">
      <center>
        <table id='tabla' >
          <thead id='cabecera_datos'>
            <tr style='text-align: center;'>
              <th class='titulos'>Factura</th>
              <th class='titulos'>Fecha</th>
              <th class='titulos'>Identificacion</th>
              <th class='titulos'>Cliente</th>
              <th class='titulos'>Motivo</th>
              <th class='titulos'>Precio</th>
<!--              <th class='titulos'>VER</th>
              <th class='titulos'>ANULAR</th> -->
            </tr>
          </thead>
          <tbody id='contenido_datos'>
            <?php
            $i = 0;
            foreach ($notas as $row): 
              if($i % 2 == 0){
                $back = "white";
              }
              else{
                $back = "#ECECEC";
              }
              ?>
            <tr class="<?php echo $back; ?>" style="text-align: center; background-color: <?php echo $back; ?>; height: 5px !important;">
                <td><?php echo $row['codigo_venta']; ?></td>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['cedula'];?></td>
                <td><?php echo ucfirst($row['nombre_cliente']) . ' ' . $row['apellido_cliente']; ?></td>
                <td><?php echo $row['motivo']; ?></td>
                <td><?php echo number_format($row['valor_total']); ?></td>
<!--                <td><a href="<?php echo base_url('Ventas/get_detalles_venta/' . $row['codigo_venta']); ?>"><i class="fa fa-eye"></i></a></td> 
                <td><a id="<?php echo $row['id']; ?>" href="#" onclick="anular(this.id);"><i class="fa fa-times"></i></a></td> -->
              </tr>
            <?php 
            $i++;
            endforeach; ?>
          </tbody>
        </table>
      </center>
    </div>
    <div class="box-footer">
      <div class="row" align="center">
        <div class="col-md-12">
          <a href="<?php echo base_url('notas/create') ?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Nueva Nota</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    
    $(document).ready(function() {
       
    });
    
   $('#tabla').DataTable({
   	    "scrollCollapse": true,
            "order": [[ 1, "desc" ]],
   	    "language": {
   	        url: "<?php echo base_url('assets/datatables/languages/Spanish.json'); ?>"
   	    },
   	    responsive: true
   	});
	
</script>