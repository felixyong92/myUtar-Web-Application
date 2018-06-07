<?php
 
// Create connection
//$con=mysqli_connect("localhost","id2368302_leeus","111111","id2368302_fyp");
$con=mysqli_connect("localhost","root","","id2368302_fyp");
mysqli_set_charset( $con, 'utf8');

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{

	// $fResponse = "Feedback Reopened"."\n"." Reason : " ."sdsadsd";
	

	$fId = $_POST['fId'];
	$rating = $_POST['rating'];
	$dId = $_POST['dId'];
	$uId = $_POST['uId'];

	if( isset($_POST['reason']) ){
		$reason = $_POST['reason'];
		$fResponse = "Feedback Reopened"."\n"."Reason : " .$reason;
	}else{
		$fResponse = "Feedback Closed."."\n"."Rating : " .$rating;
	}
	
	
	
	if(isset($_POST['reason'])){
		
		$sql1 = "INSERT INTO feedback_response (`fResponse`, `fId`, `dId`) VALUES ('".$fResponse."',".$fId.",'".$dId."');";
		$sql2 = "UPDATE feedback SET `fStatus` = 3 WHERE `fId`=".$fId;
		$sql3 = "INSERT INTO satisfaction (`sReason`, `sType`, `uId`, `fId`) VALUES ('".$reason."',".$rating.",'".$uId."',".$fId.");";

	}else if(!isset($_POST['reason'])){
		
		$sql1 = "INSERT INTO feedback_response (`fResponse`, `fId`, `dId`) VALUES ('".$fResponse."',".$fId.",'".$dId."');";
		$sql2 = "UPDATE feedback SET `fStatus` = 4 WHERE `fId`=".$fId;
		$sql3 = "INSERT INTO satisfaction (`sType`, `uId`, `fId`) VALUES (".$rating.",'".$uId."',".$fId.");";

	}else{

		echo "ERROR";
	}
		
	
	if (mysqli_query($con, $sql1)){

		echo "Successfully added into database\n";

		if (mysqli_query($con, $sql2)){
			echo "Successfully update feedback status\n";

			if (mysqli_query($con, $sql3)){

				echo "Successfully added into Satisfactory\n";

			}else{

					echo "Unsuccessfully added into Satisfactory\n";
			}

		}else{

			echo "Unsuccessfully update feedback status\n";
		}

	}else{

		echo "Unsuccessfully added into database\n";
	}
	
	echo $sql1;
	echo $sql2;
	echo $sql3;



	
	
}

mysqli_close($con);
?>