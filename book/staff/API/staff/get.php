<?php
require_once("../server.php");
require "../service/main.php";
$event=$_POST['event'];
switch ($event) {
    case "sendmailagain":
        $msg="msg";
    // fromdate=2021-07-06&fromtime=08%3A21&todate=2021-07-01&totime=08%3A21&id=7
        //SELECT book.id,customer.email, book.name, book.date, book.time FROM book JOIN customer ON book.phone=customer.phone AND book.id='9' JOIN user ON book.fbemail=0 AND book.status=1 AND user.useemail=1 LIMIT 1
        $id=$_POST['id'];
        $sql=mysqli_query($conn, "SELECT book.id,customer.email, book.name, book.date, book.time, user.txtemail FROM book JOIN customer ON book.phone=customer.phone AND book.id='$id' JOIN user ON book.fbemail=0 AND book.status=1 AND user.useemail=1 LIMIT 1");
        $row=mysqli_fetch_array($sql);
        if($row>0) {
            $to=$row['email'];
            $name=$row['name'];
            $bookdate=$row['date'];
            $booktime=$row['time'];
            $txtNote=$row['txtemail'];
            $result=send($to, $name, $bookdate." ".$booktime,$txtNote);
            if($result){
                $jsonData[$event] = 1;
                $jsonData[$msg]="Mail xác nhận đã được gửi";
                mysqli_query($conn, "UPDATE `book` SET `fbemail`='1' WHERE `id`='$id'");
            }else{
                $jsonData[$event] = 0;
                $jsonData[$msg]="Mail xác nhận gửi không thành công";
            }
        } else {
            $jsonData[$event] = 0;
            $jsonData[$msg]="Điều kiện gửi gmail không thoả";
        }
        
        echo json_encode($jsonData);
        // mysqli_close($conn);
        break;
    case "offdate":
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT `id`, SUBSTRING_INDEX(`fromdate`,' ',1) AS setday, SUBSTRING_INDEX(`fromdate`,' ',-1) AS fromtime,SUBSTRING_INDEX(`todate`,' ',-1) AS totime, `status` FROM `offdate` WHERE 1 limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	    	$usertemp=array();
	        $usertemp['id']=$row['id'];
	        $usertemp['setday']=$row['setday'];
	        $usertemp['fromtime']=$row['fromtime'];
	        $usertemp['totime']=$row['totime'];
	        $usertemp['status']=$row['status'];
	        if($row['status']=='1'){
	        	$action='<a href="#" class="btn_huy"><button>Huỷ</button></a>';
	        }else{
	        	$action='Canceled';
	        }
			// $mang[$i]=$usertemp;
	        extract($usertemp);
	        $mang[$i]= "<tr data-1='$id' data-2='$setday'  data-3='$fromtime' data-5='$totime' data-6='$status'>"
			        ."<td>$i</td>"
			        ."<td>$setday</td>"
			        ."<td>$fromtime</td>"
			        ."<td>$totime</td>"
			        ."<td>$status</td>"
			        ."<td>"
			        ."$action"
			        ."</td>"
		        ."</tr>";
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `offdate` WHERE 1");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "getcustomer":
	    $id=$_POST['id'];
	    $sql=mysqli_query($conn,"SELECT `name`, `gender`, `phone`, `email`, `birthday` FROM `customer` WHERE `id`='$id' LIMIT 1");
	    $row=mysqli_fetch_array($sql); 
	    $usertemp=array();
        $usertemp['name']=$row['name'];
        $usertemp['gender']=$row['gender'];
        $usertemp['phone']=$row['phone'];
        $usertemp['email']=$row['email'];
        $usertemp['birthday']=$row['birthday'];
	    $jsonData[$event] =$usertemp;
	    echo json_encode($jsonData);
		break;
    case "customer":
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    $page*=$records;
	    if(isset($_POST['txtsearch'])){
	    	$txtsearch=$_POST['txtsearch'];
	    	$query="WHERE `name` like '%$txtsearch%'|| `phone` like '%$txtsearch%'|| `email` like '%$txtsearch%'";
	    }else {
	    	$query="WHERE 1";
	    }
	    $sql=mysqli_query($conn,"SELECT * FROM `customer` $query limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	    	$usertemp=array();
	        $usertemp['id']=$row['id'];
	        $usertemp['name']=$row['name'];
	        if($row['gender']=='M'){
	        	$usertemp['gender']="Male";
	        }else{
        		$usertemp['gender']="Female";
	        }
	        $usertemp['phone']=$row['phone'];
	        $usertemp['email']=$row['email'];
	        $usertemp['birthday']=$row['birthday'];
			// $mang[$i]=$usertemp;
	        extract($usertemp);
	        $mang[$i]= "<tr data-1='$id' data-2='$name'  data-3='$gender' data-4='$phone' data-5='$email' data-6='$birthday'>"
			        ."<td>$i</td>"
			        ."<td>$name</td>"
			        ."<td>$gender</td>"
			        ."<td>$phone</td>"
			        ."<td>$email</td>"
			        ."<td>$birthday</td>"
			        ."<td>"
			        .'<a href="#" class="btn_sua"><button>Sửa</button></a>'
			        ."</td>"
		        ."</tr>";
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `customer` $query");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;
	case "getbooked":
	    $id=$_POST['id'];
	    //d3d9446802a44259755d38e6d163e820
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
	case "smsuser":
	    $mang=array();
	    $sql=mysqli_query($conn,"SELECT book.id, book.date, book.time, book.phone FROM book JOIN user ON book.fbsms='0' AND book.status='1' AND user.usesms='1' AND TIMESTAMP(book.date,book.time)>=CURRENT_TIMESTAMP() AND book.date=CURRENT_DATE()");
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	    	$usertemp=array();
        	$usertemp['id']=$row['id'];
        	$usertemp['phone']=$row['phone'];
        	$usertemp['date']=$row['date']." ".$row['time'];
	    	$mang[$i]=$usertemp;
	    }
	    $jsonData[$event] =$mang;
	    echo json_encode($jsonData);
		break;
    case "book":
	    $mang=array();
	    $records=$_POST['records'];
	    $page=$_POST['page'];
	    if(isset($_POST['bookdate'])){
	    	$bookdate=$_POST['bookdate'];
	    	$query="WHERE `date`='$bookdate'";
	    }else {
	    	$query="WHERE 1";
	    }
	    $page*=$records;
	    $sql=mysqli_query($conn,"SELECT * FROM `book` $query limit $page, $records"); 
	    for ($i=1; $row=mysqli_fetch_array($sql); $i++){
	    	$usertemp=array();
	        $usertemp['id']=$row['id'];
	        $usertemp['name']=$row['name'];
	        $usertemp['phone']=$row['phone'];
	        $usertemp['date']=$row['date'];
	        $usertemp['time']=$row['time'];
	        $usertemp['bookeddate']=$row['bookdate'];
	        $usertemp['fbemail']=$row['fbemail'];
	        $usertemp['fbsms']=$row['fbsms'];
	        $usertemp['status']=$row['status'];
	        if($row['fbemail']=='1'){
	        	$action1='<a href="#"><button>Done</button></a>';
	        }else{
	        	$action1='<a href="#" class="btn_sendemail"><button>Send Email</button></a>';
	        }
	        if($row['fbsms']=='1'){
	        	$action2='<a href="#"><button>Done</button></a>';
	        }else{
	        	$action2='<a href="#" class="btn_sendsms"><button>Send SMS</button></a>';
	        }
	        if($row['status']=='1'){
	        	$action3='Active';
	        }else{
	        	$action3='Canceled';
	        }
			// $mang[$i]=$usertemp;
	        extract($usertemp);
	        $mang[$i]= "<tr data-1='$id' data-2='$name'  data-3='$phone' data-4='$date' data-5='$time' data-6='$bookeddate'>"
			        ."<td>$i</td>"
			        ."<td>$name</td>"
			        ."<td>$phone</td>"
			        ."<td>$date $time</td>"
			        ."<td>$bookeddate</td>"
		        	."<td>"
		        		."$action1&nbsp;"
		        		."&nbsp;$action2&nbsp;"
		        		."&nbsp;$action3"
		        	."</td>"
		        ."</tr>";
	    }
	    $rs=mysqli_query($conn,"SELECT COUNT(*) as total FROM `book` $query");
	    $rowrs=mysqli_fetch_array($rs);
	    $jsonData['total'] =(int)$rowrs['total'];
	    $jsonData['items'] =$mang;

	    echo json_encode($jsonData);
		// mysqli_close($conn);
		break;

	default:
      # code...
      break;
}
mysqli_close($conn);
?>