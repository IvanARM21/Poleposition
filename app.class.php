<?php

require_once('db.class.php');
require_once('template.class.php');

class App
{
    private $db;
    private $model;
    private $args;

    private $layout = "app";

    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', trim($uri, '/')); // Quitar los slashes
        $this->args = array_slice($uriParts, 1); // Obtener argumentos después del primer segmento
        $this->connectDB();

        // Manejo especial para dashboard
        if ($uriParts[0] === "dashboard") {
            // Si existe un segundo segmento como "usuarios"
            $this->layout = "admin";
            if (isset($uriParts[1])) {
                $this->loadModel($uriParts[1], "dashboard/");
            } else {
                $this->loadModel('dashboard');
            }
        } else {
            $this->layout = "app";
            $this->loadModel($uriParts[0]);
        }
    }

    public function connectDB()
    {
        $this->db = new DB();
    }

    public function loadModel($modelName, $folder = "")
    {
        if ($modelName != "") {
            $modelPath = "./models/" . $folder . $this->getModelFileName($modelName);
            if (file_exists($modelPath)) {
                require_once($modelPath);
                $modelName = ucfirst($this->getModelName($modelName));
                $this->model = new $modelName($this->db);
                $this->callMethod($this->model);
            } else {
                $this->redirectToErrorPage();
            }
        } else {
            $template = new Template("./views/index.php", []);
            $this->render($template);
        }
    }

    private function getModelFileName($modelName)
    {
        return str_replace('-', '', $modelName) . ".php";
    }

    private function getModelName($modelName)
    {
        return str_replace('-', '', $modelName);
    }

    private function callMethod($model)
    {
        $template = "";

        if ($this->layout === "app") {
            $template = $this->loadApp($model);
        } else {
            $template = $this->loadAdmin($model);
        }

        $this->render($template, $model->getTitle());
    }

    private function loadApp($model)
    {
        if (method_exists($model, 'index') && !isset($this->args[0])) {
            $template = $model->index();
        } else if (method_exists($model, 'create') && isset($this->args[0]) && $this->args[0] === "crear") {
            $template = $model->create();
        } else if (method_exists($model, 'update') && isset($this->args[0]) && $this->args[0] === "editar") {
            $template = $model->update($this->args[1] ?? null);
        } else if (method_exists($model, 'delete') && isset($this->args[0]) && $this->args[0] === "eliminar") {
            $template = $model->delete($this->args[1] ?? null);
        } else if (method_exists($model, 'show') && isset($this->args[0])) {
            $template = $model->show($this->args[0]);
        } else {
            $this->redirectToErrorPage();
            return;
        }

        return $template;
    }


    private function loadAdmin($model)
    {
        if (method_exists($model, 'index') && !isset($this->args[1])) {
            $template = $model->index();
        } else if (method_exists($model, 'create') && $this->args[1] === "crear") {
            $template = $model->create();
        } else if (method_exists($model, 'update') && $this->args[1] === "editar") {
            $template = $model->update($this->args[2]);
        } else if (method_exists($model, 'delete') && $this->args[1] === "eliminar") {
            $template = $model->delete($this->args[2]);
        } else if (method_exists($model, 'show') && $this->args[1] !== "crear" && $this->args[1] !== "editar" && $this->args[1] !== "eliminar") {
            $template = $model->show($this->args[1]);
        } else {
            $this->redirectToErrorPage();
            return;
        }
        return $template;
    }

    private function render($child, $title = "PP | Home")
    {
        $view = new Template("./views/{$this->layout}.php", [
            "title" => $title,
            "child" => $child
        ]);
        echo $view;
    }

    private function redirectToErrorPage()
    {
        http_response_code(404);
        header("Location: /no-encontrada");
        exit();
    }
}

?>