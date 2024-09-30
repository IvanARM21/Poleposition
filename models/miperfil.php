<?php

include_once 'db.class.php';

// Modelo de la página de Products
class MiPerfil {

    private $db;
    private $title;

    // Se le pasa la instancia de la base de datos
    // para poder insertar datos guardar datos y así
    public function __construct($db) {
        $this->db = $db;
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {
        if (!isset($_COOKIE['usuario'])) {
            header("Location: /");
        }
    
        $usuarioDatos = json_decode($_COOKIE['usuario'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die('Error decoding JSON cookie.');
        }
    
        $usuario = $usuarioDatos['usuario'];
        $this->title = "PP | Mi Perfil";
    
        $stmt = $this->db->getConexion()->prepare("SELECT nombreCompleto, usuario, email FROM cuentas WHERE usuario = ?");
        if (!$stmt) {
            die('Prepare failed: ' . htmlspecialchars($this->db->getConexion()->error));
        }
    
        $stmt->bind_param('s', $usuario);
        $stmt->execute();

        $result = $stmt->get_result();
    
        $usuarioDB = $result->fetch_assoc();
        if ($usuarioDB === null) {
            error_log('No user found for usuario: ' . htmlspecialchars($usuario));
            die('No user found.');
        }
    
        return new Template('./views/miperfil/index.php', [
            'usuarioDB' => $usuarioDB,
        ]);
    }
}    
?>