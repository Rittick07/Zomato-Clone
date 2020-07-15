<?php
session_start();
$conn=mysqli_connect("localhost","root","","zomato");
if(empty($_SESSION))
{
	header('Location: login_form.php');
}
$user_id=$_SESSION['user_id'];
$query="SELECT * FROM users WHERE user_id='$user_id'";
$result=mysqli_query($conn,$query);
$result=mysqli_fetch_array($result);
$dp=$result['dp'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hi User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<script>
	$(document).ready(function(){
		$('#edit_dp').hide();
		$('#profile').mouseenter(function(){
			$('#edit_dp').show();
		})
		$('#profile').mouseleave(function(){
			$('#edit_dp').hide();
		})
	})

</script>
<body>

	<nav class="navbar" style="background: linear-gradient(to top, #b31217, #e52d27);" >
		<h4 class="navbar-brand text-light">Zomato</h4>
		<h5 class="float-right text-light">Hi <?php echo $_SESSION['name'] ?></h5>
	</nav>

	<div class="container">
		<div class="row mt-3">
			<div class="col-md-3">

				<div class="card" id="profile">
				  <img class="card-img-top" src="<?php echo $dp; ?>"><a href="#" data-toggle="modal" data-target="#dpModal"> <i class="fa fa-edit fa-2x text-dark" id="edit_dp" style="margin-top: 8px;
    padding-left: 220px;"></i> </a>
				  <div class="card-body">
				    <h5 class="card-title text-center"><?php echo $_SESSION['name']; ?></h5>
				  </div>
				  <ul class="list-group list-group-flush">
				    <li class="list-group-item"><i>Orders</i><span class="float-right">30</span></li>
				    <li class="list-group-item"><i>Reviews</i><span class="float-right">30</span></li>
				    <!-- <li class="list-group-item text-danger"><b>Logout</b></li> -->
				  </ul>
				  <div class="card-body">
                    
				    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#editModal">Edit Profile</a>
				    <a href="index.php" class="btn btn-primary btn-block">Go To Home Page</a>
				    <a href="login_form.php" class="btn btn-danger btn-block"style="background: linear-gradient(to top, #b31217, #e52d27);"><i class='fa fa-power-off'></i>&nbsp; Logout</a>
				  </div>
				</div>
				
			</div>

			<div class="col-md-6">
				<h3 class="text-danger text-center"><i>Previous Orders</i></h3>

				<div class="row">
					<?php

					$conn=mysqli_connect("localhost","root","","zomato");

					$user_id=$_SESSION['user_id'];

					$query="SELECT * FROM orders o JOIN restaurants r ON r.r_id=o.r_id WHERE o.user_id=$user_id AND o.status=1";

					$result=mysqli_query($conn, $query);

					while($row=mysqli_fetch_array($result))
					{
						echo '<div class="col-md-12">
								<div class="card mt-2">
									<div class="card-body">
										<h5 class="card-title text-danger">'.$row['r_name'].'</h5>
										<p>Order Date: <b>'.$row['order_time'].'</b><span class="float-right">Total: Rs <b>'.$row['amount'].'</b></span></p>

										<table class="table">';

										$current_order_id=$row['order_id'];

										$query2="SELECT * FROM order_details o JOIN menu m ON m.id=o.menu_id WHERE o.order_id LIKE '$current_order_id'";

										$result2=mysqli_query($conn,$query2);
										$counter=1;

										while($row2=mysqli_fetch_array($result2))
										{
											echo '<tr>
													<td>'.$counter.'</td>
													<td>'.$row2['name'].'</td>
													<td>1 pc</td>
												</tr>';
											$counter++;
										}

										

										echo '</table>

										
										<div class="float-right">
											<button class="btn btn-success"><i class="fa fa-heart"></i>&nbsp; One Click Reorder </button>
											<button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"style="background: linear-gradient(to top, #b31217, #e52d27);"><i class="fa fa-star"></i>&nbsp; Rate Order</button><br><br>
										
											
										</div>


									</div>

								</div> 

							</div>';
					}


					?>
				</div>
				
			</div>

			<div class="col-md-3">

				<div class="row">
					<div class="col-md-12">
						<div class="card" style="height:400px;overflow-y: scroll;">
							<div class="card-body">
							<h4 class="text-center">Your Reviews</h4><hr>
							
							<?php
							$current_user_id=$_SESSION['user_id'];

							$query4="SELECT * FROM user_reviews u JOIN users ON users.user_id=u.user_id WHERE u.user_id='$current_user_id'";

							$result3=mysqli_query($conn, $query4);

							while($row=mysqli_fetch_array($result3)){

								echo '
									<h5><i>'.$row['review_heading'].'<small class="badge badge-dark text-center float-right">'.$row['star_ratings'].'/5.0</small></i></h5>
									<small class="text-danger"><b>'.$row['res_name'].'</b></small>
									
									<p>'.$row['review'].'</p>
									<hr>';
							}
							?>
								
						</div>
					</div>
				</div>
			
					<div class="col-md-12">
						<div class="card mt-3" style="height: 250px;overflow-y: scroll;">
							<div class="card-body ">
							<h6><b>Add new Address</b><button class="btn btn-dark
										btn-sm float-right" data-toggle="modal" data-target="#exampleModal1" ><b><i>Add +</i></b></button></h6><hr>

							<?php
							$current_user_id=$_SESSION['user_id'];

							$query5="SELECT * FROM address a JOIN users ON users.user_id=a.user_id WHERE a.user_id='$current_user_id'";

							$result4=mysqli_query($conn, $query5);

							while($row=mysqli_fetch_array($result4)){

								echo '
						   				<div>
							   		<small class="badge badge-danger">'.$row['badge'].'</small>
							   		<p>'.$row['Address'].'<br>
								   Pincode - '.$row['Pincode'].'
							   		</p>
						   			</div><hr>';
							}	
								
							?>	
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Rate your Order</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="submit_review.php" method="POST">
				<label>Rating Heading:</label><br>
	        	<input type="text" name="review_heading" class="form-control" max="5" min="1"><br>
	        	<label>Rating:</label><br>
	        	<input type="number" step="0.1" name="star_ratings" class="form-control" max="5" min="1"><br>
				<label>Restaurant Name:</label><br>
	        	<input type="text" name="res_name" class="form-control" max="5" min="1"><br>
	        	<label>Your Review:</label><br>
	        	<textarea  type="text" class="form-control" name="review"></textarea><br>

	        	<input type="submit" value="Submit" class="btn btn-danger">
	        </form>
	      </div>
	    </div>
	  </div>
	</div>



	<!-- Add address modal -->
	<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="address">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add New Address</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="add_new_address.php" method="POST">
				<label>Badge:</label><br>
	        	<input type="text" name="badge" class="form-control" max="5" min="1"><br>
	        	<label>Address:</label><br>
	        	<textarea  type="text" class="form-control" name="Address"></textarea><br>
				<label>Pincode:</label><br>
	        	<input type="bigint(20)" name="Pincode" class="form-control" max="5" min="1"><br>       	

	        	<input type="submit" value="Submit" class="btn btn-danger">
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
		<!-- dp modal					 -->
	<div class="modal fade" id="dpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Choose Profile picture:</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="update_dp.php" method="POST" enctype="multipart/form-data">
				<label>Choose Profile Picture:</label><br>
	        	 <input type="file" name="img_file" class="form-control"><br>  	

	        	<input type="submit" value="Submit" class="btn btn-danger">
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- edit profile modal -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Edit Profile:</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="edit_profile.php" method="POST">
				<label>Name:</label><br>
	        	 <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['name']; ?>"><br> 
				<label>Password:</label><br>
	        	 <input type="password" name="password" class="form-control"><br>  	

	        	<input type="submit" value="Submit" class="btn btn-danger">
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

</body>
</html>