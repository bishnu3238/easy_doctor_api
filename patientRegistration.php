
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(isset($_REQUEST['name']) && $_REQUEST['name']!='')
{
    $dd = date('Y-m-d H:i:s');
	$sql_block=mysqli_query($con,'INSERT INTO pre_registration SET
    doc_chamber_id="'.$_REQUEST['chamber_id'].'",
    pati_name="'.$_REQUEST['name'].'",
    age_years="'.$_REQUEST['age_years'].'",
    age_mon="'.$_REQUEST['age_month'].'",
    age_days="'.$_REQUEST['age_days'].'",
    gender="'.$_REQUEST['gender'].'",
    mobile="'.$_REQUEST['mobile'].'",
    disease_id="'.$_REQUEST['diagnosis'].'",
    pin_code="'.$_REQUEST['pincode'].'",
    payment_mode="'.$_REQUEST['payment_type'].'",
    refer_type="'.$_REQUEST['refer_type'].'",
    date="'.$_REQUEST['date'].'",
    time="'.$_REQUEST['time'].'"
    ');

    $sql_block2=mysqli_query($con,'INSERT INTO patient_master_opd SET
    doctor_id="'.$_REQUEST['refer_id'].'",
    pati_name="'.$_REQUEST['name'].'",
    age_years="'.$_REQUEST['age_years'].'",
    age_mon="'.$_REQUEST['age_month'].'",
    age_days="'.$_REQUEST['age_days'].'",
    gender="'.$_REQUEST['gender'].'",
    mobile="'.$_REQUEST['mobile'].'",
    disease_id="'.$_REQUEST['diagnosis'].'",
    doc_id="'.$_REQUEST['refer_id'].'",
    pin_code="'.$_REQUEST['pincode'].'",
    payment_mode="'.$_REQUEST['payment_type'].'",
    chamber_id="'.$_REQUEST['chamber_id'].'",
    status="1",
    date="'.$_REQUEST['date'].'",
    time="'.$_REQUEST['time'].'"
    ');
    $last_id = mysqli_insert_id($con);

    $sql_block2=mysqli_query($con,'INSERT INTO employee_master SET
                        user_type="2",
                         emp_name="'.$_REQUEST['name'].'",
                        job_role="patient",
                        user_name="'.$_REQUEST['mobile'].'",
                        user_psswd="'.$_REQUEST['mobile'].'",
                        emp_cnct="'.$_REQUEST['mobile'].'",
                        status="1",
                        user_id="'.$last_id.'",
                        doc_id="'.$_REQUEST['refer_id'].'",
                        date="'.$_REQUEST['date'].'"
    ');

    

	    $data['status']="200";
		$data['message']="Successfully added patient!";
		$data['success']=true;
		$data['patient_id']=$last_id;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No Patient Name Founc";
	  
	  echo json_encode($data);
}
