
<?php
	// lấy danh sách menu theo các id menu
	$qr = "
		SELECT * FROM danh_muc
		WHERE menu_id IN (8,9,10,11,12,13,14,15,16,21)
	";
	$ds_danh_muc = mysqli_query($conn,$qr);
?>

<?php
	// nếu có get id danh mục thì lấy daanh sách sản phẩm theo get id danh mục	
	if (isset($_GET['id_danhmuc'])) {
	$ds_san_pham = mysqli_query($conn, "SELECT * FROM `san_pham` WHERE menu_id = '$_GET[id_danhmuc]' ORDER BY id_sp DESC");
	// còn không có get id danh mục thì lấy tất các sản phẩm
	}else{$ds_san_pham = mysqli_query($conn, "SELECT * FROM `san_pham` ORDER BY `san_pham`.`id_sp` DESC");}	
		
?>

<div class="qt_sanpham">
    <div class="main_top">
        <div class="duong_dan">
            <li><span class="glyphicon glyphicon-home"></span> Trang Chủ <span style="color: black;">></span> Quản Trị Sản Phẩm</li>
        </div>
    </div>
    <div class="main_content">
        <div class="tac_vu">
            <div class="them_moi">
                <a href="admin/?xem=them_san_pham"><li><span class="glyphicon glyphicon-plus"></span> Thêm Sản Phẩm</li></a>
            </div>
            <div class="xem_anhsp">
                <a href="admin/?xem=ds_anh_san_pham"><li><span class="glyphicon glyphicon-picture" style="padding-right: 5px;"></span> Xem Ảnh Sản Phẩm</li></a>
            </div>
            <div class="tim_kiem">
                <input type="text" placeholder="Search = Tên sản phẩm" name="search">
                <button type="submit">Tìm kiếm</button>
            </div>
            <div class="sap_xep_sp_admin">
                <h5>Lọc sản phẩm theo: </h5>
                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                    <option value="admin/?xem=ds_san_pham">Tất Cả Trang Sức</option>
                    <?php
                        while($row_ds_danh_muc = mysqli_fetch_array($ds_danh_muc)){
                    ?>
                    <option <?php if(isset($_GET['id_danhmuc']) && $_GET['id_danhmuc'] == $row_ds_danh_muc['menu_id']) { ?> selected <?php } ?> value="admin/?xem=ds_san_pham&id_danhmuc=<?php echo $row_ds_danh_muc['menu_id'] ?>"><?php echo $row_ds_danh_muc['ten'] ?></option>
                    <?php
						}
					?>
                </select>
            </div>
            <div class="sap_xep_sp_admin">
                <h5>Sắp xếp theo: </h5>
                <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)">
                    <option value="">Mặc định</option>
                    <!-- sắp xếp giá giảm dần -->
                    <option value="">Giá giảm dần</option>
                    <!-- sắp xếp giá tăng dần -->
                    <option value="">Giá tăng dần</option>
                    <!-- sắp xếp sản phẩm mới về -->
                    <option value="">Mới nhất</option>
                    <!-- sắp xếp sản phẩm bán chạy -->
                    <option value="">Bán chạy</option>
                </select>
            </div>
        </div>
        <div class="hienthi_noidung">
            <div class="table_sp">
                <div class="top_table">
                    <div class="tt-sp" style="width: 3%;">STT</div>
                    <div class="tt-sp" style="width: 4%;">Id_SP</div>
                    <div class="tt-sp" style="width: 5%;">Id_DM</div>
                    <div class="tt-sp" style="width: 24%;">Tên Sản Phẩm</div>
                    <div class="tt-sp" style="width: 20%;">TT Sản Phẩm</div>
                    <div class="tt-sp" style="width: 10%;">Giá Sản Phẩm</div>
                    <div class="tt-sp" style="width: 6%;">Bán Chạy</div>
                    <div class="tt-sp" style="width: 5%;">Mới Về</div>
                    <div class="tt-sp" style="width: 6%;">Giảm Giá</div>
                    <div class="tt-sp" style="width: 10%;">Giá Giảm Giá</div>
                    <div class="tt-sp" style="width: 3%;">Ẩn</div>
                    <div class="tt-sp" style="width: 5%; border-right: none">Tác Vụ</div>
                </div>

                <div class="main_table">
                    <?php
                        $num = 1;
                        while($row_ds_sanpham = mysqli_fetch_array($ds_san_pham)){
                    ?>
                    <div class="box_tt">
                        <div class="thongtin_sanpham">
                            <div class="tt-sp" style="width: 3%;"><p><?= $num ?></p></div>
                            <div class="tt-sp" style="width: 4%;"><?php echo $row_ds_sanpham['id_sp'] ?></div>
                            <div class="tt-sp" style="width: 5%;"><?php echo $row_ds_sanpham['menu_id'] ?></div>
                            <div class="tt-sp" style="width: 24%;"><p><?php echo $row_ds_sanpham['ten'] ?></p></div>
                            <div class="tt-sp" style="width: 20%;"><textarea style="min-height: 90%;width: 90%"><?php echo $row_ds_sanpham['thong_tin_sp'] ?></textarea></div>
                            <div class="tt-sp" style="width: 10%;"><?= number_format($row_ds_sanpham['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></div> 
                            <div class="tt-sp" style="width: 6%;"><input type="checkbox" name="ban_chay" <?php  if($row_ds_sanpham['ban_chay']==1) { ?> checked <?php } ?>></input></div>
                            
                            
                            
                            
                            
                            <div class="tt-sp" style="width: 5%;"><input type="checkbox" name="moi_ve" <?php  if($row_ds_sanpham['moi_ve']==1) { ?> checked <?php } ?>></input></div>
                            <div class="tt-sp" style="width: 6%;"><input type="checkbox" name="giam_gia" <?php  if($row_ds_sanpham['giam_gia']==1) { ?> checked <?php } ?>></input></div>
                            <div class="tt-sp" style="width: 10%;"><?= number_format($row_ds_sanpham['gia_giam_gia'], 0, ",", ".")?><sup class="gia">₫</sup></div>
                            <div class="tt-sp" style="width: 3%;"><input type="checkbox" name="an"></input></div>
                            <div class="tt-sp" style="width: 5%; border-right: none; display: flex; justify-content: space-evenly; flex-direction: column;">
                                <a href="admin/?xem=sua_san_pham&id_sanpham=<?php echo $row_ds_sanpham['id_sp'] ?>" class="sua" title="Sửa sản phẩm" style="color:#333" onclick="if (!confirm('Bạn có chắc chắn muốn sửa sản phẩm?')) { return false }"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="admin/?xem=xoa_san_pham&id_sanpham=<?php echo $row_ds_sanpham['id_sp'] ?>" class="xoa" title="Xóa sản phẩm" style="color: red" onclick="if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm?')) { return false }"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                        </div>
                    </div>
                    <?php
                        $num++;
                        }
                    ?>
                </div>
                <div class="load_more">
                    <button class="btn_loadMore">Load more <span class="glyphicon glyphicon-chevron-down"></span></button>
                </div>
                <div class="go_to_top">
                    <button class="btn_gototop">Go To Top <span class="glyphicon glyphicon-chevron-up"></span></button>
                </div>
            </div>
        </div>
    </div>
</div>