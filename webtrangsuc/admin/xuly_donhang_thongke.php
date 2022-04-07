<!-- xử lý đơn hàng mới -->
<?php
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include("carbon/autoload.php");
	
	$now = Carbon::now("Asia/Ho_chi_minh")->toDateString();

	if(isset($_GET['id_donhang'])) {
		//xử lý đơn hàng mới
		$id_don_hang = $_GET['id_donhang'];
		$sql_update = "UPDATE don_hang SET trang_thai=2 WHERE id_don_hang='".$id_don_hang."'";
		$query = mysqli_query($conn,$sql_update);
		
		//thống kê doanh thu
		$sql_lietke_dh = "SELECT * FROM don_hang_chi_tiet,san_pham WHERE don_hang_chi_tiet.id_sp=san_pham.id_sp AND don_hang_chi_tiet.id_don_hang='$id_don_hang' ORDER BY don_hang_chi_tiet.id_don_hang_ct DESC";
		$query_lietke_dh = mysqli_query($conn,$sql_lietke_dh);
		
		$sql_thongke = "SELECT * FROM thong_ke WHERE ngaydat='$now'";
		$query_thongke = mysqli_query($conn,$sql_thongke);
		
		$soluongmua = 0;
		$doanhthu = 0;
		while($row = mysqli_fetch_array($query_lietke_dh)){
			$soluongmua+=$row['so_luong'];
			$doanhthu+=$row['gia_sp'];	
		}
		
		if(mysqli_num_rows($query_thongke)==0){
			$soluongban = $soluongmua;
			$doanhthu = $doanhthu;
			$donhang = 1;
			$sql_update_thongke = mysqli_query($conn, "INSERT INTO thong_ke (ngaydat,donhang,doanhthu,soluongban) VALUE ('$now', '$donhang', '$doanhthu', '$soluongban')");	
		}elseif(mysqli_num_rows($query_thongke)!=0){
			while($row_tk = mysqli_fetch_array($query_thongke)){
				$soluongban = $row_tk['soluongban']+$soluongmua;
				$doanhthu = $row_tk['doanhthu']+$doanhthu;
				$donhang = $row_tk['donhang']+1;
				$sql_update_thongke = mysqli_query($conn, "UPDATE thong_ke SET donhang='$donhang',doanhthu='$doanhthu',soluongban='$soluongban' WHERE ngaydat='$now'");
			}	
		}
		
		header("location:?xem=ds_don_hang");	
	}
?>



















































