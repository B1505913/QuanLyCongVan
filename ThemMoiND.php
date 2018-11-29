<script language="javascript">
	function test(text){
		var x;
		x = new XMLHttpRequest();
		x.onreadystatechange = function(){
			if(x.status==200&& x.readyState==4){
				document.getElementById('myspan').innerHTML = x.responseText;
			}
		}
		x.open("GET","kiemtra.php?u="+text,true);
		x.send();
	}
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
	include_once'connection.php';
	if(isset($_POST['btnThemmoi']))
	{
		$tendangnhap = trim($_POST['tendn']);
		$hoten = trim($_POST['hoten']) ;
		$matkhau = $_POST['matkhau'] ;
		$matkhaunhaplai = $_POST['nhaplaimatkhau'];
		$diachi = $_POST['diachi'];
		$email = $_POST['mail'];
		$ngaysinh =$_POST['ngsinh'] ;
		$sdt = $_POST['sdt'] ;
		$khoa = $_POST['khoa'];
		$quyen = $_POST['idloaiquyen'] ;
		$chucvu =$_POST['idloaivc'] ;
		if(isset($_POST['grpGioiTinh']))
		{
		$gioitinh = $_POST['grpGioiTinh'];
		}
		$loitendn="";
		$loihoten= "";
		$loimk ="";
		$loinhaplaimk="";
		$loidiachi ="";
		$loiemail="";
		$loingaysinh = "";
		$loisdt ="";
		$loiquyen="";
		$loicv="";
		$loitrung = "";
		$truyvan ="select * from account where Id_Acc = '$tendangnhap'";
		$result = mysqli_query($conn,$truyvan);
		if(mysqli_num_rows($result)==1)
		{
			$loitrung.="Trùng tên đăng nhập, mời bạn chọn lại tên khác!";
		}
		if($tendangnhap=="" || !preg_match('/^[A-Za-z]{5,}$/',$tendangnhap))
		{
			$loitendn.="Vui lòng nhập tên đăng nhập";
		}
		if($hoten=="" )
		{
			$loihoten.="Vui lòng nhập họ và tên";
		}
		if($matkhau=="")
		{
			$loimk.="Vui lòng nhập mật khẩu<br/>";
		}
		if(strlen($matkhau)<=5)
		{
			$loimk.="Mật khẩu phải nhiều hơn 5 kí tự";
		}
		if($matkhau!=$matkhaunhaplai)
		{
			$loinhaplaimk.="Mật khẩu phải khớp";
		}
		if($diachi=="")
		{
			$loidiachi.="Vui lòng nhập địa chỉ";
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
		if($ngaysinh=="")
		{
			$loingaysinh.="Vui lòng chọn ngày sinh!";
		}
		if($sdt=="" || !is_numeric($sdt))
		{
			$loisdt.="Vui lòng nhập số điện loại va phải là số";
		}
		if($loihoten!=""||$loimk!=""||$loinhaplaimk!=""||$loidiachi!=""||$loiemail!=""||$loitendn!=""||$loingaysinh!=""||$loisdt!=""){
		}
		else{
			$query2 = "insert into user(Name_User, Position_User, Birthday_User, Gender_User, NumberPhone_User, Email_Use, Address_User,Id_Acc,Id_Col) values('$hoten','$chucvu','$ngaysinh','$gioitinh','$sdt','$email','$diachi','$tendangnhap',$khoa)";
			$query1 ="insert into account values('$tendangnhap','".md5($matkhau)."','$quyen')";
			$result1 = mysqli_query($conn,$query1);
			$result2 = mysqli_query($conn,$query2);
			echo "<script language='javascript'>window.location='TrangChu.php?khoatrang=DanhSachND'</script>";
		}
	}
?>
	<div class="trang2">
		<div class="container">
			<div class="row">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					
				</div> <!-- end cot trái -->

				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">

					<div class="row">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-4"></div>	
							<h3 class="tieude_dkcv">Thêm mới người dùng</h3>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 canhleformdkcv">
                       
							<form action="" class="form-horizontal" method="post">
							  <div class="form-group">
							    <label for="tendn" class="col-sm-3 control-label">Tên đăng nhập(*):</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="tendn" name="tendn" value="<?php if(isset($tendangnhap)) echo $tendangnhap; ?>" onkeyup="test(this.value)">
                                   <span id="myspan"><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loitendn;
										echo $loitrung;
									}
								    ?></span>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="hoten" class="col-sm-3 control-label">Họ và tên(*):</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="hoten" name="hoten" value="<?php if(isset($hoten))echo $hoten; ?>">
                                    <span><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loihoten;
									}
								    ?></span>
							    </div>
							  </div>
                              <div class="form-group">  
                            <label for="lblGioiTinh" class="col-sm-3 control-label">Giới tính(*):  </label>
							<div class="col-sm-9">                              
                                      <label class="radio-inline"><input type="radio" name="grpGioiTinh" value="0" id="grpGioiTinh" checked="checked"  />
                                      Nam</label>
                                    
                                      <label class="radio-inline"><input type="radio" name="grpGioiTinh" value="1" id="grpGioiTinh" />
                                      Nữ</label>

							</div>
                          </div> 
							  <div class="form-group">
							    <label for="matkhau" class="col-sm-3 control-label">Mật khẩu(*):</label>
							    <div class="col-sm-9">
							    	<input type="password" class="form-control" id="matkhau" name="matkhau">
                                    <span><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loimk;
									}
								    ?></span>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="matkhau" class="col-sm-3 control-label">Nhập lại mật khẩu(*):</label>
							    <div class="col-sm-9">
							    	<input type="password" class="form-control" id="nhaplaimatkhau" name="nhaplaimatkhau">
                                    <span><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loinhaplaimk;
									}
								    ?></span>
							    </div>
							  </div>
                              <div class="form-group">
							    <label for="mail" class="col-sm-3 control-label">Địa chỉ(*):</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="diachi" name="diachi">
                                    <span><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loidiachi;
									}
								    ?></span>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="mail" class="col-sm-3 control-label">Email(*):</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="mail" name="mail" value="<?php if(isset($email))  echo $email; ?>">
                                    <span><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loiemail;
									}
								    ?></span>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="ngsinh" class="col-sm-3 control-label">Ngày sinh(*):</label>
							    <div class="col-sm-9">
							    	<input type="date" class="form-control" id="ngsinh" name="ngsinh" value="<?php if(isset($ngaysinh)) echo $ngaysinh; ?>">
                                    <span><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loingaysinh;
									}
								    ?></span>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="sdt" class="col-sm-3 control-label">Số điện thoại:</label>
							   <div class="col-sm-9">
							   		 <input type="text" class="form-control" id="sdt" name="sdt" value="<?php if(isset($sdt)) echo $sdt ?>">
                                     <span><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loisdt;
									}
								    ?></span>
							   </div>
							  </div>
                              <div class="form-group">
							    <label for="quyen" class="col-sm-3 control-label">Khoa/đơn vị(*):</label>
							    	<div class="col-sm-9">
							    		<select class="form-control" id="khoa" name="khoa" >
                                        
                                        <?php 
										$query = "select * from colleage";
										$result = mysqli_query($conn,$query);
										while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
										?>
									    <option value="<?php echo $row['Id_Col']; ?>"><?php echo $row['Name_Col']; ?></option>
									    
										<?php
										}
										?>
									 </select>

							    	</div>
							  </div>
							  <div class="form-group">
							    <label for="quyen" class="col-sm-3 control-label">Quyền(*):</label>
							    	<div class="col-sm-9">
							    		<select class="form-control" id="idloaiquyen" name="idloaiquyen" onchange="option()">
                                        <option>Chọn quyền người dùng</option>
									    <option value="1">1</option>
									    <option value="2">2</option>
									    <option value="3">3</option>
									    <option value="4">4</option>
									 </select>

							    	</div>
							  </div>
							  <div class="form-group">
							    <label for="chucvu" class="col-sm-3 control-label">Chức vụ(*):</label>
							    <div class="col-sm-9">
							   		 <select class="form-control" id="idloaivc" name="idloaivc" >
                                     	<option>Chọn chức vụ người dùng</option>
									    <option value="Cán bộ văn thư các cấp" >Cán bộ văn thư các cấp</option>
									    <option value="Lãnh đạo phòng KH-TH/Cán bộ chuyên trách">Lãnh đạo phòng KH-TH/Cán bộ chuyên trách</option>
									    <option value="Ban giám hiệu, lãnh đạo khoa-đơn vị">Ban giám hiệu, lãnh đạo khoa-đơn vị</option>
									    <option value="Quản trị viên">Quản trị viên</option>
									 </select>

							    </div>
							  </div>		
							 
							  	
							  <div class="nut2"><input type="button" class="btn btn-danger pull-right nuthuydkcv" name="btnHuy" id="btnHuy" onclick="window.location='TrangChu.php?khoatrang=DanhSachND'" value="Hủy" /></div>
							<div class="nut"><input type="submit" class="btn btn-success pull-right nutdk_cv" name="btnThemmoi" id="btnThemmoi" value="Thêm mới"/> </div>
							</form>
                            
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
