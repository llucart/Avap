<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isDirorVer.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>
<?php require_once '../controllers/facturas/getFactura.php';?>
<?php require_once '../controllers/clientes/allClientes.php';?>
<?php require_once '../controllers/almacen/allAlmacen.php';?>
<?php require_once '../controllers/vehiculos/allVehiculo.php';?>

<?php require_once '../views/facturas/seleccionar.phtml';?>

<?php 
    $cliente = new Cliente();
    $clientes = $cliente->getClientes();
    $almacen = new Almacen();
    $repuestos = $almacen->getAlmacen();

 ?>

<div class="row" >
     <div class="col-xs-12 col-md-12">
<div class="col-xs-4 col-md-4 text-left pull-right">
    <address>
        <strong>Fecha de Factura:</strong><br>
        
            <input class="form-control" required type="date" id="fecha">
            
    </address>
</div>
    <div class="col-xs-12 col-md-12">
                <div class="col-xs-6 col-md-6">
                    <strong>Cliente:</strong><br>
                    <div class="form-group">
                        <select name="cliente" id="cliente" required class="form-control">
                            <option value="">Selecciona un cliente</option>
                        <?php for($i=0; $i<count($clientes); $i++){ $rs = $clientes[$i]; ?>
                            <option value="<?php echo $rs['id_cliente']; ?>">
                                <?php echo $rs['razon_social']; ?>        
                            </option>
                        <?php } ?>
                        </select>
                    </div>
                    
                        <address>
                            <strong>No Poliza:</strong><br>
                            <input type="text" class="form-control" id="no_poliza" name="no_poliza" maxlength="15" onkeypress="return LetrasyNumeros(event)" required placeholder="No Poliza">
                        </address>
                   
                </div>
                <div class="col-xs-6 col-md-6">
                        <address>
                            <strong>Orden de Compra:</strong><br>
                            <input type="text" class="form-control" id="ordenCompra" name="ordenCompra" maxlength="25" onkeypress="return LetrasyNumeros(event)" required placeholder="Orden de Compra">
                        </address>
                        <address>
                            <strong>No Siniestro:</strong><br>
                            <input type="text" class="form-control" id="no_siniestro" name="no_siniestro" maxlength="15" onkeypress="return LetrasyNumeros(event)" required placeholder="No Siniestro">
                        </address>
                </div>
    <div class="col-xs-6 col-md-6">
        <strong>Añadir Vehiculo:</strong>
            <input type="checkbox" id="checkbox_vehiculo" class="checkbox-inline" name="checkbox_vehiculo" >
        <!-- Campos vehiculos -->
        <div id="mostrar_vehiculo" class="mostrar_vehiculo">
            <div class="form-group">
                <input class="form-control" type="text" name="marca" id="marca" maxlength="20" minlength="4" onkeypress="return soloLetras(event)" placeholder="Marca" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="modelo" id="modelo"  maxlength="20" minlength="4" onkeypress="return LetrasyNumeros(event)" placeholder="Modelo" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="anio" id="anio" placeholder="Año" maxlength="4" minlength="4" onkeypress="return soloNumero(event)" autocomplete="off" >
            </div>
             <div class="form-group">
                <input class="form-control" type="text" name="placa" id="placa"  maxlength="7" minlength="6" onkeypress="return placa(event)" placeholder="Placa" autocomplete="off">
            </div>
     </div> 
</div>
    <div class="col-xs-6 col-md-6">
        <strong>Añadir Nota de entrega:</strong>
            <input type="checkbox" id="checkbox_nota" class="checkbox-inline" name="checkbox_nota">
        <!-- Campos Nota de Entrega -->
        <div id="mostrar_notas" class="mostrar_notas">
            <div class="form-group">
                <input class="form-control" type="text" name="codigo" id="codigo" maxlength="4" onkeypress="return soloNumero(event)" placeholder="Código" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="empresa_envio" id="empresa_envio" maxlength="25" onkeypress="return soloLetras(event)" placeholder="Empresa de envio" autocomplete="off">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="guia" id="guia" maxlength="25" onkeypress="return LetrasyNumeros(event)" placeholder="Guia" autocomplete="off">
            </div>
             <div class="form-group">
                <input class="form-control" type="number" name="costo_envio" id="costo_envio" step="0.5" placeholder="Costo del envio" autocomplete="off">
            </div>
             <div class="form-group">
                <select class="form-control" name="estado_nota" id="estado_nota">
                        <option value="0">Selecciona estado</option>
                        <option value="1">Enviado</option>
                        <option value="2">Recibido</option>
                    </select>
            </div>
             <div class="form-group">
                <input class="form-control" type="date" name="fecha_envio" id="fecha_envio" autocomplete="off">
            </div>
     </div> 
</div>
</div>
</div>
<div class="container">
    <div class="col-md-12">
        <div class="pull-right">
            <button type="button" class="btn btn-primary" data-target=".bs-example-modal-lg" onclick="selectRepuesto();">Agregar</button>
        </div>
        <table class="table table-bordered" id="tabla">        
            <thead>
                <tr>
                    <th>Repuesto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Monto</th>
                </tr>
            </thead>
            
            <tbody>  
            <div class="col-md-2">
            <tr id="aqui">
                <td></td>
                <td></td>
                <td class="text-right"><strong>Sub Total</strong></td>
                <td><input class="form-control" type="text" id="sub_total" readonly="off" placeholder="0.00"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="text-right"><strong>IVA</strong></td>
                <td><input class="form-control" id="iva" value="0" onkeypress="return soloNumero(event)" onblur="limpiaIva()" maxlength="2" minlength="1" type="text"></td>
            </tr>
            </div>
            <tr>
                <td>
                    <select class="form-control" name="estado" id="estado">
                        <option value="0">Selecciona estado</option>
                        <option value="1">Pagada</option>
                        <option value="2">No pagada</option>
                    </select>
                </td>
                <td></td>
                <td class="text-right"><strong>Total</strong></td>
                <td><input type="text" readonly="off" class="form-control" id="total" placeholder="0.00"></td>
            </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-success pull-right" onclick="validarFactura();" id="btnCreaFactura">Guardar</button>
        <a class="btn btn-danger pull-right" href="../pages/facturas">Cancelar</a>
    </div>
</div>
</div>
<?php require_once 'layout/footer.php'; ?>