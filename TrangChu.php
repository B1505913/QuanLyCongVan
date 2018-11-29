<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trang chủ2</title>
	<!-- bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="01.css">
	<!-- jquey CDN -->
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="01.js"></script>
  
<!--   font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <!-- font lato -->
  <link href="https://fonts.googleapis.com/css?family=Oswald:400,500|Raleway|Roboto|Source+Sans+Pro:200,300,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
</head>
<body>
	<?php
	session_start();
	?>
	<nav class="navbar navbar-default menu" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="?khoatrang=trangchu"><h4>Trường đại học Cần Thơ</h4><h5>Hệ thống quản lý công văn</h5></a>
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse dangnhap">				
				<ul class="nav navbar-nav navbar-right ">
					<li><a href="#"><span class=""></span></a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav> <!-- end menu -->

	
	<div class="dangxuat">
		<i class="fas fa-users nutdangxuat"><a href="?khoatrang=dangxuat" style="color:#fff;text-decoration:none; font-size:16px;">Đăng xuất</a></i>
	</div>
	<div class="logo"><img src="img/logo.png" class="img-responsive" width="40px" height="40px" alt=""></div>
	<div class="trang2">
		<div class="container">
			<div class="row">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                	<?php
						if (isset($_SESSION['username']) && $_SESSION['username'] != "")
						{
					 ?>
					<h6 class="dn">Người dùng: <span><?php echo $_SESSION['username']; }?></span></h6>
					<h6 class="quyen">Chức vụ: <span><?php
						if(isset($_SESSION['quyen']) && $_SESSION['quyen']!="")
						{
							if($_SESSION['quyen'] == 1)
							{
								echo "Cán bộ văn thư";
							}
							else if($_SESSION['quyen'] == 2)
							{
								echo "Lãnh đạo phòng KH/TH. Cán bộ chuyên trách";
							}
							else if($_SESSION['quyen'] == 3)
							{
								echo "BGH/Lãnh đạo khoa-đơn vị/ Cán bộ chuyên trách";
							}
							else if($_SESSION['quyen'] == 4)
							{
								echo "Quản trị viên";
							}
						}
					 ?></span></h6>

					<div class="motkhoi">
						<button class="btn-default1 nutSildeup">Quản lý công văn đến</button>
							<ul class="list-group">
								<!--<a href="?khoatrang=QuanLyCV" class="nutlistgr"><li class="list-group-item list-group-item-info">Danh sách công văn đến</li></a>	-->
                                <a href="<?php if($_SESSION['quyen']==1) echo "?khoatrang=QuanLyCV"; ?>" class="nutlistgr" ><li class="list-group-item list-group-item-info" <?php if($_SESSION['quyen']==1) echo 'style="background-color: #a9f1b5;"';?> >Danh sách công văn đến</li></a>
								  <a href="<?php if($_SESSION['quyen']==2 ||$_SESSION['quyen']==3 ) echo "?khoatrang=KiemDuyetCV"; ?>" class="nutlistgr"><li class="list-group-item list-group-item-info"  <?php if($_SESSION['quyen']==2) echo 'style="background-color: #a9f1b5;"';?>>Kiểm duyệt công văn</li></a>
								  <a href="<?php if($_SESSION['quyen']==2 ||$_SESSION['quyen']==3 ) echo "?khoatrang=PheDuyetCV"; ?>" class="nutlistgr"><li class="list-group-item list-group-item-info"  <?php if($_SESSION['quyen']==2) echo 'style="background-color: #a9f1b5;"';?>>Phê duyệt công văn</li></a>
							</ul>
					</div>

					<div class="motkhoi">
						<button class="btn-default1 nutSildeup">Quản trị</button>
							<ul class="list-group">
							<a href="<?php if($_SESSION['quyen']==4) echo "?khoatrang=DanhSachND"; ?>" class="nutlistgr"><li class="list-group-item list-group-item-info"  <?php if($_SESSION['quyen']==4) echo 'style="background-color: #a9f1b5;"';?>>Danh sách người dùng</li></a>
                            
                            <a href="<?php if($_SESSION['quyen']==4) echo "?khoatrang=DanhSachKhoa"; ?>" class="nutlistgr"><li class="list-group-item list-group-item-info"  <?php if($_SESSION['quyen']==4) echo 'style="background-color: #a9f1b5;"';?>>Danh sách khoa đơn vị</li></a>
						</ul>
					</div>
				</div> <!-- end cot trái -->

	
					<?php 
						//include_once 'DanhSachND.php';

						if(isset($_GET['khoatrang'])){
							$khoatrang = $_GET['khoatrang'];

							if($khoatrang == 'QuanLyCV'){
								include_once 'QuanLyCV.php';
							}
							else if($khoatrang == 'KiemDuyetCV'){
								include_once 'KiemDuyetCV.php';
							}
							else if($khoatrang== 'CapNhatKD'){
								include_once 'CapNhatKD.php';
							}
							else if($khoatrang== 'ThemYKienKD'){
								include_once 'ThemYKienKD.php';
							}
							else if($khoatrang == 'PheDuyetCV'){
								include_once 'PheDuyetCV.php';
							}
							else if($khoatrang == 'CapNhatPD'){
								include_once 'CapNhatPD.php';
							}
							else if($khoatrang== 'ThemYKienPD'){
								include_once 'ThemYKienPD.php';
							}
							else if($khoatrang == 'DanhSachND'){
								include_once 'DanhSachND.php';
							}
							else if($khoatrang == 'CapNhatND'){
								include_once 'CapNhatND.php';
							}
							else if($khoatrang == 'CapNhatKhoa'){
								include_once 'CapNhatKhoa.php';
							}
							else if($khoatrang == 'ThemMoiKhoa'){
								include_once 'ThemMoiKhoa.php';
							}
							else if($khoatrang == 'DanhSachKhoa'){
								include_once 'DanhsachKhoa.php';
							}
							else if($khoatrang == 'CapNhatCV'){
								include_once 'CapNhapCV.php';
							}
							else if($khoatrang == 'DangKyCV'){
								include_once 'DangKyCV.php';
							}
							else if($khoatrang == 'ThemMoiND'){
								include_once 'ThemMoiND.php';
							}
							else if($khoatrang == 'dangxuat'){
								include_once 'DangXuat.php';
							}
							else if($khoatrang == 'trangchu'){
								include_once 'TrangChu.php';
							}
						}
					 ?>
				
			</div>
		</div>
	</div>

</body>
</html>