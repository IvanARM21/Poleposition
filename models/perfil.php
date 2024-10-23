<?php

class Perfil {
    private $db;
    private $title;

    public function __construct($db) {
        $this->db = $db;
        $this->title = "PP | Mi Perfil";
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {
        if (!isset($_COOKIE['usuario'])) {
            header("Location: /");
            exit;
        }
        
        $usuario = json_decode($_COOKIE['usuario']);
        $usuarioId = intval($usuario->id);
        $usuarioDatos = json_decode($_COOKIE['usuario'], true); 

        $cuentas = $this->obtenerDatosPerfil($usuarioId);

if (!$cuentas) {
    return $this->mostrarError('No se encontraron datos del usuario.');
}
    
        $sql = "SELECT
            cuentas.nombreCompleto AS Nombre,
            vehiculo.marca AS Marca,
            vehiculo.modelo AS Modelo,
            vehiculo.color AS Color,
            vehiculo.precio AS Precio,
            vehiculo.kilometraje AS Kilometraje,
            vehiculo.año AS Año,
            CASE
                WHEN compra.id IS NOT NULL THEN 'Compra'
                WHEN alquiler.id IS NOT NULL THEN 'Alquiler'
                ELSE 'Desconocido'
            END AS Tipo,
            CASE
                WHEN compra.id IS NOT NULL THEN compra.fechaCompra
                WHEN alquiler.id IS NOT NULL THEN alquiler.fecha_inicio
            END AS Fecha
        FROM
            vehiculo
        LEFT JOIN compra ON vehiculo.id = compra.idVehiculo AND compra.idCliente = $usuarioId
        LEFT JOIN alquiler ON vehiculo.id = alquiler.idVehiculo AND alquiler.idCliente = $usuarioId
        LEFT JOIN cuentas ON cuentas.id = $usuarioId
        WHERE
            compra.id IS NOT NULL OR alquiler.id IS NOT NULL";
        
        $compras = $this->db->find($sql);
        
        [$errorPerfil, $errorSeguridad, $errorEliminar] = $this->actualizar($usuario);
    
        return new Template('./views/perfil/index.php', [
            'cuentas' => [
        'nombreCompleto' => $cuentas->nombreCompleto,
        'usuario' => $cuentas->usuario,
        'email' => $cuentas->email
    ],
            'compras' => $compras, 
            'errorPerfil' => $errorPerfil ?? null,
            'errorSeguridad' => $errorSeguridad ?? null,
            'errorEliminar' => $errorEliminar ?? null
        ]);
    }
    

    public function obtenerDatosPerfil($usuarioId) {
        $sql = "SELECT nombreCompleto, usuario, email FROM cuentas WHERE id = ?";
        $params = [$usuarioId];
        
        $resultado = $this->db->findPrepared($sql, $params, 'i');
        
        if (!empty($resultado)) {
            return $resultado[0];
        }
        
        return null;
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
        $usuarioActual = $usuarioDatos->usuario; 
    
        if (empty($nombreCompleto) || empty($nuevoUsuario) || empty($email)) {
            return 'Todos los campos son obligatorios para actualizar el perfil.';
        }
    
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
            $usuarioDatos->usuario = $nuevoUsuario;
            $usuarioDatos->nombreCompleto = $nombreCompleto; 
            $usuarioDatos->email = $email;
    
            setcookie('usuario', json_encode($usuarioDatos), time() + (86400 * 30), "/", "", false, true); 
    
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            return 'Error al actualizar los datos del perfil.';
        }
    
        return null;
    }
    


    
    
    
    private function mostrarError($mensaje) {
        return new Template('./views/perfil/index.php', ['error' => $mensaje]);
    }
}


?>