<?php
include('./includes/connect.php');

//getting products 
function getproducts(){
    global $con; // Use the global keyword to access the $con variable defined in connect.php
    $select_query="SELECT * FROM `products`";
    $result_query=mysqli_query($con,$select_query);
    while ($row=mysqli_fetch_assoc($result_query)) {
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        echo " <div class='col-4 mb-2'>
        <div class='card'>
          <div class='card-body text-center p-2'>
          <img class='card-img-top' src='./img/$product_image1' alt='Card image cap'>
            <h6 class='card-title mb-2 mt-2 text-muted'>$product_title</h6>
            <h6 class='card-subtitle'>$product_description</h6>
            <p class='card-text'>$product_price</p>
          <a href='produse.php?add_to_cart=$product_id' class='btn btn-primary mb-2'>Cumpara</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-primary mb-2'>Detalii produs</a>
          </div>
        </div>
        </div>";
    }
}

//categori
function get_unique_categories(){
  global $con; 
  if(isset($_GET['category'])){
$category_id=$_GET['category'];
$select_query = "SELECT * FROM `products` WHERE category_id = $category_id";
  $result_query=mysqli_query($con,$select_query);
  $num_of_rows=mysqli_num_rows($result_query);
  if($num_of_rows==0){
    echo "<h2 class='text-center text-danger'> No Stock</h2>";
  }
  while ($row=mysqli_fetch_assoc($result_query)) {
      $product_id=$row['product_id'];
      $product_title=$row['product_title'];
      $product_description=$row['product_description'];
      $product_image1=$row['product_image1'];
      $product_price=$row['product_price'];
      $category_id=$row['category_id'];
      echo " <div class='col-4 mb-2'>
      <div class='card'>
        <div class='card-body text-center p-2'>
        <img class='card-img-top' src='./img/$product_image1' alt='Card image cap'>
          <h6 class='card-title mb-2 mt-2 text-muted'>$product_title</h6>
          <h6 class='card-subtitle'>$product_description</h6>
          <p class='card-text'>$product_price</p>
          <a href='produse.php?add_to_cart=$product_id' class='btn btn-primary mb-2'>Cumpara</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-primary mb-2'>vezi mai multe</a>
        </div>
      </div>
      </div>";
  }
  
}
}
//view details
function view_details(){
  global $con; // Use the global keyword to access the $con variable defined in connect.php
  if(isset($_GET['product_id'])){
    if(!isset($_GET['category'])){
      $product_id =$_GET['product_id'];
      $select_query = "SELECT * FROM `products` WHERE product_id = '$product_id'";
  $result_query=mysqli_query($con,$select_query);
  if (!$result_query) {
    die('MySQL Error: ' . mysqli_error($con));
}
  while ($row=mysqli_fetch_assoc($result_query)) {
      $product_id=$row['product_id'];
      $product_title=$row['product_title'];
      $product_description=$row['product_description'];
      $product_image1=$row['product_image1'];
      $product_image2=$row['product_image2'];
      $product_image3=$row['product_image3'];
      $product_price=$row['product_price'];
      $category_id=$row['category_id'];
      echo 
    "<div class='container pt-2 pb-2'>
      <div class='row'>
      <div class='col-md-6 d-flex justify-content-center align-items-center'>
      <div id='product-carousel' class='carousel slide' data-ride='carousel'>
        <div class='carousel-inner'>
          <div class='carousel-item active'>
            <img src='./img/$product_image1' class='d-block w-100 h-80' alt='product_image1'>
          </div>
          <div class='carousel-item'>
            <img src='./img/$product_image2' class='d-block w-100 h-80' alt='product_image2'>
          </div>
          <div class='carousel-item'>
            <img src='./img/$product_image3' class='d-block w-100 h-80' alt='product_image3'>
          </div>
        </div>
        <a class='carousel-control-prev text-dark' href='#product-carousel' role='button' data-slide='prev'>
          <span class='carousel-control-prev-icon bg-dark' aria-hidden='true'></span>
          <span class='sr-only'>Previous</span>
        </a>
        <a class='carousel-control-next text-dark' href='#product-carousel' role='button' data-slide='next'>
          <span class='carousel-control-next-icon bg-dark' aria-hidden='true'></span>
          <span class='sr-only'>Next</span>
        </a>
      </div>
    </div>
        <div class='col-md-6'>
          <h1>$product_title </h2>
          <p> $product_description </p>
          <p>Price: $$product_price </p>
        </div>
      </div>
    </div>";
    


    
};
  }
}


}


