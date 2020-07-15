<?php
    session_start();
    $insert=false;

    

    $conn=mysqli_connect("localhost","root","","zomato");

    $review_heading=$_POST['review_heading'];
    $star_ratings=$_POST['star_ratings'];
    $review=$_POST['review'];

   


    $res_name=$_POST['res_name'];
    $current_user_id=$_SESSION['user_id'];

    $query="INSERT INTO user_reviews(`S.No`, `review_heading`, `res_name`, `review`, `star_ratings`, `user_id`) VALUES (NULL, '$review_heading', '$res_name', '$review', '$star_ratings', '$current_user_id')";


    if($conn -> query($query)==true){
        $insert=true;
         header('Location:profile.php');

    }
    else{
        echo "ERROR: $query <br> $conn->error";
    }
    $conn->close();



?>