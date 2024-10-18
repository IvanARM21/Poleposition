<?php 
$db = new DB();

$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($requestUri, '/'));
$idProducto = end($segments);

$idProducto = is_numeric($idProducto) ? (int) $idProducto : 0;

$vehiculo = null; 

if ($idProducto > 0) {
    $sql = "
        SELECT v.id, v.marca, v.descripcion, v.modelo, v.año, v.color, v.precio, v.kilometraje, GROUP_CONCAT(vi.imagen) as imagenes
        FROM vehiculo v
        LEFT JOIN vehiculoImagenes vi ON v.id = vi.idVehiculo
        WHERE v.id = ?
        GROUP BY v.id
    ";

    $vehiculos = $db->findPrepared($sql, [$idProducto], 'i');

    if (!empty($vehiculos)) {
        $vehiculo = $vehiculos[0]; 
    }
}

?>

<section class="flex flex-col md:flex-row gap-6 p-6 bg-white shadow-md rounded-lg">
    <?php if ($vehiculo) : ?>
        <!-- Sección de la imagen y descripción -->
        <div class="w-full md:w-1/2 flex flex-col bg-gray-100 rounded-lg">
            <?php if (!empty($vehiculo->imagenes)): ?>
                <div class="w-full h-64 md:h-80 overflow-hidden rounded-t-lg">
                    <?php
                    $imagenes = explode(',', $vehiculo->imagenes);
                    foreach ($imagenes as $imagen): ?>
                        <img src="/img/uploads/<?php echo $imagen; ?>" alt="Imagen del vehículo" class="w-full h-full object-cover">
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="w-full h-64 md:h-80 bg-gray-200 flex items-center justify-center rounded-t-lg">
                    <p class="text-gray-500">No hay imágenes disponibles para este vehículo.</p>
                </div>
            <?php endif; ?>
            <div class="mt-4 p-4 bg-white rounded-b-lg">
                <h2 class="text-lg font-bold text-red-600">Más información</h2>
                <p class="mt-2 text-gray-700"><?php echo $vehiculo->descripcion; ?></p>
            </div>
        </div>
        
        <!-- Sección de la información y botones -->
        <div class="w-full md:w-1/2 flex flex-col justify-start p-4">
            <h1 class="text-2xl font-bold text-gray-800 uppercase"><?php echo $vehiculo->marca . " " . $vehiculo->modelo; ?></h1>
            <p class="mt-2 text-lg font-semibold text-green-900">$<?php echo number_format($vehiculo->precio, 2); ?></p>
            <p class="mt-4 text-gray-700">
                <strong>Año:</strong> <?php echo $vehiculo->año; ?><br>
                <strong>Color:</strong> <?php echo $vehiculo->color; ?><br>
                <strong>Kilometraje:</strong> <?php echo $vehiculo->kilometraje; ?> km
            </p>
            <div class="mt-4 flex gap-4 flex-col">
                <button class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700">Comprar</button>
                <button class="w-full bg-white border border-red-600 text-red-600 py-2 rounded-md hover:bg-red-50">Alquilar</button>
            </div>
        </div>

        
    <?php else: ?>
        <p class="text-gray-500">El vehículo no fue encontrado o el ID es inválido.</p>
    <?php endif; ?>
</section>
