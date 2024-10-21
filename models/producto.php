<?php

class Producto
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
    // /products
    public function show($id)
    {
        $sql = "
                SELECT v.id, v.marca, v.descripcion, v.modelo, v.año, v.color, v.precio, v.kilometraje, GROUP_CONCAT(vi.imagen) as imagenes
                FROM vehiculo v
                LEFT JOIN vehiculoImagenes vi ON v.id = vi.idVehiculo
                WHERE v.id = ?
                GROUP BY v.id
            ";

        $vehiculos = $this->db->findPrepared($sql, [$id], 'i');

        $vehiculo = $vehiculos[0];

        $this->title = "PP | " . $vehiculo->marca . " " . $vehiculo->modelo;

        return new Template('./views/producto/show.php', [
            'vehiculo' => $vehiculo,
        ]);

    }
}
