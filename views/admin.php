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
    <script type="module" src="/js/dashboard/index.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="icon" type="image" href="../img/logo.png">
</head>

<body>
    <aside class="hidden fixed top-0 left-0 bg-gray-200 w-80 min-h-full py-5 px-2 lg:flex flex-col justify-between shadow">
        
        <nav class="flex flex-col gap-2">
            <a href="/">
                <img src="../img/logo.png" class="w-20 px-4 mb-5" alt="">
            </a>
            <a href="" class="flex gap-2 items-center text-gray-600 hover:bg-gray-300 py-2 px-4 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <p class="font-medium text-sm">Productos</p>    
            </a>
            <a href="" class="flex gap-2 items-center text-gray-600 hover:bg-gray-300 py-2 px-4 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>

                <p class="font-medium text-sm">Usuarios</p>    
            </a>
            <a href="" class="flex gap-2 items-center text-gray-600 hover:bg-gray-300 py-2 px-4 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                </svg>
                <p class="font-medium text-sm">Testimonios</p>   
            </a>
        </nav>

        <div class="flex flex-col gap-2 border-t pt-5">
            <a href="" class="flex gap-2 items-center text-gray-600 hover:bg-gray-200 py-2 px-4 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
                </svg>

                <p class="font-medium text-sm">Cerrar Sesión</p>
            </a>
        </div>
    </aside>

    <header class=" w-[calc(100%-320px) lg:ml-80 grid grid-cols-3 gap-5 px-4 md:px-16 py-2">
        <div class="col-span-2">
            <input 
                type="text"
                placeholder="Buscar..."
                class="w-full bg-gray-200 rounded-xl py-2 px-4"
            >
        </div>
        <div class="flex items-center text-gray-500 justify-end">
            <?php echo json_decode($_COOKIE["usuario"])->nombreCompleto ?? "" ?>
        </div>
    </header>

    <main class="lg:ml-80 px-4 md:px-20 mt-10">
        <?= $child ?>
    </main>

    <script type="module" src="/js/dashboard/index.js"></script>
        
</body>