<?php echo validation_errors(); ?>

<?php echo form_open('entradas/create'); ?>

<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Agregar Entrada</h3>
            </div>
            <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                      <label for="fecha">Fecha Ingreso</label>
                      <div class="input-group date">
                      <input name="fecha" id="fecha" type="date" class="form-control" placeholder="dd/mm/yyyy" value="<?php echo date("Y-m-d"); ?>" required/>
                       <span class="input-group-addon">
                          <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="factura">Factura</label>
                          <input type="text" name="factura" id="factura" class="form-control form-control-alternative" placeholder="Número Factura"  required />
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="proveedor">Proveedor</label>
                          <select name="proveedor" id="proveedor" class="form-control form-control-alternative" required>
                              <?php foreach ($proveedores as $proveedores_item): ?>
                              <option value="<?php echo $proveedores_item['id']; ?>"><?php echo $proveedores_item['nombres'].' '.$proveedores_item['apellidos']; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="item">Item</label>
                            <select name="item" id="item" class="form-control form-control-alternative" required>
                                <?php foreach ($items as $items_item): ?>
                                <option value="<?php echo $items_item['id']; ?>"><?php echo $items_item['codigo']." - ".$items_item['descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                          <input type="number" name="cantidad" id="cantidad" class="form-control form-control-alternative" onchange="changeCosto();" placeholder="0" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                      <label for="costo_unidad">Precio Unidad</label>
                      <div class='input-group' >
                          <span class="input-group-addon">
                              $
                          </span>
                          <input type="number" name="costo_unidad" id="costo_unidad" class="form-control form-control-alternative" placeholder="0"  onchange="changeCosto();" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <label for="iva">IVA</label>
                    <select name="iva" id="iva" class="form-control form-control-alternative" onchange="changeCosto()" required>
                        <option value="0">No</option>
                        <option value="5">5%</option>
                        <option value="12">12%</option>
                        <option value="16">16%</option>
                        <option value="19" selected>19%</option>
                        <option value="21" >21%</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="precio_unidad_iva">Precio Unidad + IVA</label>
                    <div class='input-group' >
                        <span class="input-group-addon">
                            $
                        </span>
                        <input type="number" name="precio_unidad_iva" id="precio_unidad_iva" class="form-control form-control-alternative" value="0" required />
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="descuento">Descuento</label>
                      <input type="number" name="descuento" id="descuento" class="form-control form-control-alternative" placeholder ="0"  value="0" onchange="changeCosto()"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <label for="precio_detal">Precio Venta Detal</label>
                    <div class='input-group' >
                        <span class="input-group-addon">
                            $
                        </span>
                          <input type="number" name="precio_detal" id="precio_detal" class="form-control form-control-alternative" placeholder="0" value="0" required />
                      </div>
                  </div>
                  <div class="col-md-4">
                      <label for="precio_mayor">Precio Venta Mayor</label>
                      <div class='input-group' >
                          <span class="input-group-addon">
                              $
                          </span>
                          <input type="number" name="precio_mayor" id="precio_mayor" class="form-control form-control-alternative" placeholder="0" value="0" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                      <label for="costo_total">Costo Total</label>
                      <div class='input-group' >
                          <span class="input-group-addon">
                              $
                          </span>
                            <input type="number" name="costo_total" id="costo_total" value="0" class="form-control form-control-alternative" placeholder="0" required />
                        </div>
                    </div>
                </div>
            </div>
                <div class="box-footer">
                <div class="row" align="center">
                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>

          </div>
        </div>
    </div>
</section>
</form>

<script type="text/javascript">
    function changeCosto(){
      precio = $('#costo_unidad').val();
      cantidad = $('#cantidad').val();
      descuento = $('#descuento').val();
      iva = $('#iva').val();
      if(descuento > 100){
        costo = (((precio * iva) / 100)  + parseInt(precio));
        precio_unidad_iva = $('#precio_unidad_iva').val(costo);
        costo = (((precio * iva) / 100)  + parseInt(precio)) * cantidad;
        if(descuento != ""){
          costo = costo - descuento;
        }
        $('#costo_total').val(costo);
      }else{
        costo = (((precio * iva) / 100)  + parseInt(precio));
        precio_unidad_iva = $('#precio_unidad_iva').val(costo);
        costo = (((precio * iva) / 100)  + parseInt(precio)) * cantidad;
        if(descuento != ""){
          descuento_total = ((costo * descuento) / 100);
          costo = costo - descuento_total;
        }
        $('#costo_total').val(costo);
      }
    }

</script>
