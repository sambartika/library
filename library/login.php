<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Business Casual - Start Bootstrap Theme</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.css" rel="stylesheet">

  </head>

  <body>
  <?php include 'config.php'; ?>

     <div class="tagline-upper text-center text-heading text-shadow text-white mt-5 d-none d-lg-block">Texas A&M University Library</div>
    <div class="tagline-lower text-center text-expanded text-shadow text-uppercase text-white mb-5 d-none d-lg-block">One Best Book is Equal To Hundred Good Friends</div>

        <nav class="navbar navbar-expand-lg navbar-light bg-faded py-lg-4">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item px-lg-2">
              <a class="nav-link text-uppercase text-expanded" href="index">Home
              </a>
            </li>
			<?php
				if(isset($_COOKIE['userrole']) )
				{
					echo '
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="search">Search Books</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="view_topics">View Topics</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="profile">Update Profile</a>
						</li>';
						
					if($_COOKIE['userrole']=="admin")
					{
						echo '
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="change_availability">Change Availability</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="insert_book">Add Book</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="insert_topic">Add Topic</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="delete_books">Remove Book</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="delete_topics">Remove Topic</a>
						</li>';
					}
					
				}
			?>
			<li class="nav-item px-lg-2">
			<?php
				if(isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == true)
				{
					echo '<a class="nav-link text-uppercase text-expanded" href="logout">Logout
					</a>';
					header("Location: index.php");
				}
				else
				{
					echo '<a class="nav-link text-uppercase text-expanded" href="login">Login
					</a>';
				}
			?>
			</li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">

	<?php
		$flag=0;
		if (isSet($_POST['email']) && isSet($_POST['pass']) && $_POST['email'] != '' && $_POST['pass'] != '') 
		{
			$email= $_POST['email'];
			$pass= $_POST['pass'];
			$q = mysqli_query($conn, "SELECT * FROM library.member WHERE email='$email' AND password='$pass'" ) ;
    		$check_user = mysqli_num_rows($q);

			if($check_user>0){
				if(($row = mysqli_fetch_assoc($q)))
				{
					$idd= $row["member_id"];
				}			
    			setcookie("loggedin", 1, time()+3600);  /* expire in 1 hour */
				setcookie("username", $email, time()+3600);  /* expire in 1 hour */
				setcookie("userid", $idd, time()+3600);  /* expire in 1 hour */
				setcookie("userrole", $row["role"], time()+3600);  /* expire in 1 hour */
				header("Location: index.php");
    		}else{
				$flag=1;
			}
		}
	?>
	
	<div class="bg-faded p-2 my-2">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <strong>Enter your email and password to sign in</strong>
        </h2>
        <hr class="divider">
        <form accept-charset="utf-8" method="post" action="login.php">
          <div class="row">
			<?php
			if($flag==1)
			{
				echo'
					<div class="form-group col-lg-4">
					</div>
					<div class="form-group col-lg-4">
						<label class="text-heading" style="color:red">Invalid email or password</label>
					</div>
					<div class="form-group col-lg-4">
					</div>';
			}
			?>
			<div class="form-group col-lg-4">
			</div>
            <div class="form-group col-lg-4">
              <label class="text-heading">Email</label>
              <input name="email" type="email" class="form-control">
            </div>
			<div class="form-group col-lg-4">
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-lg-4">
			</div>
            <div class="form-group col-lg-4">
              <label class="text-heading">Password</label>
              <input name="pass" type="password" class="form-control">
            </div>
			<div class="form-group col-lg-4">
			</div>
            <div class="clearfix"></div>
			<div class="form-group col-lg-4">
			</div>
			
            <div class="form-group col-lg-4">
              <button name="login" type="submit" class="btn btn-secondary">Login</button>
            </div>
			<div class="form-group col-lg-4">
			</div>
          </div>
        </form>
      </div>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>
