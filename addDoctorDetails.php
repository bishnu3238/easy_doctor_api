
<?php 
include('../config/db.php');
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = 62;
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if(isset($_REQUEST['name']) && $_REQUEST['name']!='')
{
    $roomId = generateRandomString();
    $dd = date('Y-m-d H:i:s');
	$sql_block=mysqli_query($con,'INSERT INTO doctor_master SET
    title="Dr",
    doctor_name="'.$_REQUEST['name'].'",
    join_date="'.$_REQUEST['date'].'",
    mobile="'.$_REQUEST['phone'].'",
    password="'.$_REQUEST['phone'].'",
    email="'.$_REQUEST['email'].'",
    image="90104.png",
    room_id="'.$roomId.'",
    date="'.$dd.'"');
    $lastId = mysqli_insert_id($con);

    mysqli_query($con,'INSERT INTO employee_master SET
    user_type="1",
    emp_name="'.$_REQUEST['name'].'",
   job_role="doctor",
    title="Dr",
    user_name="'.$_REQUEST['phone'].'",
    user_psswd="'.$_REQUEST['phone'].'",
    email="'.$_REQUEST['email'].'",
    emp_cnct="'.$_REQUEST['phone'].'",
    doc_id="'.$lastId.'",   
    status="1",
    date="'.$dd.'"');

	
    $sql_data = mysqli_query($con,'SELECT * FROM doctor_master WHERE id="'.$lastId.'"');
    $row_data=mysqli_fetch_assoc($sql_data);

	    $data['status']="200";
		$data['message']="Doctor added successfully!";
		$data['success']=true;
		$data['data']=$row_data;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No Name found";
	  
	  echo json_encode($data);
}
