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
	$doctorData = array();
	$doctorChamberData = array();
	$chamberTimings = array();
    $onlineTimings = array();
    $sql=mysqli_query($con,'SELECT * FROM doctor_master WHERE mobile="'.$username.'"');
    if(mysqli_num_rows($sql)>0){
        $sql2=mysqli_query($con,'SELECT * FROM doctor_master WHERE mobile="'.$username.'" and password="'.$password.'" order by id desc');
        if(mysqli_num_rows($sql2)>0){
            while($row2=mysqli_fetch_assoc($sql2)){
				array_push($doctorData,$row2);
            $sql3=mysqli_query($con,'SELECT * FROM doctor_chambers WHERE doctor_id="'.$row2['id'].'" ');
			  while($row3=mysqli_fetch_assoc($sql3)){
				array_push($doctorChamberData,$row3);
			}
				//echo 'SELECT * FROM doctor_chamber_timings WHERE doc_id="'.$row2['id'].'" ';
            $sql4=mysqli_query($con,'SELECT * FROM doctor_chamber_timings WHERE doc_id="'.$row2['id'].'" ');
	  while($row4=mysqli_fetch_assoc($sql4)){
				array_push($chamberTimings,$row4);
			}

            // text code
            $sql5 = mysqli_query($con, 'SELECT * FROM doctor_online_timings WHERE doc_id ="'.$row2['id'].'"');
            while($row5=mysqli_fetch_assoc($sql5)){
                array_push($onlineTimings, $row5);
            }


            //


			}
            $data['status']="200";
            $data['message']="Doctor Login Successful!";
            $data['success']=true;
            $data['doctorData']=$doctorData;
            $data['chamberData']=$doctorChamberData;
            $data['chamberTimings']=$chamberTimings;
            $data['onlineTimings']=$onlineTimings;
            echo json_encode($data);

        }else{
            $data['status']="400";
	  
            $data['message']="Password is incorrect!";
            
            echo json_encode($data);
        }
        
    }else{
        $data['status']="400";
	  
        $data['message']="User Doesn't Exist";
        
        echo json_encode($data);
    }
}else{
    $data['status']="400";
	  
    $data['message']="No username or password found";
    
    echo json_encode($data);
}

//echo json_encode($user_details);
?>