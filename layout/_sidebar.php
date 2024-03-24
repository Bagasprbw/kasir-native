<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
            <a href="index.html"><img class="logo_icon img-responsive" src="tema/images/logo/logo_icon.png" alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
            <div class="user_img"><img class="img-responsive" src="tema/images/layout_img/user_img.jpg" alt="#" /></div>
            <div class="user_info">
                <h6><?= $_SESSION['nama']?></h6>
                <p><span class="online_animation"></span> Online</p>
            </div>
            </div>
        </div>
    </div><hr>
    <div class="sidebar_blog_2">
        <ul class="list-unstyled components">
            <li>
                <a href="index.php"><i class="fa fa-home red_color"></i> <span>Home</span></a>
            </li>
            <li class="active">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-dashboard text-primary"></i> <span>Barang</span></a>
                <ul class="collapse list-unstyled" id="dashboard">
                    <li>
                        <a href="input_barang.php">> <span>Tambah Barang</span></a>
                    </li>
                    <li>
                        <a href="barang.php">> <span>Stok Barang</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="pelanggan.php"><i class="fa fa-users green_color"></i> <span>Pelanggan</span></a>
            </li>
            <li>
                <a href="order.php"><i class="fa fa-clock-o orange_color"></i> <span>Order</span></a>
            </li><hr>
            <li>
                <a href="logout.php"><i class="fa fa-sign-out red_color"></i> <span>Log out</span></a>
            </li>
        </ul>
    </div>
</nav>