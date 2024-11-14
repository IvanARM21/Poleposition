<?php

class DB
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "root", "poleposition");

        if ($this->db->connect_error) {
            die("Error de conexión: " . $this->db->connect_error);
        }
    }

    public function getConexion()
    {
        return $this->db;
    }

    public function find($sql)
    {
        $result = $this->db->query($sql);

        if ($result === false) {
            die("Error en la consulta: " . $this->db->error);
        }

        $arr = [];
        while ($row = $result->fetch_object()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function findPrepared($sql, $params, $types)
    {
        if (empty($params)) {
            return $this->find($sql);
        }

        $stmt = $this->db->prepare($sql);

        if ($stmt === false) {
            die("Error al preparar la consulta: " . $this->db->error);
        }

        if (!empty($types) && !empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $arr = [];

        while ($row = $result->fetch_object()) {
            $arr[] = $row;
        }

        $stmt->close();
        return $arr;
    }

    public function findOne($sql)
    {
        $result = $this->db->query($sql);
        return $result ? $result->fetch_object() : null;
    }

    public function save($sql, $params = null, $types = "")
    {
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $this->db->error);
        }

        if ($params && $types) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        
        if ($stmt->error) {
            die("Error en la ejecución: " . $stmt->error);
        }

        $id = $stmt->insert_id;
        $stmt->close();
        
        return $id;
    }

    public function delete($sql)
    {
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $this->db->error);
        }

        $stmt->execute();
        
        if ($stmt->error) {
            die("Error en la ejecución: " . $stmt->error);
        }

        return $stmt->affected_rows;
    }

    public function findVehiculosByIds($ids)
    {
        $idsString = implode(',', array_map('intval', $ids));
        $sql = "SELECT v.*, GROUP_CONCAT(vi.imagen) AS imagenes 
                FROM vehiculo v 
                LEFT JOIN vehiculoImagenes vi ON v.id = vi.idVehiculo 
                WHERE v.id IN ($idsString) 
                GROUP BY v.id";
        return $this->find($sql);
    }

    public function findTestimonials($ids = null)
    {
        $whereClause = '';
        if ($ids) {
            $idsString = implode(',', array_map('intval', $ids));
            $whereClause = "WHERE t.id IN ($idsString)";
        }

        $sql = "SELECT t.idVehiculo, t.calificacion, t.mensaje, 
                       t.titulo, t.autor
                FROM testimonio t
                $whereClause
                ORDER BY t.id DESC";

        return $this->find($sql);
    }
}
