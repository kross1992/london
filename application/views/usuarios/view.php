
<section class="section">
	<div class="container">
		<div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Ver Usuario</h3>
            </div>
            <div class="box-body">
                <div class="row justify-content-center">
                  <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                      <a href="#">
                        <img src="<?php echo base_url('assets/images/user.png');?>" class="rounded-circle" height="200" width="200">
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                    <div class="card-profile-actions py-4 mt-lg-0">
                      <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                      <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                    </div>
                  </div>
                  <div class="col-lg-4 order-lg-1">

                  </div>
                </div>
                <div class="text-center mt-5">
                  <h3><?php echo $clientes_item['nombres'].' '.$clientes_item['apellidos']; ?>
                    <span class="font-weight-light"></span>
                  </h3>
                  <div class="h6 font-weight-300"><?php echo 'Identificación: '.$clientes_item['cedula']; ?></div>
                  <div class="h6 mt-4"><?php echo 'Telefono: '.$clientes_item['telefono']; ?></div>
                  <div class="h6 mt-4"><?php echo 'Celular: '.$clientes_item['celular']; ?></div>
                </div>
                <div class="mt-5 py-5 border-top text-center">
                  <div class="row justify-content-center">
                    <div class="col-lg-9">
                      <p><?php echo 'Dirección del hogar: '.$clientes_item['direccion1']; ?></p>
                    </div>
                  </div>
                </div>
		  </div>
		</div>
	</div>
</section>

