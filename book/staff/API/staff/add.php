<?php
require_once("../server.php");
require "../service/main.php";
$event=$_POST['event'];
switch ($event) {
    case "editoffdate":
        $msg="msg";
    // name=V%C3%B5+S%C6%A1n+nam&gender=M&phone=0965276269&email=vosonnam95%40gmail.com&date=2021-07-06&address=On+the+Moon&event=customer
        $id=postAPI('id');  
        $sql="UPDATE `offdate` SET `status`=0 WHERE `id`='$id'";
            if (mysqli_query($conn, $sql)===true) {
                $jsonData[$event] = 1;
                $jsonData[$msg]="Huỷ thành công";
            } else {
                $jsonData[$event] = 0;
                $jsonData[$msg]="Không thể thực hiện thao tác này";
            }
        
        echo json_encode($jsonData);
        // mysqli_close($conn);
        break;
    case "editcustomer":
        $msg="msg";
    // name=V%C3%B5+S%C6%A1n+nam&gender=M&phone=0965276269&email=vosonnam95%40gmail.com&date=2021-07-06&address=On+the+Moon&event=customer
        $id=postAPI('id');
        $name=postAPI('name');
        $gender=postAPI('gender');
        $phone=postAPI('phone');
        $email=postAPI('email');
        $date=postAPI('date');
        $birthday=postAPI('birthday');  
        $sql="UPDATE `customer` SET `name`='$name',`gender`='$gender',`phone`='$phone',`email`='$email',`birthday`='$birthday' WHERE `id`='$id'";
            if (mysqli_query($conn, $sql)===true) {
                $jsonData[$event] = 1;
                $jsonData[$msg]="Sửa thông tin khách hàng thành công";
            } else {
                $jsonData[$event] = 0;
                $jsonData[$msg]="Không thể thực hiện thao tác này";
            }
        
        echo json_encode($jsonData);
        // mysqli_close($conn);
        break;
    case "setoff":
        $msg="msg";
    // fromdate=2021-07-06&fromtime=08%3A21&todate=2021-07-01&totime=08%3A21
        $setdate=postAPI('setdate');
        $fromtime=postAPI('fromtime');
        $totime=postAPI('totime');
        $status=1;
        $sql="INSERT INTO `offdate`(`fromdate`, `todate`, `status`) VALUES (TIMESTAMP('$setdate',  ' $fromtime'),TIMESTAMP('$setdate',  ' $totime'),$status);";
            if (mysqli_query($conn, $sql)===true) {
                $jsonData[$event] = 1;
                $jsonData[$msg]="Lịch nghỉ đặt thành công";
            } else {
                $jsonData[$event] = 0;
                $jsonData[$msg]="Không thể thực hiện thao tác này";
            }
        
        echo json_encode($jsonData);
        // mysqli_close($conn);
        break;
    case "customer":
        $msg="msg";
    // name=V%C3%B5+S%C6%A1n+nam&gender=M&phone=0965276269&email=vosonnam95%40gmail.com&date=2021-07-06&address=On+the+Moon&event=customer
        $name=postAPI('name');
        $gender=postAPI('gender');
        $phone=postAPI('phone');
        $email=postAPI('email');
        $date=postAPI('date');
        $birthday=postAPI('birthday');  
        $sql="INSERT INTO `customer`(`name`, `gender`, `phone`, `email`, `birthday`) VALUES ('$name', '$gender', '$phone', '$email', '$birthday')";
            if (mysqli_query($conn, $sql)===true) {
                $jsonData[$event] = 1;
                $jsonData[$msg]="Thêm mới khách hàng thành công";
            } else {
                $jsonData[$event] = 0;
                $jsonData[$msg]="Không thể thực hiện thao tác này";
            }
        
        echo json_encode($jsonData);
        // mysqli_close($conn);
        break;
	default:
        # code...
        break;
}
mysqli_close($conn);
?>