
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if(isset($_REQUEST['doctor_id']) && $_REQUEST['doctor_id']!='')
{
	
	    $docChamberDetails = json_decode($_REQUEST['docChamberDetails'], true);

   // $docChamberDetails=$_REQUEST['docChamberDetails'];
    $chamber_id=$_REQUEST['chamber_id'];
    $doctor_id=$_REQUEST['doctor_id'];
    $dd = date('Y-m-d H:i:s');
    foreach($docChamberDetails as $test) {

	$sql_block=mysqli_query($con,'UPDATE doctor_chambers SET
    doctor_id="'.$doctor_id.'",
    chamber_name="'.$test['chamber_name'].'",         
    address="'.$test['address'].'",   
    pincode="'.$test['pincode'].'",
    fee="'.$test['fee'].'",
    dated="'.$dd.'"  WHERE id="'.$chamber_id.'"');

    mysqli_query($con,'DELETE FROM doctor_chamber_timings 
    WHERE chamber_id="'.$chamber_id.'"');

    foreach($test['timing'] as $timing) {

    mysqli_query($con,'INSERT INTO doctor_chamber_timings SET
    doc_id="'.$doctor_id.'",
    chamber_id="'.$chamber_id.'",        
    from_time="'.$timing['from_time'].'",
    to_time="'.$timing['to_time'].'",
    days="'.$timing['days'].'",
    status="1",
    date="'.$dd.'"');

    }
}

	    $data['status']="200";
		$data['message']="Doctor chamber updated successfully!";
		$data['success']=true;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No doctor id found";
	  
	  echo json_encode($data);
}
