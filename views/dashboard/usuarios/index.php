<div class="flex justify-between items-center gap-5">
    <h1 class="text-2xl font-semibold">Lista de Usuarios</h1>
</div>

<?php if ($usuarios): ?>
    <div class="overflow-auto mt-10">
        <table class="min-w-[800px] w-full caption-bottom border-b border-gray-200">
            <thead>
                <tr class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">ID</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">Usuario</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Nombre Completo</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Email</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Tipo</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $usuario->id; ?></td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $usuario->usuario; ?></td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $usuario->nombreCompleto; ?></td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $usuario->email; ?></td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium">
                            <select id="<?php echo $usuario->id ?>" name="selectRol">
                                <option value="usuario" <?php echo $usuario->tipo === "usuario" ? 'selected' : '' ?>>Usuario</option>
                                <option value="admin" <?php echo $usuario->tipo === "admin" ? 'selected' : '' ?>>Admin</option>
                            </select>
                            
                        </td>
                        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium">
                            <div class="flex gap-5 items-center">
                                <button type="button" class="text-gray-700 hover:text-red-600" id="<?php echo $usuario->id ?>" name="deleteBtn">
                                    <!--  icon de borrar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
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
    <p class="text-xl text-gray-500">Aún no tienes usuarios creados, <span class="text-red-600 font-medium hover:underline decoration-1" id="spanModal">empieza agregando uno</span></p>
<?php endif; ?>
