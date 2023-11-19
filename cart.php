<?php
include('includes/connect.php');
include('functions/common_function.php');

if (isset($_POST['remove_cart'])) {
  remove_cart_item();
}
?>

<html>
<head>
<title>TircoStore</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<meta charset="uft-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="style.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">TircoStore</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="produse.php">Produse</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
              <li class="nav-item">
                
              <a class="nav-link" href="cart.php"> <span class="bi bi-cart"><?php cart_item();
                  echo' ';
                  total_cart_price();?></span> Cos</a>
              </li>
                  
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <?php
cart();      
      ?>
      
<!--Login-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-secondary ">
        <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Welcome Guest</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
        </li>
        </ul>
      </nav>

<!--Produse-->
<div class="bg-image align-items-center text-center" style="
background-image: url('img/flori.jpg');
height:10%;
">
<h3 >Bine ai venit</h3>
</div>

<div class="container p-1 ">
  <h1 class= "text-center">Cos de cumparaturi</h1>
    <div class="row pt-2">
      <form action="" method="post">
        <table class="table table-bordered text-center">
        <thead>    
        <tr>
                <th>nume produs</th>
                <th>poza</th>
                <th>cantitate</th>
                <th>pret</th>
                <th>remove</th>
                <th>operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
                 $product_price = array($row_product_price['product_price']);
                 $price_table = ($row_product_price['product_price']);
                 $product_title=$row_product_price['product_title'];
                 $product_image1=$row_product_price['product_image1'];
                 $product_values=array_sum($product_price);
                 $total_price += $product_values;
               }
             
            
            ?>
        <tr>
            <td><?php echo $product_title;?></td>
            
            <td><img src="./img/<?php echo $product_image1; ?>" alt="" class="cart_img"></td>
            <td>
        <input type="text" name="qty" class="form-input 2-50">
        <input type="hidden" name="product_id" value="">
        
    </td>
            <?php 
            $get_ip_add= getIPAddress();
            if (isset($_POST['update_cart'])) {
              $product_id = $_POST['product_id']; // Assuming you have a form field for the product ID
              $quantity = $_POST['qty'];
          
              // Construct the SQL query to update the quantity for a specific product
              $update_cart = "UPDATE cart_details SET quantity=$quantity WHERE ip_adress='$get_ip_add' AND product_id=$product_id";
              
              $result_products_quantity = mysqli_query($con, $update_cart);
          
              if ($result_products_quantity) {
                  // Query was successful, you can provide a success message here
                  echo "Quantity updated successfully for product ID $product_id.";
              } else {
                  // Query failed, handle the error
                  echo "Error updating quantity: " . mysqli_error($con);
              }

              $total_price=$total_price * $quantities;
          
          }
            ?>
             <td><?php echo $price_table ?></td>
                <td>
                    <input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"> 
                </td>
                <td>
                    <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 m-1" name="update_cart">
                    <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 m-1 bg-danger" name="remove_cart">
                </td>
        </tr>
        <?php
             }
        ?>
        </tbody>
        </table>
    
    <div class="d-flex m-3">
    <h4 class="px-3">SUBTOTAL: <strong class="text-info"><?php echo  $total_price  ?></strong></h4>
    <a href class="index php"><button class ="bg-info px-3 bodred-0 py-2 mx-3">Continua cumparaturile</button></a>
    <a href class="index php"><button class ="bg-secondary px-3 py-2 bodred-0 text-danger">Checkout</button></a>
    </div>
    </div>
</div>
 </form>

 <!--Remove function -->
 <?php
function remove_cart_item(){
  global $con;
  if(isset($_POST['remove_cart'])){
      foreach($_POST['removeitem'] as $remove_id){
          echo $remove_id;
          $delete_query =  "DELETE FROM cart_details WHERE product_id = $remove_id";
          $run_delete=mysqli_query($con,$delete_query);
          if($run_delete){
              echo "<script>window.open('cart.php','_self')</script>";
          }
      }
  }
}
 ?>
      <!-- Footer -->
<footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!-- Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"
        ><i class="bi bi-facebook" src="img/Facebook.png"></i>
      </a>
  
  
        <!-- Instagram -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
          ><i class="bi bi-instagram"></i></a>
  
        <!-- Linkedin -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
          ><i class="bi bi-linkedin"></i>
        </a>
  
      </section>

      
      <!-- Section: Social media -->
  
           
          </div>
          <!--Grid row-->
        </form>
      </section>
      <!-- Section: Form -->
  
      <!-- Section: Text -->
      <section class="mb-4">
        <h1>TircoStore</h1>
        <p>
         TircoStore
        </p>
      </section>
      <!-- Section: Text -->
  
      
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</body>
</html>