<?php

class Review
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