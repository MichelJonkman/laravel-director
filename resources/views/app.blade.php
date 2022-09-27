<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    {{ Vite::useHotFile(public_path('director.hot'))('resources/js/app.ts', 'director/director') }}
    @inertiaHead
</head>
<body{{-- data-test="{{ Vite::useHotFile(public_path('null'))->asset('resources/js/Icons/house-fill2.svg', 'director/director') }}"--}}>
@inertia
</body>
</html>
