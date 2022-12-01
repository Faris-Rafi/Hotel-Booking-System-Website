<div class="sidebar" id="sidebar">
            <div class="sidebar-menu">
                <li class="item" id="dashboard">
                    <a href="index.php?page=faris_dashboard" class="menu-btn">
                        <i class="fa-solid fa-chart-line"></i><span>Dashboard</span>
                    </a>
                </li>
                <?php if($_SESSION['role'] == 1) : ?>
                <li class="item" id="hotel">
                    <a href="#hotel" class="menu-btn">
                        <i class="fa-solid fa-hotel"></i><span>Hotel <i class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="index.php?page=faris_kamar"><i class="fa-solid fa-bed"></i><span>Kamar</span></a>
                        <a href="index.php?page=faris_letak-kamar"><i class="fa-solid fa-location-crosshairs"></i><span>Letak Kamar</span></a>
                        <a href="index.php?page=faris_fasilitas-kamar"><i class="fa-solid fa-door-closed"></i><span>Fasilitas Kamar</span></a>
                        <a href="index.php?page=faris_fasilitas-hotel"><i class="fa-solid fa-hotel"></i><span>Fasilitas Hotel</span></a>
                    </div>
                </li>
                <li class="item" id="pengguna">
                    <a href="#pengguna" class="menu-btn">
                        <i class="fa-solid fa-user-group"></i><span>Pengguna <i class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="index.php?page=faris_user"><i class="fas fa-users"></i><span>User</span></a>
                        <a href="index.php?page=faris_tamu"><i class="fa-solid fa-circle-user"></i><span>Tamu</span></a>
                    </div>
                </li>
                <li class="item" id="pertanyaan">
                    <a href="index.php?page=faris_pertanyaan" class="menu-btn">
                        <i class="fa-solid fa-circle-question"></i><span>Pertanyaan</span>
                    </a>
                </li>
                <li class="item" id="settings">
                    <a href="#settings" class="menu-btn">
                        <i class="fa-solid fa-cog"></i><span>Pengaturan <i class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="index.php?page=faris_slideshow"><i class="fas fa-image"></i><span>Slideshow</span></a>
                        <a href="index.php?page=faris_about"><i class="fa-solid fa-building"></i><span>Tentang</span></a>
                    </div>
                </li>
                <?php else : ?>
                <li class="item" id="kamartersedia">
                    <a href="index.php?page=faris_kamar-tersedia" class="menu-btn">
                        <i class="fa-solid fa-bed"></i><span>Kamar</span>
                    </a>
                </li>
                <li class="item" id="reservasi">
                    <a href="index.php?page=faris_reservasi" class="menu-btn">
                        <i class="fa-solid fa-book"></i><span>Reservasi</span>
                    </a>
                </li>
                <li class="item" id="checkin">
                    <a href="index.php?page=faris_check-in" class="menu-btn">
                        <i class="fa-solid fa-calendar-check"></i><span>Check In</span>
                    </a>
                </li>
                <li class="item" id="checkout">
                    <a href="index.php?page=faris_check-out" class="menu-btn">
                        <i class="fa-solid fa-calendar-xmark"></i><span>Check Out</span>
                    </a>
                </li>
                <li class="item" id="laporan">
                    <a href="index.php?page=faris_laporan" class="menu-btn">
                        <i class="fa-solid fa-file-invoice-dollar"></i><span>Laporan</span>
                    </a>
                </li>
                <?php endif; ?>
            </div>
        </div>
 