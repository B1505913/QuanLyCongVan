<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
  <?php 
    include_once("connection.php");

		function bindLCVList($conn, $selectedValue){
			$sqlstring = "select Id_Type, TypeName from typedocument";
			$result = mysqli_query($conn, $sqlstring);
			echo "
				<select name ='loaicv' class='form-control'>
					<option>Chọn loại công văn</option>";
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						if($row['Id_Type']== $selectedValue)
							{
								echo "<option value='".$row['Id_Type']."' selected>".$row['TypeName']."</option>";
							}
						else {
							echo "<option value='".$row['Id_Type']."'>".$row['TypeName']."</option>";
						}
					}
				echo "</select>";
		}
    ?>

    

    <?php
    include_once("connection.php");
		function bindDVList($conn, $selectedValue){
			$sqlstring = "select Id_Off, Name_Off from office";
			$result = mysqli_query($conn, $sqlstring);
			echo "
				<select name ='dv' class='form-control'>
					<option value='0'>Chọn đơn vị</option>";
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						if($row['Id_Off']==$selectedValue){
						echo "<option value='".$row['Id_Off']."' selected>".$row['Name_Off']."</option>";
						}
						else{
							echo "<option value='".$row['Id_Off']."'>".$row['Name_Off']."</option>";
							}
					}
				echo "</select>";
		}

    ?>
    

    <?php
    include_once("connection.php");
		function bindUserList($conn, $selectedValue){
			$sqlstring = "select Id_User, Name_User from user";
			$result = mysqli_query($conn, $sqlstring);
			echo "
					<select name='ngdung' class='form-control' >
						<option value='0'>Chọn người dùng</option>";
					while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
						if($row['Id_User']==$selectedValue){
						echo "<option value='".$row['Id_User']."' selected>".$row['Name_User']."</option>";
						}
						else{
							echo "<option value='".$row['Id_User']."'>".$row['Name_User']."</option>";
							}
						
					}
				echo "</select>";	
			}


