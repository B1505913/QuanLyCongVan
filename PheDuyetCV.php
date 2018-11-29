<script src="js/jquery.dataTables.min.js"/></script>
<script src="js/dataTables.bootstrap.min.js"/></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<?php 
include 'connection.php';
$sql = "select Name_In, From_In, To_In, Content_In, Signer_In, Status_In, Name_Off, Opi_Id, Opi_Approved
from indocument a, office b, opinion c
where a.Id_Off = b.Id_Off and a.Id_In = c.Id_In ";
$query = mysqli_query($conn, $sql);
	
	$row = array();
	while($row2=mysqli_fetch_assoc($query)){
		$row[] = $row2; 
	}
	
	if(!empty($row)){
		$html = array();
		$status = "";
		$i=1;
		foreach($row as $item){
			/*@$status = ($item['Status_In']==2)? 'Đã phê  duyệt' : 'Chưa phê duyệt';*/
			if($item['Status_In']==1){
				$status = "Đã kiểm duyệt";
			}
			else if($item['Status_In'] ==2){
				$status = "Đã phê duyệt";
			}else if($item['Status_In']==0){
				$status = "Chưa kiểm duyệt";
			}
			$html[] = '
			
			<tr>
			<td><input type="checkbox" name="check[]" value="'.$item['Opi_Id'].'"></td>
			<td>'.$i.'</td>
			<td>'.$item['Opi_Id'].'</td>
			<td>'.$item['Name_In'].'</td>
			<td>'.$item['From_In'].'</td>
			<td>'.$item['To_In'].'</td>
			<td>'.$item['Content_In'].'</td>
			<td>'.$item['Opi_Approved'].'</td>
			<td>'.$item['Signer_In'].'</td>
			<td>'.$item['Name_Off'].'</td>
			<td>'.$status.'</td>
			
			<td><a href="TrangChu.php?khoatrang=CapNhatPD&ma='.$item['Opi_Id'].'"><i class="fas fa-pen-square"></i></a></td>
			<td><a onclick="return deleteConfirm()" href="XoaPD.php?ma='.$item['Opi_Id'].'"><i class="fas fa-minus-circle"></i></a></td>
			</tr>
			';
			$i++;
		}
		
	}

	// ham option của mã công văn
	function option($conn){
		$sql = "select Id_In from indocument";

		$query = mysqli_query($conn, $sql);
		echo "<select class='form-control' id='macv' name='macv'>";
		while($row2=mysqli_fetch_assoc($query)){	

			echo "<option value='".$row2['Id_In']."'>".$row2['Id_In']."</option>";

		}
		echo "</select>";
	}


	
	?>


	<script language="javascript">
		$(document).ready(function() {
			var table = $('#tableQLCV').DataTable( {
				responsive: true,
				"language": {
					"lengthMenu": "Hiển thị _MENU_ dòng dữ liệu",
					"info": "Hiển thị _START_ trong tổng số _TOTAL_ dòng dữ liệu",
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
						"next": ">>",
						"previous": "<<"
					}
				},
				"lengthMenu": [[2, 5, 10, 15, 20, 25, 30, -1], [2, 5, 10, 15, 20, 25, 30, "Tất cả"]]
			} );
			new $.fn.dataTable.FixedHeader( table );
		} );		
	</script>

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


	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
		<div class="row">
			<h3 class="tieudeQLCV">Phê duyệt công văn</h3>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 nutdkcvcottrai">
				<button class="dkvc"><a href="TrangChu.php?khoatrang=ThemYKienPD&ma='.$item['Opi_Id'].'"><i class="fas fa-plus"></i></a></button><span class="chuthemmoi">Thêm mới</span>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right tkcv_cotphai">
			</div>
		</div> <!-- end row1 -->
		<form action="XoaPD.php" method="post" id="QuanLyCV" enctype="" name="QuanLyCV">
			<table class="table"  id="tableQLCV">
				<thead>
					<tr>
						<th><i class="fas fa-check-square"></i></th>
						<th>STT</th>
						<th>Mã ý kiến</th>
						<th>Tên công văn</th>
						<th>Từ</th>
						<th>Đến</th>
						<th>Trích yếu</th>
						<th>Ý kiến Phê duyệt</th>
						<th>Đơn vị</th>
						<th>Người ký</th>
						<th>Trạng thái</th>
						<!-- <th>Ghi ý kiến</th> -->
						<th>Cập nhật</th>
						<th>Xóa ý kiến</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(!empty($html)){
						foreach($html as $value){
							echo $value;
						}
					}
					?>

				</tbody>				  		</table>

				<div class="pull-left nutxoanhieu"><a  onclick="return deleteConfirm()" href="XoaPD.php"><button type="submit" name="btnXoaNhieu" class="xoanhieu">Xóa mục chọn</button></a></div>
			</form>

				</div>

				


