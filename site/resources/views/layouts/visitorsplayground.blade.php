<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('/js/visitorcontroller.js') }}" defer></script>
    

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300&amp;display=swap" rel="stylesheet"> --}}
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;500;600;700;800;900&display=swap" rel="stylesheet"> --}}
{{-- <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;800;900&display=swap" rel="stylesheet"> --}}
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
   

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/vs2015.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/night-owl.min.css"> 

    {{-- <script src="{!! mix('js/test.js') !!}"></script> --}}
   

    <style>
        body{
            /* font-family: 'Jost', sans-serif; */
            /* font-family: 'Montserrat', sans-serif; */
            font-family: 'Poppins', sans-serif;
        }
        "@media print {
            .code-badge { display: none; }
        }
        .code-badge-pre {
            position: relative; 
        }
        .code-badge {
            display: flex;
            flex-direction: row;
            white-space: normal;
            background: transparent;
            background: #333;
            color: white;
            font-size: 0.8em;
            opacity: 0.5;
            border-radius: 0 0 0 7px;
            padding: 5px 8px 5px 8px;
            position: absolute;
            right: 0;
            top: 0;
        }
        .code-badge.active {
            opacity: 0.8;
        }
        .code-badge:hover {
            opacity: .95;
        }
        .code-badge a,
        .code-badge a:hover {
            text-decoration: none;
        }
    
        .code-badge-language {
            margin-right: 10px;
            font-weight: 600;
            color: goldenrod;
        }
        .code-badge-copy-icon {
            font-size: 1.2em;
            cursor: pointer;
            padding: 0 7px;
            margin-top:2;
        }
        .fa.text-success:{ color: limegreen !important}    
    </style>

    <script>
        const copyText = (e) => {
    const text = document.getElementById(e).innerText;

    navigator.clipboard.writeText(text).then(
          () => {
            console.log('Text copied successfully')
          },
          () => {
            console.log('Error writing to the clipboard');
          }
        );
}
    </script>
</head>
<body>
    <div id="app">
     

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    

    <footer style="padding-top: 400px; " class="text-center pb-4">
        
        Plaease share your valuable suggations.
        <br><br>
        Designed and developed by <br>
        <a href="http://toaplex.com/public/">ToaPlex LLP</a>

        
        <br><br>
         © 2021 GetCRUD | <a href="contact">Contact</a> 

     


    </footer>


    
   
</body>
</html>
