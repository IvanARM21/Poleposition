<?php

class Perfil {
    private $db;
    private $title;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {
        if (!isset($_COOKIE['usuario'])) {
            header("Location: /");
            exit;
        }

        $usuarioDatos = json_decode($_COOKIE['usuario'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->mostrarError('Error al decodificar los datos de usuario.');
        }
    
        $usuario = $usuarioDatos['usuario'];
        $this->title = "PP | Mi Perfil";

        // Maneja las actualizaciones y eliminaciones
        [$errorPerfil, $errorSeguridad, $errorEliminar] = $this->actualizar($usuarioDatos);
    
        $usuarioDB = $this->obtenerDatosUsuario($usuario);
        if ($usuarioDB === null) {
            return $this->mostrarError('Usuario Incorrecto / No Encontrado');
        }
    
        return new Template('./views/perfil/index.php', [
            'usuarioDB' => $usuarioDB,
            'errorPerfil' => $errorPerfil ?? null,
            'errorSeguridad' => $errorSeguridad ?? null,
            'errorEliminar' => $errorEliminar ?? null,
        ]);
    }

    private function actualizar($usuarioDatos) {
        $errorPerfil = null;
        $errorSeguridad = null;
        $errorEliminar = null;
    
        if (isset($_POST['enviarDatosPerfil'])) {
            $errorPerfil = $this->actualizarDatosPerfil($usuarioDatos);
        } elseif (isset($_POST['guardarContraseña'])) {
            $errorSeguridad = $this->actualizarSeguridad($usuarioDatos);
        } elseif (isset($_POST['eliminarCuenta'])) {
            $errorEliminar = $this->eliminarCuenta($usuarioDatos);
        }
    
        return [$errorPerfil, $errorSeguridad, $errorEliminar];
    }

    private function actualizarDatosPerfil(&$usuarioDatos) {
        $nombreCompleto = $_POST['nombreCompleto'] ?? '';
        $nuevoUsuario = $_POST['usuario'] ?? '';
        $email = $_POST['email'] ?? '';
        $usuarioActual = $usuarioDatos['usuario'];
    
        // Validar campos
        if (empty($nombreCompleto) || empty($nuevoUsuario) || empty($email)) {
            return 'Todos los campos son obligatorios para actualizar el perfil.';
        }
    
        //verifica si el usuario ya existe mano
        $stmt = $this->db->getConexion()->prepare(
            "SELECT COUNT(*) FROM cuentas WHERE usuario = ? AND usuario != ?"
        );
        $stmt->bind_param('ss', $nuevoUsuario, $usuarioActual);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    
        if ($count > 0) {
            return 'El nombre de usuario ya está en uso. Por favor, elige otro.';
        }
    
        //para verificar si el email existe bo
        $stmt = $this->db->getConexion()->prepare(
            "SELECT COUNT(*) FROM cuentas WHERE email = ? AND usuario != ?"
        );
        $stmt->bind_param('ss', $email, $usuarioActual);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    
        if ($count > 0) {
            return 'El correo electrónico ya está en uso. Por favor, utiliza otro.';
        }
    
        $stmt = $this->db->getConexion()->prepare(
            "UPDATE cuentas SET nombreCompleto = ?, usuario = ?, email = ? WHERE usuario = ?"
        );
        $stmt->bind_param('ssss', $nombreCompleto, $nuevoUsuario, $email, $usuarioActual);
    
        if ($stmt->execute()) {
            $usuarioDatos['usuario'] = $nuevoUsuario;
            $usuarioDatos['nombreCompleto'] = $nombreCompleto; 
            $usuarioDatos['email'] = $email;
    
            setcookie('usuario', json_encode($usuarioDatos), time() + (86400 * 30), "/", "", false, true); 
    

            //lo manda a la misma pagina xq sino no se ven los cambios xd
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            return 'Error al actualizar los datos del perfil.';
        }
    
        return null;
    }
    

    private function actualizarSeguridad($usuarioDatos) {
        $contraseñaActual = $_POST['contraseñaActual'] ?? '';
        $contraseñaNueva = $_POST['contraseñaNueva'] ?? '';
        $contraseñaNueva2 = $_POST['contraseñaNueva2'] ?? '';

        if (empty($contraseñaActual) || empty($contraseñaNueva) || empty($contraseñaNueva2)) {
            return 'Todos los campos son obligatorios para cambiar la contraseña.';
        }

        if (strlen($contraseñaNueva) < 8) {
            return 'La nueva contraseña debe tener al menos 8 caracteres.';
        }
    
        if ($contraseñaNueva !== $contraseñaNueva2) {
            return 'Las nuevas contraseñas no coinciden.';
        }
    
        $stmt = $this->db->getConexion()->prepare("SELECT password FROM cuentas WHERE usuario = ?");
        $stmt->bind_param('s', $usuarioDatos['usuario']);
        $stmt->execute();
        $usuarioDB = $stmt->get_result()->fetch_assoc();
    
        if (!$usuarioDB || !password_verify($contraseñaActual, $usuarioDB['password'])) {
            return 'Contraseña actual incorrecta.';
        }
    
        $stmt = $this->db->getConexion()->prepare("UPDATE cuentas SET password = ? WHERE usuario = ?");
        $hashContraseñaNueva = password_hash($contraseñaNueva, PASSWORD_DEFAULT);
    
        if (!$stmt->bind_param('ss', $hashContraseñaNueva, $usuarioDatos['usuario']) || !$stmt->execute()) {
            return 'Error al cambiar la contraseña.';
        }
    
        return null;
    }
    
    private function eliminarCuenta($usuarioDatos) {
        $contraseñaActualBorrar = $_POST['contraseñaActualBorrar'] ?? '';
        
        if (empty($contraseñaActualBorrar)) {
            return 'Tienes que escribir tu contraseña para eliminar la cuenta.';
        }
        
        $usuario = $usuarioDatos['usuario'];
        
        $stmt = $this->db->getConexion()->prepare("SELECT password FROM cuentas WHERE usuario = ?");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $usuarioDB = $stmt->get_result()->fetch_assoc();
        
        if (!$usuarioDB || !password_verify($contraseñaActualBorrar, $usuarioDB['password'])) {
            return 'Contraseña actual incorrecta.';
        }

        $stmt = $this->db->getConexion()->prepare("DELETE FROM cuentas WHERE usuario = ?");
        $stmt->bind_param('s', $usuario);
        
        if ($stmt->execute()) {
            // Eliminar la cookie del usuario
            setcookie('usuario', '', time() - 3600, '/');
            // Redirigir a la página principal
            header("Location: /");
            exit;
        }
        
        return 'Error al eliminar la cuenta.';
    }    
    
    private function obtenerDatosUsuario($usuario) {
        $stmt = $this->db->getConexion()->prepare("SELECT nombreCompleto, usuario, email FROM cuentas WHERE usuario = ?");
        if (!$stmt) {
            return null;
        }
    
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    private function mostrarError($mensaje) {
        return new Template('./views/perfil/index.php', ['error' => $mensaje]);
    }
}


?>