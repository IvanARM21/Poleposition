<section class="flex flex-col items-center py-8">
    <h1 class="title text-2xl font-bold mb-5 sm:text-">Mi Perfil</h1>
    <div class="flex flex-col sm:flex-row items-start gap-5 w-full max-w-6xl mx-auto">

        <!-- sidebar -->
        <nav class="bg-white p-2 w-full sm:min-h-[372px] sm:w-60 border rounded-xl flex sm:flex-col gap-3">
            <button
                class="hover:bg-gray-50 px-4 py-2 w-full transition-all duration-300 text-gray-500 rounded-xl flex gap-2 items-center"
                id="perfilBtn" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path
                        d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z" />
                </svg>
                Perfil
            </button>
            <button
                class="hover:bg-gray-50 px-4 py-2 w-full transition-all duration-300 text-gray-500 rounded-xl flex gap-2 items-center"
                id="seguridadBtn" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                        d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z"
                        clip-rule="evenodd" />
                </svg>
                Seguridad
            </button>
            <button
                class="hover:bg-gray-50 px-4 py-2 w-full transition-all duration-300 text-gray-500 rounded-xl flex gap-2 items-center"
                id="historialBtn" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z"
                        clip-rule="evenodd" />
                </svg>

                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>

                </svg>
                Historial
            </button>
        </nav>

        <!-- PERFIL -->
        <div class="w-full" id="perfilForm">
            <form method="POST" action="" class="flex flex-col space-y-4 w-full">
                <div class="flex flex-col gap-y-3 formulario">
                    <h2 class="text-gray-800 font-black text-xl">Información Personal:</h2>

                    <?php if (isset($cuentas['nombreCompleto'])): ?>
                        <div class="campo">
                            <input type="text" name="nombreCompleto" class="input" placeholder="Tu nombre"
                                value="<?php echo htmlspecialchars($cuentas['nombreCompleto']); ?>">
                        </div>
                    <?php else: ?>
                        <div class="campo">
                            <input type="text" name="nombreCompleto" class="input" placeholder="Tu nombre" value="">
                            <p class="text-red-600">No se encontraron los datos del usuario.</p>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($cuentas['usuario'])): ?>
                        <div class="campo">
                            <input type="text" name="usuario" class="input" placeholder="Tu usuario"
                                value="<?php echo htmlspecialchars($cuentas['usuario']); ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (isset($cuentas['email'])): ?>
                        <div class="campo">
                            <input type="email" name="email" class="input" placeholder="Tu e-mail"
                                value="<?php echo htmlspecialchars($cuentas['email']); ?>">
                        </div>
                    <?php endif; ?>


                    <input type="submit" name="enviarDatosPerfil" class="submit" value="Actualizar Perfil">
                </div>
            </form>
        </div>

        <!-- SEGURIDAD -->
        <div class="hidden w-full" id="seguridadForm">
            <div class="items-center p-5 sm:p-10 border rounded-xl h-full">

                <h2 class="text-gray-800 font-black text-xl">Seguridad:</h2>


                <div class="pt-4"></div>

                <!-- cambiar contraseña -->

                <button type="button" id="cambiar-contraseña"
                    class="font-bold text-white p-4 bg-red-600 rounded-xl border-2 transition-colors duration-300 hover:bg-white hover:text-black hover:border-red-600">
                    Cambiar Contraseña
                </button>

                <!-- modal cambiar contraseña -->
                <div id="modal-cambiar"
                    class="fixed z-40 inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 class="text-xl font-semibold mb-4 text-gray-800">Cambiar Contraseña</h2>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Contraseña actual</label>
                            <input type="password" id="actual-pass"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
                            <input type="password" id="new-pass"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Repetir nueva contraseña</label>
                            <input type="password" id="repeat-pass"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                        <p id="error-msg" class="text-red-500 text-sm hidden">Las contraseñas deben coincidir y ser de
                            más de 8 caracteres</p>
                        <div class="flex justify-end space-x-4">
                            <button id="guardar-pass"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Guardar</button>
                            <button id="cancelar-pass"
                                class="bg-gray-300 text-black px-4 py-2 rounded-lg hover:bg-gray-400 transition">Cancelar</button>
                        </div>
                    </div>
                </div>

                <!-- modal eliminar Cuenta -->
                <div id="modal-eliminar"
                    class="fixed z-40 inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                    <form id="formDeleteAccount" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800">¿Estás seguro?</h2>
                        <p class="mb-4 text-gray-600">Para eliminar tu cuenta, por favor ingresa tu contraseña.</p>
                        
                        <p id="alert"></p>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" id="delete-pass"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500" />
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button id="confirmar-eliminar" type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Eliminar</button>
                            <button id="cancelar-eliminar"  type="button"
                                class="bg-gray-300 text-black px-4 py-2 rounded-lg hover:bg-gray-400 transition">Cancelar</button>
                        </div>
                    </form>
                </div>


                <!-- boton eliminar cuenta -->

                <button type="button" id="eliminar-cuenta"
                    class="font-bold text-white p-4 bg-red-600 rounded-xl border-2 transition-colors duration-300 hover:bg-white hover:text-black hover:border-red-600">
                    Eliminar Cuenta
                </button>


            </div>
        </div>

        <!-- HISTORIAL DE VENTAS -->


        <div class="hidden w-full" id="historialForm">
            <div class="flex justify-between items-center p-5 sm:p-10 border rounded-xl h-full">
                <table class="min-w-[800px] w-full caption-bottom border-b border-gray-200">
                    <thead>
                        <tr class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">
                            <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800">Nombre</th>
                            <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800">Marca</th>
                            <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800">Modelo</th>
                            <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800">Color</th>
                            <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800">Precio</th>
                            <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800">Kilometraje
                            </th>
                            <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800">Año</th>
                            <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800">Tipo</th>
                            <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (empty($compras)): ?>
                            <tr>
                                <td colspan="9" class="px-1 py-4 text-center text-gray-600 font-medium">No existe ninguna
                                    compra o alquiler.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($compras as $compra): ?>
                                <tr>
                                    <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium text-nowrap">
                                        <?php echo $compra->Nombre; ?></td>
                                    <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium text-nowrap">
                                        <?php echo $compra->Marca; ?></td>
                                    <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium text-nowrap">
                                        <?php echo $compra->Modelo; ?></td>
                                    <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium text-nowrap">
                                        <?php echo $compra->Color; ?></td>
                                    <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium text-nowrap">USD
                                        <?= number_format($compra->Precio, 2) ?>
                                    <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium text-nowrap">
                                        <?php echo $compra->Kilometraje; ?> Km</td>
                                    <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium text-nowrap">
                                        <?php echo $compra->Año; ?></td>
                                    <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium text-nowrap">
                                        <?php echo $compra->Tipo; ?></td>
                                    <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium text-nowrap">
                                        <?php echo $compra->Fecha; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
</section>





<!-- 
<div class="bg-black bg-opacity-50 absolute inset-0 z-50 backdrop-blur-sm"></div> 
-->