<?php
require_once 'db.php';

class Factura{
	private $db;
	private $factura;

	public function __construct(){
		$this->db=db::conexion();
		$this->factura=array();
	}
	//Metodos CRUD
	public function addFactura($id_vehiculo, $id_usuario, $id_cliente, $iva, $total, $ordenCompra, $n_poliza, $n_siniestro, $fecha, $estado){
        $sql = "INSERT INTO factura(id_factura, id_vehiculo, id_usuario, id_cliente, iva,
                                total, ordenCompra, n_poliza, n_siniestro, fecha, estado)VALUES(
            NULL, '{$id_vehiculo}', '{$id_usuario}', '{$id_cliente}', '{$iva}', '{$total}', '{$ordenCompra}',
                    '{$n_poliza}', '{$n_siniestro}', '{$fecha}', '{$estado}')";
            return $this->db->query($sql);

    }

    public function addFacturaRepuesto($id_repuesto, $id_factura, $cantidad){
        $sql = "INSERT INTO factura_repuesto(id_fac_repuesto, id_repuesto, id_factura, cantidad)VALUES(
            NULL, '{$id_repuesto}', '{$id_factura}', '{$cantidad}')";
            return $this->db->query($sql);
    }

    public function allFacturas(){
        $sql = $this->db->query("SELECT factura.id_factura, factura.id_vehiculo, factura.id_usuario,factura.fechaPago,
                                    factura.id_cliente, factura.iva, factura.total, factura.ordenCompra,
                                    factura.n_poliza, factura.n_siniestro, factura.fecha, factura.estado, factura.fecha_log,   
                                            clientes.id_cliente, clientes.tipo_rif, clientes.correo, clientes.telefono, 
                                                clientes.rif, clientes.razon_social, clientes.direccion,
                                                    usuario.id_rol, usuario.id_usuario, usuario.cuenta,
                                                    vehiculos.marca,vehiculos.modelo,vehiculos.anio
                                            FROM factura 
                                                INNER JOIN clientes ON factura.id_cliente = clientes.id_cliente
                                                JOIN vehiculos ON factura.id_vehiculo = vehiculos.placa
                                                INNER JOIN usuario ON factura.id_usuario = usuario.id_usuario ORDER BY id_factura");
        
       if(mysqli_num_rows($sql) > 0){
         while($filas = $sql->fetch_assoc()){
            $this->factura[] = $filas;
        }

       }
        return $this->factura;
    }


    public function getFacturas(){
    $sql = $this->db->query("SELECT * FROM factura ORDER BY id_factura DESC LIMIT 1");
        while($filas = $sql->fetch_assoc()){
            $this->factura[] = $filas;
        }
        return $this->factura;      
    }

    public function getFacturaId($id_factura){
        $sql = $this->db->query("SELECT factura.id_factura, factura.id_vehiculo, factura.id_usuario,
                                    factura.id_cliente, factura.iva, factura.total, factura.ordenCompra,
                                    factura.n_poliza, factura.n_siniestro, factura.fecha, factura.estado, factura.fecha_log,   
                                            clientes.id_cliente, clientes.tipo_rif, clientes.correo, clientes.telefono, 
                                                clientes.rif, clientes.razon_social, clientes.direccion,
                                                    usuario.id_rol, usuario.id_usuario, usuario.cuenta, usuario.nombre, usuario.apellido,
                                                    vehiculos.marca,vehiculos.modelo,vehiculos.anio
                                            FROM factura 
                                                INNER JOIN clientes ON factura.id_cliente = clientes.id_cliente
                                                INNER JOIN usuario ON factura.id_usuario = usuario.id_usuario
                                                JOIN vehiculos ON factura.id_vehiculo = vehiculos.placa
                                                WHERE factura.id_factura='$id_factura'");
        while($filas = $sql->fetch_assoc()){
            $this->factura[] = $filas;
        }
        return $this->factura;
    } 

     public function getFacturasMes($mes,$anio){
        $sql = $this->db->query("SELECT id_factura,total,iva,fecha,estado FROM `factura` 
            WHERE MONTH(fecha) = '$mes' AND YEAR(fecha) = '$anio'");
        while($filas = $sql->fetch_assoc()){
            $this->factura[] = $filas;
        }
        return $this->factura;
    } 

    public function getFactura_RepuestoId($id_factura){
        $sql = $this->db->query("SELECT cantidad, descripcion, precio_unitario FROM factura_repuesto,repuesto WHERE factura_repuesto.id_repuesto=repuesto.id_repuesto 
                                    AND factura_repuesto.id_factura='$id_factura'");
        while($filas = $sql->fetch_assoc()){
            $this->factura_repuesto[] = $filas; //id_factura,repuesto.id_repuesto,
        }
        return $this->factura_repuesto;
    } 

   public function editFactura($id_factura, $id_cliente,$fecha, $estado, $siniestro, $ordenC, $poliza){
        $sql = "UPDATE factura SET id_cliente='{$id_cliente}', fechaPago='{$fecha}', n_siniestro='{$siniestro}', ordenCompra='{$ordenC}', n_poliza='{$poliza}' 
                  WHERE id_factura='{$id_factura}'";
        return $this->db->query($sql);
    }

    public function pagarFactura($id_factura, $estado, $fecha){
        $sql = "UPDATE factura SET estado='{$estado}',fechaPago='{$fecha}'
                  WHERE id_factura='{$id_factura}'";
        return $this->db->query($sql);
    }


    public function notificacion(){
        $sql = $this->db->query("SELECT id_factura, fecha, DATEDIFF(CURDATE(), fecha) AS notificacion FROM factura WHERE estado = 2");
        while($filas = $sql->fetch_assoc()){
            $this->factura[] = $filas;
        }
        return $this->factura;     
        
    }

    public function mes1(){
    $sql = $this->db->query("SELECT * FROM factura WHERE MONTH(fecha) = MONTH(curdate()) AND 
                                YEAR(fecha) = YEAR(curdate())");
        while($filas = $sql->fetch_assoc()){
            $this->factura[] = $filas;
        }
        return $this->factura;      
    }

    public function mes2(){
    $sql = $this->db->query("SELECT * FROM factura WHERE MONTH(fecha) = MONTH(curdate())-1 AND 
                                YEAR(fecha) = YEAR(curdate())");
        while($filas = $sql->fetch_assoc()){
            $this->factura[] = $filas;
        }
        return $this->factura;      
    }

    public function mes3(){
    $sql = $this->db->query("SELECT * FROM factura WHERE MONTH(fecha) = MONTH(curdate())-2 AND 
                                YEAR(fecha) = YEAR(curdate())");
        while($filas = $sql->fetch_assoc()){
            $this->factura[] = $filas;
        }
        return $this->factura;      
    }

    public function mes4(){
    $sql = $this->db->query("SELECT * FROM factura WHERE MONTH(fecha) = MONTH(curdate())-3 AND 
                                YEAR(fecha) = YEAR(curdate())");
        while($filas = $sql->fetch_assoc()){
            $this->factura[] = $filas;
        }
        return $this->factura;      
    }

    public function delFactura($id_factura){
        $sql = "DELETE FROM factura WHERE id_factura={$id_factura}";
        return $this->db->query($sql);
    }

    public function delFacturaRepuesto($id_factura){
        $sql = "DELETE FROM factura_repuesto WHERE id_factura={$id_factura}";
        return $this->db->query($sql);
    }
}

