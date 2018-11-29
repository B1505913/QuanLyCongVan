
	<?php 
	include_once 'connection.php';

	// THỰC HIỆN XÓA 1 DONG
		if(isset($_GET['ma'])){

           $id = @$_GET['ma']; 
           // lấy Opi_Content
           $sql = "select Opi_Approved from opinion where Opi_Id = '$id'";

           $query = mysqli_query($conn, $sql);
           $row = array();
           while($row2=mysqli_fetch_assoc($query)){
           		$row[] = $row2;
           }
        

	        foreach($row as $value){
	        	$Opi_Approved = $value['Opi_Approved'];
	        }

	        // thuc hien xóa

            $sql = "delete from opinion where OPi_id = '".$id."' and Opi_Approved = '".$Opi_Approved."'";
          //die();
          $query = mysqli_query($conn, $sql);
          
          header('location: TrangChu.php?khoatrang=PheDuyetCV');

        }


        /*echo '<pre>';
		print_r($_POST);
		echo '</pre>';*/

        if(isset($_POST['check']) && isset($_POST['btnXoaNhieu'])){

             $ids = @$_POST['check']; // lưu mảng vào $ids

             $valueIds="";
             foreach($ids as $value){
				$valueIds .= ",   '$value'"; // 3 khoảng trắng
				$valueIds = substr($valueIds, 1);
		 	}

		 	// lấy Opi_Content
		 	$sql = "select Opi_Approved from opinion where Opi_Id in (".$valueIds.")";
		 	$query = mysqli_query($conn, $sql);
		 	$query = mysqli_query($conn, $sql);
            $row = array();
            while($row2=mysqli_fetch_assoc($query)){
           		$row[] = $row2;
           }

           // DUYET MANG LAY Opi_Content
           $valueApp="";
             foreach($row as $value2){
				foreach($value2 as $value){
					$valueApp .= ",   '$value'"; // 3 khoảng trắng
					$valueApp = substr($valueApp, 1);
				}
		 	}
		 	echo '<pre>';
		print_r($row);
		echo '</pre>';

		 	echo $sql2 = "delete from opinion where Opi_Id in(".$valueIds.") and Opi_Approved in(".$valueApp.")";
		 	//die();
		 	$query = mysqli_query($conn, $sql2);

		 	header('location: TrangChu.php?khoatrang=PheDuyetCV');
		 	
        }
	 ?>
</body>
</html>