<?php

class Productos
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
        $sql = "
            SELECT v.id, v.marca, v.modelo, v.precio, v.color, v.kilometraje, v.año, GROUP_CONCAT(vi.imagen) as imagenes
            FROM vehiculo v
            LEFT JOIN vehiculoImagenes vi ON v.id = vi.idVehiculo
            GROUP BY v.id
        ";
        $vehiculos = $this->db->find($sql);
        echo json_encode($vehiculos);
        exit;
    }
    public function show($id)
    {
        header('Content-Type: application/json');

        $sql = "SELECT v.*, GROUP_CONCAT(vi.imagen SEPARATOR ',') AS imagenes 
        FROM Vehiculo v 
        LEFT JOIN vehiculoimagenes vi ON v.id = vi.idVehiculo 
        WHERE v.id = $id 
        GROUP BY v.id";

        // Ejecuta la consulta y verifica si falló
        $vehicle = $this->db->find($sql);
        if (!$vehicle) {
            echo json_encode(['vehicle' => false, 'message' => 'Error en la consulta SQL: ' . $this->db->error()]);
            exit;
        }

        echo json_encode(['vehicle' => $vehicle, 'message' => 'Se ha guardado correctamente.']);
        exit;
    }

    public function create()
    {
        header('Content-Type: application/json');

        // Obtén el contenido JSON de la solicitud
        $rawData = file_get_contents('php://input');

        $vehicleData = json_decode($rawData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Error en los datos']);
            return;
        }

        $modelo = $vehicleData['modelo'] ?? '';
        $marca = $vehicleData['marca'] ?? '';
        $color = $vehicleData['color'] ?? '';
        $precio = $vehicleData['precio'] ?? 0;
        $kilometraje = $vehicleData['kilometraje'] ?? 0;
        $descripcion = $vehicleData['descripcion'] ?? '';
        $año = $vehicleData["año"];
        $images = $vehicleData['images'] ?? [];

        $imagesName = [];
        if ($images) {
            foreach ($images as $image) {
                $imagesName[] = $this->uploadFiles($image);
            }
        }

        try {
            // Guardar en la BD
            $sql = "INSERT INTO Vehiculo (modelo, marca, color, precio, kilometraje, descripcion, año) VALUES ('$modelo', '$marca', '$color', $precio, $kilometraje, '$descripcion', $año)";
            $idVehiculo = $this->db->save($sql);

            echo $idVehiculo;
            echo $sql;

            // Guardar Imagenes
            foreach ($imagesName as $image) {
                $sql = "INSERT INTO vehiculoimagenes (idVehiculo, imagen) VALUES ($idVehiculo, '$image')";
                $this->db->save($sql);
            }

            echo json_encode(['ok' => true, 'message' => 'Se ha guardado correctamente.']);
        } catch (\Throwable $th) {
            echo json_encode(['ok' => false, 'message' => 'Ha ocurrido un error.']);
        }
        exit;

    }

    public function update($id)
    {
        header('Content-Type: application/json');

        // Obtén el contenido JSON de la solicitud
        $rawData = file_get_contents('php://input');

        $vehicleData = json_decode($rawData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Error en los datos']);
            exit;
        }

        $modelo = $vehicleData['modelo'] ?? '';
        $marca = $vehicleData['marca'] ?? '';
        $color = $vehicleData['color'] ?? '';
        $precio = $vehicleData['precio'] ?? 0;
        $kilometraje = $vehicleData['kilometraje'] ?? 0;
        $año = $vehicleData["año"];
        $descripcion = $vehicleData['descripcion'] ?? '';
        $imagenesCrear = $vehicleData['imagenesCrear'] ?? [];
        $imagenesEliminar = $vehicleData['imagenesEliminar'] ?? [];

        $imagenesCreadas = [];
        if ($imagenesCrear) {
            foreach ($imagenesCrear as $image) {
                $imagenesCreadas[] = $this->uploadFiles($image);
            }
        }
        // Guardar Imagenes
        foreach ($imagenesCreadas as $image) {
            $sql = "INSERT INTO vehiculoimagenes (idVehiculo, imagen) VALUES ($id, '$image')";
            $this->db->save($sql);
        }

        if ($imagenesEliminar) {
            foreach ($imagenesEliminar as $imageName) {
                $this->deleteFile($imageName);
                $sql = "DELETE FROM vehiculoimagenes WHERE imagen = '$imageName'";
                $this->db->delete($sql);
            }
        }

        // Guardar vehiculo
        $sql = "UPDATE Vehiculo 
        SET modelo = '$modelo', 
            marca = '$marca', 
            color = '$color', 
            precio = $precio, 
            kilometraje = $kilometraje, 
            descripcion = '$descripcion', 
            año = $año 
        WHERE id = $id";

        $this->db->save($sql);

        // Eliminar en BD
        echo json_encode(['ok' => true, 'message' => 'Se ha guardado correctamente.']);

        exit;


    }

    public function delete($id)
    {
        header('Content-Type: application/json');

        // Eliminar Vehiculo
        if ($id) {
            $imagesName = $this->getImages($id);
            if ($imagesName) {
                foreach ($imagesName as $imageName) {
                    $this->deleteFile($imageName->imagen);
                }
            }
            $sqlImages = "DELETE FROM vehiculoimagenes WHERE idVehiculo = $id";
            $this->db->delete($sqlImages);
            $sql = "DELETE FROM vehiculo WHERE id = $id";
            $this->db->delete($sql);
            echo json_encode(['ok' => true, 'message' => 'Se ha eliminado correctamente.']);

        } else {
            echo json_encode(['ok' => false, 'message' => 'Ha ocurrido un error.']);
        }
        // Ejemplo 
        // echo json_encode(['ok' => false, 'message' => 'Ha ocurrido un error.']);
        exit;
    }

    public function getImages($idVehiculo)
    {
        $sql = "SELECT * FROM vehiculoimagenes WHERE idVehiculo = $idVehiculo";
        $imagesName = $this->db->find($sql);
        return $imagesName;
    }

    public function uploadFiles($file)
    {
        $base64Str = $file;
        $base64String = preg_replace('#^data:image/\w+;base64,#i', '', $base64Str);

        // Decodificar Base64
        $imageData = base64_decode($base64String);

        // Nombre unico
        $imageUnique = md5(uniqid(rand(), true)) . ".webp";

        $uploadDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        // Direction para subir archivos

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filePath = $uploadDir . $imageUnique;


        file_put_contents($filePath, $imageData);

        // Retornamos la URL completa para guardar su nombre en BD 
        return $imageUnique;
    }

    public function deleteFile($fileName)
    {

        $uploadDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;

        $filePath = $uploadDir . $fileName;

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
