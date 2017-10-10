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

    <!-- Navigation -->
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

      <div class="bg-faded p-4 my-4">
        <!-- Image Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators" style="bottom: 400px !important">
		  <?php 
		   if(isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == true)
			{
		  ?>
			<button name="addtopic" type="submit" class="btn btn-secondary" onclick="location.href = '<?php echo $url."/library/search.php"; ?>';" style="color: black !important; background-color: white;">Click to continue</button>
			<?php
			}
			else{
			?>
			<button name="addtopic" type="submit" class="btn btn-secondary" onclick="location.href = '<?php echo $url."/library/login.php"; ?>';" style="color: black !important; background-color: white;">Click to continue</button>
			
			<?php
			}
			?>
          </ol>
		  <button class="navbar-toggler" type="button"></button>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid w-100" src="images/library.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- /.container -->

    <!--<footer class="bg-faded text-center py-5">
      <div class="container">
        <p class="m-0">Copyright &copy; Your Website 2017</p>
      </div>
    </footer>-->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>
