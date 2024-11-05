
<?php 
    class Vehiculo {
        public $id;
        public $modelo;
        public $marca;
        public $color;
        public $precio;
        public $kilometraje;
        public $anio;
        public $descripcion;

        public $imagenes = [];
        public $motor;

        public function __construct($id, $modelo, $marca, $color, $precio, $kilometraje, $anio, $descripcion, $imagenes, $motor) {
            $this->id = $id;
            $this->modelo = $modelo;
            $this->marca = $marca;
            $this->color = $color;
            $this->precio = $precio;
            $this->kilometraje = $kilometraje;
            $this->anio = $anio;
            $this->descripcion = $descripcion;
            $this->imagenes = $imagenes;
            $this->motor = $motor;
        }
    }

?>