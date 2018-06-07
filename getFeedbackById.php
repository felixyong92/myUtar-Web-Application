<?php
 
// Create connection
$con=mysqli_connect("localhost","id5194333_limrs","1403537","id5194333_myutar");
mysqli_set_charset( $con, 'utf8');

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
// This SQL statement selects ALL from the table 'Locations'
$sql = "SELECT `fStatus` FROM feedback where `fId`=".$_GET['fId'];
 

if ($result = mysqli_query($con,$sql)){
 
	// Loop through each row in the result set
	$row = $result->fetch_object();
	
		// Add each row into our results array
		
 
	// Finally, encode the array to JSON and output the results
	echo json_encode($row);
}
 
// Close connections
mysqli_close($con);
?>