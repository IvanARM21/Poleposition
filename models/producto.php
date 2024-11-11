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

    // /producto/{id}
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

        if (count($vehiculos) > 0) {
            $vehiculo = $vehiculos[0]; 

            $sql2 = "
                SELECT id AS id, idVehiculo AS vehiculo, idCliente AS cliente, calificacion AS calificacion,
                       mensaje AS mensaje, titulo AS titulo, autor AS autor
                FROM testimonio
                WHERE idVehiculo = ?
            ";

            $testimonios = $this->db->findPrepared($sql2, [$id], 'i');

            $testimonio = !empty($testimonios) ? $testimonios[0] : null;

            // Establece el título para la página
            $this->title = "PP | " . $vehiculo->marca . " " . $vehiculo->modelo;

            return new Template('./views/producto/show.php', [
                'vehiculo' => $vehiculo,
                'testimonio' => $testimonio
            ]);
        } else {
            throw new Exception("Vehículo no encontrado.");
        }
    }
}
