  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php 
	include_once 'connection.php';
	//lấy mã ý kiến
	if(isset($_GET['ma'])){

           $id = @$_GET['ma'];

           $sql = "select Opi_Id, Id_In, Opi_Content from opinion where Opi_Id = '$id'";

           $query = mysqli_query($conn, $sql);
           $row = array();
           while($row2=mysqli_fetch_assoc($query)){
           		$row[] = $row2;
           }
        }

	        foreach($row as $value){
	        	$Opi_Id = $value['Opi_Id'];
	        	$Id_In = $value['Id_In'];
	        	echo $Opi_Content = $value['Opi_Content'];
	        }


	// thực hiện viec cap nhật
	//nếu $Opi_Content khác rỗng thì tien hành cập nhật, nguoc lại thì k
	
	        if($Opi_Content !=""){
	        	if(isset($_POST['btnKiemDuyet'])){

	        		$macv = $_POST['macv'];
	        		$maykien = $_POST['maykien'];
	        		$nd = $_POST['nd'];


	        		$loi="";
	        		if($nd == ""){
	        			$loi .= "Không được rỗng!";
	        		}

	        		if($loi == ""){
	        			$sql = "update opinion set OPi_Content = '$nd' where Opi_Id = '$maykien' and Id_In = '$macv'";
				//die();
	        			$query = mysqli_query($conn, $sql);
	        			header('location: TrangChu.php?khoatrang=KiemDuyetCV');
				/*echo '<pre>';
				print_r($_POST);
				echo '</pre>';*/
			}


		}
	}
	
	
	
 ?>


<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
	<h2 class="text-center">Cập nhật ý kiến kiểm duyệt</h2>
					<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
							  <div class="form-group">
							    <label for="idtype" class="col-sm-3 control-label">Mã công văn:</label>
							    <div class="col-sm-9">
							    	<input type="text" value="<?php echo $Id_In; ?>" name="macv" class="form-control" id="nd" readonly >
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="idtype" class="col-sm-3 control-label">mã ý kiến:</label>
							    <div class="col-sm-9">
							    	<input type="text" name="maykien" value="<?php echo $Opi_Id;?>" class="form-control" id="nd" readonly>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="nd" class="col-sm-3 control-label">Nội dung:</label>
							    <div class="col-sm-9">
							    	<textarea class="form-control" rows="5" id="comment" name="nd" placeholder="<?php echo $Opi_Content; ?>" ></textarea>
							    	<!-- <script language="javascript">
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
                    
                                    </script> -->
                                    <span><?php if(isset($_POST['btnKiemDuyet'])){echo $loi;} ?></span>
							    </div>
							  </div>
							   
							 
							  	<div class="nut"><button type="submit" name="btnKiemDuyet" class="btn btn-default pull-right nutdk_cv">Xác nhận</button></div>
							  	<div class="nut"><a href="TrangChu.php?khoatrang=KiemDuyetCV"></a><button name="btnHUy" class="btn btn-default pull-right nutdk_cv">Hủy</button></div>							
			</form>
</div>