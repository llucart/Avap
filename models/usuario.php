<?php
require_once 'db.php';

class Usuario{
	private $db;
	private $usuario;

	public function __construct(){
		$this->db=db::conexion();
		$this->usuario=array();
	}

	//Metodos de Sesiones
	public function getSession($usuario, $password){
		$password = md5($password);
		$sql = $this->db->query("SELECT * FROM usuario WHERE cuenta='{$usuario}' AND clave='{$password}' LIMIT 1");
        
		if($sql->num_rows > 0){
			$usuario = $sql->fetch_assoc();
			$this->setSession($usuario);
		}else if($sql->num_rows != 1){
			header("Location: ../../pages/login?error");
		}else{
			//Al home
			
			echo 'A home';
		}

		if (isset($usuario)) {
            return $this->usuario;
        }
    }

    public function setSession($data = '')
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!empty($data)) {
            $_SESSION['id_usuario'] = $data['id_usuario'];
            $_SESSION['cuenta'] = $data['cuenta'];
            $_SESSION['rol'] = $data['id_rol'];
        }
        header("Location: ../../pages/");
    }

    public function delSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION['id_usuario']);
        unset($_SESSION['cuenta']);
        unset($_SESSION['rol']);
        session_destroy();
        header("Location: ../pages/");
    }
	//Metodos CRUD
    public function getUsuarioExist($nombre, $apellido,$cuenta,$clave, $id_rol){
        $sql = $this->db->query("SELECT * FROM usuario WHERE cuenta='{$cuenta}' LIMIT 1");
        
        if($sql->num_rows > 0){
            $usuario = $sql->fetch_assoc();
            echo 1;
        }else if($sql->num_rows != 1){
            $this->addUsuario($nombre, $apellido,$cuenta,$clave, $id_rol);
        }

        if (isset($usuario)) {
            return $this->usuario;
        }
    }
	public function addUsuario($nombre, $apellido,$cuenta,$clave, $id_rol){
        $hash = MD5($clave);
        $sql = "INSERT INTO usuario(id_usuario, nombre, apellido, cuenta, clave, id_rol)VALUES(
            NULL, '{$nombre}', '{$apellido}', '{$cuenta}', '{$hash}', '{$id_rol}')";
            return $this->db->query($sql);
    }

    public function getUsuarios(){
        $sql = $this->db->query("SELECT usuario.id_usuario, usuario.nombre, usuario.apellido,usuario.cuenta, 
                                        usuario.clave, usuario.id_rol, 
                                        usuario.fecha_log, rol.id_rol, rol.rol, rol.fecha_log
                                            FROM usuario
                                                INNER JOIN rol on usuario.id_rol = rol.id_rol
                                                    WHERE rol.id_rol != 4");
        while($filas = $sql->fetch_assoc()){
            $this->usuario[] = $filas;
        }
        return $this->usuario;
    }

    public function getUsuarioId($id_usuario){
        $sql = $this->db->query("SELECT usuario.id_usuario, usuario.cuenta, 
                                        usuario.clave, usuario.id_rol, 
                                        usuario.fecha_log, rol.id_rol, rol.rol, rol.fecha_log
                                            FROM usuario
                                                INNER JOIN rol on usuario.id_rol = rol.id_rol
                                                WHERE usuario.id_usuario = '{$id_usuario}'");
        while($filas = $sql->fetch_assoc()){
            $this->usuario[] = $filas;
        }
        return $this->usuario;
    } 

    public function editUsuario($id_usuario, $nombre, $apellido, $cuenta, $clave, $rol){
        $hash = md5($clave);
        $sql = "UPDATE usuario SET nombre='{$nombre}', apellido='{$apellido}', cuenta='{$cuenta}', 
                clave='{$hash}', id_rol='{$rol}' WHERE id_usuario='{$id_usuario}'";
        return $this->db->query($sql);
    }

   public function editPerfil($id_usuario, $cuenta, $clave){
        $hash = MD5($clave);
        $sql = "UPDATE usuario SET cuenta='{$cuenta}', clave='{$hash}'
                  WHERE id_usuario='{$id_usuario}'";
        return $this->db->query($sql);

        //$this->getSession($cuenta, $clave);
    }

    public function deleteUsuario($id_usuario){
        $sql = "DELETE FROM usuario WHERE id_usuario={$id_usuario}";
        return $this->db->query($sql);
    }
}