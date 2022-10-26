<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="media/favicons/favicon-ap-his.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head>

    <body>
        <!-- Top Bar Start -->
        <?php include('include/topBar.php');?>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <?php include('include/navBar.php');?>
        <!-- Nav Bar End -->


        <!-- Hero Start -->
        <div class="hero">
            <div class="container-fluid">
                <div class="row">
					<div class="ap-his">
						<div class="ap-his-form">					
							<h1>LỊCH SỬ CUỘC HẸN</h1>
							<div class="ap-his-show">
								<input type="date" name="bookdate" id="bookdate" required="">
								<button name="all" id="btn-all">Tất cả</button>
							</div>
							<table>
								<thead>
									<tr>
										<th>Mã Số</th>
										<th>Họ Và Tên</th>
										<th>Số Điện Thoại</th>
										<th>Ngày Đặt Hẹn</th>
										<th>Ngày Tạo Hẹn</th>
										<th>Hành Động</th>
									</tr>
								</thead>
								<tbody class="tb_data">
								</tbody>
							</table>
							<div class="row ls_numberpage"></div>
							<div id="smsuser"></div>
						</div>
					</div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

        <!-- Footer Start -->
        <?php include('include/footerBar.php');?>
        <!-- Footer End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
        <script src="jsuser/main.js"></script>
        <script type = "text/javascript" src="jsuser/appointmenthistory.js"></script>
    </body>
</html>
