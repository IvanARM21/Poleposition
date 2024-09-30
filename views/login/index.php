<section class="flex flex-col justify-center items-center">
    <h1 class="title">Iniciar Sesión</h1>
    <form method="POST" action="" class="formulario">

        <div class="flex flex-col gap-3 mt-5">

            <div class="campo">
                <label for="usuario" class="label">Usuario:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Tu usuario" class="input">
            </div>
            <div class="campo">
                <label for="contraseña" class="label">Contraseña:</label>
                <input type="password" name="contraseña" placeholder="Tu contraseña" class="input">
            </div>

            <?php if (!empty($error)) : ?>
                <p class="text-red-600"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <input type="submit" name="submit" value="Iniciar Sesión" name="iniciarSesion" class="submit">
        </div>
    </form>

</section>