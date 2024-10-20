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

        $sql = "SELECT c.*, 
       IF(a.idAdmin IS NOT NULL, 'Admin', 'Usuario') AS tipo
FROM cuentas c
LEFT JOIN admin a ON c.id = a.idAdmin;
";

        $usuarios = $this->db->find($sql);
        json_encode(value: $usuarios);


        return new Template('./views/dashboard/usuarios/index.php', [
            "usuarios" => $usuarios
        ]);
    }

    public function show($id)
    {
        $this->title = "Dashboard | Usuario ";

        return new Template('./views/dashboard/usuarios/show.php', [
        ]);
    }

}