<?php
require_once 'db.php';

class Cliente{
	private $db;
	private $cliente;

	public function __construct(){
		$this->db=db::conexion();
		$this->cliente=array();
	}
	//Metodos CRUD
    public function getClienteExist($Lrif, $correo, $razon, $telefono, $Nrif, $direccion){
        $sql = $this->db->query("SELECT * FROM clientes WHERE tipo_rif='{$Lrif}' and rif='{$Nrif}' LIMIT 1");
        
        if($sql->num_rows > 0){
            $cliente = $sql->fetch_assoc();
            header("Location: ../../pages/clientes?error");
        }else if($sql->num_rows != 1){
            $this->addCliente($Lrif, $correo, $razon, $telefono, $Nrif, $direccion);
             header("Location: ../../pages/clientes?correcto");
        }

        if (isset($cliente)) {
            return $this->cliente;
        }
    }

	public function addCliente($Lrif, $correo, $razon, $telefono, $Nrif, $direccion){
        $sql = "INSERT INTO clientes(id_cliente, tipo_rif, correo, razon_social, telefono, rif, direccion)VALUES(
            NULL, '{$Lrif}', '{$correo}', '{$razon}', '{$telefono}', '{$Nrif}', '{$direccion}')";
            return $this->db->query($sql);
    }

    public function getClientes(){
        $sql = $this->db->query("SELECT * FROM clientes");
        while($filas = $sql->fetch_assoc()){
            $this->cliente[] = $filas;
        }
        return $this->cliente;
    }

    public function getClienteId($id_cliente){
        $sql = $this->db->query("SELECT * FROM clientes WHERE id_cliente = {$id_cliente}");
        while($filas = $sql->fetch_assoc()){
            $this->cliente[] = $filas;
        }
        return $this->cliente;
    } 

   public function editCliente($id_cliente, $razon_social, $tipo_rif, $rif,  $correo, $direccion, $telefono){
       $sql = "UPDATE clientes SET razon_social='{$razon_social}',tipo_rif='{$tipo_rif}', rif='{$rif}',
                    correo='{$correo}', direccion='{$direccion}',telefono='{$telefono}'
                  WHERE id_cliente='{$id_cliente}'";
                  var_dump($rif);
        return $this->db->query($sql);

    }

    public function deleteCliente($id_cliente){
        $sql = "DELETE FROM clientes WHERE id_cliente={$id_cliente}";
        return $this->db->query($sql);
    }
}

