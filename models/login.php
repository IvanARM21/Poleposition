<?php

class Login {

    private $db;
    private $title;
  
    public function __construct($db) {
        $this->db = $db;
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {
        if (isset($_COOKIE['usuario'])) {
            header("Location: /");
            exit();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $this->db->getConexion()->real_escape_string($_POST['usuario']);
            $contraseña = $this->db->getConexion()->real_escape_string($_POST['contraseña']);

            // Validación de campos vacíos
            if (empty($usuario) || empty($contraseña)) {
                $error = 'Todos los campos son obligatorios.';
            } else {
                // Verifica el usuario en la base de datos
                $sql = "SELECT * FROM cuentas WHERE usuario = '$usuario'";
                $usuarioDB = $this->db->findOne($sql);

                if (!$usuarioDB) {
                    $error = 'El usuario no existe.';
                } else {
                    $contraseñaBd = $usuarioDB->password;

                    // Verifica la contraseña
                    if (!password_verify($contraseña, $contraseñaBd)) {
                        $error = 'La contraseña es incorrecta.';
                    } else {
                        // Autenticación exitosa
                        $sql = "SELECT * FROM admin WHERE idAdmin = '$usuarioDB->id'";
                        $esAdmin = $this->db->findOne($sql);
                        $usuarioDatos = [ "id" => $usuarioDB->id, "usuario" => $usuarioDB->usuario, "email" => $usuarioDB->email, "admin" => $esAdmin->id, "nombreCompleto" => $usuarioDB->nombreCompleto];
                        setcookie('usuario', json_encode($usuarioDatos), time() + (86400 * 30));   
                        if($esAdmin->id) {
                            header("Location: /dashboard");
                        } else {
                            header("Location: /");
                        }
                        exit();
                    }
                }
            }
        }

        $this->title = "PP | Login";

        // Pasa el mensaje de error a la vista
        return new Template('./views/login/index.php', ['error' => $error ?? null]);
    }
}
