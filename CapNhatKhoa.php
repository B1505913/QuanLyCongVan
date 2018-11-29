<?php
	include_once('connection.php');
	if(isset($_GET['ma']))
	{
		$ma = $_GET['ma'];
		$sql= "SELECT * from colleage where Id_Col=$ma";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_row($result);
		$stt= $row['0'];
		$tenkhoa= $row['1'];
		$email = $row['2'];
	}
	if(isset($_POST['btnCapNhat']))
	{
		//$mak = $_POST['makhoa'];
		$tenkhoa = $_POST['tenkhoa'];
		$mail = $_POST['mail'];
		$loitenkhoa ="";
		$loiemail="";
		
		if(trim($tenkhoa)==""){
			$loitenkhoa.="Vui lòng nhập tên đăng nhập";
		}
		if($mail=="")
		{
			$loiemail.="Vui lòng nhập email";
		}
		//if(strpos($email,"@")=== false)
		if(!preg_match("/^[A-Za-z0-9_]{2,32}@ctu.edu.vn/",$mail))
		{
			$loiemail.="Email phải họp lệ";
		}
		
		if( $loiemail!="" ||  $loitenkhoa!="")
		{
		}
		else
		{
			$query2 = "update colleage set Name_Col = '$tenkhoa',Mail_Col = '$mail' where Id_Col=$ma";
			$result2 = mysqli_query($conn,$query2);
			echo '<meta http-equiv="refresh" content="0;URL=TrangChu.php?khoatrang=DanhSachKhoa"/>';
		}
	}
?>
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">

					<div class="row">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-4"></div>	
							<h3 class="tieude_dkcv">Cập nhật khoa, đơn vị</h3>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 canhleformdkcv">
							<form action="" class="form-horizontal" method="post">
							  <div class="form-group">
							    <label for="tendn" class="col-sm-3 control-label">Mã khoa, đơn vị:</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="makhoa" name="makhoa" value="<?php echo $stt ?>" disabled="disabled">
                                    
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="hoten" class="col-sm-3 control-label">Tên khoa, đơn vị:</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="tenkhoa" name="tenkhoa" value="<?php echo $tenkhoa ?>">
                                    <span>
                                    	<?php 
											if(isset($_POST['btnCapNhat'])){
												echo $loitenkhoa;
											}
										?>
                                    </span>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="matkhau" class="col-sm-3 control-label">Email khoa:</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="mail" name="mail" value="<?php echo $email ?>">
                                    <span>
                                    	<?php 
											if(isset($_POST['btnCapNhat'])){
												echo $loiemail;
											}
										?>
                                    </span>
							    </div>
							  </div>			
							  	<div class="nut"><button type="submit" class="btn btn-success pull-right nutdk_cv" id="btnCapNhat" name="btnCapNhat">Cập nhật</button></div>
							  <div class="nut2"><input type="button" class="btn btn-danger pull-right nuthuydkcv" id="btnHuy" onclick="window.location='TrangChu.php?khoatrang=DanhSachKhoa'" value="Hủy"/></div>
							
							</form>
						</div>
					</div>
				</div>
