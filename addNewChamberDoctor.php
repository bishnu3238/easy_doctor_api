
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if(isset($_REQUEST['doctor_id']) && $_REQUEST['doctor_id']!='')
{
    $docChamberDetails=$_REQUEST['docChamberDetails'];
    $doctor_id=$_REQUEST['doctor_id'];
    $dd = date('Y-m-d H:i:s');
    foreach($docChamberDetails as $test) {

	$sql_block=mysqli_query($con,'INSERT INTO doctor_chambers SET
    doctor_id="'.$doctor_id.'",
    chamber_name="'.$test['chamberName'].'",         
    address="'.$test['address'].'",
    pincode="'.$test['pincode'].'",
    fee="'.$test['fee'].'",
    dated="'.$dd.'"');

    $chamberId = mysqli_insert_id($con);
    foreach($test['timing'] as $timing) {

    mysqli_query($con,'INSERT INTO doctor_chamber_timings SET
    doc_id="'.$doctor_id.'",
    chamber_id="'.$chamberId.'",        
    from_time="'.$timing['openingTime'].'",
    to_time="'.$timing['closingTime'].'",
    days="'.$timing['days'].'",
    status="1",
    date="'.$dd.'"');
    }
}


	    $data['status']="200";
		$data['message']="Doctor chamber added successfully!";
		$data['success']=true;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No doctor id found";
	  
	  echo json_encode($data);
}
