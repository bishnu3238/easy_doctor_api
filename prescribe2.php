
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='')
{
    $dd = date('Y-m-d H:i:s');
  
	$sql_block=mysqli_query($con,'INSERT INTO temp_tests SET
    patient_id="'.$_REQUEST['patient_id'].'",
    test_type="'.$_REQUEST['test_type'].'",
    test_id="'.$_REQUEST['test_id'].'",
    test_name="'.$_REQUEST['test_name'].'",
    files="'.$_REQUEST['files'].'",
    dated="'.$_REQUEST['date'].'"');

    mysqli_query($con,'INSERT INTO temp_medicines SET
    patient_id="'.$_REQUEST['patient_id'].'",
    medicine_id="'.$_REQUEST['medicine_id'].'",
    medici_name="'.$_REQUEST['medici_name'].'",
    alternative_medicine="'.$_REQUEST['alternative_medicine'].'",
    strength="'.$_REQUEST['strength'].'",
    unit="'.$_REQUEST['unit'].'",
    method="'.$_REQUEST['method'].'",
    consume_session="'.$_REQUEST['consume_session'].'",
    consume_time="'.$_REQUEST['consume_time'].'",
    per_day_use="'.$_REQUEST['per_day_use'].'",
    number_of_days="'.$_REQUEST['number_of_days'].'",
    medicine_qty="'.$_REQUEST['medicine_qty'].'",
    dated="'.$_REQUEST['date'].'"');

    mysqli_query($con,'UPDATE patient_past_history SET
    advise="'.$_REQUEST['advise'].'" WHERE patient_id="'.$_REQUEST['patient_id'].'"');

mysqli_query($con,'UPDATE patient_master_opd SET
status="2" WHERE id="'.$_REQUEST['patient_id'].'"');


	    $data['status']="200";
		$data['message']="Patient Data inserted successfully!";
		$data['success']=true;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No patient id found";
	  
	  echo json_encode($data);
}
