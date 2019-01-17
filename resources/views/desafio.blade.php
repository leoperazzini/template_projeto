 <html>
    <head>
        <title></title>

          @include('dependencias')
    
    </head>

    <body> 

          @yield('active')

          @include('menu')
  
          <br><br><br><br>

          <center><h3>@yield('title')</h3></center>
 
          <hr>

            <div class="container-fluid">

                 @yield('content') 
            </div> 
            
            @yield('script-js')

    </body>
 </html>
    
</head>
<body>
 