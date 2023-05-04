<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Director</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    {{ Vite::useHotFileFor(Director::getBuildHotFile(), fn($vite) => $vite('resources/package/js/app.ts', 'director/director')) }}
    @inertiaHead
</head>
<body>
@inertia
@routes
</body>
</html>
