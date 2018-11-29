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
</script>
<?php
	include_once'connection.php';
	if(isset($_POST['btnThemmoi']))
	{
		$tenkhoa = $_POST['tenkhoa'];
		$mail = $_POST['mailkhoa'];
		$loitenkhoa="";
		$loimail="";
		/*$truyvan ="select * from colleage where Name_Col ='$tenkhoa' ";
		$result = mysqli_query($conn,$truyvan);
		if(mysqli_num_rows($result)==1)
		{
			$loitrung.="Trùng tên đăng nhập, mời bạn chọn lại tên khác!";
		}*/
		if($tenkhoa=="")
		{
			$loitenkhoa.="Vui lòng nhập tên khoa";
		}
		if($mail=="")
		{
			$loimail.="Vui lòng nhập email<br>";
		}
		//if(strpos($email,"@")=== false)
		if(!preg_match("/^[A-Za-z0-9_]{2,32}@ctu.edu.vn/",$mail))
		{
			$loimail.="Email phải họp lệ";
		}
		if( $loitenkhoa != "" || $loimail!=""){
		}
		else{
			
			$query1 ="insert into colleage(Name_Col,Mail_Col) values('$tenkhoa','$mail')";
			$result1 = mysqli_query($conn,$query1);
			echo "<script language='javascript'>window.location='TrangChu.php?khoatrang=DanhSachKhoa'</script>";
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
							<h3 class="tieude_dkcv">Thêm mới khoa, đơn vị</h3>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 canhleformdkcv">
                       
							<form action="" class="form-horizontal" method="post">
							  <div class="form-group">
							    <label for="tendn" class="col-sm-3 control-label">Tên khoa, đơn vị:</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="tenkhoa" name="tenkhoa" value="<?php if(isset($tenkhoa)) echo $tenkhoa; ?>" >
                                   <span id="myspan"><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loitenkhoa;
										
									}
								    ?></span>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="hoten" class="col-sm-3 control-label">Email khoa, đơn vị:</label>
							    <div class="col-sm-9">
							    	<input type="text" class="form-control" id="mailkhoa" name="mailkhoa" value="<?php if(isset($mail))echo $mail; ?>">
                                    <span><?php 
								   	if(isset($_POST['btnThemmoi']))
									{
										echo $loimail;
									}
								    ?></span>
							    </div>
							  </div>
							  <div class="nut2"><input type="button" class="btn btn-danger pull-right nuthuydkcv" name="btnHuy" id="btnHuy" onclick="window.location='TrangChu.php?khoatrang=DanhSachKhoa'" value="Hủy" /></div>
							<div class="nut"><input type="submit" class="btn btn-success pull-right nutdk_cv" name="btnThemmoi" id="btnThemmoi" value="Thêm mới"/> </div>
							</form>
                            
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
