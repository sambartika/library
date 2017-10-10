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
		$flag=0;
		if (isSet($_POST['t_name']) && isSet($_POST['d_name']) && $_POST['t_name'] != '') 
		{
			$topic_name= $_POST['t_name'];
			$dept_no= $_POST['d_name'];
			$q1 = mysqli_query($conn, "SELECT * FROM topic WHERE name='$topic_name'" ) ;
			$check_topic = mysqli_num_rows($q1);
			
			if($check_topic<1){
				$q2 = mysqli_query($conn, "SELECT * FROM topic where topic_id= (select max(topic_id) from topic)" ) ;
				$row = mysqli_fetch_assoc($q2) ;
				$topic_id =intval($row["topic_id"]) ;
				$sp= split(",", $row["shelf_no"]);
				$topic_id = $topic_id + 1 ;
				$sp[1]++;
				$ss= $sp[1].",";
				$sp[1]++;
				$ss= $ss.$sp[1];
			    $q = mysqli_query($conn, "INSERT INTO topic (topic_id, name, dept_no, shelf_no) VALUES ($topic_id, '$topic_name', $dept_no, '$ss');" ) ;
				$flag=3;
			
			}
			else{
				$flag=1;
			}
		}
		elseif (isSet($_POST['t_name']) && $_POST['t_name'] == '')
		{
			$flag=2;
		}		
		
	?>
	
	<div class="bg-faded p-2 my-2">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <strong>Enter the topic details</strong>
        </h2>
        <hr class="divider">
        <form accept-charset="utf-8" method="post" action="insert_topic.php">
          <div class="row">
			<?php
			if($flag==1)
			{
				echo'
					<div class="form-group col-lg-4">
					</div>
					<div class="form-group col-lg-4">
						<label class="text-heading" style="color:red">Topic Exisis</label>
					</div>
					<div class="form-group col-lg-4">
					</div>';
			}
			elseif($flag==2)
			{
				echo'
					<div class="form-group col-lg-4">
					</div>
					<div class="form-group col-lg-4">
						<label class="text-heading" style="color:red">Invalid topic</label>
					</div>
					<div class="form-group col-lg-4">
					</div>';
			}
			elseif($flag==3)
			{
				echo'
					<div class="form-group col-lg-4">
					</div>
					<div class="form-group col-lg-4">
						<label class="text-heading" style="color:red">Topic successfully added</label>
					</div>
					<div class="form-group col-lg-4">
					</div>';
			}
			?>
            <div class="form-group col-lg-4">
              <label class="text-heading">Topic Name</label>
              <input name="t_name" type="text" class="form-control">
            </div>
            <div class="form-group col-lg-4">
              <label class="text-heading">Department Name</label>
				<select name="d_name">
					<?php 
					$sql = mysqli_query($conn, "SELECT * FROM department");
					while ($row = mysqli_fetch_assoc($sql)){
					echo "<option value=\"".$row['dept_no']."\">" . $row['name'] . "</option>";
					}
					?>
				</select>
            </div>
			<div class="form-group col-lg-4">
              <label class="text-heading"></label>
              
            </div>
            <div class="form-group col-lg-4">
              <button name="addtopic" type="submit" class="btn btn-secondary">Add Topic</button>
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
