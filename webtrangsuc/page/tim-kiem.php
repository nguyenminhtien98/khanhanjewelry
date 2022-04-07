
<?php
	//tìm kiếm
	$tukhoa = isset($_GET['tu-khoa']) ? $_GET['tu-khoa'] :"";
	if ($tukhoa) {
		$where = "WHERE 'ten' LIKE '%". $tukhoa . "%'";	
	}
	
	$param = "";
	$sortParam = "";
	$orderConditon = "";
	//Sắp xếp
	$orderField = isset($_GET['field']) ? $_GET['field'] : "";
	$orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
	if(!empty($orderField)
		&& !empty($orderSort)){
		$orderConditon = "ORDER BY `san_pham`.`".$orderField."` ".$orderSort;
		$param .= "field=".$orderField."&sort=".$orderSort." ";
	}
	//phân trang
	$sosp1trang = 16;
	$page = !empty($_GET['page']) ? $_GET['page']:1;
	$offset = ($page -1) * $sosp1trang;
	// nếu trên thanh địa chỉ có $tukhoa thì truy vấn như dưới
	if ($tukhoa) {
	$query_all_sanpham = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE ten LIKE '%". $tukhoa . "%' ORDER BY id_sp DESC LIMIT " . $sosp1trang . " OFFSET " . $offset);$tongsanpham = mysqli_query($conn, "SELECT * FROM san_pham WHERE ten LIKE '%". $tukhoa . "%'");
	// còn trên thanh địa chỉ không có $tukhoa thì truy vấn như dưới
	}else{$query_all_sanpham = mysqli_query($conn, "SELECT * FROM `san_pham` ".$orderConditon." LIMIT " . $sosp1trang . " OFFSET " . $offset);$tongsanpham = mysqli_query($conn, "SELECT * FROM san_pham ");}
	$tongsanpham = $tongsanpham->num_rows;
	$tongPage = ceil($tongsanpham / $sosp1trang);	
?>

<div class="tim-kiem">
    <div class="ds_sanpham">
        <div class="ds_sanpham_main">
            <div class="ds_sanpham_header">
                <div class="ten_danh_muc" style="padding-top: 20px;"><a href="#">Trang chủ</a> / <span>Tìm kiếm</span></div>
                <div class="kq-timkiem_sapxep">
                    <div class="ket-qua_tim-kiem"><h2>Kết quả tìm kiếm cho "<?=isset($_GET['tu-khoa']) ? $_GET['tu-khoa'] : ""?>"</h2></div>
                </div>
            </div>
            <div class="list_ds_sanpham">
                <div class="list">
                    <div class="row">
                        <?php
                            while($row_ds_all_sanpham = mysqli_fetch_array($query_all_sanpham)){
                        ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="avatar">
                                    <div class="box-hover">
                                        <a href="trang-suc/<?php echo $row_ds_all_sanpham['id_sp'] ?>-<?php echo $row_ds_all_sanpham['code'] ?>.html"><img src="./images_sanpham/<?php echo $row_ds_all_sanpham['anh_dai_dien']?>" alt="Image"/></a>
                                        <a href="trang-suc/<?php echo $row_ds_all_sanpham['id_sp'] ?>-<?php echo $row_ds_all_sanpham['code'] ?>.html"><img class="img-change" src="./images_sanpham/<?php echo $row_ds_all_sanpham['anh_ct']?>" alt="Image" style="width: 75%; margin: auto;"/></a>
                                    </div>
                                    <div class="addcart">
                                        <a onclick="addcart(this)" class="themvaogio">Thêm Vào Giỏ</a>
                                    </div>
                                    <?php
                                        if( $row_ds_all_sanpham['giam_gia']==1){
                                    ?>	
                                    <div class="giamgia"><p style="color: #da262e;">SALE</p></div>
                                    <?php
                                        }elseif($row_ds_all_sanpham['moi_ve']==1){
                                    ?>
                                    <div class="giamgia"><p>NEW</p></div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <a href="trang-suc/<?php echo $row_ds_all_sanpham['id_sp'] ?>-<?php echo $row_ds_all_sanpham['code'] ?>.html">
                                    <?php
                                        if( $row_ds_all_sanpham['giam_gia']==1){
                                    ?>  
                                    <div class="name_gia">
                                        <input type="hidden" name="id_sp" value="<?php echo $row_ds_all_sanpham['id_sp'] ?>">
                                        <h5><?php echo $row_ds_all_sanpham['ten'] ?></h5>
                                        <span style="color: #af203c"><?php echo number_format($row_ds_all_sanpham['gia_giam_gia'], 0, ",", ".")?><sup class="gia">₫</sup></span>
                                        <input type="hidden" name="soluong" value="1">
                                        <span style="text-decoration: line-through; padding-right: 10px; color: #707070;"><?php echo number_format($row_ds_all_sanpham['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
                                    </div>
                                    <?php
                                        }else{
                                    ?>
                                    <div class="name_gia">
                                        <input type="hidden" name="id_sp" value="<?php echo $row_ds_all_sanpham['id_sp'] ?>">
                                        <h5><?php echo $row_ds_all_sanpham['ten'] ?></h5>
                                        <span><?php echo number_format($row_ds_all_sanpham['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
                                        <input type="hidden" name="soluong" value="1">
                                    </div>
                                    <?php
                                        }
                                    ?>    
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                        <div class="page"></div>
                            <ul class="pagination">
                              <?php $param = "";
                                if($tukhoa){
                                    $param = "tu-khoa=".$tukhoa."&";
                              } ?>	
                              <!-- lùi page -->
                              <?php if ($page > 1) {
                                        $prev_page = $page -1 ?>
                              <?php } ?>
                              <li class="page-item"><a <?php if(isset($_GET['page']) && $_GET['page'] > 1 ) { ?> style="cursor: pointer;" <?php } ?> style="cursor:no-drop;" class="page-link" href="?xem=tim-kiem&<?=$param?>&page=<?= $prev_page ?>"><</a></li>
                              <!-- số page -->
                              <?php for($num = 1; $num <= $tongPage; $num++ ) { ?>
                                <?php if($num > $page -3 && $num < $page +3) { ?>
                                    <li class="page-item"><a <?php if ($num == $page) echo " style = 'background: black; border: 1px solid black; color: white;' " ?> class="page-link" href="?xem=tim-kiem&<?=$param?>&page=<?= $num ?>"><?= $num ?></a></li>
                                <?php } ?>
                              <?php } ?>
                              <li class="page-item"><a class="page-link" style="cursor: no-drop; color: #d9d9d9;">...</a></li>
                              <!-- end page -->
                              <?php $end_page = $tongPage;?>
                              <li class="page-item"><a class="page-link" href="?xem=tim-kiem&<?=$param?>&page=<?= $end_page ?>"><?= $end_page ?></a></li>
                              <!-- next page -->
                              <?php if ($page < $tongPage) {
                                        $next_page = $page + 1;?>
                              <?php }?>
                              <li class="page-item"><a <?php if(isset($_GET['page']) && $_GET['page'] == $end_page ) { ?> style="cursor: no-drop;" <?php } ?> class="page-link" href="?xem=tim-kiem&<?=$param?>&page=<?= $next_page ?>">></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
