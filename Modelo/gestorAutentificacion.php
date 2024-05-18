<?php
require_once '../conf/database.php';

namespace Modelo;

class Autentificar {
    private $db;

    public function __construct() {
        $db = new Database();
        $this->db = $db->getConnection();
    }
    

    public function inicioSesion($correo, $contrasenia) {
        $correo = $this->db->real_escape_string($correo);
        $contrasenia = $this->db->real_escape_string($contrasenia);
    
        $query = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasenia = '$contrasenia'";
        $result = $this->db->query($query);
    
        if ($result->num_rows == 1) {
            session_start();
            $_SESSION['correo'] = $correo;
            return true;
        } else {
            return false;
        }
    }
    

    public function cerrarSesion() {
        // Implementar la lógica de cierre de sesión
    }

    public function registrarUsuario($nombre, $apellidos, $correo, $contrasenia) {
        
        // Hash de la contrasenia (se recomienda utilizar bcrypt o argon2)
        $hashed_password = password_hash($contrasenia, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar un nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, apellidos, correo, contrasenia) VALUES (?, ?, ?, ?)";

        // Preparar la sentencia SQL
        $stmt = $this->db->prepare($sql);

        // Vincular los parámetros y ejecutar la consulta
        $stmt->bind_param("ssss", $nombre, $apellidos, $correo, $hashed_password);
        $resultado = $stmt->execute();

        // Verificar si la consulta se ejecutó correctamente
        if ($resultado) {
            return true; // Registro exitoso
        } else {
            return false; // Fallo al registrar el usuario
        }
    }
}

?>
