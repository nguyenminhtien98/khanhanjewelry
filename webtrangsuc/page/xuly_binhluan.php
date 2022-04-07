<?php
	include("../lib/dbCon.php");

	if(isset($_POST["comment_load_data"])) {
		$id_sp = $_POST["id_sp"];
		$comment_query = "SELECT * FROM comment WHERE id_sp = '$id_sp' AND trang_thai = 'Đã duyệt'";
		$comment_query_run = mysqli_query($conn, $comment_query);
		$array_result = [];
		if(mysqli_num_rows($comment_query_run) > 0) {
			foreach($comment_query_run as $row) {
				array_push($array_result, ['comment'=>$row]); 
			}
			header('Content-type: application/json');
			echo json_encode($array_result);
			// echo '<script>close_form_binhluan()</script>';
		}else{
			echo "Chưa có bình luận nào";
		}
	}

	if(isset($_POST["add_cmt"])) {
		
			$msg = $_POST["msg"];
			$id_sp = $_POST["id_sp"];
			$ten = $_POST["ten"];
			$rating = $_POST["rating"];
		
		$insert_comment = "INSERT INTO comment VALUES(null, '$id_sp', '$ten', '$rating', NOW(), '$msg', 'Chưa duyệt')";
		mysqli_query($conn,$insert_comment);
	}
?>
