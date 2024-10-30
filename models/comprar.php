<?php

// Modelo de la página de Products
class Comprar
{
    private $db;
    private $title;
    private $nombre = '';
    private $apellido = '';
    private $email = '';

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

        if (isset($_COOKIE['usuario'])) {
            $usuarioData = json_decode($_COOKIE['usuario'], true);

            $this->email = $usuarioData['email'];

            $nombreCompleto = $usuarioData['nombreCompleto'];
            $nombreApellido = explode(' ', $nombreCompleto, 2);
            $this->nombre = $nombreApellido[0];
            $this->apellido = isset($nombreApellido[1]) ? $nombreApellido[1] : '';
        }

        return new Template('./views/comprar/index.php', [
            'title' => $this->title,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email
        ]);
    }
}
