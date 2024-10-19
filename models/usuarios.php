<?php

class SobreNosotros
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

        $this->title = "PP | Contacto";

        return new Template('./views/dashboard/usuarios/index.php', [
        ]);
    }
}