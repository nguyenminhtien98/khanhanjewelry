<?php
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
	if (isset($_GET['field'])) {
	$query_all_sanpham = mysqli_query($conn, "SELECT * FROM `san_pham` ".$orderConditon." LIMIT " . $sosp1trang . " OFFSET " . $offset);$tongsanpham = mysqli_query($conn, "SELECT * FROM san_pham");
	}else{$query_all_sanpham = mysqli_query($conn, "SELECT * FROM `san_pham` where menu_parent_id=1 ORDER BY `id_sp` DESC LIMIT " . $sosp1trang . " OFFSET " . $offset);$tongsanpham = mysqli_query($conn, "SELECT * FROM san_pham");}
	if (isset($_GET['field']) && $_GET['field']== 'moi_ve') {
	$query_all_sanpham = mysqli_query($conn, "SELECT * FROM `san_pham` where moi_ve=1 ORDER BY `id_sp` DESC LIMIT " . $sosp1trang . " OFFSET " . $offset);$tongsanpham = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE moi_ve=1 ORDER BY `id_sp` DESC;");}
	if (isset($_GET['field']) && $_GET['field']== 'ban_chay') {
	$query_all_sanpham = mysqli_query($conn, "SELECT * FROM `san_pham` where ban_chay=1 ORDER BY `id_sp` DESC LIMIT " . $sosp1trang . " OFFSET " . $offset);$tongsanpham = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE ban_chay=1 ORDER BY `id_sp` DESC;");}
	
	$tongsanpham = $tongsanpham->num_rows;
	$tongPage = ceil($tongsanpham / $sosp1trang);	
?>


<?php
	$qr = "
		SELECT * FROM danh_muc
		WHERE menu_id = '$_GET[menu_id]'
	";
	$query_ht_ten_dm = mysqli_query($conn,$qr);
	$ht_anh_dm = mysqli_fetch_array($query_ht_ten_dm);
?>

<div class="page_tat-ca-bo-suu-tap">
    <div class="ds_sanpham">
        <div class="ds_sanpham_main">
            <div class="ds_sanpham_header">
                <div class="anh_danhmuc" style="width:100%">
                    <img src="<?php echo $ht_anh_dm['anh_dai_dien'] ?>" style="width: 100%; height: 430px;" />
                </div>
                <div class="ten-dm_sap-xep">
                    <div class="ten_danh_muc"><a href="#">Trang chủ</a> / <span><?php echo $ht_anh_dm['ten'] ?></span></div>
                    <div class="sap_xep">
                        <h5>Sắp xếp theo: </h5>
                        <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                            <option value="tat-ca-trang-suc.html">Mặc định</option>
                            <!-- sắp xếp giá giảm dần -->
                            <option <?php if(isset($_GET['field']) && $_GET['sort'] == "desc") { ?> selected <?php } ?> value="tat-ca-trang-suc/gia-giam-dan.html">Giá giảm dần</option>
                            <!-- sắp xếp giá tăng dần -->
                            <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "asc") { ?> selected <?php } ?> value="tat-ca-trang-suc/gia-tang-dan.html">Giá tăng dần</option>
                            <!-- sắp xếp sản phẩm mới về -->
                            <option <?php if(isset($_GET['field']) && $_GET['field'] == "moi_ve") { ?> selected <?php } ?> value="tat-ca-trang-suc/moi-nhat.html">Mới nhất</option>
                            <!-- sắp xếp sản phẩm bán chạy -->
                            <option <?php if(isset($_GET['field']) && $_GET['field'] == "ban_chay") { ?> selected <?php } ?> value="tat-ca-trang-suc/ban-chay.html">Bán chạy</option>
                        </select>
                    </div>
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
                                    <a href="trang-suc/<?php echo $row_ds_all_sanpham['id_sp'] ?>-<?php echo $row_ds_all_sanpham['code'] ?>.html"><img src="<?php echo $row_ds_all_sanpham['anh_dai_dien']?>" alt="Image"/></a>
                                    <div class="addcart">
                                        <a href="?xem=giohang&action=add_ds&id_sanpham=<?php echo $row_ds_all_sanpham['id_sp'] ?>" class="themvaogio">Thêm Vào Giỏ</a>
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
                                    <div class="name_gia">
                                        <h5><?php echo $row_ds_all_sanpham['ten'] ?></h5>
                                        <span><?php echo number_format ($row_ds_all_sanpham['gia_ban'])?><sup class="gia">₫</sup></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                        <div class="page"></div>
                            <ul class="pagination">
                              <!-- lùi page -->
                              <?php if ($page > 1) {
                                        $prev_page = $page -1 ?>
                              <?php } ?>
                              <li class="page-item"><a <?php if(isset($_GET['page']) && $_GET['page'] > 1 ) { ?> style="cursor: pointer;" <?php } ?> style="cursor:no-drop;" class="page-link" href="?xem=ds_tatcatrangsuc&page=<?= $prev_page ?>&<?=$param?>"><</a></li>
                              <!-- số page -->
                              <?php for($num = 1; $num <= $tongPage; $num++ ) { ?>
                                <?php if($num > $page -3 && $num < $page +3) { ?>
                                    <li class="page-item"><a <?php if ($num == $page) echo " style = 'background: black; border: 1px solid black; color: white;' " ?> class="page-link" href="tat-ca-trang-suc-<?php echo $ht_anh_dm['menu_id'] ?>&<?=$param?>&page=<?= $num ?>.html"><?= $num ?></a></li>
                                <?php } ?>
                              <?php } ?>
                              <li class="page-item"><a class="page-link" style="cursor: no-drop; color: #d9d9d9;">...</a></li>
                              <!-- end page -->
                              <?php $end_page = $tongPage;?>
                              <li class="page-item"><a class="page-link" href="tat-ca-trang-suc-<?php echo $ht_anh_dm['menu_id'] ?>&page=<?= $end_page ?>&<?=$param?>.html"><?= $end_page ?></a></li>
                              <!-- next page -->
                              <?php if ($page < $tongPage) {
                                        $next_page = $page + 1;?>
                              <?php }?>
                              <li class="page-item"><a <?php if(isset($_GET['page']) && $_GET['page'] == $end_page ) { ?> style="cursor: no-drop;" <?php } ?> class="page-link" href="?xem=ds_tatcatrangsuc&page=<?= $next_page ?>&<?=$param?>">></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
