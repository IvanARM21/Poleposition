<?php
$db = new DB();

$idsDestacados = [1, 6, 4];
$vehiculosDestacados = $db->findVehiculosByIds($idsDestacados);

$idsTestimonios = [1, 38, 40]; 
$testimonios = $db->findTestimonials($idsTestimonios);

?>


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

<section class="pt-16">
    <h2 class="font-black text-2xl text-red-600 flex justify-center uppercase text-center md:text-4xl lg:text-5xl">
        Testimonios & Reseñas
    </h2>

    <div class="flex flex-wrap justify-center gap-6 mt-5 px-4">
        <?php foreach ($testimonios as $testimonio): ?>
            <div class="border-2 p-6 rounded-lg shadow-md max-w-xs flex flex-col justify-between h-full transition-transform transform hover:scale-105 hover:shadow-lg">
                <div>
                    <h3 class="font-extrabold text-left text-gray-800 mb-2 uppercase">
                        <?= htmlspecialchars($testimonio->titulo) ?: 'Reseña' ?>
                    </h3>
                    <p class="text-gray-600 mb-4 text-sm">
                        <?= htmlspecialchars($testimonio->mensaje) ?>
                    </p>
                </div>

                <div class="mt-4">
                    <div class="text-xl flex space-x-1 mb-1 justify-right">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 <?= $i <= $testimonio->calificacion ? 'text-yellow-500' : 'text-gray-300' ?>">
                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <p class="text-xs text-gray-500 text-right">
                        <?= htmlspecialchars($testimonio->autor) ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
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
            <a href="/producto/<?= htmlspecialchars($vehiculo->id) ?>" class="flex flex-col h-full">
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
                            USD <?= number_format($vehiculo->precio, 2) ?>
                        </h3>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <section class="flex justify-start mt-6">
    <a name="catalogo" class="uppercase mx-2 py-3 px-8 text-xl text-white bg-red-600 hover:bg-red-700 rounded-lg font-extrabold transition-colors duration-300" href="./catalogo">
        Catálogo
    </a>
</section>

<!-- contáctenos -->
<section class="flex flex-col justify-start mt-6">
    <h2 class="pt-20 font-black text-3xl sm:text-4xl lg:text-5xl text-red-600 uppercase text-left">
        <a href="/contacto" class="inline-block">
            Contáctenos
        </a>
    </h2>

    <p class="font-medium text-lg sm:text-xl lg:text-2xl text-gray-600 text-left">
        Nuestros horarios de atención al cliente:
    </p>
    <p class="font-medium text-lg text-zinc-400 text-left">
        Lunes a Viernes de 8.30 a 12.30 y de 14.00 a 18.30; Sábado de 8.30 a 12:30
    </p>

    <p class="pt-5 font-black text-2xl sm:text-3xl lg:text-4xl text-red-600 uppercase text-left">
        (+598) 91 014 226
    </p>
</section>
