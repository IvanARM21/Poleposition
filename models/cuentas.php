<?php

class Cuentas
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
        $sql = "
            SELECT * from cuentas
        ";
        $cuentas = $this->db->find($sql);
        echo json_encode($cuentas);
        exit;
    }




    public function update($id)
{
    header('Content-Type: application/json');

    $rawData = file_get_contents('php://input');
    $userData = json_decode($rawData, true);

    if (!is_numeric($id) || $id <= 0) {
        echo json_encode(['ok' => false, 'message' => 'ID inválido.']);
        exit;
    }

    $pass = $userData["pass"] ?? null;
    $contraseña = $userData["contraseña"] ?? null;
    $repetirContraseña = $userData["repetirContraseña"] ?? null;

    if (!$pass || !$contraseña || !$repetirContraseña) {
        echo json_encode(['ok' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    if ($contraseña !== $repetirContraseña) {
        echo json_encode(['ok' => false, 'message' => 'Las contraseñas no coinciden.']);
        exit;
    }

    $user = $this->db->findOne("SELECT * FROM cuentas WHERE id = $id");
    if (!$user || !password_verify($pass, $user->password)) {
        echo json_encode(['ok' => false, 'message' => 'Contraseña actual incorrecta.']);
        exit;
    }

    $hashedPassword = password_hash($contraseña, PASSWORD_DEFAULT);
    $this->db->save("UPDATE cuentas SET password = '$hashedPassword' WHERE id = $id");

    // Respuesta final
    echo json_encode(['ok' => true, 'message' => 'Contraseña actualizada correctamente.']);
    exit;
}



    public function delete($id)
    {
        header('Content-Type: application/json');

        // Obtén el contenido JSON de la solicitud
        $rawData = file_get_contents('php://input');

        $userData = json_decode($rawData, true);
        try {
            // Verifica que el ID sea válido
            if (!is_numeric($id) || $id <= 0) {
                echo json_encode(['ok' => false, 'message' => 'ID inválido.']);
                exit;
            }

            $pass = $userData["pass"];

            if (!$pass) {
                echo json_encode(['ok' => false, 'message' => 'La contraseña es obligatoria']);
                exit;
            }

            $sql = "SELECT * FROM cuentas WHERE id = $id";
            $user = $this->db->findOne($sql);

            if (!$user) {
                echo json_encode(['ok' => false, 'message' => 'El usuario no fue encontrado']);
                exit;
            }
            $checkPass = password_verify($pass, hash: $user->password);

            if (!$checkPass) {
                echo json_encode(['ok' => false, 'message' => 'La contraseña es incorrecta']);
                exit;
            }

            $sqlAdmin = "SELECT * FROM admin WHERE idAdmin = $id";
            $admin = $this->db->findOne($sqlAdmin);

            // Elimina de la tabla 'admin' si existe el registro
            if ($admin) {
                $this->db->delete("DELETE FROM admin WHERE idAdmin = $id");
            }

            $sql1 = "DELETE FROM admin WHERE idAdmin = $id";
            $sql2 = "DELETE FROM testimonio WHERE idCliente = $id";
            $sql3 = "DELETE FROM compra WHERE idCliente = $id";
            $sql4 = "DELETE FROM cuentas WHERE id = $id";

            $res = $this->db->delete($sql1);
            $res = $this->db->delete($sql2);
            $res = $this->db->delete($sql3);
            $res = $this->db->delete($sql4);

            // Verifica si se eliminó algún registro
            if ($res > 0) {
                echo json_encode(['ok' => true, 'message' => 'Se ha eliminado correctamente.']);
            } else {
                echo json_encode(['ok' => false, 'message' => 'No se encontró ' . $id . ' la cuenta a eliminar.']);
            }
            exit;
        } catch (Exception $e) {
            echo json_encode(['ok' => false, 'message' => 'Ha ocurrido un error.', 'error' => $e->getMessage()]);
            exit;
        }
    }

}
