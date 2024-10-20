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

<section class="flex flex-col md:flex-row gap-6 p-6 bg-white shadow-md rounded-lg items-start">
    <?php if ($vehiculo) : ?>
        <div class="w-full md:w-1/2 flex flex-col bg-gray-100 rounded-lg relative">
            <?php if (!empty($vehiculo->imagenes)): ?>
                <?php
                $imagenes = explode(',', $vehiculo->imagenes);
                $totalImagenes = count($imagenes);
                ?>
                <div id="image-slider" class="relative w-full overflow-hidden rounded-lg">
                <?php foreach ($imagenes as $index => $imagen): ?>
                <img src="../img/uploads/<?php echo htmlspecialchars($imagenes[($index + 7) % count($imagenes)]); ?>" 
         alt="Imagen del vehículo" 
         class="vehicle-image w-full h-full object-cover rounded-lg <?php echo $index === 0 ? 'block' : 'hidden'; ?>">
<?php endforeach; ?>

</div>

<?php if ($totalImagenes > 1): ?>
    <!-- boton antes -->
    <button id="prev-button" class="absolute top-[calc(50%-7rem)] left-4 text-gray-700 p-2 md:p-3 z-10 bg-white rounded-full shadow">
        &#10094;
    </button>

    <!-- boton despues -->
    <button id="next-button" class="absolute top-[calc(50%-7rem)] right-4 text-gray-700 p-2 md:p-3 z-10 bg-white rounded-full shadow">
        &#10095;
    </button>
<?php endif; ?>


            <?php else: ?>
                <div class="w-full h-64 md:h-80 bg-gray-200 flex items-center justify-center rounded-lg">
                    <p class="text-gray-500">No hay imágenes disponibles para este vehículo.</p>
                </div>
            <?php endif; ?>
            <div class="p-4 bg-white rounded-b-lg">
                <h2 class="text-lg font-bold text-red-600">Más información</h2>
                <p class="mt-2 text-gray-700"><?php echo $vehiculo->descripcion; ?></p>
            </div>
        </div>
        
        <div class="w-full md:w-1/2 flex flex-col justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 uppercase"><?php echo $vehiculo->marca . " " . $vehiculo->modelo; ?></h1>
                <p class="mt-2 text-lg font-semibold text-green-900">$<?php echo number_format($vehiculo->precio, 2); ?></p>
                <p class="mt-4 text-gray-700">
                    <strong>Año:</strong> <?php echo $vehiculo->año; ?><br>
                    <strong>Color:</strong> <?php echo $vehiculo->color; ?><br>
                    <strong>Kilometraje:</strong> <?php echo $vehiculo->kilometraje; ?> km
                </p>
            </div>
            <div class="flex gap-4 flex-col mt-auto sm:pt-72">
            <button class="w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-102">Comprar</button>
<button class="w-full bg-white border border-red-600 text-red-600 py-2 rounded-md hover:bg-red-50 hover:border-red-700 hover:text-red-700 hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-102">Alquilar</button>

            </div>
        </div>

    <?php else: ?>
        <p class="text-gray-500">El vehículo no fue encontrado o el ID es inválido.</p>
    <?php endif; ?>
</section>

<script>
    let images = document.querySelectorAll('.vehicle-image');
    let currentIndex = 0;

    if (images.length > 1) {
        document.getElementById('next-button').addEventListener('click', () => {
            images[currentIndex].classList.add('hidden');
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].classList.remove('hidden');
        });

        // Event listener for the "Previous" button
        document.getElementById('prev-button').addEventListener('click', () => {
            images[currentIndex].classList.add('hidden');
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            images[currentIndex].classList.remove('hidden');
        });
    }
</script>
