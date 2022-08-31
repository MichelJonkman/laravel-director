<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <script src="{{ Vite::useHotFile(public_path('director.hot'))->asset('resources/js/app.ts', 'vendor/director/build') }}" type="module" defer></script>
    @inertiaHead
</head>
<body data-test="{{ Vite::asset('resources/js/Fieldtypes/Text.vue') }}">
@inertia
</body>
</html>
