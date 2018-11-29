    <!-- Bootstrap -->
   <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--datatable
    <script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>-->
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
    
       <?php
			include_once ("connection.php");
			
			if(isset($_GET["ma"])){
				
				$macv = $_GET["ma"];
				mysqli_query($conn, "delete from indocument where Id_In=$macv");
				echo'<meta http-equiv="refresh" content="0;URL=TrangChu.php?khoatrang=QuanLyCV"/>';
				}
		?>
        <?php
        	if(isset($_POST['btnXoa']) && isset($_POST['checkbox'])){
				for($i = 0; $i < count($_POST['checkbox']); $i++){
					$macv = $_POST['checkbox'][$i];
					mysqli_query($conn, "delete from indocument where Id_In = $macv");
					}
				}
		?>
        
        <script language="javascript">
        	function deleteConfirm(){
				if(confirm("Bạn chắc chắn muốn xóa!")){
					return true;
					}
					else{
						return false;
						}
				}
        </script>
        <!--phan trang-->
        <script language="javascript">
		
        	$(document).ready(function(){
				var table = $('#tableQLCV').DataTable({
					responsive: true,
					"language":{
						"lengthMenu": "Hiển thị _MENU_ dòng trên 1 trang",
						"info": "Hiển thị _END_ trong tổng _MAX_ dòng dữ liệu",
						"infoEmpty": "Dữ liệu rỗng",
						"EmptyTable": "Chưa có dữ liệu nào",
						"processing": "Đang xử lý,...",
						"search": "Tìm kiếm:",
						"loadingRecords": "Đang load dữ liệu...",
						"zeroRecords": "Không tìm thấy dữ liệu",
						"infoFiltered": "(Được từ tổng số _MAX_ dòng dữ liệu)",
						"paginate":{
							"first":      "Trước",
							"last":       "Sau",
							"next":       "Tiếp",
							"previous":   "Trước"
							}
						},
						"lengthMenu": [[3, 5, 10, 15, 20, -1],[3, 5, 10, 15, 20,  "Tất cả"]]
					});
					new $.fn.dataTable.FixedHeader( table );
				});
        </script>
        <form name="frmXoa" method="post" action="">
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
        <h1>Quản lí công văn</h1>
        <p>
            <button class="dkvc"><i class="fas fa-plus"></i></button>
			<a href="TrangChu.php?khoatrang=DangKyCV" class="chuthemmoi"><font size="4px;">Thêm mới</font></a>
			
            	<!--<input type="submit" value="Xóa" name="btnXoa" onclick="return deleteConfirm()" class="btn btn-primary" /> -->
 
        </p>
        <table id="tableQLCV" class="table table-striped " cellspacing="0" width="100%" bgcolor="#33CCCC">
            <thead>
                <tr>
                	 <th><i class="fas fa-check-square"></i></th>
							        <th>IDCV</th>
							        <th>Tên công văn</th>
							        <th>Từ</th>
							        <th>Đến</th>
							        <th>Nội dung</th>
							        <th>Ngày công văn đến</th>
							        <th>Hạn cuối xử lí công văn</th>
							        <th>Trạng thái</th>
							        <th>File</th>
							        <th>Cập nhật</th>
							        <th>Xóa ý kiến</th>
                </tr>
             </thead>
		
			<tbody>
            <?php
					
			
				$result = mysqli_query($conn, "SELECT Id_In, Name_In, From_In, To_In, Content_In, Status_In, Date_In, DaedLine_In, taptin_In FROM indocument i  ORDER BY Id_In ASC");
				while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$files_field= $row['taptin_In'];
					$idcv = $row['Id_In'];
					$files_show= "pdf/$files_field";
			?>
			<tr>

						        <td><input type="checkbox" name="checkbox[]" id="checkbox[]" 
                                value="<?php echo $row["Id_In"] ?>"></td>
						        <td><?php  echo $row["Id_In"] ?></td>
						        <td><?php echo $row["Name_In"] ?></td>
						        <td><?php echo $row["From_In"] ?></td>
						        <td><?php echo $row["To_In"] ?></td>
						        <td><?php echo $row["Content_In"] ?></td>
						        <td><?php echo $row["Date_In"] ?></td>
						        <td><?php echo $row["DaedLine_In"] ?></td>
						        <td><?php 
						        	if($row["Status_In"]==0){
						        		echo "<span style='color: red'>Chưa xử lí</span>"; 
						        	}

						        	if($row["Status_In"]==1){
						        		echo "<span style='color: orange'>Chờ bút phê</span>"; 
						        	}
						        	if($row["Status_In"]==2){
						        		echo "<span style='color: blue'>Đã xử lí</span>"; 
						        		 
						        	}
						        	?>	
						        </td>
						        <td><?php 
						        		if($files_field!=""){
						        		echo "<a href='$files_show' class='fas fa-eye' 
						        		target='_blank'></a>";}
						        	?>
						        </td>

						        <!-- "<a href='$files_show' target='_blank'>$files_field</a>}"-->
						        <td><a href="TrangChu.php?khoatrang=CapNhatCV&ma=<?php echo $row["Id_In"]  ?>">
                                <i class="fas fa-pen-square"></i></a></td>
						        <td><a onclick="return deleteConfirm()" 
                                href="?khoatrang=QuanLyCV&ma=<?php echo $row['Id_In']?>">
                                <i class="fas fa-minus-circle"></i></a></td>
						      </tr>	
                                     <?php
										}
										?>
			</tbody>
        
        </table>  
        <div class="pull-left nutxoanhieu btn-default"><a href="XoaKD.php"><input type="submit" value="Xóa mục chọn" name="btnXoa" onclick="return deleteConfirm()" class="btn btn-primary" /></a></div>
 </form>