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
    <div class="container">


<!-- /.row --> 

<div class="row">
      <h4 class="text-center bg-dark"><?php display_message(); ?></h4>
      <h1>Checkout</h1>

<form action="" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="edwindiaz123-facilitator@gmail.com">
<input type="hidden" name="currency_code" value="US">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>


          <?php cart(); ?>
 


        </tbody>
    </table>


    <input type="submit" name="submit">

</form>


 
<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Total</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php 
echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">&#36;<?php 
echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";?>



</span></strong> </td>
</tr>



</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


    </div>
    <!-- /.container -->

   

        
    
<?php include("footer.php") ?>
