

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container" style="border:thin black solid;padding: 5px;margin-top: 10px;">
  <h2 class="text-center bg-dark text-white">ADD PRODUCT</h2>
  
  <form method="POST" enctype="multipart/form-data" onsubmit="return validation()">
  
    <div class="row"> 
      <div class="col-sm-6">
        <label for="product_name"><strong>Product Name</strong></label>
       <center><input type="text" class="form-control" id="product_name"  name="product_name"></center>
     <span id="chkfirst" class="text-danger font-weight-bold"></span>
      </div>
      <div class="col-sm-6">
        <label for="product_price"><strong>Product Price</strong></label>
       <center><input type="number" class="form-control" id="product_price"  name="product_price"></center>
     <!--  <span id="chkfirst" class="text-danger font-weight-bold"></span> -->
      </div>
      <div class="col-sm-6">
        <label for="profilepic"><strong>Image Upload</strong></label>
       <center><input type="file" class="form-control" id="profilepic"  name="profilepic"></center>
     <!--  <span id="chkfirst" class="text-danger font-weight-bold"></span> -->
      </div>
      <div class="col-sm-6">
      <label for="product_category"><strong>Product Category</strong></label>
    <select class="form-control" id="product_category" name="product_category">
      <option>--select category--</option>
     <?php
        include "dbconnection.php";  // Using database connection file here
        $records = mysqli_query($con, "SELECT category_name From add_category");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['category_name'] ."'>" .$data['category_name'] ."</option>";  // displaying data in option menu
        } 
    ?>  
    </select>
      </div>
<hr class="style1">
 <div class="col-sm-12">
  <center><button class="btn btn-warning mt-3 col-sm-3"  name="save">Submit</button></center>
  <a href="index_new.php">Category List</a>
</div>
  </form>
  <br><br>

</div>
<?php
//Databse Connection file
include('dbconnection.php');
if(isset($_POST['save']))
  {
    //getting the post values
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_category=$_POST['product_category'];
    //$email=$_POST['email'];
    //$add=$_POST['address'];
   $filename=$_FILES["profilepic"]["name"];

   $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

   $extensions_arr = array("jpg","png");

   if(in_array($imageFileType,$extensions_arr))
   {
    if(move_uploaded_file($_FILES["profilepic"]["tmp_name"],'profilepics/'.$filename))
    {
      $insert = "INSERT into tbl_product(product_name,product_price,product_category,profilepic)values('$product_name','$product_price','$product_category','$filename')";

      if(mysqli_query($con,$insert))
      {
        echo '<div class="alert alert-success">
    <strong>Success!</strong>Data submitted Successfully!
    </div>';
      }
      else
      {
        echo "error";
      }
    }else
      {
        echo "error in uplosding";
      }
    }
   }

?>
</body>
</html>
<script type="text/javascript">
  function validation()
  {
    var prod_name = document.getElementById('product_name').value;
    var checkfirst = /^[A-Za-z. ]{3,30}$/ ;



    if(checkfirst.test(prod_name))
    {
      document.getElementById('chkfirst').innerHTML = " ";

    }else
    {
      document.getElementById('chkfirst').innerHTML = " ****Product Name is invalid***";
      return false;
    }
  }
</script>