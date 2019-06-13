<?php echo validation_errors(); ?>

<?php echo form_open('notas/create', 'id="createForm"'); ?>
<section>
  <br>
  <div class="container">
    <div class="box box-primary">
      <div class="box-body">
        <div class="wizard">
          <div class="wizard-inner">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Datos Iniciales">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-info-sign"></i>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-usd"></i>
                  </span>
                </a>
              </li>
              <li role="presentation" class="disabled">
                <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                  <span class="round-tab">
                    <i class="glyphicon glyphicon-ok"></i>
                  </span>
                </a>
              </li>
            </ul>
          </div>
          <form role="form">
            <div class="tab-content">
              <div class="tab-pane active" role="tabpanel" id="step1">
                <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                    <div class="form-group">
                      <label>Fecha:</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="form-group">
                      <label>Cliente:</label>
                      <select id="cliente" name="cliente" onchange="buscar_facturas();" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true"  data-placeholder="Seelccione">
                        <?php foreach ($clientes as $row) { ?>
                          <option></option>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['cedula'] . " - " . $row['nombres'] . " " . $row['apellidos'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Motivo:</label>
                      <select id="motivo" name="motivo" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true"  data-placeholder="Seelccione" onchange="select_motivo();">
                        <?php foreach ($tipos_nota as $row) { ?>
                          <option></option>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <ul class="list-inline" align="center">
                  <li><button type="button" class="btn btn-primary next-step">Guardar y continuar</button></li>
                </ul>
              </div>
              <div class="tab-pane" role="tabpanel" id="step2">
                <div class="row">
                  <br>
                  <div class="row" id="div_motivo_1" style="display: hide;">
                      <div class="col-md-8 col-md-offset-2" id="div_facturas"></div>
                      <div class="col-md-8 col-md-offset-2">
                      <div class="form-group" id="div_detalles_fact"></div>
                    </div>
                  </div>
                  <div class="row" id="div_motivo_2" style="display: none;">
                    
                  </div>
                  <br><br>
                  <ul class="list-inline" align="center">
                    <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                    <!-- <li><button type="button" class="btn btn-default next-step">Skip</button></li> -->
                    <li><button type="button" class="btn btn-primary btn-info-full next-step">Guardar y continuar</button></li>
                  </ul>
                </div>
              </div>
              <div class="tab-pane" role="tabpanel" id="step3">
                <h3>Tipos de Pago</h3>

                <div class="row">
                  <div class="col-md-12">
                    <br>
                    <input type="hidden" id="cantPagos" name="cantPagos" value="1" />
                    <table id='tabla_pagos' class='display compact cell-border dataTable no-footer'>
                      <thead>
                        <tr>
                          <th>TIPO DE PAGO</th>
                          <th>TOTAL</th>
                          <th>ELIMINAR</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <!-- style="width: 90%; height:30px;" -->
                          <td>
                            <select name="tipo_pago1" id="tipo_pago1" class="js-example-basic-single" required>
                              <option>Seleccione</option>
                              <?php foreach ($tipos_pago as $tipos_item): ?>
                                <option value="<?php echo $tipos_item['id']; ?>"><?php echo $tipos_item['nombre']; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </td>

                          <td>
                            <input id="totalP1" name="totalP1" type="number" placeholder="$ 0" class="form-control form-control-alternative" onchange="changePago();" required/>
                          </td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row" align="right">
                  <div class="col-md-12">
                    <a onclick="agregarPago();">
                      <i class="fa fa-plus-circle fa-2x"></i>
                    </a>
                  </div>
                </div>
                <ul class="list-inline" align="center">
                  <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                  <li><button type="button" class="btn btn-primary next-step">Guardar y continuar</button></li>
                </ul>
              </div>

              <div class="tab-pane" role="tabpanel" id="complete">
                <h3>Terminar</h3>
                <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="costo_total">Total Venta</label>
                      <input type="number" name="costo_total" id="costo_total" class="form-control form-control-alternative" required/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="pago_total">Total Pago</label>
                      <input type="number" name="pago_total" id="pago_total" class="form-control form-control-alternative" required/>
                    </div>
                  </div>
                  <div class="col-md-2"></div>
                </div>
                <div class="row" align="center">
                  <div class="col-md-12">
                    <!-- <button id="btnGuardar" type="button" class="btn btn-primary" >Crear</button> -->
                    <button id="btnModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ventaModal" >Guardar y Finalizar</button>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section> 
</form> 

<div class="modal fade bs-info-modal-sm" id="ventaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span></button>
                <h4 class="modal-title">Finalizar Venta</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" align="center">
                        <div class="group">
                            <label for="efectivo">Efectivo</label>
                            <input type="number" name="efectivo" id="efectivo" class="form-control form-control-alternative" readonly=""/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" align="center">
                        <div class="group">
                            <label for="entrega">Entrega</label>
                            <input type="number" name="entrega" id="entrega" onchange="changeDevuelve();" class="form-control form-control-alternative" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" align="center">
                        <div class="group">
                            <label for="devuelve">Devuelve</label>
                            <input type="number" name="devuelve" id="devuelve" class="form-control form-control-alternative" readonly=""/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" align="center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="btnCrear" type="submit" name="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>  

<!-- Modal -->
<?php echo form_open('ventas/create_cliente', 'id="clienteForm"'); ?>
<div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Crear cliente</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cedula">Cedula</label>
                            <input type="text" name="cedula" id="cedula" class="form-control form-control-alternative" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control form-control-alternative" required/>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control form-control-alternative" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input name="fecha" id="fecha" type="date" class="form-control" placeholder="dd/mm/aaaa" required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-alternative"  />
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control form-control-alternative" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input type="text" name="empresa" id="empresa" class="form-control form-control-alternative"  />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion1">Direccion Casa</label>
                            <input type="text" name="direccion1" id="direccion1" class="form-control form-control-alternative"  />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion2">Direccion Trabajo</label>
                            <input type="text" name="direccion2" id="direccion2" class="form-control form-control-alternative"  />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="btnCrearCliente" type="submit" name="submit" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">

.wizard {
    margin: 20px auto;
    background: #fff;
}

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 25%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style> 
<script type="text/javascript">
  
  //iCheck for checkbox and radio inputs
    
  
  $('#datepicker').datepicker({
        autoclose: true
    });
    
  function select_motivo(){
    var opcion = $("#motivo").val();
    $.ajax({
          url: "<?php echo base_url(); ?>notas/get_tipo_motivo_fact",
          type: 'POST',
          data: {id: opcion},
          success: function (data) {
            if(data === "1"){
              $("#div_motivo_1").show();
              $("#div_motivo_2").hide();
            }else{
              $("#div_motivo_1").hide();
              $("#div_motivo_2").show();
            }
          }
      });
  }
  
  function buscar_facturas(){
    var opcion = $("#cliente").val();
    var div = $("#div_facturas");
    $.ajax({
      url: "<?php echo base_url(); ?>notas/buscar_facturas",
      type: 'POST',
      data: {id: opcion},
      success: function (data) {
        data=JSON.parse(data);
        var select = '<select id="select_fact" onChange="items_fact();" class="form-control select2 " style="width: 80%;"><option></option>';
        $.each(data, function(i, item) {
          select += '<option value="' + item["codigo_venta"] +'">Fact: ' + item["codigo_venta"] + ' // ' + item["tipo"] + ' // ' + item["fecha_fact"] + ' // ' + format_number(item["costo_total"]) + '</option>';
        });
        select += '</select>';
        $(div).html(select);
      }
    });
  }
  
  function items_fact(){
    var fact_id = $("#select_fact").val();
    var div = $("#div_detalles_fact");
    $.ajax({
      url: "<?php echo base_url(); ?>notas/buscar_items_fact",
      type: 'POST',
      data: {id: fact_id},
      success: function (data) {
        data=JSON.parse(data);
        var checks = '';
        $.each(data, function(i, item) {
          checks += '<label>' + item["codigo"] +' - '+ item["descripcion"] + item["descripcion"] + '</label> - ';
          checks += '<select value="'+ item["descripcion"] +'">';
          for(i=0; i<=item["cantidad"]; i++){
            checks += '<option>'+ i +'</option>';
          }
          checks += '</select>';
//          checks += '<label class=""><div class="icheckbox_minimal-blue" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" class="minimal" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>' + item["codigo"] +' - '+ item["descripcion"] + '</label><br>';
        });
        $(div).html(checks);
      }
    });
//    $('input[type="checkbox"].minimal').iCheck({ checkboxClass: 'icheckbox_minimal-blue' });
  }
  

	$(document).ready(function () {
      
      $('.select2').select2({width: '100%'}); 
      
      
        $('.js-example-basic-single').select2({width: '100%'});
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();
        
        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);
        
            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });

        $(".next-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);

        });
        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });
    });


    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }

    $("#btnCrear").click(function () {
        var codigo = $('#codigo_venta').val();
        var fecha = $('#fecha').val();
        var costo = parseInt($('#costo_total').val());
        var tipo = $('#tipo_venta').val();
        var pago_total = $('#pago_total').val();
        var cliente = $('#cliente').val();
        var plazo = $('#plazo').val();
        var periodicidad = $('#periodicidad').val();
        //var efectivo = parseInt($('#efectivo').val());
        //var abono_separado = parseInt($('#abono_separado').val());
        //console.log('abono_separado');
        
       /* if(tipo=='3'){
            console.log("entra");
            changeDevuelve();
        }*/
        
        if (fecha == '') {
            swal('Advertencia', 'La fecha no puede estar vacia');
            return false;
        } else if (codigo == '') {
            swal('Advertencia', 'El codigo no puede estar vacio');
            return false;
        } else if (costo == '' || costo == 0) {
            swal('Advertencia', 'El total de la factura no puede ser vacio o cero');
            return false;
        } else if (tipo != '1' && cliente == '0') {
            swal('Advertencia', 'El cliente es requerido para este tipo de venta');
            return false;
        } else if (tipo != '1' && plazo == '0') {
            swal('Advertencia', 'El plazo es requerido para este tipo de venta');
            return false;
        } else if (tipo != '1' && periodicidad == '0') {
            swal('Advertencia', 'La periodicidad es requerida para este tipo de venta');
            return false;
        } else if (tipo == 1 && pago_total < costo) {
            swal('Advertencia', 'El efectivo recibido no puede ser inferior al total de la venta');
            return false;
        } /*else if (tipo == '3' && abono_separado <= 0) {
            swal('Advertencia', 'Ventas por separado solicita Monto a Abonar');
            return false;
        }*/
        swal({
            title: "Esta seguro de querer guardar?",
            text: "Asegurese de confirmar los datos ingresados",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-confirm",
            confirmButtonText: "Guardar",
            closeOnConfirm: true
        },
                function () {
                    var url = "<?php echo base_url('ventas/create1') ?>"; // El script a dónde se realizará la petición.

                    $.ajax({
                        type: "POST",
                        url: url,
                        dataType: 'json',
                        //data: form.serialize(),
                        data: $("#createForm").serializeArray(),
                        success: function (data)
                        {
                            console.log(data);
                            try
                            {
                                ret = data;//$.parseJSON(data);
                                console.log(ret);
                                if (ret.error === 'Y') {                                    
                                    swal("Error", ret.message, "error");
                                } else {
                                    swal("Hecho!", ret.message, "success");
                                    window.open("<?php echo base_url('reporte') ?>" + "/" + codigo, '_blank');
                                    function redirect_delay() {
                                        location.reload(true);
                                    }
                                    setTimeout(redirect_delay, 3000);
                                }
                            } catch (e) {
                                console.log(e);
                                return false;
                            }
                        },
                        error: function (data) {
                            console.log('An error occurred.');
                            console.log(data);
                        }
                    });

                });
        return false;

    });
    
    $("#btnCrearCliente").click(function () {
        var cedula = $('#cedula').val();
        var nombre = $('#nombres').val();
        var apellido = $('#apellidos').val();
        
        
        
        if (cedula == '') {
            swal('Advertencia', 'La cedula no puede estar vacia');
            return false;
        } else if (nombre == '') {
            swal('Advertencia', 'El nombre no puede estar vacio');
            return false;
        } /*else if (apellido == '') {
            swal('Advertencia', 'El apellido no puede ser vacio');
            return false;
        } */
        swal({
            title: "Esta seguro de crear este cliente?",
            text: "Asegurese de confirmar los datos ingresados",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-confirm",
            confirmButtonText: "Guardar",
            closeOnConfirm: true
        },
                function () {
                    var url = "<?php echo base_url('ventas/create_cliente') ?>"; // El script a dónde se realizará la petición.

                    $.ajax({
                        type: "POST",
                        url: url,
                        dataType: 'json',
                        //data: form.serialize(),
                        data: $("#clienteForm").serializeArray(),
                        success: function (data)
                        {
                            console.log(data);
                            if (data == 0){
                                swal("Error", "error al crear el cliente", "error");
                            } else {
                                var newOption = new Option($("#nombres").val()+' '+$("#apellidos").val(), data, false, true);
                                $('#cliente').append(newOption).trigger('change');
                                $('#clienteModal').modal('hide');
                            }
                            
                        },
                        error: function (data) {
                            console.log('An error occurred.');
                            // console.log(data);
                            // console.log(data.responseText);
                        }
                    });

                });
        return false;

    });

    /*$("#btnGuardar").click(function () {
        document.getElementById("btnModal").click();
        changeDevuelve();
    });*/

   

    function mostrarPlazo(){
        if ($("#tipo_venta").val()!=1){
            $("#rowPlazo").show();
        } else {
            $("#rowPlazo").hide();
        }
    }

    function maximo(item) {
        if ($(item).val() > $(item).attr('max') * 1) {
            $(item).val($(item).attr('max'));
        }
    }

    function agregarDetalle() {
        var i = parseInt($('#cantDetalles').val()) + 1;
        $('#cantDetalles').val(i);

        $('#tabla_detalles tr:last').after('<tr>' +
                '<td><select id="codigo' + i + '" name="codigo' + i + '" class="js-example-basic-single" onchange="changeItem(this);" required><option>Seleccione</option>' +
                <?php
                $option = '';
                foreach ($items as $items_item):
                    $option .= '<option value="' . $items_item['id'] . '">' . $items_item['codigo'] . ' - ' . $items_item['descripcion'] . '</option>';
                endforeach;
                echo "'" . $option . "'";
                ?> + '</td>' +
                '<td><input id="precio' + i + '" name="precio' + i + '" type="number" placeholder="$ 0" class="form-control form-control-alternative" onchange="changeCosto(this.id.substr(6));" required/></td>' +
                '<td><input id="desc' + i + '" name="desc' + i + '" type="number" placeholder="%" class="form-control form-control-alternative" onchange="changeCosto(this.id.substr(4));" required/></td>' +
                '<td><input id="cantidad' + i + '" name="cantidad' + i + '" type="number" placeholder="0" class="form-control form-control-alternative" onchange="changeCosto(this.id.substr(8));" onkeyup="maximo(this);" required/></td>' +
                '<td><input id="total' + i + '" name="total' + i + '" type="number" placeholder="$ 0" class="form-control form-control-alternative" onchange="changeCostoTotal();" required/></td>' +
                '<td align="center"><a onclick="eliminarDetalle(this)"><i class="fa fa-fw fa-close"></i></a></td></tr>');

         // $("#codigo"+i).select2({width: '100%'});
         $('.js-example-basic-single').select2({width: '100%'});
    }

    function eliminarDetalle(row) {
        $('#cantDetalles').val($('#cantDetalles').val() - 1);
        $(row).closest("tr").remove();
        changeCostoTotal();
        return false;
    }

    function agregarPago() {
        var i = parseInt($('#cantPagos').val()) + 1;
        $('#cantPagos').val(i);

        $('#tabla_pagos tr:last').after('<tr>' +
                '<td><select id="tipo_pago' + i + '" name="tipo_pago' + i + '" class="js-example-basic-single"  required><option>Seleccione</option>' +
                <?php
                $option = '';
                foreach ($tipos_pago as $tipos_item):
                    $option .= '<option value="' . $tipos_item['id'] . '">' . $tipos_item['nombre'] . '</option>';
                endforeach;
                echo "'" . $option . "'";
                ?> + '</td>' +
                '<td><input id="totalP' + i + '" name="totalP' + i + '" type="number" placeholder="$ 0" class="form-control form-control-alternative" onchange="changePago();" required/></td>' +
                '<td align="center"><a onclick="eliminarPago(this)"><i class="fa fa-fw fa-close"></i></a></td></tr>');

         // $("#codigo"+i).select2({width: '100%'});
         $('.js-example-basic-single').select2({width: '100%'});
    }

    function eliminarPago(row) {
        $('#cantPagos').val($('#cantPagos').val() - 1);
        $(row).closest("tr").remove();
        return false;
    }

    function changeItem(option) {
        var array = <?php echo json_encode($items); ?>;
        for (var i = 0; i < array.length; i++) {
            if (array[i]['id'] == option.value) {
                $('#precio' + option.id.substr(6)).val(array[i]['precio']);
                document.getElementById("cantidad" + option.id.substr(6)).max = array[i]['cantidad'];
            }
        }
    }

    function changeCosto(id) {
        precio = $('#precio' + id).val();
        desc = $('#desc' + id).val();
        cantidad = $('#cantidad' + id).val();
        costo = (precio - (precio * desc/100) ) * cantidad;
        $('#total' + id).val(costo);

        changeCostoTotal();
    }

    function changeCostoTotal() {
        var cant = parseInt($('#cantDetalles').val());
        var costo = 0;
        for (var i = 1; i <= cant; i++) {
            precio = $('#precio' + i).val();
            desc = $('#desc' + i).val();
            cantidad = $('#cantidad' + i).val();
            costo += (precio - (precio * desc/100) ) * cantidad;
        }
        $('#costo_total').val(costo);
        $('#total').val(costo);
    }

    function changePago() {
        var cant = parseInt($('#cantPagos').val());
        var total = 0;
        var efectivo = 0;
        var pago = 0;
        for (var i = 1; i <= cant; i++) {
            pago = $('#totalP' + i).val() * 1;
            if ($('#tipo_pago' + i).val()==1){
                efectivo += pago;
            }
            total += pago;
        }
        console.log(total);
        console.log(efectivo);
        $('#pago_total').val(total);
        $('#efectivo').val(efectivo);
    }

    function changeDevuelve() {
        var efectivo = $('#efectivo').val();
        var entrega = $('#entrega').val();
        
        $('#devuelve').val(entrega-efectivo);
    }

    function format_number(number) {
        var nf = new Intl.NumberFormat(["en-US"], {
            style: "currency",
            currency: "USD",
            currencyDisplay: "symbol",
            maximumFractionDigit: 1
        });
        return nf.format(number);
    }
</script>      	