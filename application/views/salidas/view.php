
<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Ver Salida</h3>
            </div>
            <div class="box-body">
              
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="proveedor">Proveedor</label>
                        <select name="proveedor" id="proveedor" class="form-control form-control-alternative" required>
                            <?php foreach ($proveedores as $proveedores_item): ?>
                            <option value="<?php echo $proveedores_item['id']; ?>"><?php echo $proveedores_item['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="item">Item</label>
                        <select name="item" id="item" class="form-control form-control-alternative" required>
                            <?php foreach ($items as $items_item): ?>
                            <option value="<?php echo $items_item['id']; ?>"><?php echo $items_item['descripcion']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control form-control-alternative" value="<?php echo $salidas_item['cantidad']; ?>" required />
                    </div>
                </div>
            </div>


            <!-- <div class="row" align="center">
                <div class="col-md-12">
                    <button type="submit" name="submit" class="btn btn-primary">Crear</button>
                </div>

            </div> -->

          </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).on("ready", function () {
       $('#proveedor').val(<?php echo $salidas_item['proveedor']; ?>).change();
       $('#item').val(<?php echo $salidas_item['item']; ?>).change();

    });
</script>