<?php

require_once('db.class.php');
require_once('template.class.php');

class App
{
    private $db;
    private $model;
    private $args;

    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);
        array_shift($uriParts);
        $this->args = array_slice($uriParts, 1); // Simplificación
        $this->connectDB();
        $this->loadModel($uriParts[0]);
    }

    public function connectDB()
    {
        $this->db = new DB();
    }

    public function loadModel($modelName)
    {
        if ($modelName != "") {
            $modelPath = "./models/" . $this->getModelFileName($modelName);
            if (file_exists($modelPath)) {
                require_once($modelPath);
                $modelName = ucfirst($this->getModelName($modelName));
                $this->model = new $modelName($this->db);
                $this->callMethod($this->model);
            } else {
                http_response_code(404);
                $this->redirectToErrorPage(); // Redirige a la página de error
            }
        } else {
            $template = new Template("./views/index.php", []);
            $this->render($template);
        }
    }

    private function getModelFileName($modelName)
    {
        if (preg_match('/-/', $modelName)) {
            $modelParts = explode('-', $modelName);
            return implode('', $modelParts) . ".php";
        }
        return $modelName . ".php";
    }

    private function getModelName($modelName)
    {
        if (preg_match('/-/', $modelName)) {
            $modelParts = explode('-', $modelName);
            return implode('', $modelParts);
        }
        return $modelName;
    }

    private function callMethod($model)
    {
        $template = "";

        // Asegúrate de que el método index esté en el modelo
        if (method_exists($model, 'index') && !isset($this->args[0])) {
            $template = $model->index();
        } else if (method_exists($model, 'create') && $this->args[0] === "crear") {
            $template = $model->create();
        } else if (method_exists($model, 'update') && $this->args[0] === "editar") {
            $template = $model->update($this->args[1]);
        } else if (method_exists($model, 'delete') && $this->args[0] === "eliminar") {
            $template = $model->delete($this->args[1]);
        } else if (method_exists($model, 'show')) {
            $template = $model->show($this->args[0]);
        } else {
            // Si no se encuentra un método, redirigir a la página de error
            $this->redirectToErrorPage();
            return; // Evitar que continúe
        }

        $layout = (get_class($model) === "Dashboard") ? "admin" : "app";
        $this->render($template, $model->getTitle(), $layout);
    }

    private function render($child, $title = "PP | Home", $layout = "app")
    {
        if ($layout === "app") {
            $view = new Template("./views/app.php", [
                "title" => $title,
                "child" => $child
            ]);
        } else if ($layout === "admin") {
            $view = new Template("./views/admin.php", [
                "title" => $title,
                "child" => $child
            ]);
        }
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