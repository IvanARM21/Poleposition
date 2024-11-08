<?php

class Historial
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
        
        $this->title = "Dashboard | Historial";

        $sql = "SELECT 
    c.idCliente AS Cuenta,
    CONCAT(c.nombre, ' ', c.apellido) AS Nombre,
    v.marca AS Marca,
    v.modelo AS Modelo,
    v.color AS Color,
    v.kilometraje AS Kilometraje,
    v.año AS Año,
    'Compra' AS Tipo,
    c.fechaCompra AS Fecha
FROM compra c
JOIN vehiculo v ON c.idVehiculo = v.id

UNION ALL

SELECT 
    a.idCliente AS Cuenta,
    CONCAT(a.nombre, ' ', a.apellido) AS Nombre,
    v.marca AS Marca,
    v.modelo AS Modelo,
    v.color AS Color,
    v.kilometraje AS Kilometraje,
    v.año AS Año,
    'Alquiler' AS Tipo,
    a.fecha_inicio AS Fecha
FROM alquiler a
JOIN vehiculo v ON a.idVehiculo = v.id
ORDER BY Fecha DESC;
";
        
        $historial = $this->db->find($sql);
        json_encode(value: $historial);


        return new Template('./views/dashboard/historial/index.php', [
            "historial" => $historial
        ]);
    }

    public function show($id)
    {
        $this->title = "Dashboard | Historial ";

        return new Template('./views/dashboard/historial/show.php', [
        ]);
    }

}