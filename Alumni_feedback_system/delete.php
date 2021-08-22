

<?php
// Process delete operation after confirmation
if(isset($_POST["regd"]) && !empty($_POST["regd"]))
{
   // Include config file
   require_once "config.php";

   // Prepare a delete statement
   $sql = "DELETE FROM student_details WHERE regdno = ?";

   if($stmt = $mysqli->prepare($sql))
   {
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("i", $param_regd);

      // Set parameters
      $param_regd = trim($_POST["regd"]);

      // Attempt to execute the prepared statement
      if($stmt->execute())
      {
         // Records deleted successfully. Redirect to landing page
         header("location: studentdatabase.php");
         exit();
      }
      else
      {
         echo "Oops! Something went wrong. Please try again later.";
      }
   }
     // Close statement
     $stmt->close();
     // Close connection
     $mysqli->close(); 
} 
else
{
   // Check existence of regd parameter
   if(empty($_GET["regd"]))
   {
      // URL doesn't contain regd parameter. Redirect to error page
      header("location: error.php");
      exit();
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Record</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
.wrapper{
width: 500px;
margin: 0 auto;
}
</style>
</head>
<body>
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">

<div class="page-header">
<h1>Delete Record</h1>
</div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="alert alert-danger fade in">
<input type="hidden" name="regd" value="<?php echo trim($_GET["regd"]); ?>"/>

<p>Are you sure you want to delete this record?</p><br/>

<p>
<input type="submit" value="Yes" class="btn btn-danger">
<a href="studentdatabase.php" class="btn btn-default">No</a>
</p>
</div>
</form>
</div>
</div>        
</div>
</div>
</body>
</html>