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
    </header>

   
<?php 

      
      
      
      

  if(isset($_GET['add'])) {


    $query = query("SELECT * FROM product WHERE p_id=" . escape_string($_GET['add']). " ");
    confirm($query);

    while($row = fetch_array($query)) {
      if($row['p_quantity'] != $_SESSION['product_' . $_GET['add']]) {

        $_SESSION['product_' . $_GET['add']]+=1;
        redirect("../public/check.php");


      } else {


        set_message("We only have " . $row['p_quantity'] . " " . "{$row['p_title']}" . " available");
        redirect("../public/check.php");



      }






    }



  // $_SESSION['product_' . $_GET['add']] +=1;

  // redirect("index.php");


  }

      
      
      

  if(isset($_GET['remove'])) {

    $_SESSION['product_' . $_GET['remove']]--;

    if($_SESSION['product_' . $_GET['remove']] < 1) {

      unset($_SESSION['item_total']);
      unset($_SESSION['item_quantity']);
      redirect("../public/check.php");

    } else {

      redirect("../public/check.php");

     }


  }


 if(isset($_GET['delete'])) { 

  $_SESSION['product_' . $_GET['delete']] = '0';
  unset($_SESSION['item_total']);
  unset($_SESSION['item_quantity']);

  redirect("../public/check.php");


 }
      
function cart() {


//
//    foreach ($_SESSION as $name => $value) {
//
//        echo "<pre>";
//
//       var_dump($_SESSION);
//
//        echo "</pre>";
//
//
//    }




$total = 0;
$item_quantity = 0;
$item_name = 1;
$item_number =1;
$amount = 1;
$quantity =1;
foreach ($_SESSION as $name => $value) {





if($value > 0 ) {

if(substr($name, 0, 8 ) == "product_") {


$length = strlen($name);

$id = substr($name, 8 , $length);


$query = query("SELECT * FROM product WHERE p_id = " . escape_string($id). " ");
confirm($query);

while($row = fetch_array($query)) {

$sub = $row['p_price']*$value;
$item_quantity +=$value;

$p_image = display_image($row['p_image']);

$product = <<<DELIMETER

<tr>
  <td>{$row['p_title']}<br>

  <img width='100' src='../resources/{$p_image}'>

  </td>
  <td>&#36;{$row['p_price']}</td>
  <td>{$value}</td>
  <td>&#36;{$sub}</td>
  <td><a class='btn btn-warning' href="cart.php?remove={$row['p_id']}"><span class='glyphicon glyphicon-minus'></span></a>   <a class='btn btn-success' href="cart.php?add={$row['p_id']}"><span class='glyphicon glyphicon-plus'></span></a>
<a class='btn btn-danger' href="cart.php?delete={$row['p_id']}"><span class='glyphicon glyphicon-remove'></span></a></td>
  </tr>

<input type="hidden" name="p_title[]" value="{$row['p_title']}">
<input type="hidden" name="p_id[]" value="{$row['p_id']}">
<input type="hidden" name="p_price[]" value="{$row['p_price']}">
<input type="hidden" name="p_quantity[]" value="$value">


DELIMETER;

echo $product;

$item_name++;
$item_number++;
$amount++;
$quantity++;



    $_SESSION['item_total'] = $total += $sub;
    $_SESSION['item_quantity'] = $item_quantity;



}




           }

      }

    }



}




  
 ?>    
<?php include("footer.php") ?>
