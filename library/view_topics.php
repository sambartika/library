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
		$q = mysqli_query($conn, "SELECT t.name topic, d.name department FROM topic t INNER JOIN department d on t.dept_no= d.dept_no" ) ;
    	$check_user = mysqli_num_rows($q);

		echo "
		<div class=\"bg-faded p-2 my-2\">
        <hr class=\"divider\">
        <h2 class=\"text-center text-lg text-uppercase my-0\">
          <strong>List of the topics</strong>
        </h2>
        <hr class=\"divider\">
		";
		if($check_user>0){
			$topics = array();
			$i=0;
    		while ($row = mysqli_fetch_assoc($q)) 
			{	
				$url= "search.php?searchby=topic&searchname=".$row["topic"];
				echo "
				<div class=\"row\">
					<div class=\"col-md-6\">
						<p style=\"text-align:center\">Topic name: <a href=\"".$url."\">".$row["topic"]."</a>
						</p>
					</div>
				<div class=\"col-md-6\">
					<p>Department name:".$row["department"]."</p>
				</div>
				
			</div>
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
