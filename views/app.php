<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title> <!-- variable para el titulo de la pagina -->
    <link rel="stylesheet" href="../css/output.css"> <!-- linkeo de tailwind css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&display=swap" rel="stylesheet">
    <script type="module" src="/js/app.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="icon" type="image" href="../img/logo.png">
</head>

<body class="flex flex-col min-h-screen">

    <?php
    $isLogged = isset($_COOKIE['usuario']) && !empty($_COOKIE['usuario']);
    $isAdmin = false;

    if ($isLogged) {
        $userData = json_decode($_COOKIE['usuario'], true);
        if (isset($userData["admin"]) && $userData["admin"]) {
            $isAdmin = true;
        }
    }
    ?>
    <!-- intento de nav bar -->
    <header class="border-b bg-white h-20 w-full z-20">
        <div class="max-w-screen-xl mx-auto px-4 w-full">
            <nav class="flex justify-between lg:grid lg:grid-cols-3">
                <!-- logo -->
                <a href="/">
                    <img src="/img/logo.svg" class=" h-20 w-auto">
                </a>

                <button type="button" class="block cursor-pointer lg:hidden" id="menuBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-8 text-gray-700">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- cosos -->
                <div class="hidden lg:flex justify-center items-center gap-5 text-red-600 font-semibold text-lg">
                    <a class="link" href="/">Inicio</a>
                    <a class="link" href="/catalogo">Catalogo</a>
                    <a class="link" href="/contacto">Contacto</a>
                    <a class="link" href="/sobre-nosotros">Sobre Nosotros</a>
                </div>

                <!-- auth -->
                <div class="hidden lg:flex gap-5 justify-end items-center  text-red-600 font-semibold text-lg">
                    <?php if ($isLogged): ?>
                        <a class="link" href="/perfil">Perfil</a>
                        <?php if ($isAdmin): ?>
                            <a class="link" href="/dashboard">Dashboard</a>
                        <?php endif; ?>
                        <a class="link" href="/logout">Cerrar Sesión</a>
                    <?php else: ?>
                        <a href="/login" class="link">Iniciar Sesión</a>
                        <a href="/register" class="link">Registrarse</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <aside id="menu-mobile"
        class=" bg-white w-[calc(100%-20px)] max-w-[400px] h-full max-h-screen fixed z-30 flex flex-col justify-between px-4 top-0 right-0 gap-2 transform transition-all duration-300 lg:hidden menu-inactivo ">
        <button id="btnClose" type="button" class="fixed top-3 right-3 size-8">
            <svg class="fixed top-3 right-3 size-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <nav class="flex flex-col gap-4 mt-20">
            <a href="/" class="text-gray-500 text-sm">Inicio</a>
            <a href="/catalogo" class="text-gray-500 text-sm">Cátalogo</a>
            <a href="/contacto" class="text-gray-500 text-sm">Contacto</a>
            <a href="/sobre-nosotros" class="text-gray-500 text-sm">Sobre Nosotros</a>
        </nav>

        <nav class="flex flex-col gap-4 py-8 border-t">
            <?php if ($isLogged): ?>
                <a class="text-gray-500 text-sm" href="/perfil">Perfil</a>
                <?php if ($isAdmin): ?>
                    <a class="text-gray-500 text-sm" href="/dashboard">Dashboard</a>
                <?php endif; ?>
                <a class="text-gray-500 text-sm" href="/logout">Cerrar Sesión</a>
            <?php else: ?>
                <a href="/login" class="text-gray-500 text-sm">Iniciar Sesión</a>
                <a href="/registro" class="text-gray-500 text-sm">Registro</a>
            <?php endif; ?>
        </nav>

    </aside>

    <div id="bgMenu"
        class="fixed bg-black bg-opacity-50 backdrop-blur-sm inset-0 z-20 transition-all duration-300 lg:hidden bg-black-inactivo">
    </div>

    <?php if ($_SERVER['REQUEST_URI'] === "/"): ?>
        <div class="fixed-text">
            <h1
                class="text-white font-black leading-10 text-[40px] min-[400px]:text-5xl sm:text-6xl lg:text-7xl select-none">
                <span class="block">¡Encuentra tu vehiculo en </span><span class="text-red-600 block">Pole-Position
                    Motors!</span>
            </h1>
            <a name="catalogo"
                class="uppercase mt-6 mx-auto sm:mx-0 w-fit block py-3 px-8 text-xl text-white bg-red-600 hover:bg-red-700 rounded-3xl font-extrabold transition-colors duration-300"
                href="./catalogo">
                Catálogo
            </a>
        </div>
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide-1 slide-item img-1">

                </div>
                <div class="swiper-slide slide-2 slide-item img-2">

                </div>
                <div class="swiper-slide slide-3 slide-item img-3">

                </div>
                <div class="swiper-slide slide-4 slide-item img-4">

                </div>
                <div class="swiper-slide slide-5 slide-item img-5">

                </div>
            </div>
            <div class="swiper-pagination">a</div>
        </div>


    <?php endif; ?>


    <?php if ($_SERVER['REQUEST_URI'] === "/sobre-nosotros"): ?>
        <div class="fixed-text">
            <h1
                class="text-white font-black leading-10 text-[40px] min-[400px]:text-5xl sm:text-6xl lg:text-7xl select-none">
                <span class="block">¡Conoce mas sobre </span><span class="text-red-600 block">Pole-Position
                    Motors!</span>
            </h1>

        </div>

        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide-1 slide-item img-1-sobrenosotros">
                </div>
                <div class="swiper-slide slide-2 slide-item img-2-sobrenosotros">

                </div>
                <div class="swiper-slide slide-3 slide-item img-3-sobrenosotros">

                </div>
                <div class="swiper-slide slide-4 slide-item img-4-sobrenosotros">

                </div>
                <div class="swiper-slide slide-5 slide-item img-5-sobrenosotros">

                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    <?php endif; ?>


    <!-- child para generar las paginas -->
    <main class="container-page flex-1 mt-10 mb-20">
        <?= $child ?>
    </main>



    <!-- Contenido de la página -->
    <footer class="bg-gray-100 w-full mt-32">
        <div class="mx-auto max-w-screen-xl w-full px-4  py-10">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 pb-10">
                <div class="sm:col-span-2 md:col-span-3 lg:col-span-2">
                    <img src="../img/logo-text.svg" class="size-20" alt="">
                </div>

                <div>
                    <h2 class="font-semibold text-gray-800 text-xl">Navegación</h2>

                    <ul class="mt-4 flex flex-col gap-4 text-gray-600 font-medium">
                        <li>
                            <a href="/">Inicio</a>
                        </li>
                        <li>
                            <a href="/catalogo">Cátalogo</a>
                        </li>
                        <li>
                            <a href="/contacto">Contacto</a>
                        </li>
                        <li>
                            <a href="/sobre-nosotros">Sobre Nosotros</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-800 text-xl">Encuéntranos</h2>

                    <ul class="mt-4 flex flex-col gap-4 text-gray-600 font-medium">
                        <li>Avda Italia 948, Montevideo Uruguay</li>
                        <li class="flex flex-col gap-1">
                            <p>Lunes a Viernes de 8.30 a 12.30 y de 14.00 a 18.30</p>
                            <p>Sábado de 8.30 a 12:30</p>
                        </li>
                        <li><span class="text-gray-800">Télefono:</span> (+598) 91 014 226</li>
                        <li><span class="text-gray-800">Email:</span> contacto@poleposition.com</li>
                    </ul>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-800 text-xl">Legal</h2>

                    <ul class="mt-4 flex flex-col gap-4 text-gray-600 font-medium">
                        <li>Política de Privacidad</li>
                        <li>Términos & Condiciones</li>
                        <li>Aviso Legal</li>
                        <li>Política de Cookies</li>
                    </ul>
                </div>
            </div>

            <div class="border-t w-full pt-10 flex flex-col-reverse gap-5 md:flex-row justify-between items-center">
                <p class="text-lg font-medium text-gray-600 text-balance text-center">© 2024 Pole-Position. Todos los
                    derechos
                    reservados.</p>

                <div class="flex gap-5">
                    <a href="https://www.instagram.com/ivanrm021" target="_blank"
                        class="text-lg text-gray-600 font-medium">Facebook</a>
                    <a href="https://www.instagram.com/bbruuuuno" target="_blank"
                        class="text-lg text-gray-600 font-medium">Instagram</a>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>