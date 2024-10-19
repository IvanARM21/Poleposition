<?php

class Usuarios
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

        $this->title = "Dashboard | Usuarios";


        return new Template('./views/dashboard/usuarios/index.php', [
        ]);
    }

    public function show($id)
    {
        $this->title = "Dashboard | Usuario ";

        return new Template('./views/dashboard/usuarios/show.php', [
        ]);
    }

}