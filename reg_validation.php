<?php

    $conn=mysqli_connect("localhost","root","","zomato");
    session_start();

    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query= "INSERT INTO users(user_id,name,email,password,dp) VALUES(null,'$name','$email','$password','http://localhost:10080/zomato/avatar.jpg')";

    try{
        // check user already exists or not
        mysqli_query($conn,$query);
        header('Location:login_form.php?message=1');

    }catch(Exeption $e){
        header('Location:login_form.php?message=0');
    }
?>