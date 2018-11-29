<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php 
	include_once 'connection.php';
	//lấy mã ý kiến
	if(isset($_GET['ma'])){

           $id = @$_GET['ma'];

           $sql = "select Id_In from opinion where Opi_Id = '$id'";

           $query = mysqli_query($conn, $sql);
        
           @$id=mysqli_fetch_assoc($query);
        }


    if(isset($_POST['btnKiemDuyet'])){
    	 $macv = isset($_POST['macv']) ? trim($_POST['macv']) : '';
    	$mayk = isset($_POST['maykien']) ? trim($_POST['maykien']) : '';
    	$nd = isset($_POST['nd']) ? trim($_POST['nd']) : '';

    	//lay
    	$sql2 = "select Opi_Id from opinion where Opi_Id like 'KD%'";
			$query2 = mysqli_query($conn, $sql2);
			$arr = array();
			while($arr2=mysqli_fetch_assoc($query2)){
				$arr[] = $arr2; 
			}
			
			$pattern = '';
			foreach($arr as $value){
				$pattern .= '^'.$value['Opi_Id'].'$|';
			}
			$pattern = substr($pattern, 0, strlen($pattern)-1);
			$pattern = '/'.$pattern.'/';
			if($pattern == "//"){
				$pattern = "/^df$/";
			}
			else{
				$pattern = $pattern;
			}



			//truy van so sanh cv da kiem duyet hay chua
			 $sql3 = "select Opi_Id, Id_In from opinion
			 where Id_In = '$macv'";
			$query3 = mysqli_query($conn, $sql3);
			$arr3 = mysqli_fetch_assoc($query3);

			

			 

    	
    	$loimyk="";
    	$loind="";
    	$loimcv = "";

    	if(mysqli_affected_rows($conn)==1){
    		$loimcv .= 'Cong van nay da duoc duyet';
    	}

    	if($mayk == ""){
    		$loimyk .= 'mã ý kiến không được rỗng!';
    	}
    	else if(preg_match($pattern, $mayk)){
    		$loimyk .= 'Mã ý kiến đã tồn tại!';
			}
		else if(!preg_match('/^KD[0-9]{2,}$/', $mayk)){
    		$loimyk = 'Mã ý kiến bắt đầu bằng KD và từ 2 số!';
			}	

    	if($nd == ''){
    		$loind .= 'Nội dung công văn không được rỗng!';
    	}

    	if($loind == '' and $loimyk =='' and $loimcv ==''){
    		 $sql = "insert into opinion(OPi_Id, Opi_Content, Id_In ) values('$mayk', '$nd', '$macv')";
				//die();
				$query = mysqli_query($conn, $sql);

			// khi insert thành công, sẽ tiến hành cap nhật lai Status_In = 1
				if(mysqli_affected_rows($conn) > 0){
					$sql2 = "update indocument set Status_In = '1' where Id_In = $macv";

					$query2 = mysqli_query($conn, $sql2);
						header('location: TrangChu.php?khoatrang=KiemDuyetCV');
				}

			
    	}
    
    }



    function option($conn, $selected=''){
		$sql = "select Id_In from indocument where Status_In = 0";

		$query = mysqli_query($conn, $sql);
		echo "<select class='form-control' id='macv' name='macv'>
			  <option>Chọn mã công văn</option>";
		while($row2=mysqli_fetch_assoc($query)){	
			if($row2[Id_In]==$selected){
				echo "<option value='".$row2['Id_In']."' selected>".$row2['Id_In']."</option>";
			}else{
				echo "<option value='".$row2['Id_In']."'>".$row2['Id_In']."</option>";
			}
			

		}
		echo "</option></select>";
	}    
	
	
	
 ?>



<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
	<h2 class="text-center">Ghi ý kiến kiểm duyệt</h2>
					<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
							  <div class="form-group">
										<label for="idtype" class="col-sm-3 control-label">Mã công văn:</label>
										<div class="col-sm-9">
											<?php echo option($conn,@$macv); ?>
											<span><?php if(isset($_POST['btnKiemDuyet'])){echo $loimcv;} ?></span>
										</div>
									</div>
							  <div class="form-group">
							    <label for="idtype" class="col-sm-3 control-label">mã ý kiến:</label>
							    <div class="col-sm-9">
							    	<input type="text" name="maykien" value="<?php if(isset($_POST['btnKiemDuyet'])){echo $_POST['maykien'];} ?>" class="form-control" id="nd" >
							    	<span><?php if(isset($_POST['btnKiemDuyet'])){echo $loimyk;} ?></span>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="nd" class="col-sm-3 control-label">Nội dung:</label>
							    <div class="col-sm-9">
							    	<textarea class="form-control" rows="5" id="comment" name="nd" ></textarea>
							    	<script language="javascript">
                                        CKEDITOR.replace( 'comment',
                                        {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                                ['Style','FontFormat','FontName','FontSize'],
                                                ['TextColor','BGColor'],[ 'UIColor' ] ]
                                        });
                    
                                    </script>
							    	<span><?php if(isset($_POST['btnKiemDuyet'])){echo $loind;} ?></span>
							    </div>
							  </div>
							   
							 	<!-- <div class="nut"><a href="TrangChu.php?khoatrang=KiemDuyetCV"><button type="submit" name="btnHuy" class="btn btn-default pull-right nutdk_cv">Hủy</button></a></div> -->
							  	<div class="nut"><button type="submit" name="btnKiemDuyet" class="btn btn-default pull-right nutdk_cv">Xác nhận</button></div>
							  	<div class="nut"><button name="btnHUy" class="btn btn-default pull-right nutdk_cv" onClick="window.location='?khoatrang=KiemDuyetCV'">Hủy</button></div>							
			</form>
</div>