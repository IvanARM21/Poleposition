<?php

class Producto
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
    // /products
    public function show($id)
    {
        // Consulrar la bd y obtener el vehiculo 

        // retornar la vista y mandar el vehiculo 
        return new Template('./views/producto/show.php', [
            // s'vehiculo' => $vehiculo,
        ]);

    }
}
