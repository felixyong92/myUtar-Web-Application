<?php
 
// Create connection
$con=mysqli_connect("localhost","id5194333_limrs","1403537","id5194333_myutar");
mysqli_set_charset( $con, 'utf8');
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
$date = $_GET['date'];
// This SQL statement selects ALL from the table 'Locations'
$sql = "SELECT * FROM event WHERE `expiryDate` LIKE '%".$date."%' ORDER BY `expiryDate` ASC";
 

// Check if there are results
if ($result = mysqli_query($con, $sql))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$resultArray = array();
	$resultArray["event"] = array();
	$tempArray = array();
 
	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($resultArray["event"], $tempArray);
	}
 
	// Finally, encode the array to JSON and output the results
	echo json_encode($resultArray);
}
 
// Close connections
mysqli_close($con);
?>