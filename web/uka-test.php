<?php include "../ui/html/header.php"?>


    <link href="../ui/static/form-search.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">


<?php 
   
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$term = $_POST['term'];
	echo "You searched for " . var_dump($_POST);
}else { ?>
	<form action="uka-test.php" method="POST">
	Search for: <input type="text" name="term">
	<input type="text" name="xd">
	<input type="submit" value="search">
	</form> 
<?php } ?> 