<?php

class NoEncontrada {
    private $db;
    private $title;

    public function __construct($db) {
        $this->db = $db;
        $this->title = "PP | Página Inválida";
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {
        return new Template('./views/no-encontrada/index.php', []);
    }
}
?>
