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

        $this->title = "Dashboard | Historial";

       $sql = "SELECT cuentas.id AS Cuenta,
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
        FROM vehiculo
        LEFT JOIN compra ON vehiculo.id = compra.idVehiculo
        LEFT JOIN alquiler ON vehiculo.id = alquiler.idVehiculo
        LEFT JOIN cuentas ON cuentas.id = COALESCE(compra.idCliente, alquiler.idCliente)
        WHERE compra.id IS NOT NULL OR alquiler.id IS NOT NULL;";

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