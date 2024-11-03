<section class="flex flex-col md:flex-row gap-6 p-6 bg-white shadow-md rounded-lg max-w-screen-xl mx-auto items-start">
    <?php if ($vehiculo): ?>
        <div class="w-full md:w-1/2 flex flex-col bg-gray-100 rounded-lg relative">
            <?php if (!empty($vehiculo->imagenes)): ?>
                <?php
                $imagenes = explode(',', $vehiculo->imagenes);
                $totalImagenes = count($imagenes);
                ?>
                <div id="image-slider" class="relative w-full overflow-hidden rounded-lg">
                    <?php foreach ($imagenes as $index => $imagen): ?>
                        <img src="../img/uploads/<?php echo htmlspecialchars($imagenes[($index) % count($imagenes)]); ?>"
                            alt="Imagen del vehículo"
                            class="vehicle-image w-full h-full object-cover rounded-lg <?php echo $index === 0 ? 'block' : 'hidden'; ?>">
                    <?php endforeach; ?>

                </div>

                <?php if ($totalImagenes > 1): ?>
                    <!-- boton antes -->
                    <button id="prev-button"
                        class="absolute top-[calc(50%-7rem)] left-4 text-gray-700 p-2 md:p-3 z-10 bg-white rounded-full shadow">
                        &#10094;
                    </button>

                    <!-- boton despues -->
                    <button id="next-button"
                        class="absolute top-[calc(50%-7rem)] right-4 text-gray-700 p-2 md:p-3 z-10 bg-white rounded-full shadow">
                        &#10095;
                    </button>
                <?php endif; ?>


            <?php else: ?>
                <div class="w-full h-64 md:h-80 bg-gray-200 flex items-center justify-center rounded-lg">
                    <p class="text-gray-500">No hay imágenes disponibles para este vehículo.</p>
                </div>
            <?php endif; ?>
            <div class="pt-4 bg-white rounded-b-lg">
                <h2 class="text-xl font-bold text-red-600">Más información</h2>
                <p class="mt-2 text-gray-700 text-left"><?php echo $vehiculo->descripcion; ?></p>
            </div>
        </div>

        <div class="w-full md:w-1/2 flex flex-col justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 uppercase">
                    <?php echo $vehiculo->marca . " " . $vehiculo->modelo; ?>
                </h1>
                <p class="mt-2 text-lg font-semibold text-green-900">$<?php echo number_format($vehiculo->precio, 2); ?></p>
                <p class="mt-4 text-gray-700">
                <div class="flex items-center space-x-2 rounded-lg shadow p-4 mt-4">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <span><?php echo $vehiculo->año; ?></span>
                </div>

                <div class="flex items-center space-x-2 rounded-lg shadow p-4 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>

                    <span> <?php echo $vehiculo->color; ?></span>
                </div>

                <div class="flex items-center space-x-2 rounded-lg shadow p-4 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z" />
                    </svg>

                    <span><?php echo $vehiculo->kilometraje; ?> Km</span>
                </div>


                <div class="flex items-center space-x-2 rounded-lg shadow p-4 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z" />
                    </svg>

                    <span><?php echo $vehiculo->marca; ?></span>
                </div>
                </p>
            </div>
            <div class="flex gap-4 mt-auto sm:pt-10">
                <button name="alquilar" id="<?php echo $vehiculo->id ?>"
                    class="w-fit px-6  text-red-600 py-2 rounded-xl bg-red-50 transition hover:scale-105 ">Alquilar</button>
                <button name="compra" id="<?php echo $vehiculo->id ?>"
                    class="w-fit px-6 bg-red-600 text-white py-2 rounded-xl  transition-all hover:scale-105">Comprar</button>

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