<?php
require_once 'db.php';

class Almacen{
	private $db;
	private $almacen;

	public function __construct(){
		$this->db=db::conexion();
		$this->almacen=array();
	}
	//Metodos CRUD
	public function addAlmacen($descripcion,$detalle, $tipo, $precio_unitario, $stock){
        $sql = "INSERT INTO repuesto(id_repuesto, descripcion, detalle, tipo, precio_unitario, stock)VALUES(
            NULL, '{$descripcion}', '{$detalle}', '{$tipo}', '{$precio_unitario}', '{$stock}')";
            return $this->db->query($sql);
            header("Location: ../../pages/almacen?agregado");
    }

    public function getAlmacen(){
        $sql = $this->db->query("SELECT * FROM repuesto WHERE stock != 0");
        while($filas = $sql->fetch_assoc()){
            $this->almacen[] = $filas;
        }
        return $this->almacen;
    }

    public function getAlmacen1(){
        $sql = $this->db->query("SELECT * FROM repuesto");
        while($filas = $sql->fetch_assoc()){
            $this->almacen[] = $filas;
        }
        return $this->almacen;
    }

    public function getAlmacenId($id_repuesto){
        $sql = $this->db->query("SELECT * FROM repuesto WHERE id_repuesto = {$id_repuesto}");
        while($filas = $sql->fetch_assoc()){
            $this->almacen[] = $filas;
        }
        return $this->almacen;
    } 

   public function editAlmacen($id_repuesto, $descripcion,$detalle, $tipo, $precio_unitario, $stock){
        $sql = "UPDATE repuesto SET descripcion='{$descripcion}', detalle='{$detalle}',tipo='{$tipo}', 
                        precio_unitario='{$precio_unitario}', stock='{$stock}'
                  WHERE id_repuesto='{$id_repuesto}'";
        header("Location: ../../pages/almacen?editado");
        return $this->db->query($sql);
    }

    public function delAlmacen($id_repuesto){
        $sql = "DELETE FROM repuesto WHERE id_repuesto={$id_repuesto}";
        return $this->db->query($sql);
    }

    public function editAlmacenStock($id_repuesto, $cantidad){
        $sql = "UPDATE repuesto SET repuesto.stock= repuesto.stock-'{$cantidad}'
                  WHERE id_repuesto='{$id_repuesto}'";
        return $this->db->query($sql);
    }
}