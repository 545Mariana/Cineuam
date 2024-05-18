<?php
namespace Controlador;

use Modelo\Autentificar;


class ControladorAutentificacion
{
    public function iniciarSesion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $correo = $_POST['correo'];
            $contraseña = $_POST['contraseña'];

            $aut = new Autentificar();
            if ($aut->inicioSesion($correo, $contraseña)) {
                echo "Inicio de sesión exitoso";
            } else {
                echo "Correo o contraseña incorrectos";
            }
        }
    }

    public function registrarUsuario()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $contrasenia = $_POST['contrasenia'];

            // Crear una instancia de la clase Autentificar
            $autentificar = new Autentificar();

            // Intentar registrar al usuario en la base de datos
            if ($autentificar->registrarUsuario($nombre, $apellidos, $correo, $contrasenia)) {
                // Registro exitoso
                echo "¡Registro exitoso!";
            } else {
                // Error al registrar el usuario
                echo "Error al registrar el usuario.";
            }
        }
    }
}
?>
