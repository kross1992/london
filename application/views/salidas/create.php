<?php echo validation_errors(); ?>

<?php echo form_open('salidas/create'); ?>

<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Agregar Salida</h3>
            </div>
            <div class="box-body">
              <div class="row">
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
                              <option value="<?php echo $proveedores_item['id']; ?>"><?php echo $proveedores_item['nombres']; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="item">Item</label>
                          <select name="item" id="item" class="js-example-basic-single form-control form-control-alternative" required>
                              <?php foreach ($items as $items_item): ?>
                              <option value="<?php echo $items_item['id']; ?>"><?php echo $items_item['descripcion']; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-4">
                    <label for="costo_unidad">Precio Unidad</label>
                    <div class='input-group' >
                        <span class="input-group-addon">
                            $
                        </span>
                        <input type="number" name="costo_unidad" id="costo_unidad" class="form-control form-control-alternative" placeholder="0"  onchange="changeCosto();" required />
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="cantidad">Cantidad</label>
                          <input type="number" name="cantidad" id="cantidad" class="form-control form-control-alternative" placeholder="0" onchange="changeCosto();" required />
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
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="reembolso">Reembolso</label>
                        <input type="number" name="reembolso" id="reembolso" class="form-control form-control-alternative" placeholder="0"  required />
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class='form-group'>
                    <label for="observaciones">Observaciones</label>
                    <textarea id="observaciones" name="observaciones" class="form-control" rows="3" placeholder="Observaciones"></textarea>
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
  $(document).ready(function () {
    $('.js-example-basic-single').select2({width: '100%',});
  });

  function changeCosto(){
    precio = $('#costo_unidad').val();
    cantidad = $('#cantidad').val();
    costo = precio * cantidad;
    $('#costo_total').val(costo);
  }
</script>
