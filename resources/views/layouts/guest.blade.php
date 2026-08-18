<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" :class="{ 'dark': darkMode }">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ $title ?? 'Bites Restaurant' }}
    </title>


    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="
min-h-screen
bg-[#faf8f5]
dark:bg-gray-950
flex
items-center
justify-center
transition
duration-300
">


    <div class="absolute inset-0 overflow-hidden pointer-events-none">


        <div class="
    absolute
    -top-40
    -right-40
    w-96
    h-96
    bg-amber-400/20
    rounded-full
    blur-3xl
    ">
        </div>


        <div class="
    absolute
    -bottom-40
    -left-40
    w-96
    h-96
    bg-orange-400/20
    rounded-full
    blur-3xl
    ">
        </div>


    </div>



    <div class="
relative
w-full
max-w-md
px-6
">


        <!-- Logo -->

        <div class="flex justify-center mb-8">


            <a href="{{ route('menu.index') }}" class="flex items-center gap-3">


                <div class="
            w-14
            h-14
            rounded-full
            bg-amber-400
            flex
            items-center
            justify-center
            shadow-lg
            shadow-amber-400/30
            ">

                    <span class="text-3xl">
                        🍴
                    </span>

                </div>


                <span class="
            text-3xl
            font-black
            text-gray-900
            dark:text-white
            ">
                    Bites
                </span>


            </a>


        </div>




        <!-- Card -->

        <div class="
    bg-white
    dark:bg-gray-900

    border
    border-gray-200
    dark:border-gray-800

    rounded-3xl

    shadow-xl
    shadow-gray-200/40
    dark:shadow-black/30

    p-8

    transition
    ">


            {{ $slot }}


        </div>



        <p class="
    text-center
    text-sm
    text-gray-500
    dark:text-gray-400
    mt-6
    ">

            © {{ date('Y') }} Bites Restaurant

        </p>


    </div>



</body>

</html>