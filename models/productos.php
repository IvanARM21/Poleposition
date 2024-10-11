<?php

// Modelo de la página de Products
class Productos {

    private $db;
    private $title;

    // Se le pasa la instancia de la base de datos
    // para poder insertar datos guardar datos y así
    public function __construct($db) {
        $this->db = $db;
    }

    public function getTitle() {
        return $this->title;
    }

    // Este es el index de en este caso Página Productos
    // /products
    public function index() {
        $sql = "SELECT * FROM vehiculo";
        $product = $this->db->find($sql);

        // Creamos el título de está página
        $this->title = "PP | Vehiculos";
        header("Location: /dashboard");
    }

    // Esta es la página donde podemos ver el producto
    // /products/1
    public function show($id) {
        echo $id;
        
        $product = $this->db->queryOne("SELECT * FROM products WHERE id = " . $id);

        return new Template('./views/productos/show.html', [
            "product" => $product
        ]);
    }
    
    // En los siguientes metodos creo que se deben realizar modificiones en
    // callMethod para incluirlos de forma correcta

    // Aquí podemos crear un nuevo producto
    // /products/create
    public function create() {
        // Desactiva la visualización de errores
        error_reporting(E_ALL);
        ini_set('display_errors', 0);
    
        // Configura el encabezado para JSON
        header('Content-Type: application/json');
    
        // Obtén el contenido JSON de la solicitud
        $rawData = file_get_contents('php://input');
    
        // Decodifica el JSON a un array asociativo
        $vehicleData = json_decode($rawData, true);
    
        // Verifica si hubo un error en la decodificación
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Error en los datos JSON']);
            return;
        }
    
        // Accede a los datos
        $marca = $vehicleData['marca'] ?? '';
        $modelo = $vehicleData['modelo'] ?? '';
        $color = $vehicleData['color'] ?? '';
        $precio = $vehicleData['precio'] ?? 0;
        $kilometraje = $vehicleData['kilometraje'] ?? 0;
        $descripcion = $vehicleData['descripcion'] ?? '';
        $images = $vehicleData['images'] ?? [];
    
        // Genera la respuesta
        $response = ['status' => 'success', 'data' => $vehicleData];
        $jsonResponse = json_encode($response);

        return $jsonResponse;
    
        // Verifica si hubo un error al codificar el JSON
        if ($jsonResponse === false) {
            echo json_encode(['status' => 'error', 'message' => 'Error en la codificación JSON']);
            return;
        }
    
        // Envía la respuesta JSON

        echo $jsonResponse;
    }
    
    
    
    

    // Aquí podemos actualizar un producto
    public function update($id) {
        
    }

    // Aquí podemos eliminar un producto
    public function delete($id) {
        
    }
}