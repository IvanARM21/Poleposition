<section class="flex flex-col justify-center items-center">
    <h1 class="title">Registro</h1>
    <form method="POST" action="" class="formulario">
        <div class="flex flex-col gap-3">
            <div class="campo">
                <label class="label">Nombre Completo:</label>
                <input type="text" name="NombreCompleto" placeholder="Tu nombre" class="input" >
            </div>
            <div class="campo">
                <label class="label">Correo Electrónico:</label>
                <input type="email" name="Correo" placeholder="Tu correo" class="input" >
            </div>  
            <div class="campo">
                <label class="label">Usuario:</label>
                <input type="text" name="Usuario" placeholder="Tu usuario" class="input" >
            </div>
            <div class="campo">
                <label class="label">Contraseña:</label>
                <input type="password" name="Contraseña" placeholder="Tu contraseña" class="input" >
            </div>

            
            <div class="campo">
                <label class="label">Repetir contraseña:</label>
                <input type="password" name="RepetirContraseña" placeholder="Repetir contraseña" class="input" >
            </div>

            <?php if (!empty($error)) : ?>
                <p class="text-red-600"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <input type="submit" name="submit" value="Registrarme" class="submit">
        </div>
    </form>
</section>
