<div id="chinh_sach">
	<div class="container">
    	<div class="ds_chinh_sach_header" style="padding: 30px 0;">
            <div class="tieude_giamgia" style="text-align: center; border-bottom: 1px solid; padding-bottom: 20px;">
                <h2>CHÍNH SÁCH THU ĐỔI, BẢO HÀNH, VẬN CHUYỂN VÀ HƯỚNG DẪN ĐO SIZE</h2>
        	</div>
            <div class="ten_danh_muc"><a href="#">Trang chủ</a> / <span>Chính sách</span></div>
        </div>
    	<div class="ds_chinh_sach">
        	<div class="chinh_sach_thu_doi">
            	<div class="chinhsach">
                    <button type="button" class="collapsible">CHÍNH SÁCH THU ĐỔI:</button>
                    <div class="xemct">
                      <img src="./images/chinh_sach_thu_doi.png"/>
                    </div>
                </div>
            </div>
            <div class="chinh_sach_bao_hang">
            	<div class="chinhsach">
                    <button type="button" class="collapsible">CHÍNH SÁCH BẢO HÀNH:</button>
                    <div class="xemct">
                      <img src="./images/chinh_sach_bao_hanh.png"/>
                    </div>
                </div>
            </div>
            <div class="chinh_sach_van_chuyen">
            	<div class="chinhsach">
                    <button type="button" class="collapsible">CHÍNH SÁCH VẬN CHUYỂN:</button>
                    <div class="xemct">
                      <img src="./images/chinh_sach_van_chuyen.png"/>
                    </div>
                </div>
            </div>
            <div class="huong_dan_do_size">
            	<div class="chinhsach">
                    <button type="button" class="collapsible">HƯỚNG DẪN ĐO SIZE:</button>
                    <div class="xemct">
                      <img src="./images/huong_dan_do_size.png"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- js chính sách -->
<script>
	var coll = document.getElementsByClassName("collapsible");
	var i;
	
	for (i = 0; i < coll.length; i++) {
	  coll[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var content = this.nextElementSibling;
		if (content.style.display === "block") {
		  content.style.display = "none";
		} else {
		  content.style.display = "block";
		}
	  });
	}
</script>