function getIPAddress() {  
  //whether ip is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
              $ip = $_SERVER['HTTP_CLIENT_IP'];  
      }  
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether ip is from the remote address  
  else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
   }  
   return $ip;  
}  
/*
$ip = getIPAddress();  
echo 'User Real IP Address - '.$ip;  
*/

function cart(){
  if(isset($_GET['add_to_cart'])){
    global $con;
    $get_ip_add = getIPAddress();
    $get_product_id=$_GET['add_to_cart'];
    $select_query = "SELECT * FROM `cart_details` WHERE ip_adress='$get_ip_add ' and product_id = '$get_product_id'";
    $result_query=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows>0){
    echo "<script>alert('produs deja prezent in cos')</script>";
    echo "<script>windows.open('produse.php','_self')</script>";

  }else{
    $insert_query = "INSERT INTO cart_details (product_id, ip_adress, quantity) VALUES ('$get_product_id', '$get_ip_add', 0)";;
  $result_query=mysqli_query($con,$insert_query);
  echo "<script>alert('Item is added to cart')</script>";
  echo "<script>windows.open('produse.php','_self')</script>";
  }
  }
}

function cart_item(){
  if(isset($_GET['add to cart'])){
    global $con;
    $get_ip_add= getIPAddress();
    $select_query="SELECT * FROM `cart_details` WHERE ip_adress='$get_ip_add '";
    $result_query=mysqli_query($con,$select_query);
    $count_cart_items=mysqli_num_rows($result_query);
  }else{
    global $con;
    $get_ip_add= getIPAddress();
    $select_query="SELECT * FROM `cart_details` WHERE ip_adress='$get_ip_add '";
    $result_query=mysqli_query($con,$select_query);
    $count_cart_items=mysqli_num_rows($result_query);
  }
  echo  $count_cart_items;
}

function total_cart_price(){
  global $con;
  $get_ip_add = getIPAddress();
  $total_price = 0;
  $cart_query = "SELECT * FROM `cart_details` WHERE ip_adress='$get_ip_add'";
  $result = mysqli_query($con, $cart_query);

  while ($row = mysqli_fetch_array($result)) {
    $product_id = $row['product_id'];
    $select_products = "SELECT * FROM `products` WHERE product_id = '$product_id'";
    $result_products = mysqli_query($con, $select_products);

    while ($row_product_price = mysqli_fetch_array($result_products)) {
      $product_price = $row_product_price['product_price'];
      $total_price += $product_price;
    }
  }

  echo $total_price;
}

//random products
function get_random_products($limit)
{
    global $con;
    $query = "SELECT * FROM products ORDER BY RAND() LIMIT $limit";
    $result = mysqli_query($con, $query);

    echo '<div class="container">';
    echo '<div class="row">';

    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $product_image = $row['product_image1'];

        echo "
            <div class='col-md-6 col-lg-6 col-xl-3 mb-3'>
                <div class='card'>
                    <div class='text-center'>
                        <img class='card-img-top' src='img/$product_image' alt='Card image cap'>
                        <div class='card-body'>
                            <h6 class='card-subtitle mb-2 mt-2 text-muted'>$product_title</h6>
                            <p class='card-text'>$product_price</p>
                           <a href='product_details.php?product_id=$product_id' class='btn btn-primary mb-2'>Detalii produs</a>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }

    echo '</div>';
    echo '</div>';
}
