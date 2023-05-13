
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if(isset($_REQUEST['docId']) && $_REQUEST['docId']!='')
{
	
	  move_uploaded_file($_FILES["image"]["tmp_name"], "../doctor/uploads/doctor_images/" . $_FILES["image"]["name"]);

        $filelocation = $_FILES["image"]["name"];

        $size = ($_FILES["image"]["size"]/1024).' kB';
	
	
	
    $dd = date('Y-m-d H:i:s');
	$sql_block=mysqli_query($con,'UPDATE doctor_master SET
    address="'.$_REQUEST['address'].'",
    pincode="'.$_REQUEST['pincode'].'",
    city="'.$_REQUEST['city'].'",
    state="'.$_REQUEST['state'].'",
    regn_no="'.$_REQUEST['registrationNo'].'",
    qulifica="'.$_REQUEST['qualification'].'",
    about_doctor="'.$_REQUEST['about'].'",
    department="'.$_REQUEST['department'].'",
    status="'.$_REQUEST['isVerified'].'",
	accept_online="'.$_REQUEST['onlineStatus'].'",
    bank_name="'.$_REQUEST['bankName'].'",
    account_no="'.$_REQUEST['accountNo'].'",
    ifsc_code="'.$_REQUEST['ifscCode'].'",
    branch_code="'.$_REQUEST['branchName'].'",
    image="'.$filelocation.'" WHERE id="'.$_REQUEST['docId'].'"
    ');

	// Insert data into doctor_chambers table
    $docChamberDetails = json_decode($_REQUEST['docChamberDetails'], true);
   
   // for($i=0;$i<count($docChamberDetails);$i++) {
        
     //   $test = $_REQUEST['docChamberDetails'][$i];
//mysqli_query('INSERT INTO doctor_chambers SET
   //     doctor_id="'.$_REQUEST['docId'].'",
    //    chamber_name="'.$_REQUEST['docChamberDetails'][$i]['chamberName'].'",           
     //   address="'.$_REQUEST['docChamberDetails'][$i]['address'].'",           
     //   pincode="'.$_REQUEST['docChamberDetails'][$i]['pincode'].'",           
     //   fee="'.$_REQUEST['docChamberDetails'][$i]['fee'].'",           
     //   dated="'.$dd.'"
    //    ');

    //        $chamberId = mysqli_insert_id($con);    
   // for($j=0;$j<len($test['timing']);$j++) {
    //    mysqli_query('INSERT INTO doctor_chamber_timings SET
//doc_id="'.$_REQUEST['docId'].'",
//chamber_id="'.$chamberId.'",           
//from_time="'.$test['timing'][$j]['openingTime'].'",  
//to_time="'.$test['timing'][$j]['closingTime'].'",  
//days="'.$test['timing'][$j]['days'].'",  
//status="1",
//date="'.$dd.'"
//')    
//}
//}
	
	//if(empty($docChamberDetails)){
//	}else{

	 for($i=0;$i<count($docChamberDetails);$i++) {
        
        $test = $docChamberDetails[$i];
        mysqli_query($con, 'INSERT INTO doctor_chambers SET
        doctor_id="'.$_REQUEST['docId'].'",
        chamber_name="'.$test['chamberName'].'",           
        address="'.$test['address'].'",           
        pincode="'.$test['pincode'].'",           
        fee="'.$test['fee'].'",           
        dated="'.$dd.'"
        ');

        $chamberId = mysqli_insert_id($con);    

        // Insert data into doctor_chamber_timings table
        for($j=0;$j<count($test['timing']);$j++) {
            mysqli_query($con, 'INSERT INTO doctor_chamber_timings SET
            doc_id="'.$_REQUEST['docId'].'",
            chamber_id="'.$chamberId.'",           
            from_time="'.$test['timing'][$j]['openingTime'].'",  
            to_time="'.$test['timing'][$j]['closingTime'].'",  
            days="'.$test['timing'][$j]['days'].'",  
            status="1",
            date="'.$dd.'"
            ');
        }
    }
	
	//}
	
	
	// Insert data into doctor_chambers table

    //$docOnlineDetails = json_decode($_REQUEST['docOnlineDetails'], true);
	       $docOnlineDetails = json_decode($_REQUEST['docOnlineDetails'], true);


	 //  if(empty($docOnlineDetails)){
	//}else{
	   

		   
	 for($k=0;$k<count($docOnlineDetails);$k++) {
         $test2 = $docOnlineDetails[$k];


            mysqli_query($con, 'INSERT INTO doctor_online_timings SET
            doc_id="'.$_REQUEST['docId'].'",
            from_time="'.$test2['from_time'].'",
            to_time="'.$test2['to_time'].'",
            days="'.$test2['day'].'",
            status="'.$test2['status'].'",
            date="'.$dd.'"
            ');
        
    }
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
	   
	   
	  // }
	
	
	
	
	
	
	
	

	$dataaa=array();
    $sql_data = mysqli_query($con,'SELECT * FROM doctor_master WHERE id="'.$_REQUEST['docId'].'"');
    while($row_data=mysqli_fetch_assoc($sql_data)){
		array_push($dataaa,$row_data);
	}

	    $data['status']="200";
		$data['message']="Doctor details and chamber details updated successfully!";
		$data['success']=true;
		$data['data']=$dataaa;
		echo json_encode($data);
		
}else{
 $data['status']="400";
	  
	  $data['message']="No Doctor Id Found";
	  
	  echo json_encode($data);
}
