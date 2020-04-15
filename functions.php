<?php 
// helper function

function redirect($location){

return header("Location: $location ");


}

function query($sql) {

global $connection;

return mysqli_query($connection, $sql);


}


function confirm($result){

global $connection;

if(!$result) {

die("QUERY FAILED " . mysqli_error($connection));


	}


}

function display_message() {

    if(isset($_SESSION['message'])) {

        echo $_SESSION['message'];
        unset($_SESSION['message']);

    }



}

function send_message() {

   
    if(isset($_POST['submit'])){ 

        $to          = $_POST['email'];
        $from_name   = $_POST['name'];
        $subject     = $_POST['subject'];
        $email = "khannamk131@gmail.com";
        $message = $_POST['message'];

        $headers = "From: {$from_name} {$email}";


        $result = mail($to, $subject, $message,$headers);

        if(!$result) {

            set_message("Sorry we could not send ur message");
        redirect("contact.php");
        } else {

            set_message("Your Message has been sent");
            redirect("contact.php");
        }




    }




}

function escape_string($string){

global $connection;

return mysqli_real_escape_string($connection, $string);


}



function fetch_array($result){

return mysqli_fetch_array($result);


}

function set_message($msg){

if(!empty($msg)) {

$_SESSION['message'] = $msg;

} 
    else
{
    
$msg = "";

    }

}

/**FRONT END FUNCTIONS**/


// get products 


function get_products() {


$query = query(" SELECT * FROM product");
confirm($query);

$rows = mysqli_num_rows($query); // Get total of mumber of rows from the database


if(isset($_GET['page'])){ //get page from URL if its there

    $page = preg_replace('#[^0-9]#', '', $_GET['page']);//filter everything but numbers



} else{// If the page url variable is not present force it to be number 1

    $page = 1;

}


$perPage = 6; // Items per page here 

$lastPage = ceil($rows / $perPage); // Get the value of the last page


// Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

if($page < 1){ // If it is less than 1

    $page = 1; // force if to be 1

}elseif($page > $lastPage){ // if it is greater than $lastpage

    $page = $lastPage; // force it to be $lastpage's value

}



$middleNumbers = ''; // Initialize this variable

// This creates the numbers to click in between the next and back buttons


$sub1 = $page - 1;
$sub2 = $page - 2;
$add1 = $page + 1;
$add2 = $page + 2;



if($page == 1){

      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

} elseif ($page == $lastPage) {
    
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

}elseif ($page > 2 && $page < ($lastPage -1)) {

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">' .$sub2. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';

      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

         $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">' .$add2. '</a></li>';

     


} elseif($page > 1 && $page < $lastPage){

     $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page= '.$sub1.'">' .$sub1. '</a></li>';

     $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';
 
     $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';


     


}


// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query


$limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;




// $query2 is what we will use to to display products with out $limit variable

$query2 = query(" SELECT * FROM product $limit");
confirm($query2);


$outputPagination = ""; // Initialize the pagination output variable


// if($lastPage != 1){

//    echo "Page $page of $lastPage";


// }


  // If we are not on page one we place the back link

if($page != 1){


    $prev  = $page - 1;

    $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Back</a></li>';
}

 // Lets append all our links to this variable that we can use this output pagination

$outputPagination .= $middleNumbers;


// If we are not on the very last page we the place the next link

if($page != $lastPage){


    $next = $page + 1;

    $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a></li>';

}


// Doen with pagination



while($row = fetch_array($query2)) {

$p_image = display_image($row['p_image']);

$product = <<<DELIMETER

<div class="col-sm-4 col-lg-4 col-md-4" >
    <div class="thumbnail"  >
        <a href="product.php?id={$row['p_id']}"><img style="height:auto" src="img/{$p_image}" alt=""></a>
        <p>{$row['p_description']}</p>
            
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['p_price']}</h4>
            <h5><a href="product.php?id={$row['p_id']}">{$row['p_title']}</a>
            </h5><a class="btn btn-primary" target="_blank" href="cart.php?add={$row['p_id']}">Add To Cart</a>
        </div>


       
    </div>
</div>


DELIMETER;

echo $product;


        }


       echo "<div style='clear:both' class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";


}


function display_image($picture) {

global $upload_directory;

return $upload_directory  . $picture;



}



function cart() 

{

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

  <img width='100' src='img/{$p_image}'>

  </td>
  <td>&#36;{$row['p_price']}</td>
  <td>{$value}</td>
  <td>&#36;{$sub}</td>
  <td>
  <a class="btn-floating btn-large waves-effect waves-light black" href="cart.php?remove={$row['p_id']}"><i class="material-icons">-</i></a>
  <a class="btn-floating btn-large waves-effect waves-light black" href="cart.php?add={$row['p_id']}"><i class="material-icons">+</i></a>
  <a class="btn-floating btn-large waves-effect waves-light black" href="cart.php?delete={$row['p_id']}"><i class="material-icons">x</i></a>
</td>
  </tr>

<input type="hidden" name="item_name_{$item_name}" value="{$row['p_title']}">
<input type="hidden" name="item_number_{$item_number}" value="{$row['p_id']}">
<input type="hidden" name="amount_{$amount}" value="{$row['p_price']}">
<input type="hidden" name="quantity_{$quantity}" value="$value">


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


function get_products_play_page() {


$query = query(" SELECT * FROM product");
confirm($query);

while($row = fetch_array($query)) {

$p_image = display_image($row['p_image']);

$product = <<<DELIMETER


            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail" style ="height:auto" >
                    <img style ="height:40%" src="img/{$p_image}" alt="" >
                    <p>{$row['desc']}</p>
                        
                    <div class="caption" style ="height:auto" >
                        <h4>{$row['p_title']}</h4>
                        <p>
                            <a href="cart.php?add={$row['p_id']}" class="btn btn-primary">Buy Now</a> <a href="product.php?id={$row['p_id']}" class="btn btn-default">More Details</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

echo $product;


        }


}



 ?>






