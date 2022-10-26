<?php
require_once("../server.php");
require "../service/main.php";
$event=$_POST['event'];
switch ($event) {
    case "editbooked":
        $msg="msg";
    // name=V%C3%B5+S%C6%A1n+nam&gender=M&phone=0965276269&email=vosonnam95%40gmail.com&date=2021-07-06&address=On+the+Moon&event=customer
        $id=postAPI('id');
        $status=postAPI('status');
        $booktime=postAPI('booktime');
        $sql="UPDATE `book` SET `time`='$booktime',`status`='$status' WHERE MD5(`id`)='$id'";
            if (mysqli_query($conn, $sql)===true) {
                $jsonData[$event] = 1;
                $jsonData[$msg]="Thao tác thành công";
            } else {
                $jsonData[$event] = 0;
                $jsonData[$msg]="Không thể thực hiện thao tác này";
            }
        
        echo json_encode($jsonData);
        // mysqli_close($conn);
        break;
	case "booking":
        $msg="msg";
        $name=postAPI('name');
		$phone=postAPI('phone');
        $bookdate=postAPI('bookdate');
        $booktime=postAPI('booktime');
        $fbemail=0;
        $fbsms=0;
        $status=1;  
    	$sql="INSERT INTO `book`( `name`, `phone`, `date`, `time`, `fbemail`, `fbsms`, `status`) VALUES ('$name', '$phone', '$bookdate', '$booktime', '$fbemail', '$fbsms', '$status')";
            if (mysqli_query($conn, $sql)===true) {
                $jsonData[$event] = 1;
                $jsonData[$msg]="Lịch hẹn đặt thành công";
                //send email
                $query=mysqli_query($conn, "SELECT customer.email, user.txtemail FROM `customer` JOIN user ON `phone`='$phone'");
                $row=mysqli_fetch_array($query);
                if($row>0){
                    $to=$row['email'];
                    $txtNote=$row['txtemail'];
                    $queryId=mysqli_query($conn, "SELECT `id`, MD5(`id`) as md5Id FROM `book` ORDER BY `bookdate` DESC LIMIT 1");
                    $rowId=mysqli_fetch_array($queryId);
                    $id=$rowId['id'];
                    $md5Id=$rowId['md5Id'];
                    $result=send($to, $name, $bookdate." ".$booktime,$txtNote,$md5Id);
                    
                    if($result){
                        mysqli_query($conn, "UPDATE `book` SET `fbemail`='1' WHERE `id`='$id'");
                    }else{
                        $jsonData[$event] = 1;
                        $jsonData[$msg]="Lịch hẹn đặt thành công";   
                    }
                }else {
                    $jsonData[$event] = 1;
                    $jsonData[$msg]="Lịch hẹn đặt thành công";
                }
            } else {
                $jsonData[$event] = 0;
                $jsonData[$msg]="Không thể thực hiện thao tác này";
            }
        
        echo json_encode($jsonData);
        mysqli_close($conn);
        break;
	default:
        # code...
        break;
}
?>