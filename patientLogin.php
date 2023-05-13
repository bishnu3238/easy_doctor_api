<?php
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
?>
<?php

if(isset($_REQUEST['username']) && $_REQUEST['username']!='' && isset($_REQUEST['password']) && $_REQUEST['password']!='')
{
    $username=$_REQUEST['username'];    
    $password=$_REQUEST['password'];
	$patientData = array();
    $sql=mysqli_query($con,'SELECT * FROM employee_master WHERE user_name="'.$username.'"');
    if(mysqli_num_rows($sql)>0){
        $sql2=mysqli_query($con,'SELECT * FROM employee_master WHERE user_name="'.$username.'" and user_psswd="'.$password.'" and job_role="patient" order by emp_id desc');
		
        if(mysqli_num_rows($sql2)>0){
            while($row2=mysqli_fetch_assoc($sql2)){
//				array_push($doctorData,$row2);
            $sql3=mysqli_query($con,'SELECT * FROM patient_master_opd WHERE id="'.$row2['user_id'].'" ');
			  while($row3=mysqli_fetch_assoc($sql3)){
				array_push($patientData,$row3);
			}
           
			}
            $data['status']="200";
            $data['message']="Patient Login Successful!";
            $data['success']=true;
            $data['patientData']=$patientData;
            echo json_encode($data);

        }else{
            $data['status']="400";
	  
            $data['message']="Password is incorrect!";
            
            echo json_encode($data);
        }
        
    }else{
        $data['status']="400";
	  
        $data['message']="Patient Doesn't Exist";
        
        echo json_encode($data);
    }
}else{
    $data['status']="400";
	  
    $data['message']="No username or password found";
    
    echo json_encode($data);
}

//echo json_encode($user_details);
?>