<?php
    if ($rank == "admin") {
        header("location: ../admin");
    }
?>
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="../index.php">
                            <h1>I4104</h1>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="../index.php"><i class="fas fa-home"></i>Trang chủ</a>
                        </li>
                        <hr>
                        <?php if ($rank == "boss") { ?>
                        <li>
                            <a href="../users.php"><i class="fas fa-users"></i>Users</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="../api.php"><i class="fas fa-code"></i>API</a>
                        </li>
                        <hr>
                        <li>
                            <a href="../bank.php"><i class="fas fa-wallet"></i>Quản lý ngân hàng</a>
                        </li>
                        <li>
                            <a href="../withdraw.php"><i class="fas fa-hand-holding-usd"></i>Rút tiền</a>
                        </li>
                        <hr>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Lịch sử</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li><a href="doithe.php">Đổi thẻ</a></li>
                                <li><a href="withdraw.php">Rút tiền</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <h1>I4104</h1>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="../index.php"><i class="fas fa-home"></i>Trang chủ</a>
                        </li>
                        <hr>
                        <?php if ($rank == "boss") { ?>
                        <li>
                            <a href="../users.php"><i class="fas fa-users"></i>Users</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="../api.php"><i class="fas fa-code"></i>API</a>
                        </li>
                        <hr>
                        <li>
                            <a href="../bank.php"><i class="fas fa-wallet"></i>Quản lý ngân hàng</a>
                        </li>
                        <li>
                            <a href="../withdraw.php"><i class="fas fa-hand-holding-usd"></i>Rút tiền</a>
                        </li>
                        <hr>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Lịch sử</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="doithe.php">Đổi thẻ</a>
                                </li>
                                <li>
                                    <a href="withdraw.php">Rút tiền</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap float-right">
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPvy24PzneV-ktjESIW1zsShu-rOtoSiS_Rw&usqp=CAU" alt="I4104" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['username']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPvy24PzneV-ktjESIW1zsShu-rOtoSiS_Rw&usqp=CAU" alt="I4104" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION['username']; ?></a>
                                                    </h5>
                                                    <span class="email">Số dư: <?php echo number_format($users['price']); ?>đ</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#"><i class="fa fa-user"></i>Thông tin tài khoản</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#"><i class="fa fa-lock"></i>Đổi mật khẩu cấp 2</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="handler/execute/users.php?action=logout"><i class="fa fa-sign-out"></i>Đăng xuất</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>