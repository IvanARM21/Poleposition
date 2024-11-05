<?php

class Logout {

    private $db;
    private $title;

    public function __construct($db) {
        $this->db = $db;
        $this->title = "Logout";
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {
        setcookie('usuario', '', time() - (86400*30));
        header("Location: /");
        exit();
    }
}