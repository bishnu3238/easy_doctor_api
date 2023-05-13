
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if(isset($_REQUEST['doctor_id']) && $_REQUEST['doctor_id']!='')
{
    $dd = date('Y-m-d H:i:s');
  
	

    mysqli_query($con,'UPDATE doctor_master SET
    bank_name="'.$_REQUEST['bank'].'" WHERE id="'.$_REQUEST['doctor_id'].'"');



	    $data['status']="200";
		$data['message']="Doctor bank updated successfully!";
		$data['success']=true;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No patient id found";
	  
	  echo json_encode($data);
}
