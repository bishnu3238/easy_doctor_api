
<?php 
include('../config/db.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


if(isset($_REQUEST['id']) && $_REQUEST['id']!='')
{
   
	 if ($_FILES["image"]["error"] > 0) {

        $data['status']="400";
	  
	  $data['message']="File Error".$_FILES["file"]["error"];
	  
	  echo json_encode($data);

      } else {

        move_uploaded_file($_FILES["image"]["tmp_name"], "../doctor/uploads/doctor_images/" . $_FILES["image"]["name"]);

        $filelocation = $_FILES["image"]["name"];

        $size = ($_FILES["image"]["size"]/1024).' kB';

        mysqli_query($con, "UPDATE doctor_master SET image='".$filelocation."' WHERE id='".$_REQUEST['id']."'");

     
	    $data['status']="200";
		$data['message']="Doctor Image added successfully!";
		$data['success']=true;
		echo json_encode($data);
	 
	 }
   

	
	
	


		
}else{
 $data['status']="400";
	  
	  $data['message']="No doctor id found";
	  
	  echo json_encode($data);
}
