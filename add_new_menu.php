<?php
session_start();
$insert=false;
$conn=mysqli_connect("localhost","root","","zomato");
print_r($_FILES['img_file']);

$filename=$_FILES['img_file']['name'];

$img="http://localhost:10080/zomato/images/".$filename;
$r_id=$_SESSION['r_id'];
$name=$_POST['name'];
$price=$_POST['price'];
$desc=$_POST['desc'];
$type=$_POST['type'];

$query="INSERT INTO menu(`id`,`name`,`price`,`desc`,`img`,`r_id`,`status`,`type`) VALUES(null,'$name','$price','$desc','$img','$r_id','1','$type') ";

if($conn -> query($query)==true){
    $insert=true;
    move_uploaded_file($_FILES['img_file']['tmp_name'], 'images/'.$filename);
     header('Location:admin.php');

}
else{
    echo "ERROR: $query <br> $conn->error";
}
$conn->close();


?>