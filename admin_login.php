<?php
	session_start();
	// if(!empty($_SESSION)){
	// 	header('Location:login_form.php');
	// }
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body style="background: linear-gradient(to right, #1F1C18, #8E0E00); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">

	<nav class="navbar">
		<h3 class="navbar-brand text-light">Zomato Admin</h3>
	</nav>

	<div class="container">

		<div class="row mt-50">
			<div class="col-md-8">
				<h1 class="display-2 text-light text-md-center">Welcome Admin.</h1>
				<h2 class="display-3 text-light text-md-center"> Login to view your credentials.</h2>
			</div>
			<div class="col-md-4">
				<div class="card" style="border:4px solid black;">
					<div class="card-body">
					<?php
					if(!empty($_GET)){
						$message=$_GET['message'];
						if($message==1){
							echo '<p class="text-success">Account Created. Login to proceed</p>';
						}
						else{
							echo '<p class="text-danger">Some eroor occured. Try again</p>';
						}
					}
					?>

					
						<form action="admin_validation.php" method="POST">
							<label><b>Email:</b></label><br>
							<input type="email" name="r_email" class="form-control"><br><br>

							<label><b>Password:</b></label><br>
							<input type="password" name="r_password" class="form-control"><br><br>

							<input type="submit" name="" value="Login" class="btn bg-danger btn-block btn-lg text-light"style="background: linear-gradient(to right, #1F1C18, #8E0E00);">
						</form>
						<br>

						<p><b><i>New Admin?</i></b> <a href="#" data-toggle="modal" data-target="#adminModal">Sign Up here</a></p>
						<p><b><i>Are you an user?</i></b> <a href="login_form.php" >Go back</a></p>
						
					</div>
				</div>
			</div>
		</div>
		
	</div>

	<div class="modal" id="adminModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Register Admin</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="new_admin_registration.php" method="POST">
	        	<label>Name of Restaurant:</label><br>
	        	<input type="text" name="r_name" class="form-control"><br><br>

                <label>Cuisine Type:</label><br>
	        	<input type="textarea" name="r_cuisine" class="form-control"><br><br>

	        	<label>Email:</label><br>
	        	<input type="email" name="r_email" class="form-control"><br><br>

	        	<label>Password:</label><br>
                <input type="password" name="r_password" class="form-control"><br>
                
                <input type="submit" name="" value="Sign-up" class=" btn bg-danger btn-block btn-lg text-light"style="background: linear-gradient(to right, #1F1C18, #8E0E00);">
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn bg_background text-light">Sign Up</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

</body>
</html>

