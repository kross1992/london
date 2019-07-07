

<?php echo form_open('resolucion/edit/'.$resolucion['id']); ?>

<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Editar Resolución</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                      <?php echo validation_errors(); ?>
                      <label for="texto">Descripción Resolución</label>
                        <div class="form-group">
                            <textarea name="texto_resolucion" class="form-control" id="texto_resolucion" rows="10" cols="50" required><?php echo $resolucion['texto_resolucion']; ?></textarea>
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
