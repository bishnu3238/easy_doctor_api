
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(isset($_REQUEST['medicine_name']) && $_REQUEST['medicine_name']!='')
{
    $dd = date('Y-m-d H:i:s');
	
    $medicine_name=$_REQUEST['medicine_name'];
	
	$data2=array();
    $sql_data = mysqli_query($con,'SELECT * FROM ph_medicine_master WHERE medici_name LIKE "%'.$medicine_name.'%"');
    while($row_data=mysqli_fetch_assoc($sql_data)){
		array_push($data2,$row_data);
	}

	    $data['status']="200";
		$data['success']=true;
		$data['medicines']=$data2;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No medicine name Found";
	  
	  echo json_encode($data);
}
