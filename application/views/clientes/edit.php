<?php echo validation_errors(); ?>

<?php echo form_open('clientes/edit/'.$clientes_item['id']); ?>

<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Editar Cliente</h3>
            </div>
            <div class="box-body">
              
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cedula">Cedula</label>
                            <input type="text" name="cedula" id="cedula" class="form-control form-control-alternative" value="<?php echo $clientes_item['cedula']; ?>" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control form-control-alternative" value="<?php echo $clientes_item['nombres']; ?>" required/>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control form-control-alternative" value="<?php echo $clientes_item['apellidos']; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha">Fecha de Nacimiento</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input name="fecha" id="fecha" class="form-control datepicker" placeholder="mm/dd/aaaa" type="text" value="<?php echo $clientes_item['fecha_nacimiento']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-alternative" value="<?php echo $clientes_item['telefono']; ?>" />
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control form-control-alternative" value="<?php echo $clientes_item['celular']; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" name="empresa" id="empresa" class="form-control form-control-alternative" value="<?php echo $clientes_item['empresa']; ?>"  />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion1">Direccion Casa</label>
                            <input type="text" name="direccion1" id="direccion1" class="form-control form-control-alternative" value="<?php echo $clientes_item['direccion1']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion2">Direccion Trabajo</label>
                            <input type="text" name="direccion2" id="direccion2" class="form-control form-control-alternative" value="<?php echo $clientes_item['direccion2']; ?>" />
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