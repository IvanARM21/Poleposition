<section>
    <h1 class="title">Mi Perfil</h1>
    <div class="flex flex-col sm:flex-row items-start gap-5 h-full">

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
        </nav>

        <!-- PERFIL -->
        <div class="w-full" id="perfilForm">
            <form method="POST" action="" class="flex flex-col space-y-4 w-full">
                <div class="flex flex-col gap-y-3 formulario">
                    <h1 class="text-gray-800 font-black text-xl">Información Personal:</h1>

                    <!-- si algo de perfil esta sin poner y se le hace click al formulario tira error -->

                    <?php if (!empty($errorPerfil)): ?>
                        <p class="text-red-600"><?php echo htmlspecialchars($errorPerfil); ?></p>
                    <?php endif; ?>

                    <div class="campo">
                        <input type="text" name="nombreCompleto" class="input" placeholder="Tu nombre"
                            value="<?php echo htmlspecialchars($usuarioDB['nombreCompleto']); ?>">
                    </div>
                    <div class="campo">
                        <input type="text" name="usuario" class="input" placeholder="Tu usuario"
                            value="<?php echo htmlspecialchars($usuarioDB['usuario']); ?>">
                    </div>
                    <div class="campo">
                        <input type="email" name="email" class="input" placeholder="Tu e-mail"
                            value="<?php echo htmlspecialchars($usuarioDB['email']); ?>">
                    </div>

                    <input type="submit" name="enviarDatosPerfil" class="submit" value="Actualizar Perfil">
                </div>
            </form>
        </div>

        <!-- SEGURIDAD -->
        <div class="hidden w-full" id="seguridadForm">
            <div class="flex justify-between items-center p-5 sm:p-10 border rounded-xl h-full">
                <button
                    type="button"
                    id="cambiar-contraseña"
                    class="text-gray-600 hover:text-black transition-colors"
                >Cambiar Contraseña</button>

                <button
                    type="button"
                >Eliminar Cuenta</button>
            </div>
        </div>
    </div>  
</section>

<!-- <div class="bg-black bg-opacity-50 absolute inset-0 z-50 backdrop-blur-sm">
    
</div> -->