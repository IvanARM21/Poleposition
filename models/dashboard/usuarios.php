<?php

class Usuarios
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

        $this->title = "Dashboard | Usuarios";

        $sql = "SELECT c.*, 
       IF(a.idAdmin IS NOT NULL, 'admin', 'usuario') AS tipo
FROM cuentas c
LEFT JOIN admin a ON c.id = a.idAdmin;
";

        $usuarios = $this->db->find($sql);
        json_encode(value: $usuarios);


        return new Template('./views/dashboard/usuarios/index.php', [
            "usuarios" => $usuarios
        ]);
    }

    public function show($id)
    {
        $this->title = "Dashboard | Usuario ";

        return new Template('./views/dashboard/usuarios/show.php', [
        ]);
    }

    public function update($id) {

        header('Content-Type: application/json');

        echo $id;

        $adminSql = "SELECT * FROM admin WHERE idAdmin = $id";
        $admin = $this->db->findOne($adminSql);

        if($admin) {
            $updateSql = "DELETE FROM admin WHERE idAdmin = $id"; 
            $this->db->delete($updateSql);

            echo json_encode([
                "success" => false,
            ]);
            exit;
        }

        $createSql = "INSERT INTO admin (idAdmin) VALUES ($id)";
        $this->db->save($createSql);
        echo json_encode([
            "success" => true,
        ]);
        exit;
    }

}