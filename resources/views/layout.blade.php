<!DOCTYPE html>
<html lang="en">

<head>
    @section('head')
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title') - SkillPath</title>

        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/main.css">
        <!-- Добавляем стили из CDN -->
        <link rel="stylesheet" type="text/css" href="/slick/slick.css" />
        <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css" />
        <style>
            .card-item.admin {
                position: relative;
                height: fit-content;
            }

            .card-item.admin a {
                z-index: 0;
                position: relative;
            }

            .card-item.admin form {
                position: absolute;
                top: 10px;
                right: 10px;
                z-index: 1;
            }
        </style>
    </head>

    <body>
        <x-header></x-header>
        <main class="main">
            @yield('page-content')
        </main>
        <x-footer></x-footer>
    </body>


    </html>
