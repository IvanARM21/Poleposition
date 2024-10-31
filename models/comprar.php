<?php

class Comprar
{
    private $db;
    private $title;
    private $nombre = '';
    private $apellido = '';
    private $email = '';
    private $errors = [];
    private $inputData = [];

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

        if (!isset($_COOKIE['usuario'])) {
            header("Location: /login");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->validateInput();
        }

        return new Template('./views/comprar/index.php', [
            'title' => $this->title,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'errors' => $this->errors,
            'inputData' => $this->inputData
        ]);
    }

    private function validateInput()
    {
        function limpiarDato($dato)
        {
            return htmlspecialchars(trim($dato));
        }

        $this->inputData['nombre'] = limpiarDato($_POST["nombre"]);
        if (empty($this->inputData['nombre'])) {
            $this->errors['nombre'] = "El nombre es obligatorio.";
        }

        $this->inputData['apellido'] = limpiarDato($_POST["apellido"]);
        if (empty($this->inputData['apellido'])) {
            $this->errors['apellido'] = "El apellido es obligatorio.";
        }

        $this->inputData['email'] = limpiarDato($_POST["email"]);
        if (empty($this->inputData['email'])) {
            $this->errors['email'] = "El email es obligatorio.";
        } elseif (!filter_var($this->inputData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Formato de email inválido.";
        }

        $this->inputData['direccion'] = limpiarDato($_POST["direccion"]);
        if (empty($this->inputData['direccion'])) {
            $this->errors['direccion'] = "La dirección es obligatoria.";
        }

        $this->inputData['ciudad'] = limpiarDato($_POST["ciudad"]);
        if (empty($this->inputData['ciudad'])) {
            $this->errors['ciudad'] = "La ciudad es obligatoria.";
        }

        $this->inputData['codigo'] = limpiarDato($_POST["codigo"]);
        if (empty($this->inputData['codigo'])) {
            $this->errors['codigo'] = "El código postal es obligatorio.";
        } elseif (!preg_match("/^[0-9]{5}$/", $this->inputData['codigo'])) {
            $this->errors['codigo'] = "El código postal debe tener 5 dígitos.";
        }

        $this->inputData['pais'] = limpiarDato($_POST["pais"]);
        if (empty($this->inputData['pais'])) {
            $this->errors['pais'] = "El país es obligatorio.";
        }

        $this->inputData['telefono'] = limpiarDato($_POST["telefono"]);
        if (empty($this->inputData['telefono'])) {
            $this->errors['telefono'] = "El teléfono es obligatorio.";
        } elseif (!preg_match("/^[0-9]{9}$/", $this->inputData['telefono'])) {
            $this->errors['telefono'] = "El teléfono debe tener 9 digitos.";
        }

        $this->inputData['tarjeta'] = limpiarDato($_POST["tarjeta"]);
        if (empty($this->inputData['tarjeta'])) {
            $this->errors['tarjeta'] = "El número de tarjeta es obligatorio.";
        } elseif (!preg_match("/^[0-9]{16}$/", $this->inputData['tarjeta'])) {
            $this->errors['tarjeta'] = "El número de tarjeta debe tener 16 dígitos.";
        }

        $this->inputData['nombreTarjeta'] = limpiarDato($_POST["nombreTarjeta"]);
        if (empty($this->inputData['nombreTarjeta'])) {
            $this->errors['nombreTarjeta'] = "El nombre en la tarjeta es obligatorio.";
        }

        $this->inputData['caducidad'] = limpiarDato($_POST["caducidad"]);
        if (empty($this->inputData['caducidad'])) {
            $this->errors['caducidad'] = "La fecha de caducidad es obligatoria.";
        } elseif (!preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{2})$/", $this->inputData['caducidad'])) {
            $this->errors['caducidad'] = "La fecha de caducidad debe tener el formato MM/AA.";
        } else {
            $caducidad = DateTime::createFromFormat('m/y', $this->inputData['caducidad']);
            $caducidad->modify('last day of this month');

            if ($caducidad < new DateTime()) {
                $this->errors['caducidad'] = "La fecha de caducidad está vencida.";
            }
        }

        $this->inputData['cvc'] = limpiarDato($_POST["cvc"]);
        if (empty($this->inputData['cvc'])) {
            $this->errors['cvc'] = "El CVC es obligatorio.";
        } elseif (!preg_match("/^[0-9]{3,5}$/", $this->inputData['cvc'])) {
            $this->errors['cvc'] = "El CVC debe tener entre 3 y 5 dígitos.";
        }


        if (empty($this->errors)) {
            header("Location: confirmacion.php");
            exit;
        }
    }
}
