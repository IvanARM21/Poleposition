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

<section class="px-2">
    <h1 class="title">Catálogo</h1>
    
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
</section>
