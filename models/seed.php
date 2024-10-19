<?php

class Seed {
    private $db;
    private $title = "PP | Seed (Devs)";

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTitle() {
        return $this->title;
    }

    public function index() {

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
        $this->db->save("SET FOREIGN_KEY_CHECKS = 1");

        $autos = [
            [
                'modelo' => 'M3 Competition',
                'marca' => 'BMW',
                'color' => 'Amarillo',
                'precio' => 75295,
                'kilometraje' => 0,
                'descripcion' => 'Potencia y precisión se fusionan en el BMW M3 Competition 2023. Equipado con un motor 3.0L Twin-Turbo de 6 cilindros en línea, este sedán deportivo entrega 510 caballos de fuerza y acelera de 0 a 100 km/h en solo 3.9 segundos. Su diseño agresivo, combinado con tecnología de última generación y un manejo dinámico, hacen de este modelo la elección perfecta para quienes buscan rendimiento sin sacrificar el lujo. ¿Estás listo para sentir la adrenalina al volante? ¡Este es el momento de llevarte el M3 Competition!',
                'año' => 2023,
                'imagenes' => [
                    "bmwm3_costado.webp",
                    "bmwm3_frente.webp"
                ]
            ],
            [
                'modelo' => 'Silverado High Country',
                'marca' => 'Chevrolet',
                'color' => 'Negro',
                'precio' => 71603,
                'kilometraje' => 0,
                'descripcion' => 'La Chevrolet Silverado High Country 2024 redefine el lujo y la potencia en el mundo de las camionetas. Con un motor V8 de 6.2L que entrega 420 caballos de fuerza, esta pick-up está diseñada para el trabajo duro sin perder elegancia. Su interior premium incluye detalles en madera, asientos de cuero y tecnología avanzada con pantalla táctil de 13.4”. Además, cuenta con capacidad de remolque impresionante y un manejo suave, haciendo que cualquier trayecto, sea en la ciudad o el campo, se sienta excepcional. ¡Lleva tu aventura al siguiente nivel con la Silverado High Country!',
                'año' => 2024,
                'imagenes' => [
                    "chevroletsilveradohc_costado.webp",
                    "chevroletsilveradohc_frente.webp"
                ]
            ],
            [
                'modelo' => 'Mustang Mach 1',
                'marca' => 'Ford',
                'color' => 'Negro',
                'precio' => 65390,
                'kilometraje' => 0,
                'descripcion' => 'El Ford Mustang Mach 1 es una leyenda que revive con más fuerza que nunca. Equipado con un motor V8 de 5.0L que genera 480 caballos de fuerza, ofrece un rendimiento impresionante en carretera y pista. Su diseño aerodinámico y agresivo, combinado con mejoras de suspensión y frenado, garantiza una experiencia de manejo ágil y emocionante. Con detalles deportivos únicos y tecnología avanzada, el Mach 1 no solo rinde homenaje a su legado, sino que también establece un nuevo estándar para los autos de alto rendimiento. ¡Siente el poder y la herencia del Mustang en cada curva!',
                'año' => 2024,
                'imagenes' => [
                    "fordmustang_costado.webp",
                    "fordmustang_frente.webp"
                ]
            ],
            [
                'modelo' => 'AMG G63',
                'marca' => 'Mercedes',
                'color' => 'Negro',
                'precio' => 131923,
                'kilometraje' => 6263,
                'descripcion' => 'La Mercedes-AMG G63 2021 es la perfecta combinación de lujo extremo y potencia todoterreno. Bajo su icónico diseño cuadrado se encuentra un motor V8 biturbo de 4.0L que genera 577 caballos de fuerza, permitiendo acelerar de 0 a 100 km/h en solo 4.5 segundos. Con tracción integral 4MATIC, suspensión ajustable y un interior tapizado en cuero de la más alta calidad, la G63 ofrece comodidad y rendimiento tanto en la ciudad como en terrenos desafiantes. Con tecnología de punta y una presencia imponente, este SUV es sinónimo de exclusividad y capacidad sin límites. ¡Elige la G63 y domina cualquier camino con estilo!',
                'año' => 2021,
                'imagenes' => [
                    "mercedesamg_costado.webp",
                    "mercedesamg_frente.webp"
                ]
            ],
            [
                'modelo' => 'Cayenne Coupe',
                'marca' => 'Porsche',
                'color' => 'Blanco',
                'precio' => 84300,
                'kilometraje' => 2973,
                'descripcion' => 'La Porsche Cayenne Coupé combina deportividad y elegancia en un SUV que desborda carácter. Con un motor turboalimentado que va desde los 340 hasta los 670 caballos de fuerza en sus versiones más potentes, este modelo ofrece un desempeño que rivaliza con autos deportivos, pero con la comodidad y versatilidad de un SUV. Su diseño coupé resalta con líneas dinámicas y un techo más bajo, mientras que el interior lujoso, con tecnología de vanguardia y acabados premium, garantiza una experiencia de conducción inigualable. ¡El Cayenne Coupé es el equilibrio perfecto entre lujo y emoción!',
                'año' => 2023,
                'imagenes' => [
                    "porschecayenne_costado.webp",
                    "porschecayenne_frente.webp"
                ]
            ],
            [
                'modelo' => '1500 TRX',
                'marca' => 'RAM',
                'color' => 'Gris',
                'precio' => 80000,
                'kilometraje' => 10315,
                'descripcion' => 'La RAM 1500 TRX es la máxima expresión de poder y rendimiento en una camioneta. Equipada con un motor V8 supercargado de 6.2L que entrega impresionantes 702 caballos de fuerza, esta pick-up está diseñada para dominar cualquier terreno con una aceleración de 0 a 100 km/h en solo 4.5 segundos. Su suspensión de alto rendimiento y tecnología todoterreno hacen que no haya desafío imposible. En su interior, el lujo y la tecnología de punta se combinan para ofrecer una experiencia de conducción cómoda y emocionante. ¡La RAM 1500 TRX es pura potencia y aventura lista para llevarte a donde quieras!',
                'año' => 2021,
                'imagenes' => [
                    "ram1500trx_atras.webp",
                    "ram1500trx_frente.webp"
                ]
            ],
            [
                'modelo' => '2500',
                'marca' => 'RAM',
                'color' => 'Negro',
                'precio' => 79990,
                'kilometraje' => 1900,
                'descripcion' => 'La RAM 2500 es una camioneta robusta y versátil diseñada para enfrentar las tareas más exigentes. Con opciones de motorización que incluyen un potente motor diésel de 6.7L, esta pick-up ofrece una capacidad de remolque impresionante, perfecta para trabajos pesados y aventuras al aire libre. Su diseño exterior muscular se complementa con un interior cómodo y bien equipado, que cuenta con tecnología avanzada y materiales de alta calidad. Además, la RAM 2500 garantiza un manejo seguro y confiable, tanto en carretera como fuera de ella. ¡La RAM 2500 es la elección ideal para quienes buscan fuerza y durabilidad sin sacrificar el confort!',
                'año' => 2023,
                'imagenes' => [
                    "ram2500_costado.webp",
                    "ram2500_frente.webp"
                ]
            ],
            [
                'modelo' => 'R1T ',
                'marca' => 'Rivian',
                'color' => 'Negro',
                'precio' => 73000,
                'kilometraje' => 465,
                'descripcion' => 'La Rivian R1T es una innovadora camioneta eléctrica que redefine el concepto de aventura. Con su motor dual o cuádruple que ofrece hasta 800 caballos de fuerza, la R1T puede acelerar de 0 a 100 km/h en apenas 3 segundos. Su diseño robusto y aerodinámico, junto con una impresionante capacidad de remolque de hasta 5,000 kg, la convierten en la compañera perfecta para explorar terrenos difíciles. El interior está equipado con tecnología de vanguardia, incluyendo una pantalla táctil de 15.6 pulgadas y materiales sostenibles. Con un enfoque en la sostenibilidad y la conectividad, la Rivian R1T es el futuro de las camionetas. ¡Prepárate para llevar tus aventuras a un nuevo nivel!',
                'año' => 2022,
                'imagenes' => [
                    "rivianr1t_costado.webp",
                    "rivianr1t_frente.webp"
                ]
            ]
        ];

        foreach ($autos as $auto) {
            $idVehiculo = $this->db->save("INSERT INTO vehiculo (modelo, marca, color, precio, kilometraje, descripcion, año) 
                VALUES ('{$auto['modelo']}', '{$auto['marca']}', '{$auto['color']}', {$auto['precio']}, {$auto['kilometraje']}, 
                '{$auto['descripcion']}', {$auto['año']})");

            foreach ($auto['imagenes'] as $imagen) {
                $this->db->save("INSERT INTO vehiculoImagenes (idVehiculo, imagen) VALUES ({$idVehiculo}, '{$imagen}')");
            }
        }

        header("Location: /catalogo");
    }
}
