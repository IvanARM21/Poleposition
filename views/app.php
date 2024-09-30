<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title> <!-- variable para el titulo de la pagina -->
    <link rel="stylesheet" href="../css/output.css"> <!-- linkeo de tailwind css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
    <header class="border-b bg-white fixed inset-x-0 h-20 w-full z-20">
        <nav class="container-page flex justify-between lg:grid lg:grid-cols-3">
            <!-- logo -->
            <a href="/" class="w-20 h-20">
                <img src="/img/logo.png" class="w-full">
            </a>

            <button type="button" class="block lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-10">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- cosos -->
            <div class="hidden lg:flex justify-center items-center gap-5 text-red-600 font-semibold ">
                <a class="link" href="/">Inicio</a>
                <a class="link" href="/catalogo">Catalogo</a>
                <a class="link" href="/contacto">Contacto</a>
               <!-- <a class="link" href="/sobrenosotros">Sobre Nosotros</a> -->
            </div>

            <!-- auth -->
            <div class="hidden lg:flex gap-5 justify-end items-center  text-red-600 font-semibold">
                <?php if ($isLogged): ?>
                    <a class="link" href="/perfil">Perfil</a>
                    <a class="link" href="/logout">Cerrar Sesión</a>
                    <?php if ($isAdmin): ?>
                        <a class="link" href="/dashboard">Dashboard</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="/login" class="link">Iniciar Sesión</a>
                    <a href="/register" class="link">Registrarse</a>
                <?php endif; ?>


            </div>
        </nav>
    </header>

    <?php if ($_SERVER['REQUEST_URI'] === "/"): ?>
        <div class="fixed-text">
            <h1
                class="text-white font-black leading-10 text-[40px] min-[400px]:text-5xl sm:text-6xl lg:text-7xl select-none">
                <span class="block">¡Encuentra tu vehiculo en </span><span class="text-red-600 block">Pole-Position
                    Motors!</span></h1>
            <a name="catalogo"
                class="uppercase mt-6 mx-auto sm:mx-0 w-fit block py-3 px-8 text-xl text-white bg-red-600 hover:bg-red-700 rounded-3xl font-extrabold transition-colors duration-300"
                href="./catalogo">
                Cátalogo
            </a>
        </div>
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide-1 slide-item img-1">
                    <div class="text-container">
                        <h5 class="slider-title"></h5>
                    </div>
                </div>
                <div class="swiper-slide slide-2 slide-item img-2">
                    <div class="text-container">
                        <h5 class="slider-title"></h5>
                    </div>
                </div>
                <div class="swiper-slide slide-3 slide-item img-3">
                    <div class="text-container">
                        <h5 class="slider-title"></h5>
                    </div>
                </div>
                <div class="swiper-slide slide-4 slide-item img-4">
                    <div class="text-container">
                        <h5 class="slider-title"></h5>
                    </div>
                </div>
                <div class="swiper-slide slide-5 slide-item img-5">
                    <div class="text-container">
                        <h5 class="slider-title"></h5>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination">a</div>
        </div>
    <?php endif; ?>


    <div class="h-20 "></div>

    <!-- child para generar las paginas -->
    <main class="container-page flex-1 my-10">
        <?= $child ?>
    </main>

    

    <!-- Contenido de la página -->
    <footer class="border-t">
        <div
            class="container-page flex justify-between flex-col-reverse gap-5 md:flex-row items-center md:h-20 py-4 px-2">
            <p class="text-gray-500 text-xl flex flex-wrap gap-2 justify-center">
                <span>&copy; 2024 Pole-Position Motors </span> <span> All Rights Reserved.</span>
            </p>
            <div class="flex gap-5">
                <a href="https://www.instagram.com/ivanrm021/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icono" width="40" height="40" viewBox="0 0 24 24"
                        style="transform: ;msFilter:;">
                        <path
                            d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z">
                        </path>
                        <circle cx="16.806" cy="7.207" r="1.078"></circle>
                        <path
                            d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z">
                        </path>
                    </svg>
                </a>
                <a href="https://www.instagram.com/ivanrm021/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icono" width="24" height="24" viewBox="0 0 24 24"
                        style="transform: ;msFilter:;">
                        <path
                            d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z">
                        </path>
                    </svg>
                </a>
                <a href="https://www.instagram.com/ivanrm021/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icono" width="24" height="24" viewBox="0 0 24 24"
                        style="transform: ;msFilter:;">
                        <path
                            d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </footer>
</body>

</html>