<script language="javascript">
	function option(){
		var a = document.getElementById('idloaiquyen').value;
		if(a==1){
			document.getElementById('idloaivc').selectedIndex = "1";
		}else if(a==2){
			document.getElementById('idloaivc').selectedIndex = "2";
		}else if(a==3){
			document.getElementById('idloaivc').selectedIndex = "3";
		}else{
			document.getElementById('idloaivc').selectedIndex = "4";
		}
	}
</script>

<?php
		include_once ('connection.php'); 
		function bindPerList($conn,$selectedValue){
				$sql= "SELECT a.*, b.* FROM account as a JOIN user AS b ON a.Id_Acc = b.Id_Acc";
				$result=mysqli_query($conn,$sql);
				echo "<select name='quyen' id='quyen' class='form-control'>
						<option>Chọn quyền cho người dùng</option>";
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
                		if ($row['Permission_Acc'] == $selectedValue) {
                    		echo "<option value='".$row['Permission_Acc']."' selected>".$row['Permission_Acc']."</option>";
							echo "<option value='1'>1</option>";
							echo "<option value='2'>2</option>";
							echo "<option value='3'>3</option>";
							echo "<option value='4'>4</option>";
               			} else{
							echo "<option value='1'>1</option>";
							echo "<option value='2'>2</option>";
							echo "<option value='3'>3</option>";
							echo "<option value='4'>4</option>";
							
						}
				echo "</select>";
			}
	?>
<?php
		include_once ('connection.php'); 
		function bindLSPList($conn,$selectedValue){
				$sql= "SELECT a.*, b.* FROM account as a JOIN user AS b ON a.Id_Acc = b.Id_Acc";
				$result=mysqli_query($conn,$sql);
				echo "<select name='quyen' id='quyen' class='form-control'>
						<option>Chọn quyền cho người dùng</option>";
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                		if ($row['Permission_Acc'] == $selectedValue) {
                    		echo "<option value='".$row['Permission_Acc']."' selected>".$row['Permission_Acc']."</option>";
							echo "<option value='1'>1</option>";
							echo "<option value='2'>2</option>";
							echo "<option value='3'>3</option>";
							echo "<option value='4'>4</option>";
               			} else{
							//echo "<option value='".$row['Permission_Acc']."'>".$row['Permission_Acc']."</option>";
							echo "<option value='1'>1</option>";
							echo "<option value='2'>2</option>";
							echo "<option value='3'>3</option>";
							echo "<option value='4'>4</option>";
							
						}
				echo "</select>";
			}
	?>
<?php
include_once ('connection.php'); 
		function bindCVList($conn,$selectedValue){
				$sql= "SELECT a.*, b.* FROM account as a JOIN user AS b ON a.Id_Acc = b.Id_Acc";
				$result=mysqli_query($conn,$sql);
				echo "<select name='congviec' id='congviec' class='form-control'>
						<option>Chọn quyền cho người dùng</option>";
						$row= mysqli_fetch_array($result, MYSQLI_ASSOC);
						if($row['Position_User']==$selectedValue){
									echo "<option value='".$row['Position_User']."' selected>".$row['Position_User']."</option>";
									echo "<option value='Cán bộ văn thư các cấp'>1-Cán bộ văn thư các cấp</option>";
									echo "<option value='Lãnh đạo phòng KH-TH/Cán bộ chuyên trách'>2-Lãnh đạo phòng KH-TH/Cán bộ chuyên trách</option>";
									echo "<option value='Ban giám hiệu, lãnh đạo khoa-đơn vị'>3-Ban giám hiệu, lãnh đạo khoa-đơn vị</option>";
									echo "<option value='Quản trị viên'>4-Quản trị viên</option>";
						}else{
							//echo "<option value='".$row['Position_User']."'>".$row['Position_User']."</option>";
									echo "<option value='Cán bộ văn thư các cấp'>1-Cán bộ văn thư các cấp</option>";
									echo "<option value='Lãnh đạo phòng KH-TH/Cán bộ chuyên trách'>2-Lãnh đạo phòng KH-TH/Cán bộ chuyên trách</option>";
									echo "<option value='Ban giám hiệu, lãnh đạo khoa-đơn vị'>3-Ban giám hiệu, lãnh đạo khoa-đơn vị</option>";
									echo "<option value='Quản trị viên'>4-Quản trị viên</option>";
						}
								
				echo "</select>";
			}
