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


   

    public function create()
    {
        try {
            header('Content-Type: application/json');

            $rawData = file_get_contents('php://input');

            $formData = json_decode($rawData, true);

            $titulo = $formData['titulo'] ?? '';
            $mensaje = $formData['mensaje'] ?? '';
            $calificacion = $formData['calificacion'] ?? 1;
            $autor = $formData['autor'] ?? '';
            $idVehiculo = $formData['idVehiculo'] ?? null;
            $idCliente = $formData['idCliente'] ?? null;

            $sql = "INSERT INTO Testimonio (idVehiculo, idCliente, calificacion, mensaje, titulo, autor) VALUES ($idVehiculo, $idCliente, $calificacion, '$mensaje', '$titulo', '$autor')";

            $result = $this->db->save($sql);

            if ($result > 0) {
                echo json_encode(["error" => false, "message" => "Se ha creado correctamente el testimonio"]);
            } else {
                echo json_encode(["error" => true, "message" => "Hubo un error al crear el testimonio", "result" => $result]);
            }

        } catch (Exception $e) {
            echo json_encode(["error" => true, "message" => "Hubo un error al crear el testimonio: " . $e->getMessage()]);
        }

        exit;
    }

    public function show($id)
    {
        try {
            header('Content-Type: application/json');

            if (empty($id) || !is_numeric($id)) {
                echo json_encode(["error" => true, "message" => "ID inválido."]);
                exit;
            }

            $sql = "SELECT * FROM Testimonio WHERE id = $id";
            $result = $this->db->findOne($sql);

            if ($result) {
                echo json_encode(["error" => false, "testimonio" => $result]);
            } else {
                echo json_encode(["error" => true, "message" => "No se encontró el testimonio con el ID proporcionado."]);
            }
        } catch (Exception $e) {
            echo json_encode(["error" => true, "message" => "Hubo un error al obtener el testimonio: " . $e->getMessage()]);
        }

        exit;
    }

    public function delete($id)
    {
        header('Content-Type: application/json');

        if ($id) {
            $sqlTestimonio = "DELETE FROM testimonio WHERE id = $id";
            $this->db->delete($sqlTestimonio);


            echo json_encode(['ok' => true, 'message' => 'Se ha eliminado correctamente.']);
        } else {
            echo json_encode(['ok' => false, 'message' => 'Ha ocurrido un error.']);
        }
        exit;
    }

    public function update($id)
{
    header('Content-Type: application/json');

    $rawData = file_get_contents('php://input');
    $testimonialData = json_decode($rawData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['status' => 'error', 'message' => 'Error en los datos recibidos']);
        exit;
    }

    $calificacion = $testimonialData['calificacion'] ?? null;
    $mensaje = $testimonialData['mensaje'] ?? null;
    $titulo = $testimonialData['titulo'] ?? null;
    $autor = $testimonialData['autor'] ?? null;

    if ($calificacion === null || $mensaje === null) {
        echo json_encode(['status' => 'error', 'message' => 'Campos obligatorios faltantes']);
        exit;
    }

    if (!is_numeric($calificacion) || $calificacion < 0 || $calificacion > 5) {
        echo json_encode(['status' => 'error', 'message' => 'La calificación debe ser un número entre 0 y 5']);
        exit;
    }

    if (strlen($mensaje) > 100) {
        echo json_encode(['status' => 'error', 'message' => 'El mensaje excede los 100 caracteres permitidos']);
        exit;
    }

    if ($titulo !== null && strlen($titulo) > 20) {
        echo json_encode(['status' => 'error', 'message' => 'El título excede los 20 caracteres permitidos']);
        exit;
    }

    if ($autor !== null && strlen($autor) > 30) {
        echo json_encode(['status' => 'error', 'message' => 'El autor excede los 30 caracteres permitidos']);
        exit;
    }

    $sql = "UPDATE testimonio 
            SET calificacion = $calificacion, 
                mensaje = '$mensaje', 
                titulo = " . ($titulo !== null ? "'$titulo'" : "NULL") . ", 
                autor = " . ($autor !== null ? "'$autor'" : "NULL") . " 
            WHERE id = $id";

    try {
        $this->db->save($sql);
        echo json_encode(['ok' => true, 'message' => 'Testimonio actualizado correctamente.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el testimonio: ' . $e->getMessage()]);
    }

    exit;
}

}