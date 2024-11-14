<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Language" content="ru">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Система управления бизнесом.">
    <meta name="keywords" content="управление бизнесом, бизнес, система управления, CRM, расписание для бизнеса">
    <meta name="author" content="Коряков Максим Александрович">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="antialiased">
    @inertia
</body>

</html>
