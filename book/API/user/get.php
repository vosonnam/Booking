<?php
require_once("../server.php");
$event=$_POST['event'];
switch ($event) {
	case "getoffdate":
	    //c81e728d9d4c2f636f067f89cc14862c
		$mang=array();
		$bookdate=$_POST['bookdate'];
	    $sql=mysqli_query($conn,"SELECT `fromdate` AS fromtime,  `todate` AS totime FROM `offdate` WHERE '$bookdate'=DATE(`fromdate`) AND `status`=1");
	    for($i=1; $row=mysqli_fetch_array($sql); $i++){
	        $usertemp['fromtime']=$row['fromtime'];
	        $usertemp['totime']=$row['totime'];
		    $mang[$i] =$usertemp;
	    }
	    $jsonData[$event] =$mang;
	    echo json_encode($jsonData);
		break;
	case "getbooked":
	    $id=$_POST['id'];
	    //c81e728d9d4c2f636f067f89cc14862c
	    $sql=mysqli_query($conn,"SELECT `name`, `phone`, `date`, `time`, `bookdate`, `status` FROM `book` WHERE MD5(`id`)='$id' LIMIT 1");
	    $row=mysqli_fetch_array($sql); 
	    $usertemp=array();
        $usertemp['name']=$row['name'];
        $usertemp['phone']=$row['phone'];
        $usertemp['date']=$row['date'];
        $usertemp['time']=$row['time'];
        $usertemp['bookeddate']=$row['bookdate'];
        $usertemp['status']=$row['status'];
	    $jsonData[$event] =$usertemp;
	    echo json_encode($jsonData);
		break;
	case "getbooked":
	    $id=$_POST['id'];
	    //c81e728d9d4c2f636f067f89cc14862c
	    $sql=mysqli_query($conn,"SELECT `name`, `phone`, `date`, `time`, `bookdate`, `status` FROM `book` WHERE MD5(`id`)='$id' LIMIT 1");
	    $row=mysqli_fetch_array($sql); 
	    $usertemp=array();
        $usertemp['name']=$row['name'];
        $usertemp['phone']=$row['phone'];
        $usertemp['date']=$row['date'];
        $usertemp['time']=$row['time'];
        $usertemp['bookeddate']=$row['bookdate'];
        $usertemp['status']=$row['status'];
	    $jsonData[$event] =$usertemp;
	    echo json_encode($jsonData);
		break;
		
	default:
      # code...
	//SELECT `id`, MAX(TO_DAYS(`fromdate`)) FROM `offdate` WHERE 1
	//SELECT SUBSTRING_INDEX(`fromdate`,' ',1) AS fromday, SUBSTRING_INDEX(`fromdate`,' ',-1) AS fromtime, SUBSTRING_INDEX(`todate`,' ',1) AS today, SUBSTRING_INDEX(`todate`,' ',-1) AS totime, `status` FROM `offdate` JOIN (SELECT `id`, MAX(TO_DAYS(`fromdate`)) FROM offdate WHERE CURRENT_DATE()=SUBSTRING_INDEX(`fromdate`,' ',1) ) tb ON tb.id=offdate.id
	//SELECT SUBSTRING_INDEX(`fromdate`,' ',-1) AS fromtime,  SUBSTRING_INDEX(`todate`,' ',-1) AS totime FROM `offdate` WHERE CURRENT_DATE()=DATE(`fromdate`) AND `status`=1
      break;
}
mysqli_close($conn);
?>