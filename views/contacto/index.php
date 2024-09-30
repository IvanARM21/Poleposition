<section class="flex flex-col justify-center items-center">
    <h1 class="title">Contáctanos</h1>
    <form method="POST" action="" class="formulario w-full max-w-4xl">
        <div class="grid sm:grid-cols-2 gap-3">
            <div class="campo">
                <label for="nombre" class="label">Nombre:</label>
                <input type="text" name="nombre" placeholder="Tu nombre" class="input w-full" required>
            </div>
            <div class="campo">
                <label for="apellido" class="label">Apellido:</label>
                <input type="text" name="apellido" placeholder="Tu apellido" class="input w-full" required>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-3">
            <div class="campo">
                <label for="email" class="label">Email:</label>
                <input type="email" name="email" placeholder="Tu e-mail" class="input w-full" required>
            </div>
            <div class="campo">
                <label for="telefono" class="label">Número de Teléfono:</label>
                <input type="number" name="telefono" placeholder="Tu teléfono" class="input w-full" required>
            </div>
        </div>

        <div class="campo">
            <label for="mensaje" class="label">Tu Mensaje:</label>
            <textarea rows="5" class="input w-full resize-none" placeholder="Tu mensaje"></textarea>
        </div>

        <input type="submit" name="submit" value="Enviar mensaje" class="submit w-full px-3">
    </form>
</section>
