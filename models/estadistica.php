<?php
require_once 'db.php';

class Estadistica{
	private $db;
	private $estadistica;

	public function __construct(){
		$this->db=db::conexion();
		$this->estadistica=array();
	}
	//Metodos CRUD
	public function addEstadistica($id_factura, $total, $fecha, $estado){
        $sql = "INSERT INTO estadistica(id_estadistica, id_factura, total, fecha, estado)VALUES(
            NULL, '{$id_factura}', '{$total}', '{$fecha}', '{$estado}')";
            return $this->db->query($sql);
    }

    public function getEstadistica(){
        $sql = $this->db->query("SELECT * FROM estadistica
                                    ");
        while($filas = $sql->fetch_assoc()){
            $this->estadistica[] = $filas;
        }
        return $this->estadistica;
    }
}