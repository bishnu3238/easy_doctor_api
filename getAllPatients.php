<?php
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(isset($_REQUEST['doc_id']) && $_REQUEST['doc_id']!='')
{
$dd = date('Y-m-d H:i:s');

$doc_id=$_REQUEST['doc_id'];

$dataa=array();
$dataa2=array();
$dataa3=array();
	$diseases=array();
$tests=array();
$medicines=array();
	
$sql_data = mysqli_query($con,'SELECT * FROM patient_master_opd where status="2" and revisit_status="0" and doctor_id="'.$doc_id.'" ORDER BY id DESC limit 150');
while($row_data=mysqli_fetch_assoc($sql_data)){
array_push($dataa,$row_data);


$sql_data2 = mysqli_query($con,'SELECT * FROM patient_general_info WHERE patient_id="'.$row_data['id'].'"');
while($row_data2=mysqli_fetch_assoc($sql_data2)){
array_push($dataa2,$row_data2);
}

$sql_data22 = mysqli_query($con,'SELECT * FROM patient_past_history WHERE patient_id="'.$row_data['id'].'"');
while($row_data22=mysqli_fetch_assoc($sql_data22)){
array_push($dataa3,$row_data22);
}
	
$sql_data3 = mysqli_query($con,'SELECT * FROM temp_disease WHERE patient_id="'.$row_data['id'].'"');
while($row_data3=mysqli_fetch_assoc($sql_data3)){
array_push($diseases,$row_data3);
}

$sql_data4 = mysqli_query($con,'SELECT * FROM temp_tests WHERE patient_id="'.$row_data['id'].'"');
while($row_data4=mysqli_fetch_assoc($sql_data4)){
array_push($tests,$row_data4);
}

$sql_data5 = mysqli_query($con,'SELECT * FROM temp_medicines WHERE patient_id="'.$row_data['id'].'"');
while($row_data5=mysqli_fetch_assoc($sql_data5)){
array_push($medicines,$row_data5);
}
}




$data['status']="200";
$data['message']="All Patients fetched successfully!";
$data['success']=true;
$data['patients']=$dataa;
$data['general']=$dataa2;
$data['past']=$dataa3;
$data['tests']=$tests;
$data['diseases']=$diseases;
$data['medicines']=$medicines;
echo json_encode($data);

}else{
$data['status']="400";
//
$data['message']="No Doctor Id Found";

echo json_encode($data);
}