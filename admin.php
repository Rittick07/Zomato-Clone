<?php

session_start();

$conn=mysqli_connect("localhost","root","","zomato");

$r_id=$_SESSION['r_id'];
$r_name=$_SESSION['r_name'];
$query="SELECT * FROM orders WHERE r_id='$r_id' AND status=1";

$result=mysqli_query($conn,$query);

$amount=0;
$pending=0;
$delivered=0;
$counter=0;
$total=0;

while($row=mysqli_fetch_array($result)){
   
    $amount=$amount+ $row['amount'];
   

    if($row['delivery_status']==0){
        $pending++;
    }else{
        $total=$total+ $row['rating'];
        $counter++;

        $delivered++;
        
    }
}
$rating=$total/$counter;


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>
<style>
    input[type="checkbox"]{
    width:20px;
    height:20px;
}
</style>
<script>
    $(document).ready(function(){
        $('.order_id').click(function(){
            var order_id=$(this).text();

            $ajax({
                url:'fetch_order_details.php',
                type:'POST',
                data:{'order_id':order_id},
                success:function(data){
                    $('#order_details').html(data);
                    $('#orderModal').modal('show');
                },
                error:function(){

                }
            });
           
        });
    })

</script>
<body>
    <nav class="navbar bg-danger"style="background: linear-gradient(to top, #b31217, #e52d27);">
		<h4 class="navbar-brand text-light">Zomato Admin</h4>
		<h5 class="float-right text-light">Hi <?php echo $_SESSION['r_name']?></h5>
	</nav>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="card text-light"style="background: linear-gradient(to right, #000000, #0f9b0f);">
                    <div class="card-body">
                        <h4>Sales </h4>
                        <h1><span class="float-right"><span><?php echo $amount; ?></span></span></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-light" style="background: linear-gradient(to right, #ba8b02, #181818);">
                    <div class="card-body">
                        <h4>Pending Orders </h4>
                        <h1><span class="float-right"><?php echo $pending; ?></span></h1>
                    </div>
                </div> 
            
            </div>
            <div class="col-md-3">
                <div class="card bg-primary text-light"style=" background: linear-gradient(to right, #0f0c29, #302b63, #24243e);">
                    <div class="card-body">
                        <h4>Delivered </h4>
                        <h1><span class="float-right"><?php echo $delivered; ?></span></h1>
                    </div>
                </div> 
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-light"style="background: linear-gradient(to right, #870000, #190a05);">
                    <div class="card-body">
                        <h4>Rating </h4>
                        <h1><span class="float-right"><?php echo $rating; ?></span></h1>
                    </div>
                </div>     
            
            </div>
      
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2>Menu <button class="btn btn-danger btn-sm float-right"style="background: linear-gradient(to top, #b31217, #e52d27);"><a class="text-light" style="text-decoration:none;"href="#" data-toggle="modal" data-target="#addmenuModal">Add menu</a></button></h2>
                       
                        <table class="table">
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                            <?php
                                $query1="SELECT * FROM menu WHERE r_id='$r_id'";
                                $result1=mysqli_query($conn,$query1);
                                $counter1=1;
                                while($row1=mysqli_fetch_array($result1)){
                                    if($row1['status']==1){
                                        echo '<tr>
                                        <td>'.$counter1.'</td>
                                        <td>'.$row1['name'].'</td>
                                        <td>
                                            <input type="checkbox" checked>
                                        </td>
                                     </tr>';
                                    }else{
                                        echo '<tr class="text-muted">
                                            <td>'.$counter1.'</td>
                                            <td>'.$row1['name'].'</td>
                                            <td>
                                                <input type="checkbox">
                                            </td>
                                         </tr>';
                                    }
                                    
                                $counter1++;
                                }
                            ?>
                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2>Recent Orders</h2>
                        <table class="table">
                            <tr>
                                <th>S.No</th>
                                <th>Order id</th>
                                <th>Customer Name</th>
                                <th>Amount</th>
                            </tr>
                            <?php
                            
                            $query2="SELECT * FROM orders o JOIN users u ON u.user_id=o.user_id WHERE r_id='$r_id'";
                            $result2=mysqli_query($conn,$query2);
                            $counter2=1;
                            while($row2=mysqli_fetch_array($result2)){
                                    echo '<tr>
                                    <td>'.$counter2.'</td>
                                    <td><a href="#" data-toggle="modal" data-target="#order_details" >'.$row2['order_id'].'</a></td>
                                    <td>'.$row2['name'].'</td>
                                    <td>Rs '.$row2['amount'].'</td>
                                </tr>';
                                $counter2++;
                            }


                            ?>
                            
                        </table>
                    </div>
                </div>
                <div>
                            <div class="mt-3">
                            <a href="admin_login.php" class="btn btn-danger btn-block"style="background: linear-gradient(to top, #b31217, #e52d27);"><i class='fa fa-power-off'></i>&nbsp; Logout</a>
                            </div>
                </div>
            </div>
            
        </div>
    
    </div>
    <!-- order modal -->
    <!-- <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Order Details:</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <table class="table">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Chicken Pizza</td>
                    <td>1</td>
                </tr>
            </table>
	      </div>
	    </div>
	  </div>
	</div> -->

    <!-- add menu modal -->
    <div class="modal fade" id="addmenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="address">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="add_new_menu.php" method="POST">
				<label>Name:</label><br>
	        	<input type="text" name="name" class="form-control" max="5" min="1"><br>
	        	<label>Price:</label><br>
                <input type="number" class="form-control" name="price"><br>
                <label>Choose Food Thumbnail:</label><br>
	        	<input type="file" name="img" class="form-control"><br>
				<label>Description:</label><br>
	        	<textarea  type="text" class="form-control" name="desc"></textarea><br>
                <label>Type:</label><br>
                <smallclass="text-muted">Enter 1 for veg & 0 for non-veg</small><br>
                <input type="number" class="form-control" name="type"><br>
             
	        	<input type="submit" value="Submit" class="btn btn-danger btn-block">
	        </form>
	      </div>
	    </div>
	  </div>
    </div>
    

    <!-- view orders modal -->
    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="address">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Order Details:</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="order_details">
	        <table class="table">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Quantity</th>
                </tr>
                 <?php

                //  $query3="SELECT * FROM order_details o JOIN menu m ON m.id=o.menu_id WHERE order_id LIKE '$order_id'";
                //  $result3=mysqli_query($conn,$query3);
                //  $counter3=1;

                while($row=mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td>1</td>
                    <td><?php echo $row['name'];?></td>
                    <td>1 pc</td>
                </tr>
                <?php    
                }
                // $counter3++;
                ?> 
            </table>
	      </div>
	    </div>
	  </div>
	</div>
    
</body>
</html>