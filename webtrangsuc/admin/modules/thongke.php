<?php
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	include("../../lib/dbCon.php");
	include("../carbon/autoload.php");
	
	if(isset($_POST['thoigian'])){
		$thoigian = $_POST['thoigian'];
	}else{
		$thoigian = '';
		$subdays = Carbon::now("Asia/Ho_chi_minh")->subdays(7)->toDateString();	
	}
	
	if($thoigian=='7ngay'){
		$subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(7)->toDateString();
	}elseif($thoigian=='28ngay'){
		$subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(28)->toDateString();
	}elseif($thoigian=='90ngay'){
		$subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(90)->toDateString();
	}elseif($thoigian=='365ngay'){
		$subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(365)->toDateString();
	}
	
	$now = Carbon::now("Asia/Ho_chi_minh")->toDateString();
	
	$sql = "SELECT * FROM thong_ke WHERE ngaydat BETWEEN '$subdays' AND '$now' ORDER BY ngaydat ASC";
	$sql_query = mysqli_query($conn,$sql);
	
	while($val = mysqli_fetch_array($sql_query)){
		$chart_data[] = array(
			'date' => $val['ngaydat'],
			'order' => $val['donhang'],
			'sales' => $val['doanhthu'],
			'quantity' => $val['soluongban']
		);
	}
	
	echo $data = json_encode($chart_data);
?>