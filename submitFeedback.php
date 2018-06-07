<?php
 
// Create connection
$con=mysqli_connect("localhost","id5194333_limrs","1403537","id5194333_myutar");
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{

	
	$fType = $_POST['fType'];

	if( isset($_POST['fContent']) ){
		$fContent = $_POST['fContent'];
	}
	
	if( isset($_POST['fAttachment']) ){
		$fAttachment = $_POST['fAttachment'];
	}
	
	$uId = $_POST['uId'];
	$dId = $_POST['dId'];

	
	if(isset($_POST['fAttachment']) && isset($_POST['fContent'])){
		echo "1";
		$sql = "INSERT INTO feedback (`fType`, `fContent`, `fAttachment`, `uId`, `dId`) VALUES (".$fType.",'".$fContent."','".$fAttachment."','".$uId."','".$dId."');";

	}else if(isset($_POST['fAttachment']) && !isset($_POST['fContent'])){
		echo "2";
		$sql = "INSERT INTO feedback (`fType`, `fAttachment`, `uId`, `dId`) VALUES (".$fType.",'".$fAttachment."','".$uId."','".$dId."');";

	}else if(!isset($_POST['fAttachment']) && isset($_POST['fContent'])){
		echo "3";
		$sql = "INSERT INTO feedback (`fType`, `fContent`, `uId`, `dId`) VALUES (".$fType.",'".$fContent."','".$uId."','".$dId."');";

	}else if(!isset($_POST['fAttachment']) && !isset($_POST['fContent'])){
		echo "4";
		$sql = "INSERT INTO feedback (`fType`, `uId`, `dId`) VALUES (".$fType.",'".$uId."','".$dId."');";
	}else{

		echo "ERROR";
	}
		
	
	if (mysqli_query($con, $sql)){
		echo "Successfully added into database";

		$newSql = "SELECT * FROM `feedback` WHERE `uId` = '".$uId."' ORDER BY `fId` DESC LIMIT 1";

		if ($result = mysqli_query($con,$newSql)){
			
			$row   = mysqli_fetch_row($result);

			$fId = $row['0'];

			$fResponse = "Feedback submitted to ".$dId;
			$sql2 = "INSERT INTO feedback_response (`fResponse`, `fId`, `dId`) VALUES ('".$fResponse."',".$fId.",'".$dId."');";

			if (mysqli_query($con, $sql2)){

				echo "Successfully added into fr database";
			}else{

				echo "Unsuccessfully added into fr database feedback_response";
			}

		}else{

			echo "Unsuccessfully added into database feedback_response";
		}

	}else{

		echo "Unsuccessfully added into database";
	}
	
	


	
	
}

mysqli_close($con);
?>