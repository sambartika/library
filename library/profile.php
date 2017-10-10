<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TAMU Library</title>

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
              <a class="nav-link text-uppercase text-expanded" href="index.php">Home
              </a>
            </li>
			<?php
				if(isset($_COOKIE['userrole']) )
				{
					echo '
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="search.php">Search Books</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="view_topics.php">View Topics</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="profile.php">Update Profile</a>
						</li>';
						
					if($_COOKIE['userrole']=="admin")
					{
						echo '
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="change_availability.php">Change Availability</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="insert_book.php">Add Book</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="insert_topic.php">Add Topic</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="delete_books.php">Remove Book</a>
						</li>
						<li class="nav-item px-lg-2">
						  <a class="nav-link text-uppercase text-expanded" href="delete_topics.php">Remove Topic</a>
						</li>';
					}
					
				}
			?>
			<li class="nav-item px-lg-2">
			<?php
				if(isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == true)
				{
					echo '<a class="nav-link text-uppercase text-expanded" href="logout.php">Logout</a>';
				}
				else
				{
					echo '<a class="nav-link text-uppercase text-expanded" href="login.php">Login</a>';
				}
			?>
			</li>
          </ul>
        </div>
      </div>
    </nav>
	
    <div class="container">
	  
	<?php
		$flag= 0;
		if (isSet($_POST['fname'])  ) 
		{	
			$id1= $_COOKIE['username'];
			$fname1= $_POST["fname"];
			$lname1= $_POST["lname"];
			$email1= $_POST["email"];
			$stad1= $_POST["street_address"];
			$city1= $_POST["city"];
			$state1= $_POST["state"];
			$zip1= $_POST["zip"];
			$phone1= $_POST["phone_no"];
			$password1= $_POST["password"];
			
			if(mysqli_query($conn, "UPDATE member set first_name=\"".$fname1."\", last_name= \"".$lname1."\", email= \"".$email1."\",
			street_address= \"".$stad1."\", city= \"".$city1."\", state= \"".$state1."\", zip= \"".$zip1."\", phone_no= \"".$phone1."\", password= \"".$password1."\" where email=\"".$id1."\""))
			{
				$flag=1;
			}
			
			
			
		}
		
		$q = mysqli_query($conn, "SELECT * from member where email=\"".$_COOKIE['username']."\"" ) ;
    	$check_user = mysqli_num_rows($q);

		echo "
		<div class=\"bg-faded p-2 my-2\">
        <hr class=\"divider\">
        <h2 class=\"text-center text-lg text-uppercase my-0\">
          <strong>View or update profile</strong>
        </h2>
        <hr class=\"divider\">
		";
		if($check_user>0){
			$topics = array();
			$i=0;
    		if ($row = mysqli_fetch_assoc($q)) 
			{	
				$id= $row["member_id"];
				$fname= $row["first_name"];
				$lname= $row["last_name"];
				$email= $row["email"];
				$stad= $row["street_address"];
				$city= $row["city"];
				$state= $row["state"];
				$zip= $row["zip"];
				$phone= $row["phone_no"];
				$password= $row["password"];
				
				
				echo "<form accept-charset=\"utf-8\" method=\"post\" action=\"profile.php\">
					<div class=\"row\">";
				if($flag==1)
				{
					echo "<div class=\"col-md-12\">
						<label class=\"text-heading\" style=\"color:red\">Successfully Updated</label></br>
					</div>
					";
				}
				echo "<div class=\"col-md-6\">
						<label class=\"text-heading\">First Name</label></br>
						<input name=\"fname\" type=\"text\" value=\"".$fname."\" class=\"form-control\">
					</div>
					<div class=\"col-md-6\">
						<label class=\"text-heading\">Last Name</label></br>
						<input name=\"lname\" type=\"text\" value=\"".$lname."\" class=\"form-control\">
					</div>
					<div class=\"col-md-6\">
						<label class=\"text-heading\">Phone No</label></br>
						<input name=\"phone_no\" type=\"text\" value=\"".$phone."\" class=\"form-control\">
					</div>
					<div class=\"col-md-6\">
						<label class=\"text-heading\">Email</label></br>
						<input name=\"email\" type=\"text\" value=\"".$email."\" class=\"form-control\">
					</div>	
					<div class=\"col-md-6\">
						<label class=\"text-heading\">Street Address</label></br>
						<input name=\"street_address\" type=\"text\" value=\"".$stad."\" class=\"form-control\">
					</div>
					<div class=\"col-md-6\">
						<label class=\"text-heading\">City</label></br>
						<input name=\"city\" type=\"text\" value=\"".$city."\" class=\"form-control\">
					</div>	
					<div class=\"col-md-6\">
						<label class=\"text-heading\">State</label></br>
						<input name=\"state\" type=\"text\" value=\"".$state."\" class=\"form-control\">
					</div>
					<div class=\"col-md-6\">
						<label class=\"text-heading\">Zip Code</label></br>
						<input name=\"zip\" type=\"text\" value=\"".$zip."\" class=\"form-control\">
					</div>
					<div class=\"form-group col-lg-6\">
						<label class=\"text-heading\">Password</label></br>
						<input name=\"password\" type=\"password\" value=\"".$password."\" class=\"form-control\">
					</div>
					<div class=\"form-group col-lg-6\">
						<label class=\"text-heading\">Update</label></br>
						<button name=\"update\" type=\"submit\" class=\"btn btn-secondary\">Update profile</button>
					</div>
				</div>
				</form>
			";
				
				
			}
			echo "
				</div>
			</div>
			<hr class=\"divider\">
			";
    	}
	?>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>
