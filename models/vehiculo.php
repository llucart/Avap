<?php
require_once 'db.php';

class Vehiculo{
	private $db;
	private $vehiculo;

	public function __construct(){
		$this->db=db::conexion();
		$this->vehiculo=array();
	}
	//Metodos CRUD
	public function addVehiculo($id_vehiculo, $marca, $modelo, $placa, $anio){
        $sql = "INSERT INTO vehiculos(id_vehiculo, marca, modelo, placa, anio)VALUES(
            '{$id_vehiculo}', '{$marca}', '{$modelo}', '{$placa}', '{$anio}')";
            return $this->db->query($sql);
    }

    public function getVehiculo(){
        $sql = $this->db->query("SELECT * FROM vehiculos");
        while($filas = $sql->fetch_assoc()){
            $this->vehiculo[] = $filas;
        }
        return $this->vehiculo;
    }

   //  public function getAlmacenId($id_repuesto){
   //      $sql = $this->db->query("SELECT * FROM repuesto WHERE id_repuesto = {$id_repuesto}");
   //      while($filas = $sql->fetch_assoc()){
   //          $this->almacen[] = $filas;
   //      }
   //      return $this->almacen;
   //  } 

   // public function editAlmacen($id_repuesto, $descripcion, $marca, $precio_unitario, $stock){
   //      $sql = "UPDATE repuesto SET descripcion='{$descripcion}', marca='{$marca}', 
   //                      precio_unitario='{$precio_unitario}', stock='{$stock}'
   //                WHERE id_repuesto='{$id_repuesto}'";
   //      return $this->db->query($sql);
   //  }

   //  public function delAlmacen($id_repuesto){
   //      $sql = "DELETE FROM repuesto WHERE id_repuesto={$id_repuesto}";
   //      return $this->db->query($sql);
   //  }
}