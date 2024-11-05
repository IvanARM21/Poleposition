<?php

class Review
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


    public function show($id)
    {

    }

    public function create()
    {
        try {
            header('Content-Type: application/json');
            
            // Obtén el contenido JSON de la solicitud
            $rawData = file_get_contents('php://input');

            $formData = json_decode($rawData, true);

            $titulo = $formData['titulo'] ?? '';   
            $mensaje = $formData['mensaje'] ?? ''; 
            $calificacion = $formData['calificacion'] ?? 1; 
            $autor = $formData['autor'] ?? ''; 
            $idVehiculo = $formData['idVehiculo'] ?? null;
            $idCliente = $formData['idCliente'] ?? null;

            $sql = "INSERT INTO testimonio (idVehiculo, idCliente, calificacion, mensaje, titulo, autor) VALUES ($idVehiculo, $idCliente, $calificacion, '$mensaje', '$titulo', '$autor')";
            $result = $this->db->save($sql);

            if($result > 0) {
                echo json_encode(["error" => false, "message" => "Se ha creado correctamente el testimonio"]);
            } else {
                echo json_encode(["error" => true, "message" => "Hubo un error al crear el testimonio: "]);
            }

        } catch (Exception $e) {
            echo json_encode(["error" => true, "message" => "Hubo un error al crear el testimonio: " . $e->getMessage()]);
        }

        exit;
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}