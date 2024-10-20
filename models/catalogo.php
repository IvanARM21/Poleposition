<?php

include_once __DIR__ . '/Vehiculo.php';

class Catalogo
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
        $this->title = "PP | Catalogo";

        // Obtener vehículos desde la base de datos
        $vehiculos = $this->obtenerVehiculos();


        return new Template('./views/catalogo/index.php', [
            "vehiculos" => $vehiculos
        ]);
    }

    private function obtenerVehiculos()
    {
        $sql = "
            SELECT v.id, v.marca, v.modelo, v.precio, v.color, v.kilometraje, v.año, GROUP_CONCAT(vi.imagen) as imagenes
            FROM vehiculo v
            LEFT JOIN vehiculoImagenes vi ON v.id = vi.idVehiculo
            GROUP BY v.id
        ";
        return $this->db->find($sql);
    }

    // Otros métodos...

    public function show($id)
    {
        return new Template('./views/catalogo/show.php', [
            "vehiculo" => "vehiculo"
        ]);
    }

    public function create()
    {
        // Lógica para crear
    }

    public function update($id)
    {
        // Lógica para actualizar
    }

    public function delete($id)
    {
        // Lógica para eliminar
    }
}
