<?php
include('../../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
?>
<?php


	$doctorData = array();
	$doctorChamberData = array();
	$chamberTimings = array();

	$sql_data = mysqli_query($con,'SELECT * FROM doctor_master');
    while($row_data=mysqli_fetch_assoc($sql_data)) {
        array_push($doctorData,$row_data);
	}
	$sql3=mysqli_query($con,'SELECT * FROM doctor_chambers');
	while($row3=mysqli_fetch_assoc($sql3)){
	  array_push($doctorChamberData,$row3);
  }
	$sql4=mysqli_query($con,'SELECT * FROM doctor_chamber_timings  ');
	while($row4=mysqli_fetch_assoc($sql4)){
			  array_push($chamberTimings,$row4);
		  }

		  $data['status']="200";
		  $data['message']="Doctor Login Successful!";
		  $data['success']=true;
		  $data['doctorData']=$doctorData;
		  $data['chamberData']=$doctorChamberData;
		  $data['chamberTimings']=$chamberTimings;
		  echo json_encode($data);


// echo json_encode($user_details);
?>