<?php
$con =mysqli_connect("localhost","root","","TircoStore");
if($con){
    echo"connection succesfull";
}else{
    die(mysqli_error($con));
}
?>