<section class="max-w-screen-xl mx-auto">

    <div class="flex flex-col-reverse lg:grid lg:grid-cols-2 px-6 gap-10">
        <div class=" rounded-xl">
            <div>
                <h2 class="text-xl font-medium text-gray-800">Información Contacto</h2>

                <div class="flex flex-col gap-1 mt-5">
                    <label for="email" class="text-lg text-gray-700">Email</label>
                    <input id="email" type="email" class="w-full py-2 px-4 border rounded-md" value="<?= htmlspecialchars($email) ?>">
                </div>
            </div>

            <div class="mt-10 pt-10 border-t">
                <h2 class="text-xl font-medium text-gray-800">Información de cliente</h2>

                <div class="flex flex-col gap-3 mt-2">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="flex flex-col gap-1">
                            <label for="nombre" class="text-lg text-gray-700">Nombre</label>
                            <input type="text" id="nombre" class="w-full py-2 px-4 border rounded-md" value="<?= htmlspecialchars($nombre) ?>">
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="apellido" class="text-lg text-gray-700">Apellido</label>
                            <input type="text" id="apellido" class="w-full py-2 px-4 border rounded-md" value="<?= htmlspecialchars($apellido) ?>">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="direccion" class="text-lg text-gray-700">Dirección</label>
                        <input type="text" id="direccion" class="w-full py-2 px-4 border rounded-md">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="apartamento" class="text-lg text-gray-700">Apartamento, suite, etc..</label>
                        <input type="text" id="apartamento" class="w-full py-2 px-4 border rounded-md">
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        <div class="flex flex-col gap-1">
                            <label for="ciudad" class="text-lg text-gray-700">Ciudad</label>
                            <input type="text" id="ciudad" class="w-full py-2 px-4 border rounded-md">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="codigo" class="text-lg text-gray-700">Código Postal</label>
                            <input type="text" id="codigo" class="w-full py-2 px-4 border rounded-md">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="pais" class="text-lg text-gray-700">País</label>
                            <input type="text" id="pais" class="w-full py-2 px-4 border rounded-md">
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="telefono" class="text-lg text-gray-700">Phone</label>
                        <input type="text" id="telefono" class="w-full py-2 px-4 border rounded-md">
                    </div>
                </div>

                <div class="mt-10 pt-10 border-t">
                    <h2 class="text-xl font-medium text-gray-800">Pago</h2>

                    <div class="flex flex-col gap-3 mt-2">
                        <div class="flex flex-col gap-1">
                            <label for="tarjeta" class="text-lg text-gray-700">Numero de Tarjeta</label>
                            <input type="text" id="tarjeta" class="w-full py-2 px-4 border rounded-md">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="nombreTarjeta" class="text-lg text-gray-700">Nombre en Tarjeta</label>
                            <input type="text" id="nombreTarjeta" class="w-full py-2 px-4 border rounded-md">
                        </div>

                        <div class="grid grid-cols-4 gap-2">
                            <div class="flex flex-col gap-1 col-span-3">
                                <label for="caducidad" class="text-lg text-gray-700">Fecha de caducidad (MM/AA)</label>
                                <input type="text" id="caducidad" class="w-full py-2 px-4 border rounded-md">
                            </div>
                            <div class="flex flex-col gap-1 col-span-1">
                                <label for="cvc" class="text-lg text-gray-700">CVC</label>
                                <input type="text" id="cvc" class="w-full py-2 px-4 border rounded-md">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Fin Form -->

        <!-- Resumen Orden -->

        <div class="flex flex-col gap-5 lg:sticky top-5 h-[581px]">
            <h2 class="text-xl font-medium text-gray-800">Resumen compra</h2>

            <div class="flex flex-col gap-10">
                <div class="flex justify-between border-y py-8">
                    <div class="flex gap-5">
                        <img id="imagen" alt="" src="" class="h-32 w-48 object-cover rounded-xl">

                        <div class="flex flex-col justify-between py-2">
                            <div>
                                <h3 class="text-xl text-gray-800 hover:text-red-600 font-medium" id="titulo">
                                    Mercedes Benz AMG G63
                                </h3>
                                <div class="flex gap-2">
                                    <p class="text-gray-500 font-medium" id="año"></p>
                                    <p class="text-gray-500 font-medium">-</p>
                                    <p class="text-gray-500 font-medium" id="km"></p>
                                </div>
                            </div>

                            <p class="text-lg text-gray-500 font-medium" id="precio"></p>
                        </div>
                    </div>
                    <p class="text-gray-500 font-medium py-2">
                        Tipo:
                        <span class="py-1 px-2 rounded-lg capitalize" id="tipo">Alquier</span>
                    </p>
                </div>

                <div class="flex flex-col">
                    <div class="flex justify-between py-2">
                        <p class="text-lg text-gray-700">Subtotal</p>
                        <p class="text-lg text-gray-700 font-medium" id="subtotal">USD 755,273.00</p>
                    </div>

                    <div class="flex justify-between py-2">
                        <p class="text-lg text-gray-700">Impuestos(5%)</p>
                        <p class="text-lg text-gray-700 font-medium" id="tax">USD 56.55</p>
                    </div>

                    <div class="flex justify-between py-4 mt-8 border-y">
                        <p class="text-xl text-gray-700 font-medium">Total</p>
                        <p class="text-xl text-gray-700 font-medium" id="total">USD 533.55</p>
                    </div>

                    <button type="button" id="confirmBtn"
                        class="bg-red-600 font-medium text-lg w-full py-2 px-4 text-white rounded-xl border-t mt-4">
                        Confirmar compra
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>