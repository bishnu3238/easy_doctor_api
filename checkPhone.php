<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(isset($_REQUEST['phone']) && $_REQUEST['phone']!='')
{
	$sql_block=mysqli_query($con,'SELECT * FROM employee_master WHERE emp_cnct="'.$_REQUEST['phone'].'" and job_role="doctor"');
	if(mysqli_num_rows($sql_block)>0)
	{

	    $data['status']="200";
		$data['message']="Doctor found!";
		$data['success']=true;
		echo json_encode($data);
		}else{
			$data['status']="400";
	  	  	$data['message']="No doctor found!";
				$data['success']=true;

	  	  	echo json_encode($data);
		}
}else{
 $data['status']="400";
	  
	  $data['message']="Please Enter Phone No";
					$data['success']=false;

	  
	  echo json_encode($data);
}
