<?php 

require_once('db.class.php');
require_once('template.class.php');

class App {
    private $db;
    private $model;
    private $args;

    // Se encarga de obtener la URL actual una vez llamado desde index.php
    public function __construct() {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);
        array_shift($uriParts);
        for($i = 1; $i < count($uriParts); $i++) {
            $this->args[] = $uriParts[$i];
        }
        $this->connectDB();
        $this->loadModel($uriParts[0]);
    }

    public function connectDB() {
        $this->db = new DB();
    }

    public function loadModel($modelName) {
        if($modelName != "") {
            if(preg_match('/-/', $modelName)) {
                $modelParts = explode('-', $modelName);
                $newName = implode('', $modelParts);
                require_once("./models/" . $newName . ".php");
                $modelName = ucfirst($newName);
            } else {
                require_once("./models/" . $modelName . ".php");
                $modelName = ucfirst($modelName);
            }
            $this->model = new $modelName($this->db);
            $this->callMethod($this->model);
        } else {
            $template = new Template("./views/index.php", []);
            $this->render($template);
        }
    }

    private function callMethod($model) {
        $template = "";

        if(!isset($this->args[0])) {
            $template = $model->index();
        } else if($this->args[0] === "crear") {
            $template = $model->create(); 
        } else if($this->args[0] === "editar") {
            $template = $model->update($this->args[1]); 
        } else if ($this->args[0] === "delete") {
            $template = $model->delete($this->args[1]); 
        } else {
            $template = $model->show($this->args[0]);
        }

        $layout = "app";
        if(get_class($model) === "Dashboard") {
            $layout = "admin";
        }
        $this->render($template, $model->getTitle(), $layout);
    }

    private function render($child, $title = "PP | Home", $layout = "app") {
        if($layout === "app") {
            $view = new Template("./views/app.php", [
                "title" => $title,
                "child" => $child
            ]);
        } else if($layout === "admin") {
            $view = new Template("./views/admin.php", [
                "title" => $title,
                "child" => $child
            ]);
        }
       
        echo $view;
    }
}