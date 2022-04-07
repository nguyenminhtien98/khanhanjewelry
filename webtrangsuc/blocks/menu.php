<?php
	require "./lib/dbCon.php";
?>
<?php
	$qr = "SELECT * FROM danh_muc WHERE menu_parent_id = 0";
	$query_danhmuc = mysqli_query($conn,$qr);
?>

<div id="menu">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="menu">
                    <ul>
                        <?php
	                          if (mysqli_num_rows($query_danhmuc) > 0){
	                          	while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
                        ?>
                        <li class="nav-item dropdown">
                            <!--nếu menu id =2 thì link đến trang "tất cả trang sức"--> 
                            <?php  
                                if ($row_danhmuc['menu_id'] == 2) {	?>
                            <a class="nav-link" href="tat-ca-trang-suc.html" id="navbarDropdown"><?php echo $row_danhmuc['ten'] ?></a>
                            <!--nếu menu id =3 thì link đến trang "giảm giá"--> 
                            <?php }else{ if ($row_danhmuc['menu_id'] == 3) {?>
                            <a class="nav-link" href="trang-suc-giam-gia.html" id="navbarDropdown"><?php echo $row_danhmuc['ten'] ?></a>
                            <!--nếu menu id =4 thì link đến trang "Tất cả trang sức"--> 
                            <?php }else{ if ($row_danhmuc['menu_id'] == 4) {?>
                            <a class="nav-link" href="tat-ca-trang-suc.html" id="navbarDropdown"><?php echo $row_danhmuc['ten'] ?></a>
                            <!--nếu menu id =5 thì link đến trang "Blog"--> 
                            <?php }else{ if ($row_danhmuc['menu_id'] == 5) {?>
                            <a class="nav-link" href="?xem=blog" id="navbarDropdown"><?php echo $row_danhmuc['ten'] ?></a>
                            <!--nếu menu id = 6 thì link đến trang "chính sách"--> 
                            <?php }else{ if ($row_danhmuc['menu_id'] == 6) { ?>
                            <a class="nav-link" href="?xem=chinh-sach&menu_id=<?php echo $row_danhmuc['menu_id'] ?>" id="navbarDropdown"><?php echo $row_danhmuc['ten'] ?></a>
                            <!--nếu menu id = 7 thì link đến trang "về chúng tôi"--> 
                            <?php }else{ if ($row_danhmuc['menu_id'] == 7) { ?>
                            <a class="nav-link" href="ve-chung-toi.html" id="navbarDropdown"><?php echo $row_danhmuc['ten'] ?></a>
                            <!--còn nếu không có menu id = với các menu id trên thì link đến trang "danh sách sản phẩm"--> 
                            <?php }else{ ?>
                            <a class="nav-link" id="navbarDropdown" style="cursor: pointer;"><?php echo $row_danhmuc['ten'] ?></a>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                            <ul class="dropdown-content">
                                <?php
                                    $qr = "SELECT * FROM danh_muc WHERE menu_parent_id = {$row_danhmuc['menu_id']}";
                                    $query_danhmuccon = mysqli_query($conn,$qr);
                                                        	if (mysqli_num_rows($query_danhmuccon) > 0){
                                    	while($row_danhmuccon = mysqli_fetch_array($query_danhmuccon)){
                                ?>
                                <li><a class="dropdown-item" href="loai-trang-suc/<?php echo $row_danhmuccon['menu_id'] ?>-<?php echo $row_danhmuccon['code'] ?>.html"><?php echo $row_danhmuccon['ten']?></a></li>
                                <?php
                                }
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                        }
                        }
                        ?>
                        <span class="nav-indicator"></span>
                    </ul>
                </div>
                <div class="search">
                    <div class="form_search">
                        <form id="searchbox" method="get" action="./" autocomplete="off">
                            <input name="xem" type="hidden" value="tim-kiem" />
                            <input name="tu-khoa" type="text" size="15" value="<?=isset($_GET['query']) ? $_GET['query'] : ""?>" placeholder="Tìm Kiếm..." />
                            <input id="button-submit" type="submit" value=" "/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <span class="line_bottom"></span>
</div>

