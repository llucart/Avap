<?php 

require_once '../../models/almacen.php';

	$almacen = new Almacen();
	$almacenes = $almacen->getAlmacen();

?>
<tr>
	<td>
		<select id="repuesto1" name="repuesto1" class="form-control">
		    <option value="">Selecciona un repuesto</option>
		    <?php for($i=0; $i<count($almacenes); $i++){ $rs = $almacenes[$i]; ?>
		        <option value="<?php echo $rs['id_repuesto']; ?>">
		            <?php echo $rs['descripcion']; ?>        
		        </option>
		    <?php } ?>
		</select>
	</td>
<td>
    <input type="number" class="form-control" readonly="off" id="precio_unitario1">
</td>
<td>
    <input type="number" class="form-control" readonly="off" id="stock1">
</td>
<td>
    <input type="number" id="cantidad" class="form-control" required placeholder="Cantidad">
</td>
</tr>