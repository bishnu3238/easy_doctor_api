
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if(isset($_REQUEST['patient_id']) && $_REQUEST['patient_id']!='')
{
    $dd = date('Y-m-d H:i:s');
    if($_REQUEST['past_history']!=''){
        $past_history2= base64_encode($_REQUEST['past_history']);
    }
	$sql_block=mysqli_query($con,'INSERT INTO patient_general_info SET
    patient_id="'.$_REQUEST['patient_id'].'",
    bp="'.$_REQUEST['bp'].'",
    weight="'.$_REQUEST['weight'].'",
    height="'.$_REQUEST['height'].'",
    tempreature="'.$_REQUEST['temp'].'",
    oxyzen="'.$_REQUEST['oxygen'].'",
    pulse="'.$_REQUEST['pulse'].'",
    dated="'.$_REQUEST['date'].'"');

    mysqli_query($con,'INSERT INTO temp_disease SET
    patient_id="'.$_REQUEST['patient_id'].'",
    disease_id="'.$_REQUEST['disease_id'].'",
    disease_name="'.$_REQUEST['disease_name'].'",
    disease_desc="'.$_REQUEST['disease_desc'].'",
    dated="'.$_REQUEST['date'].'"');
	

        move_uploaded_file($_FILES["image"]["tmp_name"], "../doctor/uploads/past_history/" . $_FILES["image"]["name"]);

        $filelocation = $_FILES["image"]["name"];

        $size = ($_FILES["image"]["size"]/1024).' kB';
	
	
    mysqli_query($con,'INSERT INTO patient_past_history SET
    patient_id="'.$_REQUEST['patient_id'].'",
    past_history="'.$past_history2.'",
	past_file="'.$filelocation.'",
    dated="'.$_REQUEST['date'].'"');


	    $data['status']="200";
		$data['message']="Patient Data inserted successfully!";
		$data['success']=true;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No patient id found";
	  
	  echo json_encode($data);
}
?>