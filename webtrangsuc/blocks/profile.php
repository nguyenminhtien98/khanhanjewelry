<?php 
	$qr = "select * from ve_chung_toi
			LIMIT 1,4";
	$query_profile = mysqli_query($conn,$qr);
?>
<div id="profile">
	<div id="profile-ct">
		<div id="top-profile">			
			<svg xmlns="http://www.w3.org/2000/svg" height="34" width="211" style="margin-top: 35px; margin-left: 20px;"><defs><clipPath id="a"><path fill="none" transform="translate(1483 272.282)" data-name="Rectangle 1" d="M0 0h1224v256.058H0z"/></clipPath></defs><g data-name="Group 5"><g data-name="Group 2"><g clip-path="url(#a)" data-name="Group 1" fill="#0500ff" transform="matrix(.13278 0 0 .13278 -196.918 -36.155)"><path d="M1611.03 282.849a117.461 117.461 0 10117.463 117.463 117.593 117.593 0 00-117.463-117.463m0 245.492a128.029 128.029 0 11128.033-128.029 128.173 128.173 0 01-128.033 128.029" data-name="Path 1"/><path d="M1610.907 330.132a16.715 16.715 0 016.7-7.153c5.568-3 12.906-1.523 17.591 2.722 4.685 4.245 6.89 10.783 6.805 17.108-.116 8.908-4.493 16.5-8.212 24.3q-2.256 4.749-4.523 9.5l-2.158 4.531-14.622-31.683a81.788 81.788 0 01-1.125-2.436c-.255-.58-.5-1.144-.711-1.651-2.134-5.134-2.358-10.183.259-15.236m35.217 187.8a122.3 122.3 0 0035.983-17.607l-11.981-25.961 55.824-117.185a123.1 123.1 0 00-6.507-14.386L1663.7 460.488l-30.775-66.746L1648.042 362l.209-.441c9.1-17.332 4.906-36.752-9.465-48.846-12.7-10.686-31.072-11.919-45.493-4a42.151 42.151 0 00-13.776 12.151 40.7 40.7 0 00-7.925 22.448 45.774 45.774 0 001.063 11.965 56.423 56.423 0 003.147 10.192l30.006 64.67-15.9 34.993-68.13-148.984a122.961 122.961 0 00-25.448 40.471l73.153 159.2a122.159 122.159 0 0041.55 7.245q3 0 5.981-.147l-22.335-48.888 15.855-33.284z" data-name="Path 2"/></g></g><path d="M49.511 25.889h3.126l5.318-10.616 5.317 10.616h3.121l7.029-14.96H69.71l-4.89 10.438-5.231-10.44H56.38l-5.248 10.44-4.893-10.44h-3.725z" data-name="Path 3"/><path d="M94.658 13.785v-2.857h-17.13v14.96h17.13v-2.822H81.065v-3.26h12.56v-2.841h-12.56v-3.18z" data-name="Path 4"/><path d="M103.358 23.064V10.928h-3.505v14.96h17.13v-2.824z" data-name="Path 5"/><g data-name="Group 4"><g clip-path="url(#a)" data-name="Group 3" transform="matrix(.13278 0 0 .13278 -196.918 -36.155)"><path d="M2502.314 388.238c0 3.429-1.875 6.174-5.722 8.409-4.01 2.316-10.335 3.487-18.806 3.487h-50.392v-23.943h50.392c8.471 0 14.8 1.179 18.806 3.491 3.847 2.231 5.722 5.03 5.722 8.556m-6.283 31.386c9.929-2.057 17.827-5.792 23.5-11.12 6.1-5.737 9.2-12.557 9.2-20.266a26.988 26.988 0 00-6.116-17.1c-4.024-5.064-9.951-9.1-17.626-12.012a77.505 77.505 0 00-27.268-4.546h-76.883v112.671h26.526l.034-45.872h37.483l35.651 45.872h32.29z" data-name="Path 6"/></g></g><path d="M157.726 10.928l-6.017 5.418-6.059-5.418h-4.827l9.153 8.044v6.917h3.507l.001-6.917 9.043-8.044z" data-name="Path 7"/></g></svg>
			<p>Điểm đến cuối cùng cho đồ trang sức. Chuyên gia phong cách của bạn với khả năng tiếp cận sâu trong nghành. Mục tiêu của chúng tôi là hướng dẫn bạn đến đúng phần. Chúng tôi quản lý và chăm sóc.</p>
			<a href="ve-chung-toi.html">Về chúng tôi</a> <img src="images/xt.png" alt="Image">
		</div>
		<div id="bottom-profile">
			<div id="ct-profile">
				<?php
					while($row_profile = mysqli_fetch_array($query_profile)){
				?>	
                <div class="nd-profile">
					<img src="<?php echo $row_profile['hinh_anh'] ?>" alt="Image">
					<h4><?php echo $row_profile['ten'] ?></h4>
					<p><?php echo $row_profile['mo_ta'] ?></p>
					<a href="#">Đọc tiếp</a> 
                </div>
                <?php
					}
				?>
			</div>
		</div>
	</div>
</div>	