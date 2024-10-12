<?php

class Productos {

    private $db;
    private $title;
    public function __construct($db) {
        $this->db = $db;
    }

    public function getTitle() {
        return $this->title;
    }
    // /products
    public function index() {
        $sql = "SELECT * FROM vehiculo";
        $product = $this->db->find($sql);

        $this->title = "PP | Vehiculos";
        header("Location: /dashboard");
    }
    public function show($id) {
        echo $id;
        
        $product = $this->db->queryOne("SELECT * FROM products WHERE id = " . $id);

        return new Template('./views/productos/show.html', [
            "product" => $product
        ]);
    }
    
    public function create() {
        header('Content-Type: application/json');
    
        // Obtén el contenido JSON de la solicitud
        $rawData = file_get_contents('php://input');
    
        $vehicleData = json_decode($rawData, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Error en los datos JSON']);
            return;
        }
    
        $modelo = $vehicleData['modelo'] ?? '';
        $marca = $vehicleData['marca'] ?? '';
        $color = $vehicleData['color'] ?? '';
        $precio = $vehicleData['precio'] ?? 0;
        $kilometraje = $vehicleData['kilometraje'] ?? 0;
        $descripcion = $vehicleData['descripcion'] ?? '';
        $images = $vehicleData['images'] ?? [];

        $imagesName = [];
        if($images) {
          foreach($images as $image) {
            $imagesName[] = $this->uploadFiles($image);
          }
        }

        try {
            // Guardar en la BD
            $sql = "INSERT INTO Vehiculo (modelo, marca, color, precio, kilometraje, descripcion) VALUES ('$modelo', '$marca', '$color', $precio, $kilometraje, '$descripcion')";
            $idVehiculo = $this->db->save($sql);

            // Guardar Imagenes
            foreach($imagesName as $image) {
                $sql = "INSERT INTO vehiculoimagenes (idVehiculo, imagen) VALUES ($idVehiculo, '$image')";
                $this->db->save($sql);
            }

            echo json_encode(['ok' => true, 'message' => 'Se ha guardado correctamente.']);
        } catch (\Throwable $th) {
            echo json_encode(['ok' => false, 'message' => 'Ha ocurrido un error.']);
        }
        exit;

    }

    public function update($id) {
        
    }

    public function delete($id) {
        
    }

    public function uploadFiles($file) {
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

}
