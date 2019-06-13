<?php echo validation_errors(); ?>

<?php echo form_open('usuarios/create'); ?>
    
<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Agregar Usuario</h3>
            </div>
            <div class="box-body">
              
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombres">Nombre</label>
                        <input type="text" name="nombres" id="nombres" class="form-control form-control-alternative" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select name="rol" id="rol" class="form-control form-control-alternative" required>
                            <option value="1">General</option>
                            <option value="0">Administrador</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control form-control-alternative" required/>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control form-control-alternative" required/>
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