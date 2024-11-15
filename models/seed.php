<?php

class Seed
{
    private $db;
    private $title = "PP | Seed (Devs)";

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
        if (!isset($_COOKIE['usuario'])) {
            header("Location: /");
            exit();
        }

        $usuarioDatos = json_decode($_COOKIE['usuario'], true);

        if (empty($usuarioDatos['admin']) || !$usuarioDatos['admin']) {
            header("Location: /");
            exit();
        }

        $this->db->save("SET FOREIGN_KEY_CHECKS = 0");
        $this->db->save("TRUNCATE TABLE vehiculo");
        $this->db->save("TRUNCATE TABLE vehiculoImagenes");
        $this->db->save("TRUNCATE TABLE cuentas");
        $this->db->save("TRUNCATE TABLE admin");
        $this->db->save("TRUNCATE TABLE testimonio");
        $this->db->save("SET FOREIGN_KEY_CHECKS = 1");

        $password = 'admin';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $idAdmin = $this->db->save("INSERT INTO cuentas (usuario, password, email, nombreCompleto) 
                    VALUES ('admin', '$hashedPassword', 'admin@poleposition.com', 'Admin Admin')");

        $this->db->save("INSERT INTO admin (idAdmin) VALUES ($idAdmin)");

        $autos = [
            [
                'modelo' => 'Huracán',
                'marca' => 'Lamborghini',
                'color' => 'Azul',
                'precio' => 755273,
                'kilometraje' => 97,
                'descripcion' => 'El Lamborghini Huracán 2023 redefine la velocidad y el lujo en cada aspecto. Con su potente motor V10 de 5.2L que entrega 631 caballos de fuerza, este superdeportivo acelera de 0 a 100 km/h en solo 2.9 segundos. Su diseño aerodinámico y agresivo, junto con las tecnologías más avanzadas en manejo y confort, hacen de este modelo un referente absoluto en el mundo de los supercoches. Si deseas una experiencia de conducción inigualable, el Huracán está hecho para ti.',
                'año' => 2023,
                'stock' => 1,
                'imagenes' => [
                    "lambohuracan-frente.webp",
                    "lambohuracan-costado.webp",
                    "lambohuracan-adentro.webp",
                    "lambohuracan-adentro1.webp",
                    "lambohuracan-adentro2.webp",
                    "lambohuracan-atras.webp",
                    "lambohuracan-atras2.webp",
                    "lambohuracan-frente2.webp",
                ]
            ],
            [
                'modelo' => 'AMG G63',
                'marca' => 'Mercedes',
                'color' => 'Negro',
                'precio' => 187120,
                'kilometraje' => 129,
                'descripcion' => 'El Mercedes-Benz AMG G63 2024 combina lujo y rendimiento excepcional. Este SUV cuenta con un potente motor V8 biturbo, ofreciendo una experiencia de conducción inigualable. Su diseño robusto y elegante lo convierte en un ícono en el mundo automotriz. Con tecnología avanzada y un interior lujoso, el G63 es perfecto para aquellos que buscan confort y potencia.',
                'año' => 2024,
                'stock' => 1,
                'imagenes' => [
                    "amgg63-frente.webp",
                    "amgg63-costado.webp",
                    "amgg63-adentro5.webp",
                    "amgg63-adentro4.webp",
                    "amgg63-adentro3.webp",
                    "amgg63-adentro2.webp",
                    "amgg63-adentro.webp",
                    "amgg63-atras.webp",
                    "amgg63-atras2.webp",
                    "amgg63-frente2.webp"
                ]
            ],
            [
                'modelo' => '911 Turbo Cabriolet',
                'marca' => 'Porsche',
                'color' => 'Gris',
                'precio' => 314404,
                'kilometraje' => 0,
                'descripcion' => 'El Porsche 911 Turbo Cabriolet 2023 ofrece una experiencia de conducción excepcional, combinando lujo y potencia. Con un motor turboalimentado y un diseño icónico, este convertible es perfecto para disfrutar al aire libre sin sacrificar el rendimiento. Equipado con tecnología avanzada, el 911 Turbo Cabriolet redefine el concepto de automóviles deportivos.',
                'año' => 2023,
                'stock' => 3,
                'imagenes' => [
                    "porsche911-frente.webp",
                    "porsche911-costado.webp",
                    "porsche911-adentro.webp",
                    "porsche911-adentro2.webp",
                    "porsche911-adentro3.webp",
                    "porsche911-adentro4.webp",
                    "porsche911-atras.webp",
                    "porsche911-atras2.webp",
                    "porsche911-atras3.webp",
                    "porsche911-frente2.webp"
                ]
            ],
            [
                'modelo' => 'i7 xDrive 60 M Sport',
                'marca' => 'BMW',
                'color' => 'Negro',
                'precio' => 201816,
                'kilometraje' => 10806,
                'descripcion' => 'El BMW i7 xDrive 60 M Sport 2024 es un sedán eléctrico de lujo que combina rendimiento, tecnología de vanguardia y confort excepcional. Con un diseño elegante y una motorización potente, este modelo redefine la experiencia de conducción eléctrica. Equipado con características de alta gama y sistemas de asistencia al conductor, es ideal para quienes buscan sostenibilidad sin sacrificar el lujo.',
                'año' => 2024,
                'stock' => 1,
                'imagenes' => [
                    "bmwi7-frente.webp",
                    "bmwi7-costado.webp",
                    "bmwi7-adentro.webp",
                    "bmwi7-adentro2.webp",
                    "bmwi7-adentro3.webp",
                    "bmwi7-adentro4.webp",
                    "bmwi7-adentro5.webp",
                    "bmwi7-atras.webp",
                    "bmwi7-atras2.webp",
                    "bmwi7-frente2.webp"
                ]
            ],
            [
                'modelo' => '458 Italia',
                'marca' => 'Ferrari',
                'color' => 'Rojo',
                'precio' => 437356,
                'kilometraje' => 26239,
                'descripcion' => 'El Ferrari 458 Italia 2013 es un superdeportivo que combina un impresionante motor V8 de 4.5 litros con un diseño aerodinámico. Con un rendimiento excepcional y una aceleración que corta el aliento, este vehículo ofrece una experiencia de conducción única. Su interior lujoso y tecnología avanzada garantizan que cada viaje sea memorable.',
                'año' => 2013,
                'stock' => 1,
                'imagenes' => [
                    "ferrari458-frente2.webp",
                    "ferrari458-costado.webp",
                    "ferrari458-adentro.webp",
                    "ferrari458-adentro2.webp",
                    "ferrari458-adentro3.webp",
                    "ferrari458-adentro4.webp",
                    "ferrari458-atras.webp",
                    "ferrari458-atras2.webp",
                    "ferrari458-frente.webp",
                ]
            ],
            [
                'modelo' => 'AMG GT 63 S 4M',
                'marca' => 'Mercedes',
                'color' => 'Azul',
                'precio' => 161593,
                'kilometraje' => 14864,
                'descripcion' => 'El Mercedes-Benz AMG GT 63 S 2019 es un impresionante coupé de lujo que combina un potente motor con un diseño elegante y aerodinámico. Ofrece un rendimiento excepcional y un interior refinado, lleno de tecnología avanzada y comodidad. Con su capacidad de acelerar de 0 a 100 km/h en solo unos segundos, es el coche ideal para quienes buscan emoción y sofisticación.',
                'año' => 2019,
                'stock' => 1,
                'imagenes' => [
                    "mercedesamggt-frente.webp",
                    "mercedesamggt-costado.webp",
                    "mercedesamggt-adentro.webp",
                    "mercedesamggt-adentro2.webp",
                    "mercedesamggt-adentro3.webp",
                    "mercedesamggt-adentro4.webp",
                    "mercedesamggt-adentro5.webp",
                    "mercedesamggt-atras.webp",
                    "mercedesamggt-atras2.webp",
                    "mercedesamggt-frente2.webp"
                ]
            ],
            [
                'modelo' => 'Huracán Spyder LP',
                'marca' => 'Lamborghini',
                'color' => 'Naranja',
                'precio' => 309985,
                'kilometraje' => 0,
                'descripcion' => 'El Lamborghini Huracán Spyder LP 610-4 2017 es un superdeportivo convertible que combina potencia y estilo. Con un motor V10 de 610 caballos de fuerza, este modelo ofrece un rendimiento impresionante y un diseño aerodinámico. Su interior está equipado con tecnología de vanguardia y acabados de lujo, ofreciendo una experiencia de conducción emocionante y placentera.',
                'año' => 2017,
                'stock' => 3,
                'imagenes' => [
                    "lambohurcanspider-frente.webp",
                    "lambohuracanspider-costado.webp",
                    "lambohurcanspider-adentro.webp",
                    "lambohurcanspider-adentro2.webp",
                    "lambohurcanspider-adentro3.webp",
                    "lambohurcanspider-adentro4.webp",
                    "lambohuracanspider-atras.webp",
                    "lambohurcanspider-frente2.webp"
                ]
            ],
        ];

        foreach ($autos as $auto) {
            $idVehiculo = $this->db->save("INSERT INTO vehiculo (modelo, marca, color, precio, kilometraje, descripcion, año, stock) 
                VALUES ('{$auto['modelo']}', '{$auto['marca']}', '{$auto['color']}', {$auto['precio']}, {$auto['kilometraje']}, 
                '{$auto['descripcion']}', {$auto['año']}, {$auto['stock']})");

            foreach ($auto['imagenes'] as $imagen) {
                $this->db->save("INSERT INTO vehiculoImagenes (idVehiculo, imagen) VALUES ({$idVehiculo}, '{$imagen}')");
            }
        }

        $testimonios = [
            [
                'idVehiculo' => 1,
                'idCliente' => $idAdmin,
                'calificacion' => 5,
                'mensaje' => 'Este vehículo es increíble, la experiencia de manejo es única y el diseño es espectacular.',
                'titulo' => 'Super recomendado',
                'autor' => 'Bruno Flamant'
            ],
            [
                'idVehiculo' => 2,
                'idCliente' => $idAdmin,
                'calificacion' => 5,
                'mensaje' => 'Este auto es una joya, no hay nada que cambiar, es simplemente perfecto.',
                'titulo' => 'Muy buen rendimiento',
                'autor' => 'Rodrigo Martinez'
            ],
            [
                'idVehiculo' => 1,
                'idCliente' => $idAdmin,
                'calificacion' => 4,
                'mensaje' => 'Me encanta, todos los super autos que amo en un solo lugar..',
                'titulo' => 'Buen rendimiento',
                'autor' => 'Ivan Rodriguez'
            ]
        ];

        foreach ($testimonios as $testimonio) {
            $this->db->save("INSERT INTO testimonio (idVehiculo, idCliente, calificacion, mensaje, titulo, autor) 
                VALUES ({$testimonio['idVehiculo']}, {$testimonio['idCliente']}, {$testimonio['calificacion']}, 
                '{$testimonio['mensaje']}', '{$testimonio['titulo']}', '{$testimonio['autor']}')");
        }

        ob_clean();
        header("Location: /catalogo");
        exit();
    }
}
