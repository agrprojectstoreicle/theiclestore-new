<?php
include("config.php");
include("functions.php");
?>
<?php include("header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron jumbotron-fluid">
         <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
<!-- Bootstrap Core CSS -->
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
            
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Page Content -->
<div align="center">
            <h2>Play Like a Legend & Rise Like a Star</h2>
            <p>Top games and Best gift cards</p>
    </div> 
    </header>

        <!-- Title -->
        
        <div class="row">
     
       <nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="right hide-on-med-and-down">
   
          <?php
          $query = query("SELECT * FROM category");
confirm($query);
          //$send_query = mysqli_query($connection , $query);
          while($row = mysqli_fetch_array($query))
          {
              
              $category_l = <<<DELIMETER
              
              <a href='category.php?id={$row['c_id']}' class='right hide-on-med-and-down'>{$row['c_title']}</a>
           
           DELIMETER;
              echo $category_l;
          }
 ?>
        </ul>
    </div>
  </nav>
     </div>
       
            <div class="col-lg-12">
                <h3 align="center" >Latest Products</h3>
            </div>
    
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

    <?php 

$query1 = query(" SELECT * FROM product WHERE p_category_id = " . escape_string($_GET['id']) . " ");
confirm($query1);

while($row = fetch_array($query1)) {

$p_image = display_image($row['p_image']);

$product = <<<DELIMETER


            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="img/{$p_image}" alt="">
                    <div class="caption">
                        <h3>{$row['p_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="cart.php?add={$row['p_id']}" class="btn btn-primary">Buy Now</a> <a href="product.php?id={$row['p_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

echo $product;


		}
 ?>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<?php include("footer.php") ?>
