<?php echo validation_errors(); ?>

<?php echo form_open('items/create'); ?>
    
<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Agregar Item</h3>
            </div>
            <div class="box-body">
              
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <input type="text" name="codigo" id="codigo" class="form-control form-control-alternative" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control form-control-alternative" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control form-control-alternative">
                                <?php foreach ($categorias as $categorias_item): ?>
                                <option value="<?php echo $categorias_item['codigo']; ?>"><?php echo $categorias_item['descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="linea">Linea</label>
                            <select name="linea" id="linea" class="form-control form-control-alternative" required>
                                <option value="0">Comercializar</option>
                                <option value="1">Confección</option>
                            </select>
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