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
        // Si no hay parámetros, ejecuta la consulta simple
        if (empty($params)) {
            return $this->find($sql);
        }

        $stmt = $this->db->prepare($sql);

        if ($stmt === false) {
            die("Error al preparar la consulta: " . $this->db->error);
        }

        // Vincular parámetros si existen
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
        return $result->fetch_object();
    }

    public function save($sql)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $id = $this->db->insert_id;
        return $id;
    }

    public function delete($sql)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

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
