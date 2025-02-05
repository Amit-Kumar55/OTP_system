<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @livewireStyles
</head>
<body>
    <div class="container">
        <!-- Yield content passed to the layout -->
        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>
