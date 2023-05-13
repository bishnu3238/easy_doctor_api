
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(isset($_REQUEST['test_name']) && $_REQUEST['test_name']!='')
{
    $dd = date('Y-m-d H:i:s');
	

    $test_name=$_REQUEST['test_name'];

	$data2=array();
	$data3=array();
	$data4=array();
	$data5=array();
    $sql_data = mysqli_query($con,'SELECT * FROM blood_master WHERE sub_type LIKE "%'.$test_name.'%"');
    while($row_data=mysqli_fetch_assoc($sql_data)){
		array_push($data2,$row_data);
	}

    
    $sql_data2 = mysqli_query($con,'SELECT * FROM stool_master WHERE sub_type LIKE "%'.$test_name.'%"');
      while($row_data2=mysqli_fetch_assoc($sql_data2)){
		array_push($data3,$row_data2);
	}
    $sql_data3 = mysqli_query($con,'SELECT * FROM imageing_master WHERE sub_type LIKE "%'.$test_name.'%"');
      while($row_data3=mysqli_fetch_assoc($sql_data3)){
		array_push($data4,$row_data3);
	}    
    $sql_data4 = mysqli_query($con,'SELECT * FROM special_master WHERE sub_type LIKE "%'.$test_name.'%"');
      while($row_data4=mysqli_fetch_assoc($sql_data4)){
		array_push($data5,$row_data4);
	}
	    $data['status']="200";
		$data['success']=true;
		$data['blood_tests']=$data2;
		$data['special_tests']=$data5;
		$data['stool_tests']=$data3;
		$data['imageing_tests']=$data4;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No test_name Found";
	  
	  echo json_encode($data);
}
