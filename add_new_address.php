<?php
    session_start();
    $insert=false;
 
    $conn=mysqli_connect("localhost","root","","zomato");

    $badge=$_POST['badge'];
    $Address=$_POST['Address'];
    $Pincode=$_POST['Pincode'];

   


    
    $current_user_id=$_SESSION['user_id'];

    $query="INSERT INTO address(`S.No`, `badge`, `Address`, `Pincode`, `user_id`) VALUES (NULL, '$badge', '$Address', '$Pincode','$current_user_id')";


    if($conn -> query($query)==true){
        $insert=true;
         header('Location:profile.php');

    }
    else{
        echo "ERROR: $query <br> $conn->error";
    }
    $conn->close();



?>