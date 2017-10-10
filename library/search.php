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
						  <a class="nav-link text-uppercase text-expanded" href="search">Search Books
						  </a>
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
		if ((isSet($_POST['searchname']) && isSet($_POST['searchby'])) || ((isSet($_GET['searchname']) && isSet($_GET['searchby'])))) 
		{
			if(isSet($_POST['searchname']) && isSet($_POST['searchby']))
			{
				$searchname= $_POST['searchname'];
				$searchby= $_POST['searchby'];
			}
			else{
				$searchname= $_GET['searchname'];
				$searchby= $_GET['searchby'];
			}
			
			if(strcmp($searchby, "name")==0 || strcmp($searchby, "author")==0)
			{
				$q = mysqli_query($conn, "SELECT max(b.book_id) book_id, max(b.name) name,max(b.author)author, max(b.description) description,
										  max(b.availability) availability, max(b.location) location, 
										  case 
										  when max(t.name) = min(t.name) then max(t.name) 
										  else concat(max(t.name), \",\", min(t.name)) 
										  end topic_name, 
										  max(t.shelf_no) shelf_no, max(d.name) dept_name, max(d.lib_floor) lib_floor
										  FROM library.book b 
										  INNER JOIN library.topic_of_book tb ON b.book_id=tb.book_id
										  INNER JOIN library.topic t ON tb.topic_id= t.topic_id
										  INNER JOIN library.department d ON t.dept_no= d.dept_no
										  WHERE b.".$searchby." like '%".$searchname."%'
										  group by b.name");
				$check_user = mysqli_num_rows($q);
				
				$books = array();
				$i= 1;
				if($check_user>0){
					$flag=1;
				}
			}
			elseif(strcmp($searchby, "topic")==0){
				$q = mysqli_query($conn, "SELECT max(b.book_id) book_id, max(b.name) name,max(b.author)author, max(b.description) description,
										  max(b.availability) availability, max(b.location) location, 
										  case 
										  when max(t.name) = min(t.name) then max(t.name) 
										  else concat(max(t.name), \",\", min(t.name)) 
										  end topic_name, 
										  max(t.shelf_no) shelf_no, max(d.name) dept_name, max(d.lib_floor) lib_floor
										  FROM library.book b 
										  INNER JOIN library.topic_of_book tb ON b.book_id=tb.book_id
										  INNER JOIN library.topic t ON tb.topic_id= t.topic_id
										  INNER JOIN library.department d ON t.dept_no= d.dept_no
										  WHERE t.name like '%$searchname%'
										  group by b.name");
				$check_user = mysqli_num_rows($q);
				
				if($check_user>0){
					$flag=1;
				}
			}
			else{
				$q = mysqli_query($conn, "SELECT max(b.book_id) book_id, max(b.name) name,max(b.author)author, max(b.description) description,
										  max(b.availability) availability, max(b.location) location, 
										  case 
										  when max(t.name) = min(t.name) then max(t.name) 
										  else concat(max(t.name), \",\", min(t.name)) 
										  end topic_name, 
										  max(t.shelf_no) shelf_no, max(d.name) dept_name, max(d.lib_floor) lib_floor
										  FROM library.book b 
										  INNER JOIN library.topic_of_book tb ON b.book_id=tb.book_id
										  INNER JOIN library.topic t ON tb.topic_id= t.topic_id
										  INNER JOIN library.department d ON t.dept_no= d.dept_no
										  WHERE d.name like '%$searchname%'
										  group by b.name");
				$check_user = mysqli_num_rows($q);
				
				if($check_user>0){
					$flag=1;
				}
			}
			
			if($flag== 1)
			{
				while ($row = mysqli_fetch_assoc($q)) 
				{
					
					$book_id= $row["book_id"];
					$book_name= $row["name"];
					$book_author= $row["author"];
					$book_description= $row["description"];
					$topic_name= $row["topic_name"];
					$dept_name= $row["dept_name"];
					$availability= $row["availability"];
					$sp= split(",", $row["shelf_no"]);
					$location= "D.".$row["lib_floor"].".".$sp[0].".".$row["location"];
					$books[$i]= array(
						"book_id" => $book_id,
						"book_name" => $book_name,
						"book_author" => $book_author,
						"book_description" => $book_description,
						"topic_name" => $topic_name,
						"dept_name" => $dept_name,
						"availability" => $availability,
						"location" => $location
					);
					$i++;
				}
			}
		}
		else{
			$searchby= "name";
			$searchname= "Name";
		}
	?>
	<div class="container">
	<div class="bg-faded p-2 my-2">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">
          <strong>Search the books</strong>
        </h2>
        <hr class="divider">
        <form accept-charset="utf-8" method="post" action="search.php">
		<?php
			(isset($_POST["searchby"])) ? $sb = $_POST["searchby"] : $sb="name";
			(isset($_POST["searchname"])) ? $sn = $_POST["searchname"] : $sn="Name";	

		?>
          <div class="row">
            <div class="form-group col-lg-4">
              <label class="text-heading">Search</label></br>
              <input name="searchname" type="text" value="<?php echo $searchname; ?>" class="form-control">
            </div>
            <div class="form-group col-lg-4">
              <label class="text-heading">Search By</label></br>
              <select name="searchby" style="height:32px">
				<option <?php if ($searchby == "name" ) echo 'selected' ; ?> value="name">Book Name</option>
				<option <?php if ($searchby == "author" ) echo 'selected' ; ?> value="author">Book Author</option>
				<option <?php if ($searchby == "topic" ) echo 'selected' ; ?> value="topic">Book Topic</option>
				<option <?php if ($searchby == "department" ) echo 'selected' ; ?> value="department">Book Department</option>
			</select>
            </div>
            <div class="form-group col-lg-4">
			  </br>
              <button name="search" type="submit" class="btn btn-secondary">Enter</button>
            </div>
			</div>
        </form>
		</div>
	  
	  
		
	
	<?php 
	if($flag==1)
	{
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
				echo " <img width=\"150\" height=\"200\" src=\"".$url."/library/images/book_no".$books[$i]['book_id'].".jpeg\" />";
			}	 
			else {
				//echo "The file file does not exist".$file;
				echo " <img width=\"150\" height=\"200\" src=\"".$url."/library/images/noimage.png\" />";
			}
		
			echo "
						</div>
					</div>
				<div class=\"col-md-10\">
					<p>Book name:".$books[$i]['book_name']."</p>
					<p>By: ".$books[$i]['book_author']."</p>
					<p>Topics: ".$books[$i]['topic_name']."</p>
					<p>Department: ".$books[$i]['dept_name']."</p>
					<p>Available: ".$books[$i]['availability']."</p>";
			if(strcmp($books[$i]['availability'],"YES")==0)
				echo "<p>Location: ".$books[$i]['location']."</p>";
	echo "
				</div>
			</div>
			<hr class=\"divider\">
			";
		}	
		echo "</div>
	</div>";
	}
	
	?>
	
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>
