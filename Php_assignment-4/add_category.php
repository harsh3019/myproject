<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container" style="border:thin black solid;padding: 5px;margin-top: 10px;">
  <h2 class="text-center bg-dark text-white">ADD CATEGORY</h2>
  
  <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>" onsubmit="return validation()">
  
    <div class="row"> 
      <div class="col-sm-6">
        <label for="category_name"><strong>Category Name</strong></label>
       <center><input type="text" class="form-control" id="category_name"  name="category_name"></center>
     <!--  <span id="chkfirst" class="text-danger font-weight-bold"></span> -->
      </div>
       <div class="col-sm-12">
  <center><button class="btn btn-warning mt-3 col-sm-3"  name="save">Submit</button></center>
  <a href="category_save.php">Category List</a>
</div>
  </form>
  <br><br>

</div>
<?php
include('dbconnection.php');
if(isset($_POST['save']))
{
	$category_name = $_POST['category_name'];
	$sql = "INSERT INTO add_category (category_name) VALUES ('$category_name')";

	if(mysqli_query($con,$sql))
	{
		echo '<div class="alert alert-success">
		<strong>Success!</strong>Data submitted Successfully!
		</div>';
	}
	else
	{
		echo "Error: " .$sql ."".mysqli_error($con);
	}
	mysqli_close($con);
}
?>
</body>
</html>
<script type="text/javascript">
	function validation()
	{
		var cat_name = document.getElementById('category_name').value;
		var checkfirst = /^[A-Za-z. ]{3,30}$/ ;



		if(checkfirst.test(cat_name))
		{
			document.getElementById('chkfirst').innerHTML = " ";

		}else
		{
			document.getElementById('chkfirst').innerHTML = " ****Category Name is invalid***";
			return false;
		}
	}
</script>