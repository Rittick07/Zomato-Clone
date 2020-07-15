<?php
session_start();
if(empty($_SESSION))
{
	header('Location: login_form.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hi User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<script type="text/javascript">
	$(document).ready(function(){
		$('.rate').click(function(){
			var order_id=$(this).data('id');
			//alert(order_id);
			//pass order_id to form
			$('#order_id').val(order_id);
		});

		$('#rating-form').submit(function(){

			var order_id=$('#order_id').val();
			var rating_number=$('#rating-number').val();
			var review=$('#review').val();

			$('#exampleModal').modal('hide');


			$.ajax({
				url:'insert_rating.php',
				type:'POST',
				data:{'order_id':order_id,'rating_number':rating_number,'review':review},
				success:function(data){
					alert("Hello");
					console.log(data);
					data=JSON.parse(data);

					if(data.code==1){
						alert("Rating added successfully");
					}else{
						alert("Some error occured. Try again!");
					}
				},
				error:function(){
					alert("Some error occured");
				}
			})

		})
	})
</script>
<body>

	<nav class="navbar bg-danger">
		<h4 class="navbar-brand text-light">Zomato</h4>
		<h5 class="float-right text-light">Hi <?php echo $_SESSION['name'] ?></h5>
	</nav>

	<div class="container">
		<div class="row mt-3">
			<div class="col-md-3">

				<div class="card">
				  <img class="card-img-top" src="https://previews.123rf.com/images/metelsky/metelsky1809/metelsky180900233/109815470-man-avatar-profile-male-face-icon-vector-illustration-.jpg" alt="Card image cap">
				  <div class="card-body">
				    <h5 class="card-title"><?php echo $_SESSION['name']; ?></h5>
				  </div>
				  <ul class="list-group list-group-flush">
				    <li class="list-group-item">Orders<span class="float-right">30</span></li>
				    <li class="list-group-item">Reviews<span class="float-right">30</span></li>
				    <li class="list-group-item text-danger"><b>Logout</b></li>
				  </ul>
				  <div class="card-body">
				    <a href="#" class="btn btn-danger btn-block">Edit Profile</a>
				  </div>
				</div>
				
			</div>

			<div class="col-md-6">

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

										while($row2=mysqli_fetch_array($result2))
										{
											echo '<tr>
													<td>'.$row2['name'].'</td>
													<td>2 pcs</td>
												</tr>';
										}

										

										echo '</table>

										<button class="btn btn-danger float-right rate" data-toggle="modal" data-target="#exampleModal" data-id="'.$row['order_id'].'">Rate Order</button>


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
						<div class="card" style="height: 300px;overflow-y: scroll;">
							<div class="card-body">
								<div>
									<h5>Pathetic Food</h5>
									<small class="text-muted">Domino's Pizza</small>
									<p>THis is my reviewTHis is my reviewTHis is my reviewTHis is my reviewTHis is my reviewTHis is my reviewTHis is my reviewTHis is my reviewTHis is my reviewTHis is my review</p>
								</div><hr>	
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="card" style="height: 200px;overflow-y: scroll;">
							<div class="card-body">
								<p>Add a new Address <button class="btn btn-danger
									 btn-sm">Add</button></p>
								<div>
									<small class="badge badge-danger">Work</small>
									<p>MyWBUT, Sector V, Kolkata<br>
										Pincode 700091
									</p>
								</div><hr>
								<div>
									<small class="badge badge-danger">Home</small>
									<p>MyWBUT, Sector V, Kolkata<br>
										Pincode 700091
									</p>
								</div><hr>
								
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
	        <form id="rating-form" method="POST">
	        	<label>Rating</label><br>
	        	<input id="rating-number" type="number" name="rating" class="form-control" max="5" min="1"><br>
	        	<label>Your Review</label><br>
	        	<textarea id="review" name="review" class="form-control"></textarea><br>

	        	<input type="hidden" name="order_id" id="order_id">

	        	<input type="submit" name="" value="Submit" class="btn btn-danger">
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

</body>
</html>