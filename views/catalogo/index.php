<div class="inset-0 fixed bg-black bg-opacity-70 z-30 lg:hidden hidden" id="bgFilter"></div>

<button class="fixed top-3 right-2 text-white bg-black rounded-full bg-opacity-40 p-1 z-50 lg:hidden hidden"
    id="closeFilter">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
        <path fill-rule="evenodd"
            d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
            clip-rule="evenodd" />
    </svg>

</button>

<section class="px-4 max-w-screen-xl mx-auto">
    <!-- filtros -->
    <h1 class="title">Nuestro cátalogo de vehiculos</h1>
    <div class="flex justify-between gap-10">
        <button type="button" id="filterButton" class="
        sticky top-5 z-10
        shadow-sm w-fit px-6 py-2 mb-10 
        bg-gray-200 text-black hover:bg-gray-300 font-medium rounded-xl
        transition duration-300 
        flex gap-2 items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path
                    d="M18.75 12.75h1.5a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM12 6a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 6ZM12 18a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 18ZM3.75 6.75h1.5a.75.75 0 1 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM5.25 18.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 0 1.5ZM3 12a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 3 12ZM9 3.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM12.75 12a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM9 15.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
            </svg>
            Filtros</button>

        <div class="flex gap-2 items-center">
            <input type="text" id="buscarInput" placeholder="Buscar.." class="shadow-sm w-0 px-0 duration-300 transition-all py-2 mb-10
            bg-gray-200 text-black  font-medium rounded-xl">

            <button id="search" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-gray-700 mb-10">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>
    </div>


    <div class="w-full flex">
        <div class="
            lg:block
            top-5 lg:sticky fixed z-40
            -ml-5 -mt-5 p-5 lg:p-0 lg:ml-0
            h-screen lg:h-[730px] 
            lg:max-w-0 opacity-0 w-[calc(100%-50px)] max-w-[500px]
            -translate-x-full lg:translate-x-0
            bg-white max-lg:overflow-y-auto overflow-hidden
            transition-all duration-300" id="filtersContainer">
            <form id="formFilters" method="GET" class="space-y-6">
                <!-- filtro x marca -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Marca</h3>
                    <ul class="space-y-2">
                        <?php
                        $marcas = ['Ferrari', 'Lamborghini', 'Porsche', 'Mercedes', 'BMW'];
                        foreach ($marcas as $marca): ?>
                            <li>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="brands[]" value="<?php echo $marca; ?>"
                                        class="form-checkbox h-4 w-4 text-red-600">
                                    <span class="ml-2 text-gray-700"><?php echo $marca; ?></span>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Colores</h3>
                    <ul class="space-y-2">
                        <?php
                        $colors = ['Negro', 'Rojo', 'Azul'];
                        foreach ($colors as $color): ?>
                            <li>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="colors[]" value="<?php echo $color; ?>"
                                        class="form-checkbox h-4 w-4 text-red-600">
                                    <span class="ml-2 text-gray-700"><?php echo $color; ?></span>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- filtro año -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Año</h3>
                    <div class="flex space-x-3">
                        <input type="number" id="year_min" placeholder="Desde"
                            class="ml-1 w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                        <input type="number" id="year_max" placeholder="Hasta"
                            class="ml-1 w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                    </div>
                </div>

                <!-- filtro precio -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Precio</h3>
                    <div class="flex space-x-3">
                        <input type="number" id="price_min" placeholder="Mínimo"
                            class="ml-1 w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                        <input type="number" id="price_max" placeholder="Máximo"
                            class="ml-1 w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                    </div>
                </div>

                <!-- filtro x km -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Kilómetros</h3>
                    <div class="flex space-x-3">
                        <input type="number" id="km_min" placeholder="Mínimo"
                            class="ml-1 w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                        <input type="number" id="km_max" placeholder="Máximo"
                            class="ml-1 w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring focus:ring-red-200">
                    </div>
                </div>

                <!-- filtro nuevo o usado -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Estado</h3>
                    <ul class="space-y-2">
                        <li>
                            <label class="inline-flex items-center">
                                <input type="radio" name="state" value="nuevo" class="form-radio h-4 w-4 text-red-600">
                                <span class="ml-2 text-gray-700">Nuevo</span>
                            </label>
                        </li>
                        <li>
                            <label class="inline-flex items-center">
                                <input type="radio" name="state" value="usado" class="form-radio h-4 w-4 text-red-600">
                                <span class="ml-2 text-gray-700">Usado</span>
                            </label>
                        </li>
                        <li>
                            <label class="inline-flex items-center">
                                <input type="radio" name="state" value="todos" class="form-radio h-4 w-4 text-red-600">
                                <span class="ml-2 text-gray-700">Todos</span>
                            </label>
                        </li>
                    </ul>
                </div>

                <button type="button" id="resetFilters"
                    class="w-full bg-gray-900 text-white py-2 rounded-xl font-medium hover:bg-gray-700 transition duration-300 flex gap-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>

                    Resetear Filtros
                </button>
            </form>
        </div>

        <!--Fin Filtros -->

        <div id="empty" class="hidden"></div>

        <ul class="grid grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-2 lg:gap-x-4 w-full transition-all duration-500"
            id="vehiculos">


        </ul>
    </div>
</section>