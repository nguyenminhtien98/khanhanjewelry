
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
	$query_sanpham_banchay = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE ban_chay = 1 ".$orderConditon);
	}else{$query_sanpham_banchay = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE ban_chay = 1 ORDER BY `san_pham`.`id_sp` DESC");}		
?>

<div class="ds_sanpham_ban_chay">
	<div class="ds_sanpham_main">
		<div class="ds_sanpham_header">
        	<div class="ten-dm_sap-xep" style="border-bottom: 1px solid #3e3e3e; padding-bottom: 20px">
                <div class="ten_danh_muc" style="padding-top: 0px;"><h2>TRANG SỨC BÁN CHẠY</h2></div>
                <div class="sap_xep" style="padding-top: 0px;">
                    <h5>Sắp xếp theo: </h5>
                    <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                        <option value="trang-suc-ban-chay.html">Mặc định</option>
                        <!-- sắp xếp giá giảm dần -->
                        <option <?php if(isset($_GET['field']) && $_GET['sort'] == "desc") { ?> selected <?php } ?> value="?xem=ds_sanpham_banchay&<?=$sortParam?>field=gia_ban&sort=desc">Giá giảm dần</option>
                        <!-- sắp xếp giá tăng dần -->
                        <option <?php if(isset($_GET['field']) && $_GET['sort'] == "asc") { ?> selected <?php } ?> value="?xem=ds_sanpham_banchay&<?=$sortParam?>field=gia_ban&sort=asc">Giá tăng dần</option>
                    </select>
                </div>
            </div>
		</div>
        <div class="list_ds_sanpham">
        	<div class="list">
            	<div class="row">
                    <?php
						while($row_ds_sanpham_banchay = mysqli_fetch_array($query_sanpham_banchay)){
					?>
                    <div class="col-md-3">
                    	<div class="card">
                        	<div class="avatar">
                            	<div class="box-hover">
                                    <a href="trang-suc/<?php echo $row_ds_sanpham_banchay['id_sp'] ?>-<?php echo $row_ds_sanpham_banchay['code'] ?>.html"><img src="images_sanpham/<?php echo $row_ds_sanpham_banchay['anh_dai_dien'] ?>" style="max-width:100%;"></a>
                                    <a href="trang-suc/<?php echo $row_ds_sanpham_banchay['id_sp'] ?>-<?php echo $row_ds_sanpham_banchay['code'] ?>.html"><img class="img-change" src="./images_sanpham/<?php echo $row_ds_sanpham_banchay['anh_ct'] ?>"></a>
                                </div>
                                <div class="addcart">
                                	<a onclick="addcart(this)" class="themvaogio">Thêm Vào Giỏ</a>
                                </div>
                                <?php
									if( $row_ds_sanpham_banchay['giam_gia']==1){
								?>	
								<div class="giamgia"><p style="color: #da262e;">SALE</p></div>
								<?php
									}else{}
								?>
                            </div>
							<a href="trang-suc/<?php echo $row_ds_sanpham_banchay['id_sp'] ?>-<?php echo $row_ds_sanpham_banchay['code'] ?>.html">
                            	
                                <?php
									if( $row_ds_sanpham_banchay['giam_gia']==1){
								?>	
								<div class="name_gia">
									<input type="hidden" name="id_sp" value="<?php echo $row_ds_sanpham_banchay['id_sp'] ?>">
									<h5><?php echo $row_ds_sanpham_banchay['ten'] ?></h5>
									<span style="color: #af203c"><?php echo number_format($row_ds_sanpham_banchay['gia_giam_gia'], 0, ",", ".")?><sup class="gia">₫</sup></span>
									<input type="hidden" name="soluong" value="1">
									<span style="text-decoration: line-through; padding-right: 10px; color: #707070;"><?php echo number_format($row_ds_sanpham_banchay['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
								</div>
								<?php
									}else{
								?>
								<div class="name_gia">
									<input type="hidden" name="id_sp" value="<?php echo $row_ds_sanpham_banchay['id_sp'] ?>">
									<h5><?php echo $row_ds_sanpham_banchay['ten'] ?></h5>
									<span><?php echo number_format($row_ds_sanpham_banchay['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
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
                </div>
            </div>
		</div>
	</div>
</div>
