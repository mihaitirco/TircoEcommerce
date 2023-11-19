<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat'])){
  $category_title = $_POST['cat-title'];
//select din database
$select_query="SELECT  * from `categories` WHERE  category_title='$category_title'";
$result_select=mysqli_query($con,$select_query);
$number=mysqli_num_rows($result_select);
if($number>0){
  echo"<script>alert('categoria exista deja')</script>";
}else{
  $insert_query="INSERT INTO `categories`(category_title) VALUES('$category_title')";
  $result=mysqli_query($con,$insert_query);
  if($result){
  echo"<script>alert('categorie creata')</script>";
  }
}
}
?>
<h2>insert categories</h2>
<form action="" method="post" class ="mb-2">
<div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info" id="basic-adon1"></span>
  <input type="text" class="form-control" name="cat-title" placeholder="insert category" aria-label="Username"
   aria-describedby="basic-adon1">
</div>
<div class="input-group w-10 mb-2 m-auto">
<input type="submit" class="bg-info p-2 my-3 border-0" name="insert_cat" value ="insert categories">
</div>
</form>