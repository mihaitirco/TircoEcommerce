<?php
include('../includes/connect.php');
?>

<!DOCTYPE HTML>
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
   <div class="container-fluid p-0">
    <div class="navbar navbar-expand-lg navbar-light bg-info">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class=nav-link>Welcome Guest</a>
            </li>
        </ul>
    </div>
    <div class="bg-ligth">
        <h3 class="text-center p-2">Manage details
        </h3>
       </div>
<div class="row">
    <div class="col-md-12 bg-secondary p-1 d-flex align-items-center ">
        <div class="px-5">
            <p class="text-light text-center">Admin Name</p>
        </div>
        <div class="button text-center">
        <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a></button>
        <button><a href="" class="nav-link text-light bg-info my-1">View Products</a></button>
        <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">insert Categories</a></button>
        <button><a href="" class="nav-link text-light bg-info my-1">View Categories</a></button>
        <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brands</a></button>
        <button><a href="" class="nav-link text-light bg-info my-1">View Brands</a></button>
        <button><a href="" class="nav-link text-light bg-info my-1">All Orders</a></button>
        <button><a href="" class="nav-link text-light bg-info my-1">All Payments</a></button>
        <button><a href="" class="nav-link text-light bg-info my-1">Lift Users</a></button>
        <button><a href="" class="nav-link text-light bg-info my-1">Logout</a></button>
</div>
    </div>
</div>
</div>
<div class = "container m-2" >
    <?php 
    if(isset($_GET["insert_category"])){
        include("insert_category.php");
    }

    if(isset($_GET["insert_brand"])){
        include("insert_brand.php");
    }
    ?>
   </div>

</body>
</html>