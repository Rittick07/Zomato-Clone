<?php

session_start();

//1. TO CONNECT TO DB

$conn=mysqli_connect("localhost","root","","zomato");

//2. FETCH DATA FROM HTML

// print_r($_POST);
$r_email= $_POST['r_email'];
$r_password= $_POST['r_password'];


//3. CHECK IN DATABASE

$query="SELECT * FROM restaurants WHERE r_email LIKE '$r_email' AND r_password LIKE '$r_password'";
$result=mysqli_query($conn,$query);
// $new_result= mysqli_fetch_array($result);
// print_r($new_result);

$rows=mysqli_num_rows($result);
// echo $rows;


//4. TELL RESULT

if($rows==1){
    $_SESSION['is_user_loggedin']=1;
    $query1="SELECT * FROM restaurants WHERE r_email LIKE '$r_email'";
    $result1=mysqli_query($conn,$query1);
    $result1=mysqli_fetch_array($result1);
    $_SESSION['r_id']=$result1['r_id'];
    $_SESSION['r_name']=$result1['r_name'];
    // echo $_SESSION['user_id'];
    // echo $_SESSION['name'];
    // echo "WElcome";
    header('Location:admin.php');

}
else{
    // echo "Incorrect Email and PAssword";
    header('Location:login_form.php');
}

?>