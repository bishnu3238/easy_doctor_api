
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


    $dd = date('Y-m-d H:i:s');
	
$data2=array();

    $sql_data = mysqli_query($con,'SELECT * FROM disease_master');
    while($row_data=mysqli_fetch_assoc($sql_data)) {
        array_push($data2,$row_data);
	}
	    $data['status']="200";
		$data['message']="Disease fetched successfully!";
		$data['success']=true;
		$data['diseases']=$data2;
		echo json_encode($data);
		

