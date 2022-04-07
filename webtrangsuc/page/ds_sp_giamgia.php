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
	
	if (isset($_GET['field'])) {
	$query_sp_giamgia = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE giam_gia = 1 ".$orderConditon);
	}else{$query_sp_giamgia = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE giam_gia = 1 ORDER BY `san_pham`.`id_sp` DESC");}		
?>

<div class="ds_sanpham">
	<div class="ds_sanpham_main">
		<div class="ds_sanpham_giamgia_header">
        	<div class="tieude_giamgia">
            	<h2>BÁN VÀ THANH LÝ ĐỒ TRANG SỨC</h2>
            	<p>Mua sắm các mặt hàng trang sức giải phóng mặt bằng trước khi chúng biến mất. Phần phù hợp với mức giá phù hợp đang chờ đợi bạn.</p>
        	</div>
            <div class="ten-dm_sap-xep">
                <div class="ten_danh_muc"><a href="#">Trang chủ</a> / <span>Giảm giá</span></div>
                <div class="sap_xep">
                    <h5>Sắp xếp theo: </h5>
                    <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                        <option value="trang-suc-giam-gia.html">Mặc định</option>
                        <!-- sắp xếp giá giảm dần -->
                        <option <?php if(isset($_GET['field']) && $_GET['sort'] == "desc") { ?> selected <?php } ?> value="?xem=ds_sp_giamgia&<?=$sortParam?>field=gia_giam_gia&sort=desc">Giá giảm dần</option>
                        <!-- sắp xếp giá tăng dần -->
                        <option <?php if(isset($_GET['field']) && $_GET['sort'] == "asc") { ?> selected <?php } ?> value="?xem=ds_sp_giamgia&<?=$sortParam?>field=gia_giam_gia&sort=asc">Giá tăng dần</option>
                    </select>
                </div>
            </div>
		</div>
        <div class="list_ds_sanpham">
        	<div class="list">
            	<div class="row">
                    <?php
						while($row_ds_sp_giamgia = mysqli_fetch_array($query_sp_giamgia)){
					?>
                    <div class="col-md-3">
                    	<div class="card">
                        	<div class="avatar">
                            	<div class="box-hover">
                                    <a href="trang-suc/<?php echo $row_ds_sp_giamgia['id_sp'] ?>-<?php echo $row_ds_sp_giamgia['code'] ?>.html"><img src="images_sanpham/<?php echo $row_ds_sp_giamgia['anh_dai_dien'] ?>" style="max-width:100%;"></a>
                                    <a href="trang-suc/<?php echo $row_ds_sp_giamgia['id_sp'] ?>-<?php echo $row_ds_sp_giamgia['code'] ?>.html"><img class="img-change" src="images_sanpham/<?php echo $row_ds_sp_giamgia['anh_ct'] ?>"></a>
                                </div>
                                <div class="addcart">
                                	<a onclick="addcart(this)" class="themvaogio">Thêm Vào Giỏ</a>
                                </div>
                            </div>
							<a href="trang-suc/<?php echo $row_ds_sp_giamgia['id_sp'] ?>-<?php echo $row_ds_sp_giamgia['code'] ?>.html">
                            	<div class="name_gia">
                            		<input type="hidden" name="id_sp" value="<?php echo $row_ds_sp_giamgia['id_sp'] ?>">
                                	<h5><?php echo $row_ds_sp_giamgia['ten'] ?></h5>
                                    <span style="color: #af203c"><?php echo number_format($row_ds_sp_giamgia['gia_giam_gia'], 0, ",", ".")?><sup class="gia">₫</sup></span>
                                    <input type="hidden" name="soluong" value="1">
                                    <span style="text-decoration: line-through; padding-right: 10px; color: #707070;"><?php echo number_format($row_ds_sp_giamgia['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
                                </div>
                            </a>
                    	</div>
                	</div>
                    <?php
						}
					?>
                </div>
            </div>
		</div>
	</div>
</div>
