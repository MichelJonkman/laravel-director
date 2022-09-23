<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
{{--    <script src="{{ Vite::useHotFile(public_path('director.hot'))->asset('resources/js/app.ts', 'director/director') }}" type="module" defer></script>--}}
    {{ Vite::useHotFile(public_path('director.hot'))('resources/js/app.ts', 'director/director') }}
    @inertiaHead
</head>
<body>
@inertia
</body>
</html>
