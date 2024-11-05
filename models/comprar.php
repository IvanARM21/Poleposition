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
            $result = $this->validateInput();
            echo json_encode($result);
            exit;
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

    public function create()
{
    header('Content-Type: application/json');

    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData, true);

    $result = $this->validateInput($data);

    if (!$result) {
        echo json_encode(["error" => true, "message" => "Ha ocurrido un error validando los datos."]);
        exit;
    }
    
    // datos
    $idCliente = $data['idCliente'];
    $direccion = $data['direccion'];
    $codigo = $data['codigo'];
    $pais = $data['pais'];
    $telefono = $data['telefono'];
    $ciudad = $data['ciudad'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $email = $data['email'];
    $tipo = $data['tipo'];
    $idVehiculo = $data['idVehiculo'];
    $subtotal = $data['subtotal'];
    $tax = $data['tax'];
    $total = $data['total'];
    $fechaCompra = $data['fechaCompra'];

    // que cambie si es alquiler
    if ($tipo === "alquilar") {
        $fechaInicio = $data['fechaInicio'];
        $fechaFin = $data['fechaFin'];

        // que meta los datos de la compra en alquiler
        $sql = "INSERT INTO alquiler 
            (idCliente, direccion, codigo, pais, telefono, ciudad, nombre, apellido, email, idVehiculo, subtotal, tax, total, fechaCompra, fecha_inicio, fecha_fin)
            VALUES 
            ($idCliente, '$direccion', '$codigo', '$pais', '$telefono', '$ciudad', '$nombre', '$apellido', '$email', $idVehiculo, $subtotal, $tax, $total, '$fechaCompra', '$fechaInicio', '$fechaFin')";

        $id = $this->db->save($sql);

    } else {
        // mete los datos en compra
        $sql = "INSERT INTO compra 
            (idCliente, direccion, codigo, pais, telefono, ciudad, nombre, apellido, email, idVehiculo, subtotal, tax, total, fechaCompra)
            VALUES 
            ($idCliente, '$direccion', '$codigo', '$pais', '$telefono', '$ciudad', '$nombre', '$apellido', '$email', $idVehiculo, $subtotal, $tax, $total, '$fechaCompra')";

        $id = $this->db->save($sql);
    }

    if ($id) {
        $sqlUpdateStock = "UPDATE vehiculo SET stock = stock - 1 WHERE id = $idVehiculo AND stock > 0";
        $this->db->save($sqlUpdateStock);
        
        echo json_encode(["error" => false, "message" => "Se ha realizado correctamente la compra"]);
    } else {
        echo json_encode(["error" => true, "message" => "Ha ocurrido un error al realizar la compra"]);
    }

    exit;
}

    function limpiarDato($dato)
    {
        return htmlspecialchars(trim($dato));
    }

    function validateInput($data)
    {
        $data['direccion'] = $this->limpiarDato($data['direccion']);
        if (empty($data['direccion'])) {
            return false;
        }

        $data['codigo'] = $this->limpiarDato($data['codigo']);
        if (empty($data['codigo']) || !preg_match("/^\d{5}$/", $data['codigo'])) {
            return false;
        }

        $data['pais'] = $this->limpiarDato($data['pais']);
        if (empty($data['pais'])) {
            return false;
        }

        $data['telefono'] = $this->limpiarDato($data['telefono']);
        if (empty($data['telefono']) || !preg_match("/^\d{9}$/", $data['telefono'])) {
            return false;
        }

        $data['ciudad'] = $this->limpiarDato($data['ciudad']);
        if (empty($data['ciudad'])) {
            return false;
        }

        $data['nombre'] = $this->limpiarDato($data['nombre']);
        if (empty($data['nombre'])) {
            return false;
        }

        $data['apellido'] = $this->limpiarDato($data['apellido']);
        if (empty($data['apellido'])) {
            return false;
        }

        $data['email'] = $this->limpiarDato($data['email']);
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $data['tipo'] = $this->limpiarDato($data['tipo']);
        if (empty($data['tipo'])) {
            return false;
        }

        if ($data['tipo'] === "alquiler") {
            // Validar fechas
            $fechaInicio = isset($data['fechaInicio']) ? $data['fechaInicio'] : null;
            $fechaFin = isset($data['fechaFin']) ? $data['fechaFin'] : null;

            if (!$fechaInicio || !$fechaFin) {
                return false;
            }

            // Convertir fechas a objetos DateTime
            $inicio = DateTime::createFromFormat('Y-m-d', $fechaInicio);
            $fin = DateTime::createFromFormat('Y-m-d', $fechaFin);
            $hoy = new DateTime();

            if (!$inicio || !$fin) {
                return false;
            }

            if ($inicio < $hoy) {
                return false;
            }

            if ($fin < $inicio) {
                return false;
            }
        }

        $data['idVehiculo'] = isset($data['idVehiculo']) ? (int) $data['idVehiculo'] : null;
        if (empty($data['idVehiculo'])) {
            return false;
        }

        if (!isset($data['subtotal']) || $data['subtotal'] <= 0) {
            return false;
        }

        if (!isset($data['tax']) || $data['tax'] < 0) {
            return false;
        }

        if (!isset($data['total']) || $data['total'] <= 0) {
            return false;
        }

        return true;
    }

}
