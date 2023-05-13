
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(isset($_REQUEST['doc_id']) && $_REQUEST['doc_id']!='')
{
    $dd = date('Y-m-d H:i:s');
	
    $doc_id=$_REQUEST['doc_id'];

	$data2=array();
    $sql_data = mysqli_query($con,'SELECT * FROM patient_master_opd where doctor_id="'.$doc_id.'" and status="1" or revisit_status="1"  
     ORDER BY id DESC limit 150');
    while($row_data=mysqli_fetch_assoc($sql_data)){
		array_push($data2,$row_data);
	}

	    $data['status']="200";
		$data['message']="Current Patients fetched successfully!";
		$data['success']=true;
		$data['patients']=$data2;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No Doctor Id Found";
	  
	  echo json_encode($data);
}
