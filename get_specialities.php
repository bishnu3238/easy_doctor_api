
<?php 
include('../../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


    $dd = date('Y-m-d H:i:s');
	
$data2=array();

    $sql_data = mysqli_query($con,'SELECT * FROM doctor_department');
    while($row_data=mysqli_fetch_assoc($sql_data)) {
        array_push($data2,$row_data);
	}
	    $data['status']="200";
		$data['message']="specialitites fetched successfully!";
		$data['success']=true;
		$data['specialist']=$data2;
		echo json_encode($data);
		

