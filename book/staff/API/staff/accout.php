<?php
require_once("../server.php");
require "../service/main.php";
$event=$_POST['event'];
switch ($event) {
    case "edittxt":
        $msg="msg";
    // name=V%C3%B5+S%C6%A1n+nam&gender=M&phone=0965276269&email=vosonnam95%40gmail.com&date=2021-07-06&address=On+the+Moon&event=customer
        $isuse=postAPI('isuse');
        $txtemail=postAPI('txtemail');
        $sql="UPDATE `user` SET `useemail`='$isuse', `txtemail`='$txtemail' WHERE 1";
            if (mysqli_query($conn, $sql)===true) {
                $jsonData[$event] = 1;
                $jsonData[$msg]="Nội dung email sửa thành công";
            } else {
                $jsonData[$event] = 0;
                $jsonData[$msg]="Không thể thực hiện thao tác này";
            }
        
        echo json_encode($jsonData);
        // mysqli_close($conn);
        break;
    case "editsms":
        $msg="msg";
    // name=V%C3%B5+S%C6%A1n+nam&gender=M&phone=0965276269&email=vosonnam95%40gmail.com&date=2021-07-06&address=On+the+Moon&event=customer
        $isuse=postAPI('isuse');
        $txtsms=postAPI('txtsms');
        $sql="UPDATE `user` SET `usesms`='$isuse', `txtsms`='$txtsms' WHERE 1";
            if (mysqli_query($conn, $sql)===true) {
                $jsonData[$event] = 1;
                $jsonData[$msg]="Nội dung SMS sửa thành công";
            } else {
                $jsonData[$event] = 0;
                $jsonData[$msg]="Không thể thực hiện thao tác này";
            }
        
        echo json_encode($jsonData);
        // mysqli_close($conn);
        break;
    case "gettxt":
        $msg="msg";
        $mang=array();
        $sql=mysqli_query($conn, "SELECT `useemail`, `txtemail` FROM `user` WHERE 1 LIMIT 1");
        $row=mysqli_fetch_array($sql);
        $mang['useemail']=$row['useemail'];
        $mang['txtemail']=$row['txtemail'];
        $jsonData[$event] =$mang;
        
        echo json_encode($jsonData);
        break;
    case "getsms":
        $msg="msg";
        $mang=array();
        $sql=mysqli_query($conn, "SELECT `usesms`, `txtsms` FROM `user` WHERE 1 LIMIT 1");
        $row=mysqli_fetch_array($sql);
        $mang['usesms']=$row['usesms'];
        $mang['txtsms']=$row['txtsms'];
        $jsonData[$event] =$mang;
        
        echo json_encode($jsonData);
        break;
	 case "login":
		$username=$_POST['username'];
		$password=$_POST['password'];
        $sql=mysqli_query($conn,"SELECT * FROM user WHERE username='$username' and password='$password'"); 
        $rows=mysqli_fetch_array($sql);
		if($rows>0){
			$jsonData[$event] =1;
			$jsonData['items']=$rows['username'];
			echo json_encode($jsonData);
		}else
		{
			$jsonData[$event] =0;
			$jsonData['msg']="Tên hoặc mật khẩu không trùng khớp";
			echo json_encode($jsonData);
		}
		break;
	default:
      # code...
      break;
}
mysqli_close($conn);
?>