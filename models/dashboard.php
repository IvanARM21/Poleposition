<?php
class Dashboard {
    
    private $db;
    private $title;

    public function __construct($db) {
        $this->db = $db;
        $this->title = "Logout";
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {
        if (!isset($_COOKIE['usuario'])) {
            header("Location: /");
            exit();
        }
        
        $usuarioDatos = json_decode($_COOKIE['usuario'], true);
        
        if (empty($usuarioDatos['admin']) || !$usuarioDatos['admin']) {
            header("Location: /");
            exit();
        }
        $this->title = "PP | Dashboard";

        return new Template('./views/dashboard/index.php', [
        ]);
    }
}
?>