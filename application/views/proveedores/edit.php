<?php echo validation_errors(); ?>

<?php echo form_open('proveedores/edit/'.$proveedores_item['id']); ?>
    
<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Editar Proveedor</h3>
            </div>
            <div class="box-body">
              
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="identificacion">Identificación</label>
                            <input type="text" name="identificacion" id="identificacion" class="form-control form-control-alternative" value="<?php echo $proveedores_item['identificacion']; ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control form-control-alternative" value="<?php echo $proveedores_item['nombres']; ?>" required/>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control form-control-alternative" value="<?php echo $proveedores_item['apellidos']; ?>"  />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input type="text" name="direccion" id="direccion" class="form-control form-control-alternative" value="<?php echo $proveedores_item['direccion']; ?>"  />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-alternative" value="<?php echo $proveedores_item['telefono']; ?>" />
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control form-control-alternative" value="<?php echo $proveedores_item['celular']; ?>" />
                        </div>
                    </div>
                </div>
                
                </div>
                <div class="box-footer">
                <div class="row" align="center">
                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary">Editar</button>
                    </div>

                </div>

          </div>
        </div>
    </div>
</section>
</form>