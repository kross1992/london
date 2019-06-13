<div class="container">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fa fa-fw fa-search"></i>
            <h3 class="box-title">Lista de Items</h3>
        </div>
        <div class="box-body">
            <div>
                <?php echo form_open_multipart('items/import'); ?>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary">
                                            Buscar &hellip;
                                            <input type="file" name="archivo" class="form-control" style="display: none;">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"><input id="btnSubir" type="submit" class="btn btn-primary" value="Importar desde excel"></div>
                        <div class="col-md-1"></div>
                    </div>
                </form>
            </div>
            <center>
                <table id='tabla_datos' border='1'>
                    <thead id='cabecera_datos'>
                        <tr style='text-align: center;'>
                            <th class='titulos'>REFERENCIA</th>
                            <th class='titulos'>DESCRIPCION</th>
                            <th class='titulos'>CATEGORIA</th>
                            <th class='titulos'>LINEA</th>
                            <th class='titulos'>EDITAR</th>
                        </tr>
                    </thead>
                    <tbody id='contenido_datos'>
                        <?php foreach ($items as $items_item): ?>
                            <tr style='text-align: center;'>
                                <td><?php echo $items_item['codigo']; ?></td>
                                <td><?php echo $items_item['descripcion']; ?></td>
                                <td><?php echo $items_item['nom_categoria']; ?></td>
                                <td><?php echo $items_item['linea'] == 0 ? 'Comercial':'Confeccion'; ?></td>
                                <td><a href="<?php echo base_url('items/edit/'.$items_item['id']); ?>"><i class="fa fa-edit fa-2x"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </center>
        </div>
        <div class="box-footer">
            <div class="row" align="center">
                <div class="col-md-12">
                    <a href="<?php echo base_url('items/create')?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Crear Nuevo</a>
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

    $(document).on('change', ':file', function(){
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });
	
    $(document).ready(function(){
        $(':file').on('fileselect', function(event, numFiles, label){
            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' archivos adjuntos' : label;
            if(input.length){
                input.val(log);
            } else {
                if (log) alert(log);
            }
        });
    });

</script>