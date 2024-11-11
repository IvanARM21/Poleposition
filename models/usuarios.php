<?php

class Usuarios
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function delete($id)
{
    header('Content-Type: application/json');

    if ($id) {
        $sqlCliente = "DELETE FROM cliente WHERE idCliente = $id";
        $this->db->delete($sqlCliente);

        $sqlCuentas = "DELETE FROM cuentas WHERE id = $id";
        $this->db->delete($sqlCuentas);

        $sqlTestimonioCuentas = "DELETE FROM testimonio WHERE idCliente = $id";
        $this->db->delete($sqlTestimonioCuentas);

        $sqlCompraCuentas = "DELETE FROM compra WHERE idCliente = $id";
        $this->db->delete($sqlCompraCuentas);

        $sqlAlquilerCuentas = "DELETE FROM alquiler WHERE idCliente = $id";
        $this->db->delete($sqlAlquilerCuentas);

        echo json_encode(['ok' => true, 'message' => 'Se ha eliminado correctamente.']);
    } else {
        echo json_encode(['ok' => false, 'message' => 'Ha ocurrido un error.']);
    }
    exit;
}


    public function getImages($idVehiculo)
    {
        $sql = "SELECT * FROM vehiculoimagenes WHERE idVehiculo = $idVehiculo";
        $imagesName = $this->db->find($sql);
        return $imagesName;
    }

    public function deleteFile($fileName)
    {
        $uploadDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $filePath = $uploadDir . $fileName;

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
