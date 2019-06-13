<?php echo validation_errors(); 

ini_set('date.timezone','America/Bogota'); 
?>

<?php echo form_open('abonos/edit/'.$abonos_item['id']); ?>
    
<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Editar Abono</h3>
            </div>
            <div class="box-body">
              
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="abonado">Abonado</label>
                            <input type="text" name="abonado" id="abonado" class="form-control form-control-alternative" value="<?php echo $abonos_item['abono']; ?>" readonly/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="abono">Abono</label>
                            <input type="text" name="abono" id="abono" class="form-control form-control-alternative" placeholder="0" onchange="changeSaldo();" max="<?php echo ($abonos_item['saldo']); ?>" onkeyup="maximo(this);" required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="saldo">Saldo</label>
                            <input type="text" name="saldo" id="saldo" class="form-control form-control-alternative" value="<?php echo $abonos_item['saldo']; ?>" readonly/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control form-control-alternative" value="<?php echo date("Y/m/d"); ?>" required="" />
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
                        <button onclick="window.open('<?php echo base_url('reporte') ?>'+'/'+<?php echo $abonos_item['id']; ?>, '_blank');" type="submit" name="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
              
          </div>
        </div>
    </div>
</section>
</form>

<script type="text/javascript">
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
</script>