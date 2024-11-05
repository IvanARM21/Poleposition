<?php

class Admin
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
        echo json_encode(["error" => "Mtodo no permitido"]);
exit;
    }

    public function show($id)
    {
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 Method Not Allowed");
            echo json_encode(["error" => "Método no permitido"]);
            exit;
        }
    
        header('Content-Type: application/json');  // Establece que la respuesta será JSON
    
        // Obtén el contenido JSON de la solicitud
        $rawData = file_get_contents('php://input');
        $vehicleData = json_decode($rawData, true);  // Decodifica JSON
    
        // Comprueba si el JSON es válido
        if ($vehicleData === null) {
            echo json_encode(["error" => "No se pudo decodificar el JSON"]);
            http_response_code(400);
            exit;
        }
    
        // Envía una respuesta JSON con la ID y los datos recibidos
        echo json_encode([
            "id" => $id,
            "receivedData" => $vehicleData
        ]);
        exit;
    }

}