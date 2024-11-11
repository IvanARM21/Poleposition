<?php

class Testimonios
{

    private $db;
    private $title;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function index()
    {


        if (!isset($_COOKIE['usuario'])) {
            header("Location: /");
            exit();
        }
        
        $usuarioDatos = json_decode($_COOKIE['usuario'], true);
        
        if (empty($usuarioDatos['admin']) || !$usuarioDatos['admin']) {
            header("Location: /");
            exit();
        }
        
        $this->title = "Dashboard | Testimonio";

        $sql = "SELECT 
    id AS id,
    idVehiculo AS vehiculo,
    idCliente AS cliente,
    calificacion AS calificacion,
    mensaje AS mensaje,
    titulo AS titulo,
    autor AS autor
FROM testimonio;
";
        
        $testimonio = $this->db->find($sql);
        json_encode(value: $testimonio);


        return new Template('./views/dashboard/testimonios/index.php', [
            "testimonio" => $testimonio
        ]);
    }

    public function show($id)
    {
        $this->title = "Dashboard | Testimonio ";

        return new Template('./views/dashboard/testimonios/show.php', [
        ]);
    }

}