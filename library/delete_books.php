<!DOCTYPE html>
<html lang="en" >

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
						  <a class="nav-link text-uppercase text-expanded" href="delete_books">
						  Remove Book</a>
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
					echo '<a class="nav-link text-uppercase text-expanded" href="logout">Logout</a>';
				}
				else
				{
					echo '<a class="nav-link text-uppercase text-expanded" href="login">Login</a>';
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
			$q = mysqli_query($conn, "DELETE FROM library.book where book_id= ".$_POST['count'] ) ;
			$q = mysqli_query($conn, "DELETE from library.book_addition_history where book_id=".$_POST['count'] ) ;
			$q = mysqli_query($conn, "DELETE from library.topic_of_book where book_id=".$_POST['count'] ) ;
			$flag=3;
		}
		if(isSet($_POST['searchname']) && isSet($_POST['searchauthor']) && $_POST['searchname']!= "" && $_POST['searchauthor']!= "")
		{
			$aut= $_POST['searchauthor'];
			$q = mysqli_query($conn, "SELECT * from library.book where name like \"%".$_POST['searchname']."%\" and author like \"%".$aut."%\" limit 1" ) ;
			$check_user = mysqli_num_rows($q);
			$i=1;
			if($check_user>0)
			{
				$flag=1;
				while ($row = mysqli_fetch_assoc($q)) 
				{
					
					$book_id= $row["book_id"];
					$book_name= $row["name"];
					$book_author= $row["author"];
					$availability= $row["availability"];
					$books[$i]= array(
						"book_id" => $book_id,
						"book_name" => $book_name,
						"book_author" => $book_author,
						"availability" => $availability
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
          <strong>Search the books</strong>
        </h2>
        <hr class="divider">
		
        <form name="search_by_name1" accept-charset="utf-8" method="post" action="delete_books.php">
		<?php
			(isset($_POST["searchname"])) ? $sb = $_POST["searchname"] : $sb="name";
			(isset($_POST["searchauthor"])) ? $sa = $_POST["searchauthor"] : $sa="author";			

		?>
          <div class="row">
		   <?php
			if($flag==2)
			{
				echo'
					<div class="form-group col-lg-4">
					</div>
					<div class="form-group col-lg-4">
						<label class="text-heading" style="color:red">Book not found</label>
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
              <label class="text-heading">Enter book name</label></br>
              <input name="searchname" type="text" value="<?php echo $sb; ?>" class="form-control">
            </div>
			<div class="form-group col-lg-4">
              <label class="text-heading">Enter book author</label></br>
              <input name="searchauthor" type="text" value="<?php echo $sa; ?>" class="form-control">
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
		<form name="deletebooks" accept-charset="utf-8" method="post" action="delete_books.php">
		
		<?php
		echo "
		<div class=\"bg-faded p-2 my-2\">
        <hr class=\"divider\">
        <h2 class=\"text-center text-lg text-uppercase my-0\">
          <strong>Search Results of books having $searchby \"$searchname\"</strong>
        </h2>
        <hr class=\"divider\">
		";
	
		
		foreach($books as $i => $item) {
			echo "
				<div class=\"row\">
					<div class=\"col-md-2\">
						<div class=\"imgAbt\">";
			$file= "images/book_no".$books[$i]['book_id'].".jpeg";
			if (file_exists($file)) {
				echo " <img width=\"150\" height=\"200\" src=\"http://localhost/library/images/book_no".$books[$i]['book_id'].".jpeg\" />";
			}	 
			else {
				//echo "The file file does not exist".$file;
				echo " <img width=\"150\" height=\"200\" src=\"http://localhost/library/images/noimage.png\" />";
			}
		
			echo "
						</div>
					</div>
				<div class=\"col-md-8\">
					<p>Book name:".$books[$i]['book_name']."</p>
					<p>By: ".$books[$i]['book_author']."</p>";
	echo "
				</div>
				<div class=\"col-md-2\">
				<p>Delete</p></br>
					<input type=\"hidden\" name=\"count\" value=\"".$books[$i]['book_id']."\">
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
