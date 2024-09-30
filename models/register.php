<?php

class Register {

    private $db;
    private $title;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {

        $error = null;

        if (isset($_COOKIE['usuario'])) {
            header("Location: /");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombreCompleto = trim($_POST['NombreCompleto']);
            $correo = trim($_POST['Correo']);
            $usuario = trim($_POST['Usuario']);
            $contraseña = $_POST['Contraseña'];
            $repetirContraseña = $_POST['RepetirContraseña'];

            // Validaciones
            if (empty($nombreCompleto) || empty($correo) || empty($usuario) || empty($contraseña) || empty($repetirContraseña)) {
                $error = 'Todos los campos son obligatorios.';
            } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $error = 'El correo electrónico no es válido.';
            } elseif (strlen($contraseña) < 8) {
                $error = 'La contraseña debe tener al menos 8 caracteres.';
            } elseif ($contraseña !== $repetirContraseña) {
                $error = 'Las contraseñas no coinciden.';
            } else {
                // Verifica si el usuario o el correo ya existen
                $usuarioEscaped = $this->db->getConexion()->real_escape_string($usuario);
                $correoEscaped = $this->db->getConexion()->real_escape_string($correo);

                $sqlUsuario = "SELECT * FROM cuentas WHERE usuario = '$usuarioEscaped'";
                $usuarioDB = $this->db->findOne($sqlUsuario);
        
                $sqlCorreo = "SELECT * FROM cuentas WHERE email = '$correoEscaped'";
                $correoDB = $this->db->findOne($sqlCorreo);
        
                if ($usuarioDB) {
                    $error = 'El nombre de usuario ya está registrado.';
                } elseif ($correoDB) {
                    $error = 'El correo electrónico ya está registrado.';
                } else {
                    // Registrar nuevo usuario
                    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO cuentas (usuario, password, email, nombreCompleto) VALUES ('$usuarioEscaped', '$contraseñaHash', '$correoEscaped', '$nombreCompleto')";
                    $this->db->getConexion()->query($sql);

                    $usuarioDatos = [ "usuario" => $usuario, "email" => $correo ];
                    setcookie('usuario', json_encode($usuarioDatos), time() + (86400*30));

                    header("Location: /");
                    exit();
                }
            }
        }

        $this->title = "PP | Registrarse";

        return new Template('./views/register/index.php', [
            'error' => $error ?? null,
        ]);
    }
}
