<section class="max-w-screen-xl mx-auto">
    <form method="POST" action="" id="compraForm">
        <div class="flex flex-col-reverse lg:grid lg:grid-cols-2 px-6 gap-10">
            <div class="rounded-xl">
                <div>
                    <h2 class="text-xl font-medium text-gray-800">Información Contacto</h2>

                    <div class="flex flex-col gap-1 mt-5">
                        <label for="email" class="text-lg text-gray-700">Email</label>
                        <input id="email" name="email" type="email" class="w-full py-2 px-4 border rounded-md"
                            value="<?= htmlspecialchars($email) ?>">
                        <?php if (!empty($errors['email'])): ?>
                            <p class="text-red-600"><?= htmlspecialchars($errors['email']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t">
                    <h2 class="text-xl font-medium text-gray-800">Información de cliente</h2>

                    <div class="flex flex-col gap-3 mt-2">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex flex-col gap-1">
                                <label for="nombre" class="text-lg text-gray-700">Nombre <span
                                        class="text-red-600">*</span> </label>
                                <input type="text" id="nombre" name="nombre" class="w-full py-2 px-4 border rounded-md"
                                    value="<?= htmlspecialchars($nombre) ?>">
                                <?php if (!empty($errors['nombre'])): ?>
                                    <p class="text-red-600"><?= htmlspecialchars($errors['nombre']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="flex flex-col gap-1">
                                <label for="apellido" class="text-lg text-gray-700">Apellido <span
                                        class="text-red-600">*</span> </label>
                                <input type="text" id="apellido" name="apellido"
                                    class="w-full py-2 px-4 border rounded-md"
                                    value="<?= htmlspecialchars($apellido) ?>">
                                <?php if (!empty($errors['apellido'])): ?>
                                    <p class="text-red-600"><?= htmlspecialchars($errors['apellido']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="direccion" class="text-lg text-gray-700">Dirección <span
                                    class="text-red-600">*</span> </label>
                            <input type="text" id="direccion" name="direccion"
                                class="w-full py-2 px-4 border rounded-md">
                            <?php if (!empty($errors['direccion'])): ?>
                                <p class="text-red-600"><?= htmlspecialchars($errors['direccion']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="apartamento" class="text-lg text-gray-700">Apartamento, suite, etc..</label>
                            <input type="text" id="apartamento" name="apartamento"
                                class="w-full py-2 px-4 border rounded-md">
                            <?php if (!empty($errors['apartamento'])): ?>
                                <p class="text-red-600"><?= htmlspecialchars($errors['apartamento']) ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="grid grid-cols-3 gap-2">
                            <div class="flex flex-col gap-1">
                                <label for="ciudad" class="text-lg text-gray-700">Ciudad <span
                                        class="text-red-600">*</span> </label>
                                <input type="text" id="ciudad" name="ciudad" class="w-full py-2 px-4 border rounded-md">
                                <?php if (!empty($errors['ciudad'])): ?>
                                    <p class="text-red-600"><?= htmlspecialchars($errors['ciudad']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="codigo" class="text-lg text-gray-700">Código Postal <span
                                        class="text-red-600">*</span> </label>
                                <input type="text" id="codigo" name="codigo" class="w-full py-2 px-4 border rounded-md">
                                <?php if (!empty($errors['codigo'])): ?>
                                    <p class="text-red-600"><?= htmlspecialchars($errors['codigo']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="pais" class="text-lg text-gray-700">País <span class="text-red-600">*</span>
                                </label>
                                <input type="text" id="pais" name="pais" class="w-full py-2 px-4 border rounded-md">
                                <?php if (!empty($errors['pais'])): ?>
                                    <p class="text-red-600"><?= htmlspecialchars($errors['pais']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <label for="telefono" class="text-lg text-gray-700">Teléfono <span
                                    class="text-red-600">*</span> </label>
                            <input type="text" id="telefono" name="telefono" class="w-full py-2 px-4 border rounded-md">
                            <?php if (!empty($errors['telefono'])): ?>
                                <p class="text-red-600"><?= htmlspecialchars($errors['telefono']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t">
                        <h2 class="text-xl font-medium text-gray-800">Pago</h2>

                        <div class="flex flex-col gap-3 mt-2">
                            <div class="flex flex-col gap-1">
                                <label for="tarjeta" class="text-lg text-gray-700">Número de Tarjeta <span
                                        class="text-red-600">*</span> </label>
                                <input type="text" id="tarjeta" name="tarjeta"
                                    class="w-full py-2 px-4 border rounded-md">
                                <?php if (!empty($errors['tarjeta'])): ?>
                                    <p class="text-red-600"><?= htmlspecialchars($errors['tarjeta']) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label for="nombreTarjeta" class="text-lg text-gray-700">Nombre en Tarjeta <span
                                        class="text-red-600">*</span> </label>
                                <input type="text" id="nombreTarjeta" name="nombreTarjeta"
                                    class="w-full py-2 px-4 border rounded-md">
                                <?php if (!empty($errors['nombreTarjeta'])): ?>
                                    <p class="text-red-600"><?= htmlspecialchars($errors['nombreTarjeta']) ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="grid grid-cols-6 gap-2">
                                <div class="flex flex-col gap-1 col-span-4">
                                    <label for="caducidad" class="text-lg text-gray-700">Fecha de Caducidad (MM/AA)
                                        <span class="text-red-600">*</span> </label>
                                    <input type="text" id="caducidad" name="caducidad"
                                        class="w-full py-2 px-4 border rounded-md">
                                    <?php if (!empty($errors['caducidad'])): ?>
                                        <p class="text-red-600"><?= htmlspecialchars($errors['caducidad']) ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="flex flex-col gap-1 col-span-2">
                                    <label for="cvc" class="text-lg text-gray-700">CVC <span
                                            class="text-red-600">*</span> </label>
                                    <input type="text" id="cvc" name="cvc" class="w-full py-2 px-4 border rounded-md">
                                    <?php if (!empty($errors['cvc'])): ?>
                                        <p class="text-red-600"><?= htmlspecialchars($errors['cvc']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="confirmBtn"
                        class="bg-red-600 font-medium text-lg w-full py-2 px-4 text-white rounded-xl border-t mt-8 lg:hidden">
                        Confirmar compra
                    </button>
                </div>
            </div>
            <div class="flex flex-col gap-5 lg:sticky top-5 lg:h-[581px]">
                <h2 class="text-xl font-medium text-gray-800">Resumen compra</h2>

                <div class="flex flex-col gap-10">
                    <div class="flex  sm:flex-row justify-between border-y py-8">
                        <div class="flex gap-2 sm:gap-5">
                            <img id="imagen" alt="" src="" class="h-18 sm:h-32 w-28 sm:w-48 object-cover rounded-xl">

                            <div class="flex flex-col justify-between py-1">
                                <div>
                                    <h3 class="text-sm sm:text-xl text-gray-800 hover:text-red-600 font-medium"
                                        id="titulo">
                                        Mercedes Benz AMG G63
                                    </h3>
                                    <div class="flex gap-2">
                                        <p class="text-gray-500 font-medium text-xs sm:text-base" id="año"></p>
                                        <p class="text-gray-500 font-medium text-xs sm:text-base">-</p>
                                        <p class="text-gray-500 font-medium text-xs sm:text-base" id="km"></p>
                                    </div>
                                </div>

                                <p class="text-sm sm:text-base text-gray-500 font-medium " id="precio"></p>
                            </div>
                        </div>
                        <p class="text-gray-500 font-medium py-2 text-xs sm:text-base text-nowrap">
                            Tipo:
                            <span class="py-1 px-2 rounded-lg capitalize" id="tipo">Alquiler</span>
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

                        <button type="submit" id="confirmBtn"
                            class="bg-red-600 font-medium text-lg w-full py-2 px-4 text-white rounded-xl border-t mt-4 hidden lg:block">
                            Confirmar compra
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>