<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF=8">
        <title>Document</title>
        <link href = "//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel = "stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


        @yield('header')

        

	</script>
    </head>

    <body>
    	<div class="container">
        @yield('content')
    </div>

        @yield('footer')
        @yield('script')

    </body>
</html>
