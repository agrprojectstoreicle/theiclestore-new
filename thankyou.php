<?php
include("config.php");
include("functions.php");?>
<?php include("header.php");
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
    
        <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
          

            
<?php function process_transaction() {



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


    <!-- Page Content -->
    <div class="container">

<h1 class="text-center">Thanks for Placing the Order.</h1>

    </div>
    <!-- /.container -->

<?php include("footer.php") ?>
