<?php
include("config.php");
include("functions.php");

?>

<?php include("header.php") ?>

<?php 

if(isset($_GET['add'])) {

    $query = query("SELECT * FROM product WHERE p_id=" . escape_string($_GET['add']). " ");
    confirm($query);

    while($row = fetch_array($query)) {


      if($row['p_quantity'] != $_SESSION['product_' . $_GET['add']]) {

        $_SESSION['product_' . $_GET['add']]+=1;
        redirect("checkout.php");


      } else {


        set_message("We only have " . $row['p_quantity'] . " " . "{$row['p_title']}" . " available");
        redirect("checkout.php");



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
      redirect("checkout.php");

    } else {

      redirect("checkout.php");

     }


  }


 if(isset($_GET['delete'])) { 

  $_SESSION['product_' . $_GET['delete']] = '0';
  unset($_SESSION['item_total']);
  unset($_SESSION['item_quantity']);

  redirect("checkout.php");


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


function show_paypal() {


if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {


$paypal_button = <<<DELIMETER

    <input type="image" name="upload" border="0"
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


                    $send_order = query("INSERT INTO orders (order_amount, order_transaction, order_currency, order_status ) VALUES('{$amount}', '{$transaction}','{$currency}','{$status}')");
                    $last_id =last_id();
                    confirm($send_order);



                    $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
                    confirm($query);

                    while($row = fetch_array($query)) {
                        $product_price = $row['product_price'];
                        $product_title = $row['product_title'];
                        $sub = $row['product_price']*$value;
                        $item_quantity +=$value;


                        $insert_report = query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity) VALUES('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
                        confirm($insert_report);





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