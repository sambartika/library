<!DOCTYPE html>
<html lang="en" >

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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
	<?php
		$flag=0;	
		
		if(isSet($_POST['availupdate']) )
		{
			$q = mysqli_query($conn, "DELETE FROM topic where topic_id= ".$_POST['count'] ) ;
 		        $flag=3;
		}

		if(isSet($_POST['searchname']) && $_POST['searchname']!= "" )
		{
			$q = mysqli_query($conn, "SELECT * from topic where name like \"%".$_POST['searchname']."%\" limit 1" ) ;
			$check_user = mysqli_num_rows($q);
			$i=1;
			if($check_user>0)
			{
				$flag=1;
				while ($row = mysqli_fetch_assoc($q)) 
				{
					
					$topic_id= $row["topic_id"];
					$topic_name= $row["name"];
					$books[$i]= array(
						"topic_id" => $topic_id,
						"topic_name" => $topic_name,
					);
					$i++;
				}
			}
			else
			{
				$flag=2;
			}

		}
		if($flag!= 1)
		{
	?>
	<div class="container">
	<div class="bg-faded p-2 my-2">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <strong>Search the topics</strong>
        </h2>
        <hr class="divider">
		
        <form name="search_by_name1" accept-charset="utf-8" method="post" action="delete_topics.php">
		<?php
			(isset($_POST["searchname"])) ? $sb = $_POST["searchname"] : $sb="name";

		?>
          <div class="row">
		   <?php
			if($flag==2)
			{
				echo'
					<div class="form-group col-lg-4">
					</div>
					<div class="form-group col-lg-4">
						<label class="text-heading" style="color:red">Topic not found</label>
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
						<label class="text-heading" style="color:red">Deleted successfully</label>
					</div>
					<div class="form-group col-lg-4">
					</div>';
			}
			?>
            <div class="form-group col-lg-4">
              <label class="text-heading">Enter topic name</label></br>
              <input name="searchname" type="text" value="<?php echo $sb; ?>" class="form-control">
            </div>
            <div class="form-group col-lg-4">
			  </br>
              <button name="search" type="submit" class="btn btn-secondary">Enter</button>
            </div>
			</div>
        </form>
		</div>
	  
	  
		
	
	<?php
		}	
	else
	{
		?>
		<form name="deletetopics" accept-charset="utf-8" method="post" action="delete_topics.php">
		
		<?php
		echo "
		<div class=\"bg-faded p-2 my-2\">
        <hr class=\"divider\">
        <h2 class=\"text-center text-lg text-uppercase my-0\">
          <strong>Search Results </strong>
        </h2>
        <hr class=\"divider\">
		";
	
		
		foreach($books as $i => $item) {
			echo "<div class=\"row\">
					<div class=\"col-md-6\">
						<p style=\"text-align:center\">Topic name: ".$books[$i]["topic_name"]."
						</p>
					</div>
				
				";
	echo "
				<div class=\"col-md-2\">
					<input type=\"hidden\" name=\"count\" value=\"".$books[$i]['topic_id']."\">
					<select name=\"availability\" style=\"height:32px\">";
					if($books[$i]['availability']== "YES")
					{
						echo "<option selected value=\"YES\">YES</option>
						<option value=\"NO\">NO</option>";
					}
					else{
						echo "<option value=\"YES\">YES</option>
						<option selected value=\"NO\">NO</option>";
					}
					echo "</select>
					<button name=\"availupdate\" type=\"submit\" class=\"btn btn-secondary\">Delete</button>
				</div>
			</div>
			<hr class=\"divider\">
			";
		}	
		echo "</div>
	</div>";
	}
	
	?>
	
		</form>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>
