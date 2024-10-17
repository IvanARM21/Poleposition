<?php 
$db = new DB();

$sql = "
    SELECT v.id, v.marca, v.modelo, v.precio, v.kilometraje, GROUP_CONCAT(vi.imagen) as imagenes
    FROM vehiculo v
    LEFT JOIN vehiculoImagenes vi ON v.id = vi.idVehiculo
    GROUP BY v.id
";
$vehiculos = $db->find($sql);

?>

<section class="flex gap-6 px-4">
    <!-- Filtros a la izquierda -->
    <div class="w-full lg:w-1/4">
        <form action="catalogo.php" method="GET" class="space-y-6">
            <!-- Filtro de Marca -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Marca</h3>
                <ul class="space-y-2">
                    <?php
                    $marcas = ['Ferrari', 'Lamborghini', 'Porsche', 'Ram', 'BMW'];
                    foreach($marcas as $marca) : ?>
                        <li>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="marca[]" value="<?php echo $marca; ?>" class="form-checkbox h-4 w-4 text-red-600">
                                <span class="ml-2 text-gray-700"><?php echo $marca; ?></span>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Filtro de Año -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Año</h3>
                <div class="flex space-x-3">
                    <input type="number" name="ano_desde" placeholder="Desde" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                    <input type="number" name="ano_hasta" placeholder="Hasta" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                </div>
            </div>

            <!-- Filtro de Precio -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Precio</h3>
                <div class="flex space-x-3">
                    <input type="number" name="precio_min" placeholder="Mínimo" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                    <input type="number" name="precio_max" placeholder="Máximo" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                </div>
            </div>

            <!-- Filtro de Kilometraje -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Kilómetros</h3>
                <div class="flex space-x-3">
                    <input type="number" name="km_min" placeholder="Mínimo" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                    <input type="number" name="km_max" placeholder="Máximo" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                </div>
            </div>

            <!-- Filtro de Estado (Nuevo o Usado) -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Estado</h3>
                <ul class="space-y-2">
                    <li>
                        <label class="inline-flex items-center">
                            <input type="radio" name="estado" value="nuevo" class="form-radio h-4 w-4 text-red-600">
                            <span class="ml-2 text-gray-700">Nuevo</span>
                        </label>
                    </li>
                    <li>
                        <label class="inline-flex items-center">
                            <input type="radio" name="estado" value="usado" class="form-radio h-4 w-4 text-red-600">
                            <span class="ml-2 text-gray-700">Usado</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- Botón de Aplicar Filtros (no hace nada por ahora) -->
            <div>
                <button type="button" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition duration-300">
                    Aplicar Filtros
                </button>
            </div>
        </form>
    </div>

    <!-- Catálogo a la derecha -->
    <div class="w-full lg:w-3/4">
        <ul class="grid min-[480px]:grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-3 lg:gap-x-5">
            <?php foreach($vehiculos as $vehiculo) : ?>
                <?php 
                    $imagenes = explode(',', $vehiculo->imagenes); 
                    $imagenPrincipal = "../../img/uploads/" . $imagenes[0]; 
                    $imagenSecundaria = isset($imagenes[1]) ? "../../img/uploads/" . $imagenes[1] : $imagenPrincipal;
                ?>
                <li class="flex flex-col gap-2 rounded-xl">
                    <div class="rounded-lg overflow-hidden">
                        <img src="<?php echo $imagenPrincipal ?>" 
                             alt="Imagen de <?php echo $vehiculo->marca . ' ' . $vehiculo->modelo ?>" 
                             class="w-full aspect-video object-cover transition-all duration-300 hover:scale-105 cursor-pointer"
                             onmouseover="this.src='<?php echo $imagenSecundaria ?>'" 
                             onmouseout="this.src='<?php echo $imagenPrincipal ?>'">
                    </div>
                    <div class="px-1">
                        <h2 class="text-xl font-semibold text-gray-800 hover:text-red-600 transition-colors duration-300 cursor-pointer">
                            <?php echo $vehiculo->marca . " " . $vehiculo->modelo ?>
                        </h2>
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-1 mt-2">
                            <p class="text-gray-500 text-lg font-medium"><?php echo "$" . number_format($vehiculo->precio, 2) . " USD"?></p>
                            <p class="text-gray-500 font-medium italic"><?php echo $vehiculo->kilometraje . " KM" ?></p>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
