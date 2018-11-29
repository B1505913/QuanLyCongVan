
<script src="js/jquery.dataTables.min.js"/></script>
<script src="js/dataTables.bootstrap.min.js"/></script>
<script language="javascript">
	function deleteConfirm(){
      if(confirm("Bạn có chắc chắn muốn xóa!")){
        return true;
      }
       else{
          return false;
           }
}
</script>  
<script language="javascript">
		$(document).ready(function() {
    var table = $('#tablecv').DataTable( {
        responsive: true,
		"language": {
                "lengthMenu": "Hiển thị _MENU_ dòng dữ liệu",
                "info": "Hiển thị _END_ trong tổng số _MAX_ dòng dữ liệu",
                "infoEmpty": "Dữ liệu rỗng",
                "emptyTable": "Chưa có dữ liệu nào",
                "processing": "Đang xử lý...",
                "search": "Tìm kiếm:",
                "loadingRecords": "Đang load dữ liệu...",
                "zeroRecords": "không tìm thấy dữ liệu",
                "infoFiltered": "(Được từ tổng số _MAX_ dòng dữ liệu)",
                "paginate": {
                    "first": "|<",
                    "last": ">|",
                    "next": "Sau",
                    "previous": "Trước"
                }
            },
            "lengthMenu": [[2, 5, 10, 15, 20, 25, 30, -1], [2, 5, 10, 15, 20, 25, 30, "Tất cả"]]
    } );
    new $.fn.dataTable.FixedHeader( table );
} );		
    </script>         
<?php
	include('connection.php');
?>
<?php
			include_once 'connection.php';
			//Kiểm tra xem có truyền mã để xóa không
			if(isset($_GET["ma"])){
			//Nếu xóa thì lấy mã và tiến hành xóa
				$maxoa = $_GET["ma"];
				mysqli_query($conn, "DELETE FROM user WHERE Id_User= $maxoa");
				echo '<meta http-equiv="refresh" content="0;URL=TrangChu.php?khoatrang=DanhSachND"/>';
			}
?>
<?php
		if (isset($_POST['btnXoa'])&&isset($_POST['checkbox'])) 
		{
			for ($i = 0; $i < count($_POST['checkbox']); $i++) 
			{
						$ma = $_POST['checkbox'][$i];
						mysqli_query($conn, "delete FROM user WHERE Id_User = $ma");
			}
		}
?>
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
					<div class="row">
							<h3 class="tieudeQLCV">Danh sách người dùng</h3>
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 nutdkcvcottrai">
								<button class="dkvc"><i class="fas fa-plus"></i></button><a href="TrangChu.php?khoatrang=ThemMoiND" class="chuthemmoi">Thêm mới</a>
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right tkcv_cotphai">
								
							</div>
					</div> <!-- end row1 -->
					<form action="" method="post" id="QuanLyCV" enctype="" name="QuanLyCV">
							<table class="table table-striped "  id="tablecv">
								<thead>
							      <tr>
							        <!--<th><i class="fas fa-check-square"></i></th>-->
							        <th>STT</th>
							        <th>Tên đăng nhập</th>
							        <th>Họ và tên</th>
							        <th>Email</th>
							        <th>Số điện thoại</th>
							        <th>Chức vụ</th>
							        <th>Quyền</th>
							        <th>Cập nhật</th>
							        <th>Xóa</th>
							      </tr>
							 	</thead>
							<tbody>	 
                            <?php 	
									$stt =1;
									$result = mysqli_query($conn, "SELECT a.*, b.* FROM account as a JOIN user AS b ON a.Id_Acc = b.Id_Acc");
									while($row = mysqli_fetch_row($result)){
										$ma = $row[3];
							?> 
						      <tr>
						        <!--<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $row[3]; ?>"></td>-->
                                
						        <td><?php echo $stt; ?></td>
						        <td><?php echo $row[0];?></td>
						        <td><?php echo $row[4]; ?></td>
						        <td><?php echo $row[9];?></td>
						        <td><?php echo $row[8]; ?></td>
						        <td><?php echo $row[5];?></td>
						        <td style="text-align:center;"><?php echo $row[2]; ?></td>
						        <td><a href="TrangChu.php?khoatrang=CapNhatND&ma=<?php echo $row[3]  ?>"><i class="fas fa-pen-square"></i></a></td>
						        <td><a onclick="return deleteConfirm()" href="DanhSachND.php?ma=<?php echo $row['3'] ?>"><i class="fas fa-minus-circle"></i></a></td>						      
                                </tr>
                                <?php
								$stt ++;
								 }
								 
								 ?>
  						  </tbody>
                            
					  		</table>

					  		<!--<div class="pull-left nutxoanhieu"><input type="button" name="btnXoa" id="btnXoa" class="xoanhieu btn btn-danger" value="Xóa mục chọn" ></div>-->
					</form>
					
				</div>

