<?php
require_once 'db.php';

class NotaEntrega{
	private $db;
	private $nota_entrega;

	public function __construct(){
		$this->db=db::conexion();
		$this->nota_entrega=array();
	}
	//Metodos CRUD
	public function addNotaEntrega($codigo, $id_factura, $empresa_envio, $guia, $costo_envio, $estado_nota, $fecha_envio){
        $sql = "INSERT INTO nota_entrega(id_nota_entrega, cod_nota_entrega, id_factura, empresa_envio, guia, costo_envio, estado, fecha_envio)VALUES(
            NULL, '{$codigo}', '{$id_factura}', '{$empresa_envio}', '{$guia}', '{$costo_envio}', '{$estado_nota}', '{$fecha_envio}')";
            return $this->db->query($sql);
    }

    public function getNotaEnvio(){
        $sql = $this->db->query("SELECT * FROM nota_entrega");
        while($filas = $sql->fetch_assoc()){
            $this->nota_entrega[] = $filas;
        }
        return $this->nota_entrega;
    }

    public function getNotasMes($mes,$anio){
        $sql = $this->db->query("SELECT * FROM nota_entrega WHERE MONTH(fecha_envio) = '$mes' AND YEAR(fecha_envio) = '$anio'");
        while($filas = $sql->fetch_assoc()){
            $this->nota_entrega[] = $filas;
        }
        return $this->nota_entrega;
    }

    public function getNotaEnvioId($id_nota_entrega){
        $sql = $this->db->query("SELECT * FROM nota_entrega WHERE id_nota_entrega = {$id_nota_entrega}");
        while($filas = $sql->fetch_assoc()){
            $this->nota_entrega[] = $filas;
        }
        return $this->nota_entrega;
    } 

   public function editNotaEnvio($id_nota_entrega, $codigo, $empresa_envio, $guia, $costo_envio, $estado_nota, $fecha_envio, $fecha_entrega){
        $sql = "UPDATE nota_entrega SET cod_nota_entrega='{$codigo}', empresa_envio='{$empresa_envio}', guia='{$guia}',
                                costo_envio='{$costo_envio}', estado='{$estado_nota}', fecha_envio='{$fecha_envio}', fechaEntrega='{$fecha_entrega}'
                  WHERE id_nota_entrega='{$id_nota_entrega}'";
        return $this->db->query($sql);
        echo 1;
    }

    public function delNotaEnvio($id_nota_entrega){
        $sql = "DELETE FROM nota_entrega WHERE id_nota_entrega={$id_nota_entrega}";
        return $this->db->query($sql);
    }

    public function notificacionN(){
        $sql = $this->db->query("SELECT id_nota_entrega, cod_nota_entrega, fecha_envio, DATEDIFF(CURDATE(), fecha_envio) AS notificacion FROM nota_entrega WHERE estado = 1");
        while($filas = $sql->fetch_assoc()){
            $this->nota_entrega[] = $filas;
        }
        return $this->nota_entrega;     
        
    }

    public function entregaRepuesto($id_nota_entrega, $estado,$fecha){
        $sql = "UPDATE nota_entrega SET estado='{$estado}', fechaEntrega='{$fecha}'
                  WHERE id_nota_entrega='{$id_nota_entrega}'";
        return $this->db->query($sql);
    }


     public function mes1(){
    $sql = $this->db->query("SELECT * FROM nota_entrega WHERE MONTH(fecha_envio) = MONTH(curdate()) AND 
                                YEAR(fecha_envio) = YEAR(curdate())");
        while($filas = $sql->fetch_assoc()){
            $this->nota_entrega[] = $filas;
        }
        return $this->nota_entrega;      
    }

    public function mes2(){
    $sql = $this->db->query("SELECT * FROM nota_entrega WHERE MONTH(fecha_envio) = MONTH(curdate())-1 AND 
                                YEAR(fecha_envio) = YEAR(curdate())");
        while($filas = $sql->fetch_assoc()){
            $this->nota_entrega[] = $filas;
        }
        return $this->nota_entrega;      
    }

    public function mes3(){
    $sql = $this->db->query("SELECT * FROM nota_entrega WHERE MONTH(fecha_envio) = MONTH(curdate())-2 AND 
                                YEAR(fecha_envio) = YEAR(curdate())");
        while($filas = $sql->fetch_assoc()){
            $this->nota_entrega[] = $filas;
        }
        return $this->nota_entrega;      
    }

    public function mes4(){
    $sql = $this->db->query("SELECT * FROM nota_entrega WHERE MONTH(fecha_envio) = MONTH(curdate())-3 AND 
                                YEAR(fecha_envio) = YEAR(curdate())");
        while($filas = $sql->fetch_assoc()){
            $this->nota_entrega[] = $filas;
        }
        return $this->nota_entrega;      
    }
}