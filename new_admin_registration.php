<?php

    $conn=mysqli_connect("localhost","root","","zomato");
    session_start();

    $r_name=$_POST['r_name'];
    $r_email=$_POST['r_email'];
    $r_password=$_POST['r_password'];
    $r_cuisine=$_POST['r_cuisine'];

    $query= "INSERT INTO restaurants(r_id,r_name,r_email,r_cuisine,r_password) VALUES(null,'$r_name','$r_email','$r_cuisine','$r_password')";

    try{
        // check user already exists or not
        mysqli_query($conn,$query);
        header('Location:admin_login.php?message=1');

    }catch(Exeption $e){
        header('Location:admin_login.php?message=0');
    }
?>