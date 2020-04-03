<?php
include("config.php");
include("functions.php");
include("header.php");
?>

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
      



  
function show_paypal() {


if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {


$paypal_button = <<<DELIMETER


 <input type="image" name="submit" border="0"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">

DELIMETER;

return $paypal_button;

  }


}



function process_transaction() {



    if(isset($_GET['tx'])) {

        $amount = $_GET['amt'];
        $currency = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];
        $total = 0;
        $item_quantity = 0;

        foreach ($_SESSION as $name => $value) {

            if($value > 0 ) {

                if(substr($name, 0, 8 ) == "product_") {

                    $length = strlen($name - 8);
                    $id = substr($name, 8 , $length);


                    $send_order = query("INSERT INTO order (o_amount, o_transaction, o_currency, o_status ) VALUES('{$amount}', '{$transaction}','{$currency}','{$status}')");
                    $last_id =last_id();
                    confirm($send_order);

                    $query = query("SELECT * FROM product WHERE p_id = " . escape_string($id). " ");
                    confirm($query);

                    while($row = fetch_array($query)) {
                        $product_price = $row['p_price'];
                        $product_title = $row['p_title'];
                        $sub = $row['p_price']*$value;
                        $item_quantity +=$value;


        /*                $insert_report = query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity) VALUES('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
                        confirm($insert_report);


*/


                    }


                    $total += $sub;
                    echo $item_quantity;


                }

            }

        }

        session_destroy();
    } else {


        redirect("index.php");


    }



}


?>    
<?php include("footer.php") ?>
