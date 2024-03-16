<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Puls</title>
    <!-- fave icon -->
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    @vite('resources/css/app.css')
</head>
<body class="font-inter antialiased bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400">
  <div id="app"></div>
  @vite('resources/js/app.js')
  <script>
    
    window.user = @json(auth()->user());
    
    window.user_roles = @json(auth()->user()->roles);
    window.access_token = @json(session('access_token'));

    window.Laravel = {
        csrfToken: "{{ csrf_token() }}",
        jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():0 !!}
    }
  </script>
</body>
</html>