<div class="flex justify-between items-center gap-5">
    <h1 class="text-2xl font-semibold">Lista de Testimonios</h1>
</div>

<?php if ($testimonio): ?>
    <div class="overflow-auto mt-10">
        <table class="min-w-[800px] w-full caption-bottom border-b border-gray-200">
            <thead>
                <tr class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">ID</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-820">Titulo</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Autor</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Mensaje</th>
                    <th class="border-b px-4 py-3.5 text-left text-lg font-semibold text-gray-800 border-gray-200">Calificación</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            <?php foreach ($testimonio as $testimonio1): ?>
    <tr>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $testimonio1->id; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $testimonio1->titulo; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $testimonio1->autor; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $testimonio1->mensaje; ?></td>
        <td class="px-1 py-4 sm:p-4 text-gray-600 font-medium"><?php echo $testimonio1->calificacion; ?></td>
<?php endforeach; ?>

            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="text-xl text-gray-500">Aún no tienes <span class="text-red-600 font-medium hover:underline decoration-1" id="spanModal">ninguna venta</span></p>
<?php endif; ?>
