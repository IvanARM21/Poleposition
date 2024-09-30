<?php
include_once "db.class.php";

class Cuentas {
    private $db;

    public function __construct($db = null) {
        if ($db) {
            $this->db = $db;
        } else {
            $this->db = (new DB())->getConexion(); // Mantén la conexión por defecto si no se pasa un argumento
        }
    }

    public function registrar($usuario, $contraseña, $correo, $nombreCompleto) {
        // Verificar si el usuario ya existe
        $stmt = $this->db->prepare("SELECT * FROM cuentas WHERE email = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $stmt->close();
            return false; // Usuario ya existe
        }

        // Crear un nuevo usuario
        $hashContraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO cuentas (usuario, password, email, nombreCompleto) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $usuario, $hashContraseña, $correo, $nombreCompleto);

        $resultado = $stmt->execute();
        $stmt->close();
        
        return $resultado; // Éxito o fallo
    }

    public function iniciarSesion($usuario, $contraseña) {
        // Buscar usuario por nombre de usuario
        $stmt = $this->db->prepare("SELECT * FROM cuentas WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datosUsuario = $resultado->fetch_assoc();

        $stmt->close();

        // Verificar contraseña
        if ($datosUsuario && password_verify($contraseña, $datosUsuario['password'])) {
            return $datosUsuario; // Autenticación exitosa
        } else {
            return false; // Fallo en autenticación
        }
    }
}
