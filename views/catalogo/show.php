<section class="px-2">
    <h1 class="title">Catalogo</h1>
    
    <ul class="grid min-[480px]:grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-3 lg:gap-x-5 ">
        <?php foreach($vehiculos as $vehiculo) : ?>
            <li class="flex flex-col gap-2 rounded-xl">
                <div class="rounded-lg overflow-hidden">
                    <img src="../../img/<?php echo $vehiculo->imagenes[0] ?>" alt="" class="w-full aspect-video object-cover hover:rotate-3 cursor-pointer hover:scale-125 transition-all duration-300">
                </div>
                <div class=" px-1">
                    <h2 class="text-xl font-semibold text-gray-800 hover:text-red-600 transition-colors duration-300 cursor-pointer">
                        <?php echo $vehiculo->marca . " " . $vehiculo->modelo ?>
                    </h2>
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-1 mt-2">
                        <p class="text-gray-500 text-lg font-medium"><?php echo "$" . number_format($vehiculo->precio, 2) . " USD"?></p>
                        
                        <p class="text-gray-500 font-medium italic">
                            <?php echo $vehiculo->anio . " - " . $vehiculo->kilometraje . "KM" ?>
                        </p>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>