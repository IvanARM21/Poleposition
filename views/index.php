<?php

$db = new DB();
$idsDestacados = [1, 6, 4];
$vehiculosDestacados = $db->findVehiculosByIds($idsDestacados);
?>
<!-- marcas con las q trabajamos -->

<!-- <div class="h-24"> </div> -->

<section class>
    <h2 class="font-black text-2xl text-red-600 flex justify-center uppercase text-center md:text-5xl lg:text-5xl">
        marcas
    </h2>

    <div class="pt-8"></div>

    <div class="flex flex-wrap justify-center items-center mx-auto w-full max-w-2xl pt-4 pb-4 border-2 rounded-lg">
        <div class="flex justify-center space-x-5">
            <img src="../img/marcas/lambo.png" class="h-16 w-auto sm:h-24 md:h-32 lg:h-32">
            <img src="../img/marcas/bmw.png" class="h-16 w-auto sm:h-24 md:h-32 lg:h-32">
            <img src="../img/marcas/porsche.png" class="h-16 w-auto sm:h-24 md:h-32 lg:h-32">
            <img src="../img/marcas/ferrari.png" class="h-16 w-auto sm:h-24 md:h-32 lg:h-32">
        </div>
    </div>
</section>

<!-- testimonios y reseñas -->

<section class="pt-16">
    <h2 class="font-black text-2xl text-red-600 flex justify-center uppercase text-center  md:text-5xl lg:text-5xl">
        Testimonios & Reseñas</h2>

    <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-3  items-center">
        <div
            class="border-2 p-4 rounded-lg shadow-md max-w-xs mt-5 transition-transform transform hover:scale-105 hover:shadow-lg">
            <h3 class="font-extrabold text-left text-gray-800 mb-2 uppercase">Aserrin</h3>
            <p class="text-gray-600 mb-4">Ese telefono parece carpintero, porque aserrin porque aserrin</p>
            <p class="text-sm text-gray-500 text-right">- Rodrigo Martinez</p>
        </div>


        <div class="flex flex-col sm:flex-row justify-center space-x-0 sm:space-x-3  items-center">
            <div
                class="border-2 p-4 rounded-lg shadow-md max-w-xs mt-5 transition-transform transform hover:scale-105 hover:shadow-lg">
                <h3 class="font-extrabold text-left text-gray-800 mb-2 uppercase">Skibidi Toilet</h3>
                <p class="text-gray-600 mb-4">Skibi toilet skibidi skibidi toilet, skibi toilet skibidi</p>
                <p class="text-sm text-gray-500 text-right">- Bruno Flamant</p>
            </div>

            <div class="flex flex-row sm:flex-row justify-center space-x-0 sm:space-x-3  items-center">
                <div
                    class="border-2 p-4 rounded-lg shadow-md max-w-xs mt-5 transition-transform transform hover:scale-105 hover:shadow-lg">
                    <h3 class="font-extrabold text-left text-gray-800 mb-2 uppercase">Tomas Shelby</h3>
                    <p class="text-gray-600 mb-4">Tomas Shelby sigma sigma mafia, shelby sigma mafia
                    </p>
                    <p class="text-sm text-gray-500 text-right">- Ivan Rodriguez</p>
                </div>
            </div>
</section>

<!-- vehiculos seleccionado -->
<section class="px-4 sm:px-8 lg:px-16">
    <h2 class="font-medium text-lg sm:text-xl lg:text-2xl text-gray-600 flex justify-center lg:justify-normal text-center sm:text-left pt-6 sm:pt-10">
        Vehículos seleccionados
    </h2>
    <h2 class="font-black text-3xl sm:text-4xl lg:text-5xl text-red-600 flex justify-center lg:justify-normal uppercase text-center sm:text-left">
        Destacados
    </h2>

    <div class="flex flex-col sm:flex-row justify-center mx-auto w-full sm:space-x-4">
        <?php foreach ($vehiculosDestacados as $vehiculo): ?>
            <?php $imagenes = explode(',', $vehiculo->imagenes); ?>
            <div class="border-2 p-4 rounded-lg shadow-md mt-5 transition-transform transform hover:shadow-lg max-w-full sm:max-w-md md:max-w-lg flex flex-col h-full">
                <a href="/catalogo" class="flex flex-col h-full">
                    <div class="flex-grow flex flex-col items-center">
                        <img src="../img/uploads/<?= htmlspecialchars($imagenes[0]) ?>"
                             class="w-96 h-96 object-contain transition duration-500 ease-in-out transform hover:scale-102"
                             <?php if (count($imagenes) > 1): ?>
                                onmouseout="this.src='../img/uploads/<?= htmlspecialchars($imagenes[0]) ?>'"
                                onmouseover="this.src='../img/uploads/<?= htmlspecialchars($imagenes[1]) ?>'" <?php endif; ?>>

                        <h3 class="font-extrabold text-left text-gray-800 mb-2 uppercase text-lg sm:text-xl lg:text-2xl pt-4">
                            <?= htmlspecialchars($vehiculo->marca) ?> <?= htmlspecialchars($vehiculo->modelo) ?>
                        </h3>
                        <h3 class="font-extrabold text-left text-green-900 uppercase text-lg sm:text-xl lg:text-xl italic">
                            US$ <?= number_format($vehiculo->precio, 2) ?>
                        </h3>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="flex justify-start sm:justify-start mt-6">
        <a name="catalogo" class="uppercase mx-auto sm:mx-0 py-3 px-8 text-xl text-white bg-red-600 hover:bg-red-700 rounded-lg font-extrabold transition-colors duration-300" href="./catalogo">
            Catálogo
        </a>
    </div>
</section>



<!-- contactenos -->

<section>

    <div>
    <h2 class="pt-20 font-black text-3xl sm:text-4xl lg:text-5xl text-red-600 flex justify-center lg:justify-normal uppercase text-center sm:text-left">
    <a href="/contacto" class="inline-block">
        Contáctenos
    </a>
</h2>

        <p
            class="font-medium text-lg sm:text-xl lg:text-2xl text-gray-600 flex justify-center lg:justify-normal text-center sm:text-left sm:pt-5">
            Nuestros horarios de atención al cliente:</p>
        <p class="font-medium text-lg  text-zinc-400 flex justify-center lg:justify-normal text-center sm:text-left">
            Lunes a Viernes de 8.30 a 12.30 y de 14.00 a 18.30; Sábado de 8.30 a 12:30</p>

        <p
            class="pt-5 font-black text-2xl sm:text-3xl lg:text-4xl text-red-600 flex justify-center lg:justify-normal uppercase text-center sm:text-left">
            (+598) 91 014 226</p>
    </div>
</section>