<?php 

require_once('db.class.php');
require_once('template.class.php');

class App {
    private $db;
    private $model;
    private $args;

    // Se encarga de obtener la URL actual una vez llamado desde index.php
    public function __construct() {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);
        array_shift($uriParts);
        for($i = 1; $i < count($uriParts); $i++) {
            $this->args[] = $uriParts[$i];
        }
        // Conexión a la BD
        $this->connectDB();
        // uri = www.poleposition.com/productos 
        // uriParts[0] = productos
        $this->loadModel($uriParts[0]);
    }

    // Conecta a la base de datos y se guarda en el App
    public function connectDB() {
        $this->db = new DB();
    }

    // Carga el modelo correspondiente segun la primera parte de la url
    public function loadModel($modelName) {
        // $modelName = "products"
        if($modelName != "") {
            // llama al ./models/products.php
            require_once("./models/" . $modelName . ".php");
            // transorma products a Products
            $modelName = ucfirst($modelName);
    
            // LLamamos al modelo correspondiente (según la URL)
            $this->model = new $modelName($this->db);
            $this->callMethod($this->model);
        } else {
            $template = new Template("./views/index.php", []);
            $this->render($template);
        }
    }

    // Realizar modificaciones para ejecutar CREATE UPDATE DELETE
    private function callMethod($model) {
        $template = "";
        if(!isset($this->args[0])) {
            $template = $model->index();
        } else {
            $template = $model->index(); 
        }
        $this->render($template, $model->getTitle());
    }

    // Renderiza el app.php que contiene la base como el link a la hoja de estilos, etiqueta head el header y footer
    private function render($child, $title = "PP | Home") {
        $view = new Template("./views/app.php", [
            "title" => $title,
            "child" => $child
        ]);
        // Imprime esta vista que contiene dentro el $child y $title
        echo $view;
    }
}