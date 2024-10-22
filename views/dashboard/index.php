<div>

</div>



<div class="flex justify-between items-center gap-5">
    <h1 class="text-2xl font-semibold">Lista de Vehiculos</h1>

    <button type="button" id="menuBtn"
        class="bg-red-600 font-semibold py-2 px-4 text-white rounded-xl hover:bg-red-700 transition-colors">
        Agregar Vehiculo
    </button>
</div>

<?php if ($vehiculos): ?>
    <div class="overflow-auto mt-10">
        <table class="min-w-[800px] w-full caption-bottom border-b border-gray-200">
            <thead>
                <tr class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">ID</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">Vehiculo
                    </th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800  border-gray-200">Precio
                    </th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800  border-gray-200">Km</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800  border-gray-200">Año</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800  border-gray-200">Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($vehiculos as $vehiculo): ?>
                    <tr>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $vehiculo->id; ?></td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium flex items-center gap-1">
                            <?php
                            $imagenes = explode(',', $vehiculo->imagenes ?? '');

                            if (!empty($imagenes[1])) { // evita el bug de la imagen vacía
                                echo '<img src="../../img/uploads/' . trim($imagenes[1]) . '" alt="" class="h-14 w-24 object-cover rounded-lg">';
                            } else {
                                echo "<div class='bg-gray-700 text-white rounded-lg h-14 w-24 flex justify-center items-center font-medium'>Sin imagen</div>";
                            }
                            ?>
                            <?php echo $vehiculo->marca ?>
                            <?php echo $vehiculo->modelo; ?>
                        </td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium">USD <?= number_format($vehiculo->precio, 2) ?>
                        </td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $vehiculo->kilometraje; ?></td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $vehiculo->año ?></td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium">
                            <div class="flex gap-5 items-center">
                                <button type="button" id="<?php echo $vehiculo->id ?>" name="editBtn"
                                    class="text-gray-700 hover:text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button type="button" class="text-gray-700 hover:text-red-600" id="<?php echo $vehiculo->id ?>"
                                    name="deleteBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


<?php else: ?>
    <p class="text-xl text-gray-500">Aún no tienes vehiculos creados, <span
            class="text-red-600 font-medium hover:underline decoration-1" id="spanModal">empieza agregando
            uno</span>
    </p>
<?php endif; ?>


<div id="modalBg" class="hidden bg-black bg-opacity-50 fixed inset-0 backdrop-blur-sm  justify-center items-center">
    <div id="modalContainer"
        class="flex flex-col justify-between max-w-3xl w-full bg-white fixed z-10 h-[90vh] rounded-2xl overflow-auto p-5 overflow-y-scroll no-scrollbar">
        <button class=" text-red-600 absolute top-5 right-5" type="button" id="btnClose">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>
        <h2 id="loadTitle" class="text-xl font-bold text-gray-800"></h2>
        <form class="mt-10 flex flex-col gap-3" id="vehiculoForm" enctype="multipart/form-data">
            <div class="flex flex-col gap-1">
                <label for="marca" class="font-medium text-gray-800 ">Marca</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="marca"
                    placeholder="Marca del vehiculo">
            </div>

            <div class="flex flex-col gap-1">
                <label for="modelo" class="font-medium text-gray-800 ">Modelo</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="modelo"
                    placeholder="Modelo del vehiculo">
            </div>
            <div class="flex flex-col gap-1">
                <label for="color" class="font-medium text-gray-800 ">Color</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="color"
                    placeholder="Color del vehiculo">
            </div>
            <div class="flex flex-col gap-1">
                <label for="precio" class="font-medium text-gray-800 ">Precio</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="precio"
                    placeholder="Precio del vehiculo">
            </div>

            <div class="flex flex-col gap-1">
                <label for="kilometraje" class="font-medium text-gray-800 ">Año</label>
                <input type="number" class="w-full border shadow rounded-xl py-2 px-4" id="año"
                    placeholder="Año del vehiculo">
            </div>

            <div class="flex flex-col gap-1">
                <label for="kilometraje" class="font-medium text-gray-800 ">Kilometraje</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="kilometraje"
                    placeholder="Kilometros del vehiculo">
            </div>

            <div class="flex flex-col gap-1">
                <label for="descripcion" class="font-medium text-gray-800 ">Descripción</label>
                <textarea id="descripcion" placeholder="Descripción del vehiculo"
                    class="w-full border shadow rounded-xl py-2 px-4" cols="10" rows="4"></textarea>
            </div>

            <div class="flex flex-col gap-1">
                <label for="imagenes" class="font-medium text-gray-800 ">Imágenes</label>
                <div id="files" class="relative w-full h-60 border-red-600" ondragenter="handleDragEnter()"
                    ondragleave="handleDragLeave()">
                    <div id="dragChange"
                        class="w-full h-full border border-gray-300 rounded-xl border-dashed flex flex-col justify-center items-center">
                        <p class="text-gray-600 font-medium mb-1"><span class="text-red-600">Subir archivos</span> o
                            arrastra y suelta</p>
                        <p class="text-gray-500  font-medium">PNG, JPEG, Webp, Avif, JFIF</p>
                    </div>
                    <input type="file" class="opacity-0 absolute inset-0" id="imagenes" accept=".jpg,.jpeg,.png,.gif"
                        multiple>
                </div>
            </div>

            <div id="errorMsg" class="hidden text-left text-base font-bold mt-4"></div>


            <div class="flex gap-3 items-center justify-end mt-5">
                <button type="button" class="text-gray-800 font-semibold " id="btnCancel">
                    Cancelar
                </button>
                <input type="submit" class="bg-red-600 text-white py-2 px-4  rounded-xl font-semibold"
                    value="Guardar vehiculo">
            </div>
        </form>
    </div>
</div>

<div id="modalBgDelete"
    class="hidden bg-black bg-opacity-50 fixed inset-0 backdrop-blur-sm justify-center items-center">
    <div id="modalContainer"
        class="flex flex-col justify-between max-w-3xl w-full bg-white fixed z-10 h-auto rounded-2xl overflow-auto p-5 overflow-y-scroll no-scrollbar">
        <button class=" text-red-600 absolute top-5 right-5" type="button" id="btnCloseDelete">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>

        <h2 class="text-2xl font-bold text-gray-800">Eliminar Vehiculo</h2>
        <p class="text-lg text-gray-500">¿Estás seguro de eliminar este vehiculo? está acción es irreversible.</p>

        <div class="flex justify-end gap-5 mt-5">
            <button class="text-gray-700 text-lg font-semibold" id="btnCancelDelete">Cancelar</button>
            <button class="text-white bg-red-600 py-2 px-4 rounded-xl text-lg font-semibold"
                id="delete">Eliminar</button>
        </div>
    </div>
</div>

