<?php

include_once __DIR__ . '/Vehiculo.php'; 

class Catalogo {

    private $db;
    private $title;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {
        
        $this->title = "PP | Catalogo";

        $vehiculo1 = new Vehiculo(
            "1",
            "911 Turbo S Cabriolet", 
            "Porshe", "Verde", 
            "410000",
            "3645",
            "2022",
            "",
            ["catalogo/porsche-911-gt3-verde.jpeg"],
            "Motor 4.0 con 510CV"
        );
        $vehiculo2 = new Vehiculo(
            "2", "911 Turbo S Cabriolet",
            "Porshe", "Negro", 
            "420000", 
            "0", 
            "2024", 
            "", 
            ["catalogo/porshe-911-turbo-negro.jpeg"], 
            "Motor 4.0 con 510CV");
        $vehiculo3 = new Vehiculo(
            "3", 
            "Gallardo Superleggera", 
            "Lamborghini",
            "Blanco", 
            "410000", 
            "14885", 
            "2011", 
            "", 
            ["catalogo/lamborghini-gallardo-blanco.jpeg"], 
            "Motor 4.0 con 510CV"
        );
        $vehiculo4 = new Vehiculo(
            "4", 
            "R8 Performance", 
            "Audi", 
            "Blanco", 
            "410000", 
            "18000", 
            "2021", 
            "", 
            ["catalogo/audi-r8-performance.jpeg"], "Motor 4.0 con 510CV"
        );
        $vehiculo5 = new Vehiculo(
            "5", 
            "F8 Tributo", 
            "Ferrari", 
            "Verde", 
            "410000", 
            "12500", 
            "2022", 
            "", 
            ["catalogo/ferrari-g8-tributo.jpeg"],
            "Motor 4.0 con 510CV"
        );
        $vehiculo6 = new Vehiculo(
            "6", 
            "911 Amg GT-R", 
            "Mercedes-Benz", 
            "Gris", 
            "410000", 
            "11200", 
            "2021", 
            "", 
            ["catalogo/mercedes-amg-grr.jpeg"], 
            "Motor 4.0 con 510CV"
        );

        $vehiculos = [$vehiculo1, $vehiculo2, $vehiculo3, $vehiculo4, $vehiculo5, $vehiculo6];

        return new Template('./views/catalogo/index.php', [
            "vehiculos" =>  $vehiculos
        ]);
    }

    public function show($id) {
        
       return new Template('./views/catalogo/show.php', [
            "vehiculo" => "vehiculo"
        ]);
    }
    public function create() {
        
    }

    public function update($id) {
        
    }

    public function delete($id) {
        
    }
}