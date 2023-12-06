<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- ck editor  --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

      <!-- Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Admin</title>
</head>
<body>

    @include('admin.partials.header')


    <div class="main-wrapper d-flex">
        @include('admin.partials.sidebar')
        @yield('content')
    </div>






</body>
</html>
