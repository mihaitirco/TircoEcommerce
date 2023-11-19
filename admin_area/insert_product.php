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
<body class="bg-light">
    <div class="container">
        <h1 class="text-center">insert product</h1>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off"
                requred="required">
            </div>
            <!-- Description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter description" autocomplete="off"
                requred="required">
            </div>
            <!-- keyword-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product keyword</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" 
                placeholder="Enter keyword" autocomplete="off"
                requred="required">
            </div>

            <!--Category-->
            <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_category" id="product_category" class="form-select">
    <?php
    $select_query = "SELECT * FROM `categories`";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $category_title = $row['category_title'];
        $category_id = $row['category_id'];
        echo "<option value='$category_id'>$category_title</option>";
    }
    ?>
</select>
            </div>
            <!--Image1-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product Image 1</label>
             <input type="file" name="product_image1" id="product_image1" class="form-control" required="required">
            </div>

            <!--Image2-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required="required">

            </div>

            <!--Image3-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required="required">

            </div>

            <!-- Price-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Pret</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter keyword" autocomplete="off"
                requred="required">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
        <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="insert product">
        </div>

            

        </form>
</div>
<?php



if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
    $product_description=$_POST['product_description'];
    $product_keywords=$_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_price=$_POST['product_price'];
    $product_status=`true`;
    //imagini
    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];

    //tmp name imagini
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    //price condition 
    if (!ctype_digit($product_price)) {
        echo "<script>alert('Pretul trebuie sa fie un numar')</script>";
        exit();
    }
    //empty condition

    if($product_title ==' ' or $product_description ==' ' or $product_keywords ==' ' or $product_category ==' ' or
     $product_price ==' ' or $product_image1 ==' '  or $product_image2 ==' '  or $product_image3 ==' '  ){
        echo"<script>alert('Completeaza toate field-urile')</script>";
        exit();
     }else{
        move_uploaded_file($temp_image1, "../img/$product_image1");
        move_uploaded_file($temp_image2, "../img/$product_image2");
        move_uploaded_file($temp_image3, "../img/$product_image3");

     }


     //insert querry
     $insert_products="INSERT INTO `products`(product_title, product_description, product_keywords, 
     category_id, product_image1, product_image2, product_image3, product_price) VALUES ('$product_title', '$product_description', 
     '$product_keywords', '$product_category', '$product_image1', '$product_image2', '$product_image3', '$product_price')";
     $result_query =mysqli_query($con,$insert_products);
     if($result_query){
        echo"<script>alert('Produs adaugat cu succes')</script>";

     }
     
}
?>
</body>

</html>

