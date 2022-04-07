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
	$query_ds_sanpham = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE menu_id = '$_GET[menu_id]' ".$orderConditon);
	}else{$query_ds_sanpham = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE menu_id = '$_GET[menu_id]' ORDER BY `san_pham`.`id_sp` DESC");}		
?>

<?php
	$qr = "
		SELECT * FROM danh_muc
		WHERE menu_id = '$_GET[menu_id]'
	";
	$query_ht_ten_dm = mysqli_query($conn,$qr);
	$ht_anh_dm = mysqli_fetch_array($query_ht_ten_dm);
?>

<div class="ds_sanpham">
	<div class="ds_sanpham_main">
		<div class="ds_sanpham_header">
            <div class="anh_danhmuc" style="width:100%">
            	<img src="./admin/images/<?php echo $ht_anh_dm['hinh_anh'] ?>"/>
 			</div>
            <div class="ten-dm_sap-xep">
                <div class="ten_danh_muc"><a href="#">Trang chủ</a> / <span><?php echo $ht_anh_dm['ten'] ?></span></div>
                <div class="sap_xep">
                    <h5>Sắp xếp theo: </h5>
                    <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                        <option value="">Mặc định</option>
                        <!-- sắp xếp giá giảm dần -->
                        <option <?php if(isset($_GET['field']) && $_GET['sort'] == "desc") { ?> selected <?php } ?> value="?xem=ds_sanpham&menu_id=<?php echo $_GET['menu_id']?>&<?=$sortParam?>field=gia_ban&sort=desc">Giá giảm dần</option>
                        <!-- sắp xếp giá tăng dần -->
                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "asc") { ?> selected <?php } ?> value="?xem=ds_sanpham&menu_id=<?php echo $_GET['menu_id']?>&<?=$sortParam?>field=gia_ban&sort=asc">Giá tăng dần</option>
                        <!-- sắp xếp sản phẩm mới về -->
                        <option <?php if(isset($_GET['field']) && $_GET['field'] == "moi_ve") { ?> selected <?php } ?> value="?xem=ds_sanpham&menu_id=<?php echo $_GET['menu_id']?>&<?=$sortParam?>field=moi_ve&sort=desc">Mới nhất</option>
                        <!-- sắp xếp sản phẩm bán chạy -->
                        <option <?php if(isset($_GET['field']) && $_GET['field'] == "ban_chay") { ?> selected <?php } ?> value="?xem=ds_sanpham&menu_id=<?php echo $_GET['menu_id']?>&<?=$sortParam?>field=ban_chay&sort=desc">Bán chạy</option>
                    </select>
                </div>
            </div>
		</div>
        <section id="list_ds_sanpham">
            <div class="list_ds_sanpham">
                <div class="list">
                    <div class="row">
                        <?php
                            $menu_id = $_GET["menu_id"];
                            settype($menu_id, "int");
                            while($row_ds_sanpham = mysqli_fetch_array($query_ds_sanpham)){
                        ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="avatar">
                                    <div class="box-hover">
                                        <a href="trang-suc/<?php echo $row_ds_sanpham['id_sp'] ?>-<?php echo $row_ds_sanpham['code'] ?>.html"><img src="./images_sanpham/<?php echo $row_ds_sanpham['anh_dai_dien']?>" alt="Image"/></a>
                                        <a href="trang-suc/<?php echo $row_ds_sanpham['id_sp'] ?>-<?php echo $row_ds_sanpham['code'] ?>.html"><img class="img-change" src="./images_sanpham/<?php echo $row_ds_sanpham['anh_ct']?>" alt="Image" style="width: 75%; margin: auto;"/></a>
                                    </div>
                                    
                                    <div class="addcart">
                                        <a onclick="addcart(this)" class="themvaogio">Thêm Vào Giỏ</a>
                                    </div>
                                    <?php
                                        if( $row_ds_sanpham['giam_gia']==1){
                                    ?>	
                                    <div class="giamgia"><p style="color: #da262e;">SALE</p></div>
                                    <?php
                                        }elseif($row_ds_sanpham['moi_ve']==1){
                                    ?>
                                    <div class="giamgia"><p>NEW</p></div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <a href="trang-suc/<?php echo $row_ds_sanpham['id_sp'] ?>-<?php echo $row_ds_sanpham['code'] ?>.html">
                                    <?php
                                        if( $row_ds_sanpham['giam_gia']==1){
                                    ?>	
                                    <div class="name_gia">
                                        <input type="hidden" name="id_sp" value="<?php echo $row_ds_sanpham['id_sp'] ?>">
                                        <h5><?php echo $row_ds_sanpham['ten'] ?></h5>
                                        <span style="color: #af203c"><?php echo number_format($row_ds_sanpham['gia_giam_gia'], 0, ",", ".")?><sup class="gia">₫</sup></span>
                                        <input type="hidden" name="soluong" value="1">
                                        <span style="text-decoration: line-through; padding-right: 10px; color: #707070;"><?php echo number_format($row_ds_sanpham['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
                                    </div>
                                    <?php
                                        }else{
                                    ?>
                                    <div class="name_gia">
                                        <input type="hidden" name="id_sp" value="<?php echo $row_ds_sanpham['id_sp'] ?>">
                                        <h5><?php echo $row_ds_sanpham['ten'] ?></h5>
                                        <span><?php echo number_format($row_ds_sanpham['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
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
        </section>
	</div>
</div>
