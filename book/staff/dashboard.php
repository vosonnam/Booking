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
        <link href="media/favicons/favicon.ico" rel="icon">

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
        <?php include('include/navBar_active.php');?>
        <!-- Nav Bar End -->


        <!-- Hero Start -->
        <div class="hero">
            <div class="container-fluid">
                <div class="row">
					<div class="user">
                        <div class="user-icon">
                            <img src="media/icons/icon-note.png" alt="icon-user" srcset="">
                        </div>
						<div class="user-form">					
							<h1>BẢNG CÁC CHỨC NĂNG</h1>
                            <div class="container-box">
                                <div class="input-box">
                                    <h2>Khách Hàng</h2>
                                    <i></i><a href="./managecustomer.php">Quản Lý Khách Hàng</a>	
                                </div>	
                                <div class="input-box">
                                    <h2>Đặt Lịch Hẹn</h2>
                                    <i></i><a href="./appointmenthistory.php">Quản Lý Lịch Sử Đặt Lịch</a>	
                                </div>	                          
                                <!-- <div class="input-box">
                                    <h2>Đặt Lịch Nghỉ</h2>
                                    <i></i><a href="./manageoffdate.php">Quản Lý Lịch Nghỉ Hiện Có</a>	
                                </div> -->
                            </div>	
                            <div class="container-box">	
                                <div class="input-box">
                                    <h2>Quản Lý SMS</h2>
                                    <i></i><a href="./editsms.php">Thay Đổi SMS</a>	
                                </div>	
                                <div class="input-box">	
                                    <h2>Quản Lý Email</h2>
                                    <i></i><a href="./edittxt.php">Thay đổi Email</a>
                                </div>
                            </div>									
						</div>
					</div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

        <!-- Video Modal Start-->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Video Modal End -->       
        
        <!-- Footer Start -->
        <?php include('include/footerBar.php');?>
        <!-- Footer End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
        <script src="jsuser/main.js"></script>
    </body>
</html>