?>
<?php
	if(isset($_GET['ma']))
	{
		$ma = $_GET['ma'];
		$sql= "SELECT a.*, b.* FROM account as a JOIN user AS b ON a.Id_Acc = b.Id_Acc WHERE b.Id_User='$ma'";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_row($result);
		$tendangnhap = $row[0];
		$hoten = $row[4];
		$makhau = md5($row[1]);
		$email = trim($row[9]);
		//$ngaysinh = $row[6];
		$sodienthoai = $row[8];
		$quyen = $row[2];
		$chucvu = $row[5];
		$id_acc= $row[11];
	}
	if(isset($_POST['btnCapNhat']))
	{
		
		//$tendangnhap = $_POST['tendn'];	
		$hoten = $_POST['hoten'];
		$email = $_POST['mail'];
		$sodienthoai = $_POST['sdt'];
		$quyen = $_POST['quyen'];
		$chucvu = $_POST['congviec'];
		$loitendangnhap ="";
		$loiemail="";
		$loisdt="";
		$loichucvu="";
		if(trim($tendangnhap)==""){
			$loitendangnhap.="Vui lòng nhập tên đăng nhập";
		}
		if($email=="")
		{
			$loiemail.="Vui lòng nhập email";
		}
		//if(strpos($email,"@")=== false)
		if(!preg_match("/^[A-Za-z0-9_]{2,32}@([a-zA-Z0-9]{2,12})(\.[a-zA-Z]{2,12})+$/",$email))
		{
			$loiemail.="Email phải họp lệ";
		}
		if($sodienthoai=="" || !is_numeric($sodienthoai)){
			$loisdt="Vui lòng nhập số điện thoại và đúng định dạng";
		}
		if( $loiemail!="" || $loisdt!=""|| $loitendangnhap!="")
		{
		}
		else
		{
			$query1 = "UPDATE user set Name_User = '$hoten', Email_Use = '$email', NumberPhone_User = '$sodienthoai', Position_User = '$chucvu' where Id_User = $ma";
			$query2 = "update account set Permission_Acc = '$quyen' where Id_Acc='$id_acc'";
			$result1 = mysqli_query($conn,$query1);
			$result2 = mysqli_query($conn,$query2);
			echo '<meta http-equiv="refresh" content="0;URL=TrangChu.php?khoatrang=DanhSachND"/>';
		}
	}
?>
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">

					<div class="row">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-4"></div>	
							<h3 class="tieude_dkcv">Cập nhật người dùng</h3>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 canhleformdkcv">
							<form action="" class="form-horizontal" method="post">
							  <div class="form-group">
							    <label for="tendn" class="col-sm-3 control-label">Tên đăng nhập:</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="tendn" name="tendn" value="<?php echo $tendangnhap; ?>" disabled="disabled">
                                    <span>
                                    	<?php 
											if(isset($_POST['btnCapNhat'])){
												echo $loitendangnhap;
											}
										?>
                                    </span>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="hoten" class="col-sm-3 control-label">Họ và tên:</label>
							    <div class="col-sm-9">
							    	<input type="textv" class="form-control" id="hoten" name="hoten" value="<?php echo $hoten ?>">
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="matkhau" class="col-sm-3 control-label">Mật khẩu:</label>
							    <div class="col-sm-9">
							    	<input type="password" class="form-control" id="matkhau" name="matkhau" value="<?php echo $makhau ?>" disabled="disabled">
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="mail" class="col-sm-3 control-label">Email:</label>
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
							  <div class="form-group">
							    <label for="sdt" class="col-sm-3 control-label">Số điện thoại:</label>
							   <div class="col-sm-9">
							   		 <input type="text" class="form-control" id="sdt" name="sdt" value="<?php echo $sodienthoai; ?>">
                                     <span>
                                    	<?php 
											if(isset($_POST['btnCapNhat'])){
												echo $loisdt;
											}
										?>
                                    </span>
							   </div>
							  </div>
							   <div class="form-group">
							    <label for="quyen" class="col-sm-3 control-label">Quyền:</label>
							    	<div class="col-sm-9">
							    		<?php bindLSPList($conn,$quyen); ?>

							    	</div>
							  </div>
							  <div class="form-group">
							    <label for="chucvu" class="col-sm-3 control-label">Chức vụ:</label>
							    <div class="col-sm-9">
							   		 <?php bindCVList($conn,$chucvu); ?>

							    </div>
							  </div>			
							 
							  	<div class="nut"><button type="submit" class="btn btn-success pull-right nutdk_cv" id="btnCapNhat" name="btnCapNhat">Cập nhật</button></div>
							  <div class="nut2"><input type="button" class="btn btn-danger pull-right nuthuydkcv" id="btnHuy" onclick="window.location='TrangChu.php?khoatrang=DanhSachND'" value="Hủy"/></div>
							
							</form>
						</div>
					</div>
				</div>




