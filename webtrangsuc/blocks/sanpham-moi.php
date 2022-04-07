<?php 
	$qr = "select * from san_pham 
		   where moi_ve = 1
		   ORDER BY id_sp DESC
		   LIMIT 0,4
		   ";
	$query_sp_moi = mysqli_query($conn,$qr);
?>
<?php 
	$qr = "select * from san_pham 
		   where moi_ve = 1
		   ORDER BY id_sp DESC
		   LIMIT 4,7
		   ";
	$query_sp_moi2 = mysqli_query($conn,$qr);
?>
<div id="sp-moi">
	<div id="ct-sp">
		<div class="top">
			<h2>SẢN PHẨM MỚI</h2>
			<a href="trang-suc-moi-nhat.html"><span>XEM THÊM</span></a>
		</div>		
		<div class="sp">
			<div class="sp1">
				<div class="carousel-inner"> 
                	<div class="item active"> 
                    	<div class="row"> 
                        	<?php
								while($row_sp_moi = mysqli_fetch_array($query_sp_moi)){
							?>
                        	<div class="col-md-3">
								<div class="thumbnail">
                                	<div class="container">
                                    	<div class="box-hover">
                                        	<a href="trang-suc/<?php echo $row_sp_moi['id_sp'] ?>-<?php echo $row_sp_moi['code'] ?>.html"><img src="./images_sanpham/<?php echo $row_sp_moi['anh_dai_dien'] ?>" style="max-width:100%;"></a>
                                            <a href="trang-suc/<?php echo $row_sp_moi['id_sp'] ?>-<?php echo $row_sp_moi['code'] ?>.html"><img class="img-change" src="./images_sanpham/<?php echo $row_sp_moi['anh_ct'] ?>"></a>
                                        </div>
                                        <div class="addcart" style="position: relative;">
                                        	<button class="themvaogio" onclick="themgiohang(this)" style="height: 35px;">Thêm vào giỏ</button>
                                        </div>
                                        <div class="info_products">
                                        	<input type="hidden" name="id_sp" value="<?php echo $row_sp_moi['id_sp'] ?>">
											<h5><?php echo $row_sp_moi['ten'] ?></h5>
											<span><?php echo number_format($row_sp_moi['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<input type="hidden" name="soluong" value="1">
											<p><a href="?xem=thanh_toan&order&id_sanpham=<?php echo $row_sp_moi['id_sp'] ?>">Mua ngay</a></p>
										</div>
                              		</div>
								</div>
                            </div>
                            <?php
								}
							?> 
                        </div> 
                    </div>
				</div>
			</div>
						
			<div class="sp2">
				<div class="carousel-inner"> 
                	<div class="item active"> 
                    	<div class="row"> 
                        	<?php
								while($row_sp_moi2 = mysqli_fetch_array($query_sp_moi2)){
							?>
                            <div class="col-md-3">
								<div class="thumbnail">
                                	<div class="container">
                                        <div class="box-hover">
                                        	<a href="trang-suc/<?php echo $row_sp_moi2['id_sp'] ?>-<?php echo $row_sp_moi2['code'] ?>.html"><img src="./images_sanpham/<?php echo $row_sp_moi2['anh_dai_dien'] ?>" style="max-width:100%;"></a>
                                            <a href="trang-suc/<?php echo $row_sp_moi2['id_sp'] ?>-<?php echo $row_sp_moi2['code'] ?>.html"><img class="img-change" src="./images_sanpham/<?php echo $row_sp_moi2['anh_ct'] ?>"></a>
                                        </div>
                                        <div class="addcart" style="position: relative;">
                                        	<button class="themvaogio" onclick="themgiohang(this)" style="height: 35px;">Thêm vào giỏ</button>
                                        </div>
                                        <div class="info_products">
                                        	<input type="hidden" name="id_sp" value="<?php echo $row_sp_moi2['id_sp'] ?>">
											<h5><?php echo $row_sp_moi2['ten'] ?></h5>
											<span><?php echo number_format($row_sp_moi2['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<input type="hidden" name="soluong" value="1">
											<p><a href="?xem=thanh_toan&order&id_sanpham=<?php echo $row_sp_moi2['id_sp'] ?>">Mua ngay</a></p>
										</div>
                              		</div>
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
	</div>
</div>