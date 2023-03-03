<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
  </style>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
            bg : '#FAFAFC'
          }
        },
        fontFamily : {
         
            'mont' : ['Montserrat']
        }
      }
    }



  </script>
</head>
<body>


  <div>
    @yield('login')
    @yield('register')
  </div>

<script src="{{ asset('js/.js') }}"></script>
</body>
</html>