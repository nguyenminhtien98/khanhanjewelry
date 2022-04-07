<?php
	$qr = "SELECT * FROM ve_chung_toi where id=1 ";
	$query_ve_chung_toi = mysqli_query($conn,$qr);
	$ve_chung_toi = mysqli_fetch_array($query_ve_chung_toi);
?>
<div id="ve-chung-toi">
	<div class="container">
    	<div class="gioi-thieu-shop">
            <div class="top-div">
                <h2>GIỚI THIỆU VỀ KHÁNH AN JEWELRY</h2>
            </div>
            <div class="main-div">
                <p><?php echo $ve_chung_toi['mo_ta_chi_tiet'] ?></p>
            </div>
            <div class="bottom-div">
            	<a href="tat-ca-trang-suc.html">BẮT ĐẦU MUA SẮM</a>
            </div>
        </div>
    </div>
</div>