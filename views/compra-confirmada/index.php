<section>
    <div>
        <h1 class="title mb-4">Compra confirmada</h1>
        <p class="text-xl text-gray-500 text-center max-w-xl mx-auto">
            Tu compra se ha confirmado correctamente. ¡Gracias por comprar con nosotros! Puedes revisar la información
            en tu perfil. También puedes dejarnos <span class="text-red-600 font-medium hover:underline decoration-1"
                id="openModal">una reseña </span>
            de tu
            experiencia de compra.
        </p>
    </div>
</section>

<div class="bg-black bg-opacity-50 fixed inset-0 backdrop-blur-sm z-20 hidden justify-center items-center"
    id="modalReseña">
    <div
        class="bg-white max-w-3xl w-full flex flex-col justify-between z-30 max-h-[90vh] rounded-2xl overflow-y-scroll no-scrollbar p-5 relative">
        <div>
            <button class=" text-red-600 absolute top-5 right-5" type="button" name="closeModal">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor"
                    class="mr-2 transition-colors duration-300 size-6 cursor-pointer text-gray-300" name="remove">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>
            <h2 class="text-xl font-bold text-gray-800">Agregar Reseña</h2>

            <form class="mt-10 flex flex-col gap-3" id="reviewForm" method="POST">
                <div class="flex flex-col gap-1">
                    <label for="titulo" class="font-medium text-gray-800 ">Título reseña</label>
                    <input type="text" class="w-full border shadow rounded-xl py-2 px-4" id="titulo"
                        placeholder="Título de tu reseña">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="mensaje" class="font-medium text-gray-800 ">Mensaje</label>
                    <textarea name="mensaje" class="w-full border shadow rounded-xl py-2 px-4" id="mensaje"
                        placeholder="Mensaje de la reseña"></textarea>
                </div>

                <div>
                    <label class="font-medium text-gray-800 ">Calificación</label>

                    <div class="flex flex-wrap items-center mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-2 transition-colors duration-300 size-6 cursor-pointer text-yellow-500" name="calificacion"
                            id="1">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-2 transition-colors duration-300 size-6 cursor-pointer text-gray-300" name="calificacion" id="2">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-2 transition-colors duration-300 size-6 cursor-pointer text-gray-300" name="calificacion" id="3">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-2 transition-colors duration-300 size-6 cursor-pointer text-gray-300" name="calificacion" id="4">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="mr-2 transition-colors duration-300 size-6 cursor-pointer text-gray-300" name="calificacion" id="5">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd" />
                        </svg>

                        <p class="ml-4 text-yellow-600 font-medium text-lg" id="calificacionTexto">1.0</p>
                    </div>
                </div>

                <div class="flex gap-3 items-center justify-end mt-5">
                    <button type="button" class="text-gray-800 font-semibold " name="closeModal">
                        Cancelar
                    </button>
                    <input type="submit" class="bg-red-600 text-white py-2 px-4  rounded-xl font-semibold"
                        value="Subir reseña">
                </div>
            </form>
        </div>
    </div>
</div>

<section>
    <a href="/models/generarfactura.php">
    <button type="button" id="descargarFactura"
        class="bg-red-600 text-white font-medium py-2 px-4 rounded-xl hover:bg-red-900 transition-colors duration-300 flex items-center mt-4 text-center max-w-xl mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
        </svg>
        Descargar Factura
    </button> </a>

</section>