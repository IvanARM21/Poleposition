<?php

// Modelo de la página de Products
class Comprar
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

        $this->title = "PP | Comprar";

        return new Template('./views/comprar/index.php', [
        ]);
    }
}