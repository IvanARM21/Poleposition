<?php

class CompraConfirmada
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

        $this->title = "PP | Compra Confirmada";

        return new Template('./views/compra-confirmada/index.php', [
        ]);
    }

    public function show($id)
    {

    }

    public function create()
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}