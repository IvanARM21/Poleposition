<?php

class SobreNosotros {

    private $db;
    private $title;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {
        
        $this->title = "PP | Contacto";

        return new Template('./views/sobre-nosotros/index.php', [
        ]);
    }

    public function show($id) {

       return new Template('./views/404.php', [
        ]);
    }
    
    public function create() {
        
    }

    public function update($id) {
        
    }

    public function delete($id) {
        
    }
}