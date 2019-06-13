<?php echo validation_errors(); ?>

<?php echo form_open('ventas/create', 'id="createForm"'); ?>
<section class="section">
    <div class="container">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-fw fa-plus"></i>
                <h3 class="box-title">Agregar Venta</h3>
            </div>
            <div class="box-body">
                <!--<div class="card-body px-lg-5 py-lg-5">-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="codigo_venta">Nro Factura</label>
                            <input readonly="" type="text" name="codigo_venta" id="codigo_venta" class="form-control form-control-alternative"  required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <div class="input-group date" id="datetimepickerFecha">
                                <input type="text" class="form-control" id="fecha" name="fecha" placeholder="aaaa-mm-dd hh:mm"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <!-- <input name="fecha" id="fecha" type="datetime" class="form-control" placeholder="dd/mm/yyyy" value="<?php echo date("Y-m-d"); ?>" required/> -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipo_venta">Tipo Venta</label>
                            <select name="tipo_venta" id="tipo_venta" class="form-control form-control-alternative" required>
                                <!-- <option value="0">Contado</option>
                                <option value="1">Credito</option>
                                <option value="2">Separado</option> -->
                                <?php foreach ($tipos_venta as $tipos_item): ?>
                                    <option value="<?php echo $tipos_item['id']; ?>"><?php echo $tipos_item['descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div id="div-cliente" class="col-md-4">
                        <div class="form-group">
                            <label for="cliente">Cliente</label>
                            <select class="js-example-basic-single" name="cliente" id="cliente" class="form-control form-control-alternative">
                                <option value="0">N/A</option>
                                <?php foreach ($clientes as $clientes_item): ?>
                                    <option value="<?php echo $clientes_item['id']; ?>"><?php echo $clientes_item['nombres'] . ' ' . $clientes_item['apellidos']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <a data-toggle="modal" data-target="#clienteModal">
                                <i class="fa fa-plus-circle fa-2x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipo_pago">Tipo Pago</label>
                            <select name="tipo_pago" id="tipo_pago" class="form-control form-control-alternative" required>
                                <option value="">Seleccione</option>
                                <?php foreach ($tipos_pago as $tipos_item): ?>
                                    <option value="<?php echo $tipos_item['id']; ?>"><?php echo $tipos_item['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="abono_separado">Monto Abonar</label>
                            <input type="number" name="abono_separado" id="abono_separado" class="form-control form-control-alternative" value="0" />
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <input type="hidden" id="cantDetalles" name="cantDetalles" value="1" />
                        <table id='tabla_detalles' class='display compact cell-border dataTable no-footer'>
                            <thead>
                                <tr>
                                    <th style="width: 30%">ITEM</th>
                                    <th>PRECIO</th>
                                    <th>CANTIDAD</th>
                                    <th>TOTAL</th>
                                    <th>ELIMINAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- style="width: 90%; height:30px;" -->
                                    <td>
                                        <select name="codigo1" id="codigo1" class="js-example-basic-single" onchange="changeItem(this);" required>
                                            <option>Seleccione</option>
                                            <?php foreach ($items as $items_item): ?>
                                                <option value="<?php echo $items_item['id']; ?>"><?php echo $items_item['codigo'] . ' - ' . $items_item['descripcion']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input id="precio1" name="precio1" type="number" placeholder="$ 0" class="form-control form-control-alternative" onchange="changeCosto(this.id.substr(6));" required/>
                                    </td>
                                    <td>
                                        <input id="cantidad1" name="cantidad1" type="number" placeholder="0" class="form-control form-control-alternative" onchange="changeCosto(this.id.substr(8));" onkeyup="maximo(this);" required />
                                    </td>
                                    <td>
                                        <input id="total1" name="total1" type="number" placeholder="$ 0" class="form-control form-control-alternative" onchange="changeCostoTotal();" required/>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row" align="right">
                    <div class="col-md-12">
                        <a onclick="agregarDetalle();">
                            <i class="fa fa-plus-circle fa-2x"></i>
                        </a>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="costo">Costo</label>
                            <input type="text" name="costo" id="costo" class="form-control form-control-alternative"  />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="iva">Iva</label>
                            <input type="datetime" name="iva" id="iva" class="form-control form-control-alternative" />
                        </div>
                    </div> -->
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="costo_total">Costo Total</label>
                            <input type="datetime" name="costo_total" id="costo_total" class="form-control form-control-alternative" required/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <br/>
            </div>
            <div class="box-footer">
                <div class="row" align="center">
                    <div class="col-md-12">
                        <button id="btnGuardar" type="button" class="btn btn-primary" >Crear</button>
                        <button id="btnModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ventaModal" style="display: none">Crear</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="ventaModal" tabindex="-1" role="dialog" aria-labelledby="ventaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8" align="center">
                        <div class="group">
                            <label for="total">Total</label>
                            <input type="number" name="total" id="total" class="form-control form-control-alternative" readonly=""/>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8" align="center">
                        <div class="group">
                            <label for="efectivo">Efectivo</label>
                            <input type="number" name="efectivo" id="efectivo" class="form-control form-control-alternative" onchange="changeDevuelve();" />
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8" align="center">
                        <div class="group">
                            <label for="devuelve">Devuelve</label>
                            <input type="text" name="devuelve" id="devuelve" class="form-control form-control-alternative" readonly=""/>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="btnCrear" type="submit" name="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
</form>

<!-- Modal -->
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

<script type="text/javascript">
    $(document).on("ready", function () {
        $('#codigo_venta').val("<?php echo $max_factura['codigo_venta'] + 1; ?>");
		//$('cliente').select2({width: '100%'});
        $('.js-example-basic-single').select2({width: '100%'});

        //console.log(<?php echo json_encode($items); ?>);
    });
/*
    $(function () {
        $("#datetimepickerFecha").datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
    });*/
    // $('#cliente').select2({width: '100%'});
    /*$('#tabla_detalles').DataTable({

        drawCallback: function () {
            $('.js-example-basic-single').select2({width: '100%'});
        }
    });*/

    $("#btnCrear").click(function () {
        var codigo = $('#codigo_venta').val();
        var fecha = $('#fecha').val();
        var costo = parseInt($('#costo_total').val());
        var tipo = $('#tipo_venta').val();
        var tipo_pago = $('#tipo_pago').val();
        var cliente = $('#cliente').val();
        var efectivo = parseInt($('#efectivo').val());
        var abono_separado = parseInt($('#abono_separado').val());
        console.log('abono_separado');
        
        if(tipo=='3'){
            console.log("entra");
            changeDevuelve();
        }
        
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
        } else if (tipo == 1 && efectivo < costo) {
            swal('Advertencia', 'El efectivo recibido no puede ser inferior al total de la venta');
            return false;
        } else if (tipo_pago == '') {
            swal('Advertencia', 'El tipo de pago no puede estar vacio');
            return false;
        }else if (tipo == '3' && abono_separado <= 0) {
            swal('Advertencia', 'Ventas por separado solicita Monto a Abonar');
            return false;
        }
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
                    var url = "<?php echo base_url('ventas/create') ?>"; // El script a dónde se realizará la petición.

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
                                // TRY block when there is no exception. Since data was JSON encoded within controller,
                                // we are using jquery $.parseJSON method to parse the emncoded data.
                                ret = data;//$.parseJSON(data);
                                console.log(ret);
                                if (ret.error === 'Y') {
                                    // if error indicator was set, append the return message to form_message div element.
                                    //$("#form_msg").empty().append(ret.message);
                                    swal("Error", ret.message, "error");
                                } else {
                                    //$("#form_msg").empty().append(ret.message);
                                    //$( "#form_msg" ).append( '<p style="color:green"> Refreshing the page in 2 seconds.. </p>' );
                                    swal("", ret.message, "success");
                                    window.open("<?php echo base_url('reporte') ?>" + "/" + codigo, '_blank');
                                    // Since the form was submitted using AJAX, you will want to refresh the page since the CSRF 
                                    // token hash may be invalidated. Also, the form values will be reset with page refresh.
                                    function redirect_delay() {
                                        // location.reload(true) will load the same page again. TRUE will make sure page is
                                        // reloaded from server and not from browser cache.
                                        //console.log('ventas');
                                        //window.open("<?php echo base_url('ventas') ?>");
                                        location.reload(true);
                                    }
                                    // This will wait for the specified time and execute redirect_delay() function. In the below case,
                                    // we are waiting 2000 milliseconds (2 seconds) before refreshing the page.
                                    setTimeout(redirect_delay, 3000);
                                }
                            } catch (e) {
                                // Catch any exceptions here and handle as needed. Use console.log(e) to write the exception to 
                                // browser console, only in the development environment.
                                console.log(e);
                                // return false will ensure code execution is stopped here. Make sure it is in lower case
                                // i.e. 'false' and not 'FALSE' .
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


    $("#btnGuardar").click(function () {
        document.getElementById("btnModal").click();
        changeDevuelve();
    });

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
        cantidad = $('#cantidad' + id).val();
        costo = precio * cantidad;
        $('#total' + id).val(costo);

        changeCostoTotal();
    }

    function changeCostoTotal() {
        var cant = parseInt($('#cantDetalles').val());
        var costo = 0;
        for (var i = 1; i <= cant; i++) {
            precio = $('#precio' + i).val();
            cantidad = $('#cantidad' + i).val();
            costo += precio * cantidad;
        }
        console.log(costo);
        $('#costo_total').val(costo);
        $('#total').val(costo);
    }

    function changeDevuelve() {
        var total = $('#total').val();
        var efectivo = $('#efectivo').val();
        var abono = $('#abono_separado').val();
        var tipo = $('#tipo_venta').val();
        if(tipo=='3'){
            var devuelve = efectivo - abono;
        }else{
            var devuelve = efectivo - total;
        }
        
//        format_number(devuelve);
        $('#devuelve').val(format_number(devuelve));
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