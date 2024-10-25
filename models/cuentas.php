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

        // Obtén el contenido JSON de la solicitud
        $rawData = file_get_contents('php://input');

        $vehicleData = json_decode($rawData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Error en los datos']);
            exit;
        }

        $modelo = $vehicleData['modelo'] ?? '';
        $marca = $vehicleData['marca'] ?? '';
        $color = $vehicleData['color'] ?? '';
        $precio = $vehicleData['precio'] ?? 0;
        $kilometraje = $vehicleData['kilometraje'] ?? 0;
        $año = $vehicleData["año"];
        $descripcion = $vehicleData['descripcion'] ?? '';
        $imagenesCrear = $vehicleData['imagenesCrear'] ?? [];
        $imagenesEliminar = $vehicleData['imagenesEliminar'] ?? [];

        $imagenesCreadas = [];
        if ($imagenesCrear) {
            foreach ($imagenesCrear as $image) {
                $imagenesCreadas[] = $this->uploadFiles($image);
            }
        }
        // Guardar Imagenes
        foreach ($imagenesCreadas as $image) {
            $sql = "INSERT INTO vehiculoimagenes (idVehiculo, imagen) VALUES ($id, '$image')";
            $this->db->save($sql);
        }

        if ($imagenesEliminar) {
            foreach ($imagenesEliminar as $imageName) {
                $this->deleteFile($imageName);
                $sql = "DELETE FROM vehiculoimagenes WHERE imagen = '$imageName'";
                $this->db->delete($sql);
            }
        }

        // Guardar vehiculo
        $sql = "UPDATE Vehiculo 
        SET modelo = '$modelo', 
            marca = '$marca', 
            color = '$color', 
            precio = $precio, 
            kilometraje = $kilometraje, 
            descripcion = '$descripcion', 
            año = $año 
        WHERE id = $id";

        $this->db->save($sql);

        // Eliminar en BD
        echo json_encode(['ok' => true, 'message' => 'Se ha guardado correctamente.']);

        exit;


    }

    public function delete($id)
{
    header('Content-Type: application/json');
    try {
        // Verifica que el ID sea válido
        if (!is_numeric($id) || $id <= 0) {
            echo json_encode(['ok' => false, 'message' => 'ID inválido.']);
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
            echo json_encode(['ok' => false, 'message' => 'No se encontró la cuenta a eliminar.']);
        }
        exit;
    } catch (Exception $e) {
        echo json_encode(['ok' => false, 'message' => 'Ha ocurrido un error.', 'error' => $e->getMessage()]);
        exit;
    }
}

}
