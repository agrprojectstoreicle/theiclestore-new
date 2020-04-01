
<?php include("header.php");
include("config.php");
include("functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ICLE</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Page Content -->

<!-- Page Content -->
</head>
    <body>
    <div class="container">

      <header>
            <h1 class="text-center">PLAY & WIN </h1>
            <h2 class="text-center bg-warning">

</h2>
    </header>
<div class="container">

        <!-- Jumbotron Header -->

        <hr>

        <!-- /.row -->
        <div class="row text-center">

    <?php get_products_play_page(); 
?>
        </div>
    </div>

        </div>

<?php    
include("footer.php");

?>
    
        <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>