?>
<?php
    include_once("connection.php");
      if(isset($_GET['ma'])){
      $ma = $_GET['ma'];
      $sqlstring = "SELECT i.* FROM indocument as i  JOIN office o ON i.Id_Off = o.Id_Off
                    JOIN user as u ON i.Id_User = u.Id_User JOIN typedocument as ty ON i.Id_Type = ty.Id_Type
                     where i.Id_In='$ma'";
      $result = mysqli_query($conn, $sqlstring);
      $row = mysqli_fetch_row($result);
      $macv = $row[0];
      $tencv = $row[1];
      $tu = $row[2];
      $den = $row[3];
      $noidung = $row[4];
      $nguoiky = $row[5];
      $chuyentiep = $row[6];
      $loaicv = $row[7];
      $donvi = $row[8];
      $nguoidung = $row[9];
      $ngayden = $row[10];
      $trangthai = $row[11];
      $deadline = $row[12];
      $tapfile=$row[13];
     
      
    }
   ?>
   <?php 
   include_once("connection.php");
 if(isset($_POST['btncn'])){
    $macv=$_POST['idcv'];
    $tencv=$_POST['tencv'];
    $tu=$_POST['from'];
    $den=$_POST['to'];
    $noidung=$_POST['comment'];
    $nguoiky=$_POST['signer'];
    
    $chuyentiep=$_POST['ctiep'];
    $loaicv=$_POST['loaicv'];
    $donvi=$_POST['dv'];
    $nguoidung=$_POST['ngdung'];
    $ngayden=$_POST['inDate']; 
    $trangthai=$_POST['status'];
    $deadline=$_POST['deadline'];

  if (isset($_FILES['fileld'])) {
    if($_FILES['fileld']['error'] > 0)
      {
        
      }
    else{
    $tapfile= $_FILES['fileld']['name'];
    $tmp_name= $_FILES['fileld']['tmp_name'];
    $path='pdf/'.$tapfile; 
    move_uploaded_file($tmp_name, $path);
  }
}
    

   
    $loimacv="";
    $loitencv="";
    $loitu="";
    $loiden="";
    $loinguoiky="";
    $loicomment="";
    $loingayden="";
    $loideadline="";
    

    if($macv=="" || !is_numeric($macv) || strlen($macv)>10){
        $loimacv.= "Mã công văn không là chữ";
        }
    if($tencv==""){
        $loitencv.= "Vui lòng cập nhật lại tên công văn";
        }
    if(strlen($tencv)<=5){
        $loitencv.= "Độ dài công văn lớn hơn 5 kí tự";
      }
      
    if($tu=="null"){
        $loitu.= "<option>Vui lòng cập nhật lại nơi đi công văn</option>";
        }
    if($den=="null"){
        $loiden.= "<option>Vui lòng cập nhật lại nơi đến công văn</option>";
        }
    if($nguoiky=="" ){
        $loinguoiky.= "Phải nhập người ký công văn";
      }
      if($ngayden=="" ){
        $loingayden.= "Vui lòng cập nhật ngày công văn đến";
      }
      if($deadline=="" ){
        $loideadline.= "Vui lòng cập nhật deadline công văn";
      }
      if($noidung=="" ){
        $loicomment.= "Phải nhập nội dung tóm lược công văn";
      }
    if($loimacv!=""||$loitencv!=""||$loitu!=""||$loiden!=""||$loinguoiky!="" || $loingayden!=""
      || $loideadline!="" ){

        
    }
    else {
      $sqlstring= "
          UPDATE indocument SET
           Id_In=$macv, 
           Name_In='$tencv',
           From_In='$tu', 
           To_In='$den',
           Content_In='$noidung',
           Signer_In='$nguoiky',
           Forward_In='$chuyentiep',
           Id_Type='$loaicv',
           Id_Off='$donvi', 
           Id_User='$nguoidung', 
           Date_In='$ngayden', 
           Status_In=$trangthai,
           DaedLine_In='$deadline',
           taptin_In = '$tapfile'
            WHERE Id_In='$ma'";

          
          $result=mysqli_query($conn, $sqlstring);
          echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=QuanLyCV"/>';
          //
      }

    }


 
   ?>
  
  
  
  
  <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
    <div class="row">
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-4"></div>
      <h2 class="tieude_dkcv">Cập nhật công văn</h2>
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 canhleformdkcv">
        <form action="" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
          <div class="form-group">
            <label for="idcv" class="col-sm-3 control-label">Mã công văn:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="idcv" name="idcv" value='<?php echo $macv; ?>'/>
              <span>
                <?php
                if(isset($_POST['btncn'])){
                  echo $loimacv;
                  
                } 
                ?>
              </span> 
            </div>
          </div>
          <div class="form-group">
            <label for="tencv" class="col-sm-3 control-label">Tên công văn:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="tencv" name="tencv" value='<?php echo $tencv; ?>'>
              <span>
                <?php
                if(isset($_POST['btncn'])){
                  echo $loitencv;
                } 
                ?>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="from" class="col-sm-3 control-label">Từ:</label>
            <div class="col-sm-9">
              
              <select class="form-control" id="from" name="from" value='<?php echo $tu; ?>'>
               
                <option >Sở giáo dục Cần Thơ</option>
                <option>Phòng đào tạo</option>
                <option>Sở TT & TT</option>
                <option>Sở KHCN-Cần Thơ</option>
              </select>
              <span>
                <?php
                if(isset($_POST['btncn'])){
                  echo $loitu;
                  
                } 
                
                ?>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="to" class="col-sm-3 control-label">Đến:</label>
            <div class="col-sm-9">
              <select class="form-control" id="to" name="to" value='<?php echo $den; ?>'>
                <option>Sở giáo dục Cần Thơ</option>
                <option>Phòng đào tạo</option>
                <option>Sở TT & TT</option>
                <option>Sở KHCN-Cần Thơ</option>
              </select>
               <span>
                <?php
                if(isset($_POST['btncn'])){
                  echo $loiden;
                  
                } 
                ?>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="singers" class="col-sm-3 control-label">Người ký:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="singer" name="signer" value='<?php echo $nguoiky; ?>'>
              <span>
                    <?php
                      if(isset($_POST['btncn'])){
                      echo $loinguoiky;
                      } 
                    ?>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="comment" class="col-sm-3 control-label">Nội dung:</label>
            <div class="col-sm-9">
              <textarea class="form-control" rows="5" id="comment" name="comment" value=''><?php echo $noidung ?></textarea>
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
               <span>
                <?php
                if(isset($_POST['btncn'])){
                  echo $loicomment;
                } 
                ?>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="ctiep" class="col-sm-3 control-label">Chuyển tiếp:</label>
            <div class="col-sm-9">
              <select class="form-control" id="ctiep" name="ctiep" value='<?php echo $chuyentiep; ?>'>
                <option>Sở giáo dục Cần Thơ</option>
                <option>Phòng đào tạo</option>
                <option>Sở TT & TT</option>
                <option>Sở KHCN-Cần Thơ</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inDate" class="col-sm-3 control-label">Ngày cv đến:</label>
            <div class="col-sm-9">
              <input class="form-control" id="datepicker" type="date"  name="inDate" value='<?php echo $ngayden; ?>'>
              <span>
                <?php
                if(isset($_POST['btncn'])){
                  echo $loingayden;
                  
                } 
                ?>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="dv" class="col-sm-3 control-label">Đơn vị:</label>
            <div class="col-sm-9">
               <?php bindDVList($conn,$donvi) ?>
                
            </div>
          </div>
          <div class="form-group">
            <label for="ngdung" class="col-sm-3 control-label">Người dùng:</label>
            <div class="col-sm-9">
               <?php bindUserList($conn, $nguoidung); ?> 
                
            </div>
          </div>
          <div class="form-group">
            <label for="status" class="col-sm-3 control-label">Tình trạng:</label>
            <div class="col-sm-9">
              <select class="form-control" id="status" name="status" value='<?php echo $trangthai; ?>'>
                <option value="0">Chưa xử lí</option>
                <option value="1">Chờ bút phê</option>
                <option value="2">Đã xử lí</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label for="loaicv" class="col-sm-3 control-label">Loại công văn:</label>
            <div class="col-sm-9">
            <?php bindLCVList($conn,$loaicv); ?>

            </div>
          </div>
           
  
          <div class="form-group">
            <label for="deadline" class="col-sm-3 control-label">Hạn cuối:</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" id="deadline" name="deadline" value="<?php echo $deadline ?>">
              <span>
                <?php
                if(isset($_POST['btn'])){
                  echo $loideadline;
                  
                } 
                ?>
              </span>
            </div>
          </div>
            
          <div class="form-group">  
            <label for="file" class="col-sm-3 control-label">Tải file:</label>
            <div class="col-sm-9">
              <input type="file" class="form-control form-input" multiple="" 
              accept="application/pdf" id="fileld" name="fileld" value="<?php echo $tapfile ?>" >               
            </div>
          </div>

          <div class="form-froup">
            <button type="submit" id="btncn" name="btncn" class="btn btn-default pull-right nutdk_cv">Cập nhật</button>
          </div>
          <div class="form-group">
            <button type="button" id="btnhuy" name="btnhuy" class="btn btn-default pull-right nuthuydkcv" onClick="window.location='?khoatrang=QuanLyCV'">Hủy</button>
          </div>
        </form>
      </div>
    </div>
  </div>
