<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isAdmin.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>
<?php require_once '../controllers/facturas/getFactura.php';?>
<?php require_once '../controllers/clientes/allClientes.php';?>
<?php require_once '../controllers/almacen/allAlmacen.php';?>
<?php require_once '../controllers/vehiculos/allVehiculo.php';?>

<?php require_once '../views/facturas/seleccionar.phtml';?>

<?php 
    $almacen = new Almacen();
    $repuestos = $almacen->getAlmacen();
 ?>
                 <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Marca</th>
                        <th>Descripción</th>
                        <th>Precio unitario</th>
                        <th>Stock</th>
                        <th>Opciones</th>
                    </tr>
                    <?php for($i=0; $i<count($repuestos); $i++){ $rs = $repuestos[$i]; ?>
                    <tr><form action="./crearFactura.php" method="post">
                        <td><input type="hidden" name="id_repuesto" value="<?php echo $rs['id_repuesto']; ?>"></td>
                        <td><input type="text" readonly="off" name="marca[]" value="<?php echo $rs['id_repuesto']; ?>"></td>
                        <td><input type="text" readonly="off" name="descripcion[]" value="<?php echo $rs['descripcion']; ?>"></td>
                        <td><input type="text" readonly="off" name="precio_unitario[]" value="<?php echo $rs['precio_unitario']; ?>"></td>
                        <td><input type="text" readonly="off" name="stock[]" value="<?php echo $rs['stock']; ?>"></td>
                        <td><input type="number" name="cantidad[]"></td>
                        <td>
                            <input type="checkbox" name="id_repuesto[]" value="<?php echo $rs['id_repuesto']; ?>" id="seleccionar" onclick="/*seleccionar(this);*/">
                        </td>
                    </tr>
                    <?php } ?>

                </table>   
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-default" data-dismiss="modal" title="Aceptar">Aceptar</button>
                </div>
            </div>
            </form>