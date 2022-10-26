<!DOCTYPE html>
<html>
	<head>
		<title>Booking</title>
	</head>
	<body>
		<h1>Đặt Lịch Hẹn</h1>
		<p>Index | Booking</p>
		<form method="post">
			<input type="text" name="name"required="" placeholder="Nhập họ và tên" readonly="">
			<input type="text" name="phone" pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b" required="" placeholder="Nhập số điện thoại" readonly="">
			<input type="date" name="bookdate" required="">
			<input type="time" name="booktime"required="" min="+3" max="">
			<button type="submit|reset" name="event" value="booking">Thêm</button>
		</form>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="jsuser/main.js"></script>
		<script type = "text/javascript" src="jsuser/booking.js"></script>
	</body>
</html>