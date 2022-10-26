<?php
	/**
	 * 
	 */
	function send($to, $userName,$bookDate,$txtNote,$id){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$currentDate=date("Y/m/d h:i:sa");
		$link="http://localhost:8080/book/editbooked.php?book=$id";
		$txt = "Kính gửi:$userName \nHôm nay là ngày:\"$currentDate\".\n"
		."Với mục đích thông báo chúng tôi gửi mail xác nhận lịch hẹn đã đặt thành công này đến quý khách.\n"
		."Mong quý khách đến đúng hẹn: \"$bookDate\"\n."
		."Thông tin chi tiết lịch hẹn: $link\n"
		."Thông báo: $txtNote";


		$headers = "From: vsnam95@gmail.com"."\r\n"."CC: $to";
		$subject="5 SECOND SALON";
		return 	mail($to,$subject,$txt,$headers);
	}
	function getAPI($key, $defualtValue=''){
		return isset($_GET[$key]) ? $_GET[$key] : $defualtValue;
	}
	function postAPI($key, $defualtValue=''){
		return isset($_POST[$key]) ? $_POST[$key] : $defualtValue;
	}
	// echo send('vosonnam95@gmail.com', 'Võ Sơn nam','2021-07-11 19:04');
?>