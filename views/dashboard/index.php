<div class="flex justify-between items-center gap-5">
    <h1 class="text-xl font-semibold">Lista de Vehiculos</h1>

    <button
        type="button"
        id="menuBtn"
        class="bg-red-600 font-semibold text-sm py-2 px-4 text-white rounded-xl hover:bg-red-700 transition-colors"
    >
        Agregar Vehiculo
    </button>
</div>

<div class="overflow-auto mt-10">
    <table class="min-w-[800px] w-full">
        <thead>
            <tr class="uppercase text-xs text-gray-800 border-b">
                <th class="py-4 text-left">ID</th>
                <th class="py-4 text-left">Vehiculo</th>
                <th class="py-4 text-left">Precio</th>
                <th class="py-4 text-left">Km</th>
                <th class="py-4 text-left">Marca</th>
                <th class="py-4 text-left">Año</th>
                <th class="py-4 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

<div 
    id="modalBg"
    class="hidden bg-black bg-opacity-50 fixed inset-0 backdrop-blur-sm  justify-center items-center"
>
    <div class="flex flex-col justify-between max-w-3xl w-full bg-white fixed z-10 h-[90vh] rounded-2xl overflow-auto p-5 overflow-y-scroll no-scrollbar">
        <button 
            class=" text-red-600 absolute top-5 right-5"
            type="button"
            id="btnClose"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>
        <h2 class="text-gray-800 text-xl font-bold">Agregar Vehiculo</h2>

        <form class="mt-10 flex flex-col gap-3" id="vehiculoForm" enctype="multipart/form-data">
            <div class="flex flex-col gap-1"> 
                <label for="marca" class="font-medium text-gray-800 text-sm">Marca</label>
                <input 
                    type="text"
                    class="w-full border shadow rounded-xl py-2 px-4"
                    id="marca"
                    placeholder="Marca del vehiculo"
                >
            </div>
            
            <div class="flex flex-col gap-1"> 
                <label for="modelo" class="font-medium text-gray-800 text-sm">Modelo</label>
                <input 
                    type="text"
                    class="w-full border shadow rounded-xl py-2 px-4"
                    id="modelo"
                    placeholder="Modelo del vehiculo"
                >
            </div>
            <div class="flex flex-col gap-1"> 
                <label for="color" class="font-medium text-gray-800 text-sm">Color</label>
                <input 
                    type="text"
                    class="w-full border shadow rounded-xl py-2 px-4"
                    id="color"
                    placeholder="Color del vehiculo"
                >
            </div>
            <div class="flex flex-col gap-1"> 
                <label for="precio" class="font-medium text-gray-800 text-sm">Precio</label>
                <input 
                    type="text"
                    class="w-full border shadow rounded-xl py-2 px-4"
                    id="precio"
                    placeholder="Precio del vehiculo"
                >
            </div>

            <div class="flex flex-col gap-1"> 
                <label for="kilometraje" class="font-medium text-gray-800 text-sm">Kilometraje</label>
                <input 
                    type="text"
                    class="w-full border shadow rounded-xl py-2 px-4"
                    id="kilometraje"
                    placeholder="Kilometros del vehiculo"
                >
            </div>

            <div class="flex flex-col gap-1"> 
                <label for="descripcion" class="font-medium text-gray-800 text-sm">Descripción</label>
                <textarea 
                    id="descripcion"
                    class="w-full border shadow rounded-xl py-2 px-4"
                    cols="10"
                    rows="4"
                ></textarea>
            </div>

            <div class="flex flex-col gap-1">
                <label for="imagenes" class="font-medium text-gray-800 text-sm">Imágenes</label>
                <div 
                    id="files"
                    class="relative w-full h-60 border-red-600" 
                    ondragenter="handleDragEnter()" 
                    ondragleave="handleDragLeave()"
                >
                    <div 
                        id="dragChange"
                        class="w-full h-full border border-gray-300 rounded-xl border-dashed flex flex-col justify-center items-center"
                    >
                        <p class="text-gray-600 font-medium mb-1"><span class="text-red-600">Subir archivos</span> o arrastra y suelta</p>
                        <p class="text-gray-500 text-sm font-medium">PNG, JPEG, Webp, Avif</p>
                    </div>
                    <input 
                        type="file"
                        class="opacity-0 absolute inset-0"
                        id="imagenes"
                        multiple
                    >
                </div>
            </div>

            <div class="flex gap-3 items-center justify-end mt-5">
                <button
                    type="button"
                    class="text-gray-800 font-semibold text-sm"
                    id="btnCancel"
                >
                    Cancelar
                </button>
                <input 
                    type="submit"
                    class="bg-red-600 text-white py-2 px-4 text-sm rounded-xl font-semibold"
                    value="Guardar vehiculo"
                >
            </div>
        </form>
    </div>
</div>

<script src="../../js/dashboard/modal.js" type="module"></script>