<div class="wrapper">
        <input type="checkbox" id="check">
        <div class="header">
            <div class="header-menu">
                <div class="sidebtn mb-auto">
                    <label for="check">
                        <i class="fas fa-bars"></i>
                    </label>
                </div>
                <?php if($_SESSION['role'] == 1): ?>
                    <div class="title">Admin</div>
                <?php else : ?>
                    <div class="title">Resepsionis</div>
                <?php endif; ?>
                <ul>
                    <li><a href="faris_ajax.php?action=logout"><i class="fa-solid fa-power-off"></i></i> <?php echo $_SESSION['username'] ?></a></li>
                </ul>
            </div>
        </div>