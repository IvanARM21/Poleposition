<div class="flex justify-between items-center gap-5">
    <h1 class="text-2xl font-semibold">Lista de Ventas</h1>
</div>

<?php if ($historial): ?>
    <div class="overflow-auto mt-10">
        <table class="min-w-[800px] w-full caption-bottom border-b border-gray-200">
            <thead>
                <tr class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">ID (Usuario)</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">Nombre</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Marca</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Modelo</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Color</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Kilometraje</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Año</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Tipo</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Fecha</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            <?php foreach ($historial as $historialventas): ?>
    <tr>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $historialventas->Cuenta; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $historialventas->Nombre; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $historialventas->Marca; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $historialventas->Modelo; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $historialventas->Color; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $historialventas->Kilometraje; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $historialventas->Año; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $historialventas->Tipo; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $historialventas->Fecha; ?></td>
    </tr>
<?php endforeach; ?>

            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="text-xl text-gray-500">Aún no tienes <span class="text-red-600 font-medium hover:underline decoration-1" id="spanModal">ninguna venta</span></p>
<?php endif; ?>
