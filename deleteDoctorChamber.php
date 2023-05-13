
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if(isset($_REQUEST['chamber_id']) && $_REQUEST['chamber_id']!='')
{
    $chamber_id=$_REQUEST['chamber_id'];
    

    mysqli_query($con,'DELETE FROM doctor_chamber_timings 
    WHERE chamber_id="'.$chamber_id.'"');

   


mysqli_query($con,'DELETE FROM doctor_chambers 
WHERE id="'.$chamber_id.'"');



	    $data['status']="200";
		$data['message']="Doctor chamber deleted successfully!";
		$data['success']=true;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No chamber id found";
	  
	  echo json_encode($data);
}
