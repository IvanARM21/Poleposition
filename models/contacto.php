<?php

// Modelo de la página de Products
class Contacto {

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
        
        $this->title = "PP | Contacto";

        return new Template('./views/contacto/index.php', [
        ]);
    }

    // Esta es la página donde podemos ver el producto
    // /products/1
    public function show($id) {

       return new Template('./views/404.php', [
        ]);
    }
    
    // En los siguientes metodos creo que se deben realizar modificiones en
    // callMethod para incluirlos de forma correcta

    // Aquí podemos crear un nuevo producto
    // /products/create
    public function create() {
        
    }

    // Aquí podemos actualizar un producto
    public function update($id) {
        
    }

    // Aquí podemos eliminar un producto
    public function delete($id) {
        
    }
}