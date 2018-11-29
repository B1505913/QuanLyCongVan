<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
	include_once('connection.php');
	$ten = $_GET['u'];
	$query = "select * from account where Id_Acc ='$ten'";
	$result = mysqli_query($conn,$query);
	$row = mysqli_num_rows($result);
	if($row > 0){
			echo "Tên đăng nhập đã tồn tại, vui lòng chọn tên khác";
	}else{
		echo "OK!";
	}
?>
<body>
</body>
</html>