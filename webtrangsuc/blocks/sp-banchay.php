<?php 
	$qr = "select * from san_pham 
		   where ban_chay = 1
		   ORDER BY id_sp DESC
		   ";
	$query_spbanchay = mysqli_query($conn,$qr);
?>

<?php 
	$qr = "select * from san_pham 
		   where ban_chay = 1
		   ORDER BY id_sp DESC
		   LIMIT 4,7
		   ";
	$query_sp_banchay = mysqli_query($conn,$qr);
?>

<?php 
	$qr = "select * from san_pham 
		   where ban_chay = 1
		   ORDER BY id_sp DESC
		   LIMIT 8,11
		   ";
	$query_spbanchay3 = mysqli_query($conn,$qr);
?>
<script>
$('.carousel-inner').carousel({
    interval: false
}); 
</script>

<div id="sp-banchay">
	<div id="ct-sp-bc">
		<div class="top">
			<h2>SẢN PHẨM BÁN CHẠY</h2>
			<a href="trang-suc-ban-chay.html"><span>XEM THÊM</span></a>
		</div>		
		<div class="slider">
        	<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">    
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
      					<div class="row">
                        	<?php
								while($row_sp_banchay = mysqli_fetch_array($query_spbanchay)){
							?>
							<div class="col-md-3">
								<div class="thumbnail">
                                	<div class="container">
                                        <div class="box-hover">
                                        	<a href="trang-suc/<?php echo $row_sp_banchay['id_sp'] ?>-<?php echo $row_sp_banchay['code'] ?>.html"><img src="./images_sanpham/<?php echo $row_sp_banchay['anh_dai_dien'] ?>" style="max-width:100%;"></a>
                                            <a href="trang-suc/<?php echo $row_sp_banchay['id_sp'] ?>-<?php echo $row_sp_banchay['code'] ?>.html"><img class="img-change" src="./images_sanpham/<?php echo $row_sp_banchay['anh_ct'] ?>"></a>
                                        </div>
                                        <div class="addcart" style="position: relative;">
                                        	<button class="themvaogio" onclick="themgiohang(this)" style="height: 35px;">Thêm vào giỏ</button>
                                        </div>
                                        <?php
										if( $row_sp_banchay['giam_gia']==1){
										?>	
										<div class="info_products">
											<input type="hidden" name="id_sp" value="<?php echo $row_sp_banchay['id_sp'] ?>">
											<h5><?php echo $row_sp_banchay['ten'] ?></h5>
											<span style="color: #af203c"><?php echo number_format($row_sp_banchay['gia_giam_gia'], 0, ",", ".")?><sup class="gia">₫</sup></span>
	                                        <input type="hidden" name="soluong" value="1">
	                                        <span style="text-decoration: line-through; padding-right: 10px; color: #707070;"><?php echo number_format($row_sp_banchay['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<p><a href="?xem=thanh_toan&order&id_sanpham=<?php echo $row_sp_banchay['id_sp'] ?>">Mua ngay</a></p>
										</div>
	                                    <?php
										}else{
										?>
	                                    <div class="info_products">
	                                    	<input type="hidden" name="id_sp" value="<?php echo $row_sp_banchay['id_sp'] ?>">
											<h5><?php echo $row_sp_banchay['ten'] ?></h5>
											<span><?php echo number_format($row_sp_banchay['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<input type="hidden" name="soluong" value="1">
											<p><a href="?xem=thanh_toan&order&id_sanpham=<?php echo $row_sp_banchay['id_sp'] ?>">Mua ngay</a></p>
										</div>
	                                    <?php
										}
										?> 
		                            </div>
								</div>
        					</div>
                            <?php
								}
							?> 					
	  					</div>		
					</div>
                    <div class="carousel-item" data-bs-interval="2000">
      					<div class="row">
							<?php
								while($row_sp_banchay = mysqli_fetch_array($query_sp_banchay)){
							?>
                            <div class="col-md-3">
								<div class="thumbnail">
                                	<div class="container">
                                        <div class="box-hover">
                                        	<a href="trang-suc/<?php echo $row_sp_banchay['id_sp'] ?>-<?php echo $row_sp_banchay['code'] ?>.html"><img src="./images_sanpham/<?php echo $row_sp_banchay['anh_dai_dien'] ?>" style="max-width:100%;"></a>
                                            <a href="trang-suc/<?php echo $row_sp_banchay['id_sp'] ?>-<?php echo $row_sp_banchay['code'] ?>.html"><img class="img-change" src="./images_sanpham/<?php echo $row_sp_banchay['anh_ct'] ?>"></a>
                                        </div>
                                        <div class="addcart" style="position: relative;">
                                        	<button class="themvaogio" onclick="themgiohang(this)" style="height: 35px;">Thêm vào giỏ</button>
                                        </div>
                                        <?php
										if( $row_sp_banchay['giam_gia']==1){
										?>	
										<div class="info_products">
											<input type="hidden" name="id_sp" value="<?php echo $row_sp_banchay['id_sp'] ?>">
											<h5><?php echo $row_sp_banchay['ten'] ?></h5>
											<span style="color: #af203c"><?php echo number_format($row_sp_banchay['gia_giam_gia'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<input type="hidden" name="soluong" value="1">
	                                        <span style="text-decoration: line-through; padding-right: 10px; color: #707070;"><?php echo number_format($row_sp_banchay['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<p><a href="?xem=thanh_toan&order&id_sanpham=<?php echo $row_sp_banchay['id_sp'] ?>">Mua ngay</a></p>
										</div>
	                                    <?php
										}else{
										?>
	                                    <div class="info_products">
	                                    	<input type="hidden" name="id_sp" value="<?php echo $row_sp_banchay['id_sp'] ?>">
											<h5><?php echo $row_sp_banchay['ten'] ?></h5>
											<span><?php echo number_format($row_sp_banchay['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<input type="hidden" name="soluong" value="1">
											<p><a href="?xem=thanh_toan&order&id_sanpham=<?php echo $row_sp_banchay['id_sp'] ?>">Mua ngay</a></p>
										</div>
	                                    <?php
										}
										?> 
                                    </div>
								</div>
        					</div>
							<?php
								}
							?>
	  					</div>		
					</div>
					
                    <div class="carousel-item">
      					<div class="row">
                        	<?php
								while($row_spbanchay_3 = mysqli_fetch_array($query_spbanchay3)){
							?>
							<div class="col-md-3">
								<div class="thumbnail">
                                	<div class="container">
                                        <div class="box-hover">
                                        	<a href="trang-suc/<?php echo $row_spbanchay_3['id_sp'] ?>-<?php echo $row_spbanchay_3['code'] ?>.html"><img src="./images_sanpham/<?php echo $row_spbanchay_3['anh_dai_dien'] ?>" style="max-width:100%;"></a>
                                            <a href="trang-suc/<?php echo $row_spbanchay_3['id_sp'] ?>-<?php echo $row_spbanchay_3['code'] ?>.html"><img class="img-change" src="./images_sanpham/<?php echo $row_spbanchay_3['anh_ct'] ?>"></a>
                                        </div>
                                        <div class="addcart" style="position: relative;">
                                        	<button class="themvaogio" onclick="themgiohang(this)" style="height: 35px;">Thêm vào giỏ</button>
                                        </div>
                                        <?php
										if( $row_spbanchay_3['giam_gia']==1){
										?>	
										<div class="info_products">
											<input type="hidden" name="id_sp" value="<?php echo $row_spbanchay_3['id_sp'] ?>">
											<h5><?php echo $row_spbanchay_3['ten'] ?></h5>
											<span style="color: #af203c"><?php echo number_format($row_spbanchay_3['gia_giam_gia'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<input type="hidden" name="soluong" value="1">
	                                        <span style="text-decoration: line-through; padding-right: 10px; color: #707070;"><?php echo number_format($row_spbanchay_3['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<p><a href="?xem=thanh_toan&order&id_sanpham=<?php echo $row_spbanchay_3['id_sp'] ?>">Mua ngay</a></p>
										</div>
	                                    <?php
										}else{
										?>
	                                    <div class="info_products">
	                                    	<input type="hidden" name="id_sp" value="<?php echo $row_spbanchay_3['id_sp'] ?>">
											<h5><?php echo $row_spbanchay_3['ten'] ?></h5>
											<span><?php echo number_format($row_spbanchay_3['gia_ban'], 0, ",", ".")?><sup class="gia">₫</sup></span>
											<input type="hidden" name="soluong" value="1">
											<p><a href="?xem=thanh_toan&order&id_sanpham=<?php echo $row_spbanchay_3['id_sp'] ?>">Mua ngay</a></p>
										</div>
	                                    <?php
										}
										?> 
                                    </div>
								</div>
        					</div>
							<?php
								}
							?>
	  					</div>		
					</div>
  				</div>
  				 <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    				<span class="visually-hidden">Previous</span>
  				</button>
 				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    				<span class="carousel-control-next-icon" aria-hidden="true"></span>
    				<span class="visually-hidden">Next</span>
  				</button>
			</div>			 
        </div>
	</div>
</div>





