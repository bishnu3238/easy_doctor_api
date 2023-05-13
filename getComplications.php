
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(isset($_REQUEST['disease_name']) && $_REQUEST['disease_name']!='')
{
    $dd = date('Y-m-d H:i:s');
	

    $disease_name=$_REQUEST['disease_name'];
	$data2=array();
    $sql_data = mysqli_query($con,'SELECT * FROM disease_master WHERE dise_name LIKE "%'.$disease_name.'%"');
    while($row_data=mysqli_fetch_assoc($sql_data)) {
        array_push($data2,$row_data);
	}
	    $data['status']="200";
		$data['success']=true;
		$data['diseases']=$data2;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No disease_name Found";
	  
	  echo json_encode($data);
}
