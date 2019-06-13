<?php echo validation_errors(); ?>

<?php echo form_open('categorias/edit/'.$categorias_item['id']); ?>
    
<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Editar Categoria</h3>
            </div>
            <div class="box-body">
              
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="codigo">Codigo</label>
                            <input type="text" name="codigo" id="codigo" class="form-control form-control-alternative" value="<?php echo $categorias_item['codigo']; ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control form-control-alternative" value="<?php echo $categorias_item['descripcion']; ?>" required/>
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