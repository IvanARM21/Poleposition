<?php 

class DB {
    private $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "1234", "poleposition");
        
        if ($this->db->connect_error) {
            die("Error de conexión: " . $this->db->connect_error);
        }
    }

    public function getConexion() {
        return $this->db;
    }

    public function find($sql) {
        $result = $this->db->query($sql);
        $arr = [];
        while($row = $result->fetch_object()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function findOne($sql) {
        $result = $this->db->query($sql);
        return $result->fetch_object();
    }

    public function save($sql) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $id = $this->db->insert_id;
        return $id;
    }

    public function findVehiculosByIds($ids) {
        $idsString = implode(',', array_map('intval', $ids));
        $sql = "SELECT v.*, GROUP_CONCAT(vi.imagen) AS imagenes 
                FROM vehiculo v 
                LEFT JOIN vehiculoImagenes vi ON v.id = vi.idVehiculo 
                WHERE v.id IN ($idsString) 
                GROUP BY v.id";
        return $this->find($sql);
    }
    

}
