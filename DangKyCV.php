    <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="UTF-8">

  	<!-- bootstrap -->
  	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" href="01.css">
  	<!-- jquey CDN -->
  	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="01.js"></script>
  <!--   font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- font lato -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500|Raleway|Roboto|Source+Sans+Pro:200,300,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">

    
    </head>
    <?php
    include_once ("connection.php");
    	if(isset($_POST["btndk"])){
  		$macv=$_POST["idcv"];
  		$tencv=$_POST["tencv"];
  		$tu=$_POST["from"];
  		$den=$_POST["to"];
  		$nguoiky=$_POST["signer"];
  		$noidung=$_POST["comment"];
  		$chuyentiep=$_POST["ctiep"];
  		$ngayden=$_POST["inDate"];
  		$donvi=$_POST["dv"];
  		$nguoidung=$_POST["ngdung"];
  		$trangthai=$_POST["status"];
  		

  		$deadline=$_POST['deadline'];

      $name= $_FILES['fileld']['name'];
      $tmp_name= $_FILES['fileld']['tmp_name'];
      $position= strpos($name, "."); 
      $fileextension= substr($name, $position + 1);
      $fileextension= strtolower($fileextension);
      if (isset($name)) {
          $path= 'pdf/';
      if (!empty($name)){
      if (move_uploaded_file($tmp_name, $path.$name)) {
          //echo 'Uploaded!';
        }
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
    $loitrung="";
    $result=mysqli_query($conn,"select * FROM indocument where Id_In='$macv'");
    if(mysqli_num_rows($result)==1){
      $loitrung .= "Trùng mã công văn, mời bạn nhập lại mã công văn";
    }

  	if($macv=="" || !is_numeric($macv) || strlen($macv)>10){
  			$loimacv.= "Vui lòng nhập mã công văn, mã công văn không là chữ";
  			}
  	if($tencv==""){
  			$loitencv.= "Vui lòng nhập tên công văn";
  			}
    if(strlen($tencv)<=5){
        $loitencv.= "Độ dài công văn lớn hơn 5 kí tự";
      }
  		
  	if($tu=="null"){
  			$loitu.= "<option>Vui lòng chọn nơi đi công văn</option>";
  			}
    if($den=="null"){
        $loiden.= "<option>Vui lòng chọn nơi đến công văn</option>";
        }
    if($nguoiky=="" ){
        $loinguoiky.= "Phải nhập người ký công văn";
      }
      if($ngayden=="" ){
        $loingayden.= "Phải chọn ngày công văn đến";
      }
      if($deadline=="" ){
        $loideadline.= "Phải chọn hạn deadline công văn";
      }
      if($noidung=="" ){
        $loicomment.= "Phải nhập nội dung tóm lược công văn";
      }
    if($loimacv!=""||$loitencv!=""||$loitu!=""||$loiden!=""||$loinguoiky!="" || $loingayden!=""
      || $loideadline!="" || $loitrung!=""){

        
    }


  		else {
  			$sqlstring= "
  					insert INTO indocument(Id_In, Name_In, From_In, To_In, Signer_In, Content_In, Forward_In, Date_In,Id_Off, Id_User, Status_In, Id_Type, DaedLine_In, taptin_In)
  					VALUES('$macv', '$tencv', '$tu','$den','$nguoiky','$noidung', 
  					'$chuyentiep','$ngayden',1,11, 1,1, '$deadline', '$name')";
  					
  					$congvan=mysqli_query($conn, $sqlstring);  					
             
            echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=QuanLyCV"/>';
  			}
  		}
    ?>
    
        <?php
      	include_once'connection.php';
  		function bindLCVList($conn){
  			$sqlstring = "select Id_Type, TypeName from typedocument";
  			$result = mysqli_query($conn, $sqlstring);
  			echo "
  				<select name ='loaicv' class='form-control'>
  					<option value='0'>Chọn loại công văn</option>";
  					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  						echo "<option value='".$row['Id_Type']."'>".$row['TypeName']."</option>";
  						}
  				
  				echo "</select>";
  		}
  				
  	?>
    
     <?php
      	include_once'connection.php';
  		function bindDVList($conn){
  			$sqlstring = "select Id_Off, Name_Off from office";
  			$result = mysqli_query($conn, $sqlstring);
  			echo "
  				<select name ='dv' class='form-control'>
  					<option value='0'>Chọn đơn vị</option>";
  					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  						echo "<option value='".$row['Id_Off']."'>".$row['Name_Off']."</option>";
  						}
  				
  				echo "</select>";
  		}
  				
  	?>
      <?php 	
  		include_once 'connection.php';
  		function bindUserList($conn){
  			$sqlstring = "select Id_User, Name_User from user";
  			$result = mysqli_query($conn, $sqlstring);
  			echo "
  					<select name='ngdung' class='form-control'>
  						<option value='0'>Chọn người dùng</option>";
  					while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
  						echo "<option value='".$row['Id_User']."'>".$row['Name_User']."</option>";
  						}
  	     echo "</select>";
  			}
  	?>
    
    
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
      <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-4"></div>
        <h1 class="tieude_dkcv">Đăng ký công văn</h1>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 canhleformdkcv">
          <form action="" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
              <label for="idcv" class="col-sm-3 control-label">Mã công văn(*):</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="idcv" name="idcv"
                title="Mã công văn giới hạn 10 số" value="<?php if(isset($macv)){echo $macv;} ?>" /> 
              <span>
                <?php
                if(isset($_POST['btndk'])){
                  echo $loimacv;
                  echo $loitrung;
                } 
                ?>
              </span>  
              </div>
            </div>
            <div class="form-group">
              <label for="tencv" class="col-sm-3 control-label">Tên công văn(*):</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="tencv" name="tencv" 
                 value="<?php if(isset($tencv)){echo $tencv;} ?>">
                <span>
                <?php
                if(isset($_POST['btndk'])){
                  echo $loitencv;
                  
                } 
                ?>
              </span> 
              </div>
            </div>
            <div class="form-group">
              <label for="from" class="col-sm-3 control-label">Từ(*):</label>
              <div class="col-sm-9">
                <select class='form-control' id='from' name='from' required='required'>
                  <option value='null'>Chọn nơi công văn đi</option>
                  <option value='so'>Sở giáo dục Cần Thơ</option>
                  <option value='phong'>Phòng đào tạo</option>
                  <option value='sott'>Sở TT & TT</option>
                  <option value='sokh'>Sở KHCN-Cần Thơ</option>
                </select>
                <span>
                <?php
                if(isset($_POST['btndk'])){
                  echo $loitu;
                  
                } 
                
                ?>
              </span>
            
              </div>
            </div>
            <div class="form-group">
              <label for="to" class="col-sm-3 control-label">Đến(*):</label>
              <div class="col-sm-9">
                <select class="form-control" id="to" name="to" required="required">
                  <option value="null">Chọn nơi công văn đến</option>
                  <option value="so">Sở giáo dục Cần Thơ</option>
                  <option value="phong">Phòng đào tạo</option>
                  <option value="sott">Sở TT & TT</option>
                  <option value="sokh">Sở KHCN-Cần Thơ</option>
                </select>
                 <span>
                <?php
                if(isset($_POST['btndk'])){
                  echo $loiden;
                  
                } 
                ?>
              </span>
              </div>
            </div>
            <div class="form-group">
              <label for="singers" class="col-sm-3 control-label">Người ký:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="singer" name="signer" 
                value="<?php if(isset($nguoiky)){echo $nguoiky;} ?>">
               <span>
                    <?php
                      if(isset($_POST['btndk'])){
                      echo $loinguoiky;
                      } 
                    ?>
              </span>
              </div>
            </div>
            <div class="form-group">
              <label for="comment" class="col-sm-3 control-label">Nội dung:</label>
              <div class="col-sm-9">
                <textarea class="form-control" rows="5" id="comment" name="comment" value="<?php if(isset($noidung)){echo $noidung;} ?>"></textarea>
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
                <span>
                <?php
                if(isset($_POST['btndk'])){
                  echo $loicomment;
                  
                } 
                ?>
              </span>
              </div>
            </div>
            <div class="form-group">
              <label for="ctiep" class="col-sm-3 control-label">Chuyển tiếp:</label>
              <div class="col-sm-9">
                <select class="form-control" id="ctiep" name="ctiep" required="required">
                  <option>Sở giáo dục Cần Thơ</option>
                  <option>Phòng đào tạo</option>
                  <option>Sở TT & TT</option>
                  <option>Sở KHCN-Cần Thơ</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="inDate" class="col-sm-3 control-label">Ngày cv đến(*):</label>
              <div class="col-sm-9">
                <input class="form-control" id="datepicker" type="date"  name="inDate"
                value="<?php if(isset($ngayden)){echo $ngayden;} ?>">
                <span>
                <?php
                if(isset($_POST['btndk'])){
                  echo $loingayden;
                  
                } 
                ?>
              </span>
              </div>
            </div>
            <div class="form-group">
              <label for="dv" class="col-sm-3 control-label">Đơn vị(*):</label>
              <div class="col-sm-9">
                 <?php bindDVList($conn) ?>
                 
              </div>

            </div>
            <div class="form-group">
              <label for="ngdung" class="col-sm-3 control-label">Người dùng(*):</label>
              <div class="col-sm-9">
                <?php bindUserList($conn); ?>
              </div>
            </div>

            <div class="form-group">
              <label for="status" class="col-sm-3 control-label">Tình trạng(*):</label>
              <div class="col-sm-9">
                <select class="form-control" id="status" name="status">
                  <option>Chưa xử lí</option>
                  <option>Chờ bút phê</option>
                  <option>Đã xử lí</option>
                </select>
              </div>  
            </div>
            
            <div class="form-group">
              <label for="typecv" class="col-sm-3 control-label">Loại công văn(*):</label>
              <div class="col-sm-9">
              <?php bindLCVList($conn) ?>
                 
              </div>
            </div>

            <div class="form-group">
              <label for="deadline" class="col-sm-3 control-label">Hạn cuối:</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" id="deadline" name="deadline"
                value="<?php if(isset($deadline)){echo $dealdline;} ?>">
                <span>
                <?php
                if(isset($_POST['btndk'])){
                  echo $loideadline;  
                  
                } 
                ?>
              </span>
              </div>
            </div>

              <div class="form-group">
              <label for="file" class="col-sm-3 control-label">Tải file:</label>
              <div class="col-sm-9">
                <input id="fileld" type="file" name="fileld" class="form-control form-input" multiple="" accept="application/pdf" />
                
              </div>
            </div>
              
            <div class="form-froup">
              <button type="submit" id="btndk" name="btndk" class="btn btn-default pull-right nutdk_cv">Đăng ký</button>
            </div>
            <div class="form-group">
              <button type="button" id="btnhuy" name="btnhuy" class="btn btn-default pull-right nuthuydkcv" onClick="window.location='?khoatrang=QuanLyCV'">Hủy</button>
            </div>
          </form>
        </div>
      </div>
    </div>
