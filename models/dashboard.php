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

        $sql = "
            SELECT 
                v.*, 
                GROUP_CONCAT(vi.imagen SEPARATOR ',') AS imagenes
            FROM 
                Vehiculo v
            LEFT JOIN 
                vehiculoimagenes vi ON v.id = vi.idVehiculo
            GROUP BY 
                v.id";

        $vehiculos = $this->db->find($sql);

        json_encode($vehiculos);

        $this->title = "PP | Dashboard";

        return new Template('./views/dashboard/index.php', [
            "vehiculos" => $vehiculos
        ]);
    }
}
?>