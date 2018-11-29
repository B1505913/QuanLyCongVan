<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trang chủ</title>
	<!-- bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="01.css">
	<!-- jquey CDN -->
    <script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="01.js"></script>
  
<!--   font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <!-- font lato -->
  <link href="https://fonts.googleapis.com/css?family=Oswald:400,500|Raleway|Roboto|Source+Sans+Pro:200,300,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
</head>
<body>
<?php
include'connection.php';
require_once('recaptchalib.php');
if(isset($_POST['btnDangNhap']))
{
	$username = trim($_POST['name']);
	$password = trim($_POST['pwd']);
	$api_url    = 'https://www.google.com/recaptcha/api/siteverify';
	$site_key   = '6LcfSG8UAAAAAJE7PheV43d58WMay-xf7lV0TZT2';
	$secret_key = '6LcfSG8UAAAAAG4QTc0eWCtavjM_C0JBI9OUdvjn';
	$loiten ="";
	$loi="";
	$loimk="";
	$loisaimk="";
	$site_key_post = $_POST['g-recaptcha-response'];
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
		$remoteip = $_SERVER['HTTP_CLIENT_IP'];
		}
	else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		$remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	else
		{
		$remoteip = $_SERVER['REMOTE_ADDR'];
		}
	$api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
	$response = file_get_contents($api_url);
	$response = json_decode($response);
	if(!($response->success))
	{
		$loi.= '<li>Captcha wrong!</li>';
	}
	if($username=="")
	{
		$loiten.= "<li>Vui lòng nhập tên đăng nhập</li></br>";
	}
	if($password=="")
	{
		$loimk.= "<li>Vui lòng nhập mật khẩu</li></br>";
	}
	
	
	if($loi!="")
	{
		//echo $loi;
	}
	else
	{
		$password = md5($password);
		$result = mysqli_query($conn, "SELECT * FROM `account` WHERE Id_Acc = '$username' and Password_Acc='$password'") or die(mysqli_error($conn));
		if(mysqli_num_rows($result) == 1)
		{
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$_SESSION['username'] = $username;
			$_SESSION['quyen'] = $row['Permission_Acc'];
			echo '<meta http-equiv="refresh" content="0; URL=TrangChu.php"/>';
		}
		else 
		{
			$loisaimk.="Sai mật khẩu";
		}
	}
	
	//
	$sql2 = 'select Id_Acc, Password_Acc from account';
	$result2 = mysqli_query($conn,$sql2);
	$row = array();
	while($row1 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
		$row[] = $row1;
	}

}
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
				<a class="navbar-brand" href="#"><h4>Trường đại học Cần Thơ</h4><h5>Hệ thống quản lý công văn</h5></a>
				
			</div>
	
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse dangnhap">				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class=""></span></a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav> <!-- end menu -->

	
	<div class="dangnha">
		<button class="btn-primary tung"><i class="fas fa-align-justify tung2"></i></button>
       
	</div>
	<div class="tieudedn">Đăng nhập</div>
	<div class="logo"><img src="img/logo.png" class="img-responsive" width="40px" height="40px" alt=""></div>
	
	<div class="trang">
		<div class="nenform">
			<div class="container">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4 khungdn">
					<h3>Đăng nhập</h3>
					<form action="" method="post" id="frmDangNhap" name="frmDangNhap">
					  <div class="form-group">
					    <label for="name">Tên đăng nhập:</label>
					    <input type="text" class="form-control" id="name" name="name" placeholder=" Tên đăng nhập" value="" required  pattern="<?php foreach($row as $value){echo $value['Id_Acc'].'|';}?>" title="Vui lòng nhập đúng mật khẩu"/>
					  </div>
					  <div class="form-group">
					    <label for="pwd">Mật khẩu:</label>
					    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Mật khẩu" required pattern="123456|123456|123456|123456" title="Vui lòng nhập đúng mật khẩu">
                        
					  </div>
                      <div class="form-group">
                      	<label>Mã an toàn:</label>
                        <div class="g-recaptcha" data-sitekey="6LcfSG8UAAAAAJE7PheV43d58WMay-xf7lV0TZT2"></div>
                        
                      </div>
					  <button type="submit" class="btn btn-primary" id="btnDangNhap" name="btnDangNhap">Đăng nhập</button>
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
		</div>
	</div>

<div class="momo"></div>
	<div class="footer">
		<div class="container text-center">
				Trường Đại học Cần Thơ (Can Tho University) <br>
				Khu II - Đường 3/2 - Quận Ninh Kiều - TP. Cần Thơ <br>
				Điện thoại: <span>(84-292) 3832663 - (84-292) 3838474</span>; Fax: <span>(84-292) 3838474</span>; Email: dhct@ctu.edu.vn <br>		
		</div>
	</div>

</body>
</html>