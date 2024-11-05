<?php

// Modelo de la página de Products
class AgregarMetodo {

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
        
        $this->title = "PP | Agregar Metodo de Pago ";

        return new Template('./views/agregarmetodo/index.php', [
            
        ]);
    }

    
   
}