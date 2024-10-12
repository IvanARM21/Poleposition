<script>
    // Verificar si el vehículo fue agregado exitosamente
    document.addEventListener("DOMContentLoaded", function () {
        const vehiculoAgregado = localStorage.getItem("vehiculoAgregado");
        if (vehiculoAgregado === "true") {
            // Mostrar el mensaje de éxito
            const successMessage = document.getElementById("successMessage");
            if (successMessage) {
                successMessage.classList.remove("hidden");
            }
            // Eliminar el indicador de localStorage para que no vuelva a mostrarse
            localStorage.removeItem("vehiculoAgregado");
        }
    });
</script>

<h2 id="successMessage" class="hidden text-green-600 font-bold">Vehículo agregado correctamente</h2>


<div class="flex justify-between items-center gap-5">
    <h1 class="text-xl font-semibold">Lista de Vehiculos</h1>

    <button type="button" id="menuBtn"
        class="bg-red-600 font-semibold text-sm py-2 px-4 text-white rounded-xl hover:bg-red-700 transition-colors">
        Agregar Vehiculo
    </button>
</div>

<div class="overflow-auto mt-10">
    <table class="min-w-[800px] w-full caption-bottom border-b border-gray-200">
        <thead>
            <tr class="border-b px-4 py-3.5 text-left text-sm font-semibold text-gray-800 border-gray-820">
                <th class="border-b px-4 py-3.5 text-left text-sm font-semibold text-gray-800 border-gray-820">ID</th>
                <th class="border-b px-4 py-3.5 text-left text-sm font-semibold text-gray-800 border-gray-820">Vehiculo
                </th>
                <th class="border-b px-4 py-3.5 text-left text-sm font-semibold text-gray-800  border-gray-200">Precio
                </th>
                <th class="border-b px-4 py-3.5 text-left text-sm font-semibold text-gray-800  border-gray-200">Km</th>
                <th class="border-b px-4 py-3.5 text-left text-sm font-semibold text-gray-800  border-gray-200">Año</th>
                <th class="border-b px-4 py-3.5 text-left text-sm font-semibold text-gray-800  border-gray-200">Acciones
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php foreach ($vehiculos as $vehiculo): ?>
                <tr>
                    <td class="px-1 py-4 sm:p-4 text-sm"><?php echo $vehiculo->id; ?></td>
                    <td class="px-1 py-4 sm:p-4 text-sm flex items-center gap-1">
                        <?php
                        $imagenes = explode(',', $vehiculo->imagenes);
                        if (!empty($imagenes[0])) { //para arreglar el bug de q al poner 2 imagenes no cargaba la preview
                            echo '<img src="../../img/uploads/' . trim($imagenes[0]) . '" alt="" class="h-14 w-20 object-cover rounded-lg">';
                        }
                        ?>
                        <?php echo $vehiculo->marca ?>
                        <?php echo $vehiculo->modelo; ?>
                    </td>
                    <td class="px-1 py-4 sm:p-4 text-sm"><?php echo $vehiculo->precio; ?></td>
                    <td class="px-1 py-4 sm:p-4 text-sm"><?php echo $vehiculo->kilometraje; ?></td>
                    <td class="px-1 py-4 sm:p-4 text-sm"><?php echo "2024" ?></td>
                    <td class="px-1 py-4 sm:p-4 text-sm">

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="modalBg" class="hidden bg-black bg-opacity-50 fixed inset-0 backdrop-blur-sm  justify-center items-center">
    <div
        class="flex flex-col justify-between max-w-3xl w-full bg-white fixed z-10 h-[90vh] rounded-2xl overflow-auto p-5 overflow-y-scroll no-scrollbar">
        <button class=" text-red-600 absolute top-5 right-5" type="button" id="btnClose">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>
        <h2 class="text-gray-800 text-xl font-bold">Agregar Vehiculo</h2>

        <form class="mt-10 flex flex-col gap-3" id="vehiculoForm" enctype="multipart/form-data">
            <div class="flex flex-col gap-1">
                <label for="marca" class="font-medium text-gray-800 text-sm">Marca</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="marca"
                    placeholder="Marca del vehiculo">
            </div>

            <div class="flex flex-col gap-1">
                <label for="modelo" class="font-medium text-gray-800 text-sm">Modelo</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="modelo"
                    placeholder="Modelo del vehiculo">
            </div>
            <div class="flex flex-col gap-1">
                <label for="color" class="font-medium text-gray-800 text-sm">Color</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="color"
                    placeholder="Color del vehiculo">
            </div>
            <div class="flex flex-col gap-1">
                <label for="precio" class="font-medium text-gray-800 text-sm">Precio</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="precio"
                    placeholder="Precio del vehiculo">
            </div>

            <div class="flex flex-col gap-1">
                <label for="kilometraje" class="font-medium text-gray-800 text-sm">Kilometraje</label>
                <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="kilometraje"
                    placeholder="Kilometros del vehiculo">
            </div>

            <div class="flex flex-col gap-1">
                <label for="descripcion" class="font-medium text-gray-800 text-sm">Descripción</label>
                <textarea id="descripcion" class="w-full border shadow rounded-xl py-2 px-4" cols="10"
                    rows="4"></textarea>
            </div>

            <div class="flex flex-col gap-1">
                <label for="imagenes" class="font-medium text-gray-800 text-sm">Imágenes</label>
                <div id="files" class="relative w-full h-60 border-red-600" ondragenter="handleDragEnter()"
                    ondragleave="handleDragLeave()">
                    <div id="dragChange"
                        class="w-full h-full border border-gray-300 rounded-xl border-dashed flex flex-col justify-center items-center">
                        <p class="text-gray-600 font-medium mb-1"><span class="text-red-600">Subir archivos</span> o
                            arrastra y suelta</p>
                        <p class="text-gray-500 text-sm font-medium">PNG, JPEG, Webp, Avif, JFIF</p>
                    </div>
                    <input type="file" class="opacity-0 absolute inset-0" id="imagenes" accept=".jpg,.jpeg,.png,.gif"
                        multiple>
                </div>
            </div>

            <div id="errorMsg" class="hidden text-left text-base font-bold mt-4"></div>


            <div class="flex gap-3 items-center justify-end mt-5">
                <button type="button" class="text-gray-800 font-semibold text-sm" id="btnCancel">
                    Cancelar
                </button>
                <input type="submit" class="bg-red-600 text-white py-2 px-4 text-sm rounded-xl font-semibold"
                    value="Guardar vehiculo">
            </div>
        </form>
    </div>
</div>

<script src="../../js/dashboard/modal.js" type="module"></script>