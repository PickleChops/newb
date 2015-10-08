<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Boyd Stratton Home Page">
    <meta name="author" content="Boyd Stratton">
    <link rel="icon" href="../../favicon.ico">

    <title>Boyd Stratton Home page</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <link href="./vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">

    <script src="./vendor/jquery/dist/jquery.js"></script>
    <script src="./vendor/velocity/velocity.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>


<body>

<!-- Begin page content -->
<div class="container">
    <div class="page-header">
        <h1>Trending Tags</h1>
    </div>

    <svg>
        <rect class="rect" width="25" height="25"" x="10%" y="10%" fill="gray" stroke="rgba(80, 80, 80, 1)" stroke-width="8px" />
        <rect class="rect" width="25" height="25"" x="30%" y="10%" fill="gray" stroke="rgba(80, 80, 80, 1)" stroke-width="0px" />
    </svg>

</div>

<footer class="footer">
    <p>&copy; 2015 - Boyd Stratton</p>
    <script>

        // Animate an SVG element with a mix of standard CSS properties and SVG-specific properties.
        $(".rect")
            .delay(500)
            .velocity({ x: "+=200", y: "25%" })
            .velocity({ fillGreen: 255, strokeWidth: 2 })
            .velocity({ height: 50, width: 50 })
            .velocity({ rotateZ: 90, scaleX: 0.5 })
            .velocity("reverse", { delay: 250 });

    </script>
</footer>
</body>
</html>