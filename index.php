<?php 
    include "handler/config.php";
    if (!isset($_SESSION["username"])) {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Trang chủ - <?php echo $settings->get("title"); ?></title>

    <!-- Fontfaces CSS-->
    <link href="assets/css/font-face.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="assets/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php include 'navbar.php'; ?>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card shadow h-100 py-2" style="margin-bottom: 0px !important; border-left: 5px solid #4e73df; border-radius: 10px;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="mb-1">
                                                    Tổng Đổi Thẻ Tháng:
                                                </div> 
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        $total = 0;
                                                        $month = date("Y-m");
                                                        if ($rank == "default") {
                                                            $get = $conn->query("SELECT * FROM card WHERE username = '{$_SESSION["username"]}' AND status = 1 AND MONTH(`date`) = MONTH(NOW()) AND YEAR(`date`) = YEAR(NOW());");
                                                            if ($get->num_rows > 0) { 
                                                                while($row = $get->fetch_array()) {
                                                                    $total += $row["amount"];
                                                                }
                                                            }
                                                        } else {
                                                            $get_accounts = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'"); 
                                                            if ($get_accounts->num_rows > 0) {
                                                                while ($result = $get_accounts->fetch_array()) {
                                                                    $get = $conn->query("SELECT * FROM card WHERE username = '{$result["username"]}' AND status = 1 AND MONTH(`date`) = MONTH(NOW()) AND YEAR(`date`) = YEAR(NOW());");
                                                                    if ($get->num_rows > 0) { 
                                                                        while($row = $get->fetch_array()) {
                                                                            $total += $row["amount"];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        echo number_format($total);
                                                    ?>
                                                đ</div>
                                            </div> 
                                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card shadow h-100 py-2" style="margin-bottom: 0px !important; border-left: 5px solid #1cc88a; border-radius: 10px;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="mb-1">
                                                    Tổng Thực Nhận Tháng:
                                                </div> 
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        $total = 0;
                                                        $month = date("Y-m");
                                                        if ($rank == "default") {
                                                            $get = $conn->query("SELECT * FROM card WHERE username = '{$_SESSION["username"]}' AND status = 1 AND MONTH(`date`) = MONTH(NOW()) AND YEAR(`date`) = YEAR(NOW());");
                                                            if ($get->num_rows > 0) { 
                                                                while($row = $get->fetch_array()) {
                                                                    $total += $row["real_amount"];
                                                                }
                                                            }
                                                        } else {
                                                            $get_accounts = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'"); 
                                                            if ($get_accounts->num_rows > 0) {
                                                                while ($result = $get_accounts->fetch_array()) {
                                                                    $get = $conn->query("SELECT * FROM card WHERE username = '{$result["username"]}' AND status = 1 AND MONTH(`date`) = MONTH(NOW()) AND YEAR(`date`) = YEAR(NOW());");
                                                                    if ($get->num_rows > 0) { 
                                                                        while($row = $get->fetch_array()) {
                                                                            $total += $row["real_amount"];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        echo number_format($total);
                                                    ?>
                                                đ</div>
                                            </div> 
                                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card shadow h-100 py-2" style="margin-bottom: 0px !important; border-left: 5px solid #4e73df; border-radius: 10px;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="mb-1">
                                                    Tổng Đổi Thẻ Hôm Nay:
                                                </div> 
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        $total = 0;
                                                        if ($rank == "default") {
                                                            $get = $conn->query("SELECT * FROM card WHERE username = '{$_SESSION["username"]}' AND DATE(`date`) = CURDATE()");
                                                            if ($get->num_rows > 0) { 
                                                                while($row = $get->fetch_array()) {
                                                                    $total += $row["amount"];
                                                                }
                                                            }
                                                        } else {
                                                            $get_accounts = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'"); 
                                                            if ($get_accounts->num_rows > 0) {
                                                                while ($result = $get_accounts->fetch_array()) {
                                                                    $get = $conn->query("SELECT * FROM card WHERE username = '{$result["username"]}' AND DATE(`date`) = CURDATE()");
                                                                    if ($get->num_rows > 0) { 
                                                                        while($row = $get->fetch_array()) {
                                                                            $total += $row["amount"];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        echo number_format($total);
                                                    ?>
                                                đ</div>
                                            </div> 
                                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card shadow h-100 py-2" style="margin-bottom: 0px !important; border-left: 5px solid #1cc88a; border-radius: 10px;">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="mb-1">
                                                    Tổng Thực Nhận Hôm Nay:
                                                </div> 
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php 
                                                        $total = 0;
                                                        if ($rank == "default") {
                                                            $get = $conn->query("SELECT * FROM card WHERE username = '{$_SESSION["username"]}' AND status = 1 AND DATE(`date`) = CURDATE()");
                                                            if ($get->num_rows > 0) { 
                                                                while($row = $get->fetch_array()) {
                                                                    $total += $row["real_amount"];
                                                                }
                                                            }
                                                        } else {
                                                            $get_accounts = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'"); 
                                                            if ($get_accounts->num_rows > 0) {
                                                                while ($result = $get_accounts->fetch_array()) {
                                                                    $get = $conn->query("SELECT * FROM card WHERE username = '{$result["username"]}' AND status = 1 AND DATE(`date`) = CURDATE()");
                                                                    if ($get->num_rows > 0) { 
                                                                        while($row = $get->fetch_array()) {
                                                                            $total += $row["real_amount"];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        echo number_format($total);
                                                    ?>
                                                đ</div>
                                            </div> 
                                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php if ($rank == "default") { ?>
                            <div class="col-lg-8">
                                <div class="au-card recent-report bottom-border-success">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Đổi thẻ</h3>
                                        <hr>
                                        <form id="card">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label><i class="fa fa-credit-card"></i> Loại thẻ:</label>
                                                        <select class="form-control" name="type" required>
                                                            <option>Chọn loại thẻ</option>
                                                            <option value="Viettel">Viettel</option>
                                                            <option value="Vinaphone">Vinaphone</option>
                                                            <option value="Mobifone">Mobifone</option>
                                                            <option value="Vietnamobile">Vietnamobile</option>
                                                            <option value="Gate">Gate</option>
                                                            <option value="Zing">Zing</option>
                                                            <option value="Garena">Garena</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label><i class="fa fa-coins"></i> Mệnh giá:</label>
                                                        <select class="form-control" name="amount" required>
                                                            <option>Chọn mệnh giá</option>
                                                            <option value="10000">10.000</option>
                                                            <option value="20000">20.000</option>
                                                            <option value="30000">30.000</option>
                                                            <option value="50000">50.000</option>
                                                            <option value="100000">100.000</option>
                                                            <option value="200000">200.000</option>
                                                            <option value="500000">500.000</option>
                                                            <option value="1000000">1.000.000</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>    
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>❖ Serial:</label>
                                                        <input class="form-control" type="text" name="serial" placeholder="Nhập serial thẻ" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>❖ Mã thẻ:</label>
                                                        <input class="form-control" type="text" name="pin" placeholder="Nhập mã thẻ thẻ" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="padding-top: 10px;">
                                                <div class="col-md-12 text-center">
                                                    <button class="btn btn-success">❖ Đổi thẻ ngay</button>    
                                                </div>
                                            </div>    
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="au-card m-b-10 bottom-border-danger">
                                    <p>
                                        <span class="text-danger">* Chú ý:</span><br>
                                        ❖ Cố tình nhập sai nhiều lần sẽ bị khóa tài khoản.<br>
                                        ❖ Sai thông tin, mất thẻ, admin không chịu trách nhiệm.<br>
                                        ❖ Sai mệnh giá, nhận 50% giá trị thực nhận.<br>
                                        ❖ Vui lòng kiểm tra kĩ dữ liệu trước khi gửi thẻ.
                                    </p>
                                </div>
                            </div>
                            <?php } else { ?>
                                <div class="col-md-12">
                                    <div class="au-card recent-report bottom-border-success">
                                        <div class="au-card-inner">
                                            <h3 class="title-2">Thống Kê Doanh Thu</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 table-responsive">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td>Tổng số users:</td>
                                                                <td>
                                                                <?php 
                                                                    $get = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'");
                                                                    echo $get->num_rows;
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tổng số thẻ cào đúng:</td>
                                                                <td>
                                                                <?php 
                                                                    $total = 0;
                                                                    $get_accounts = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'"); 
                                                                    if ($get_accounts->num_rows > 0) {
                                                                        while ($result = $get_accounts->fetch_array()) {
                                                                            $get = $conn->query("SELECT * FROM card WHERE username = '{$result["username"]}' AND status = 1");
                                                                            if ($get->num_rows > 0) { 
                                                                                while($row = $get->fetch_array()) {
                                                                                    $total += 1;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    echo number_format($total);
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tổng số thẻ cào sai:</td>
                                                                <td>
                                                                <?php 
                                                                    $total = 0;
                                                                    $get_accounts = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'"); 
                                                                    if ($get_accounts->num_rows > 0) {
                                                                        while ($result = $get_accounts->fetch_array()) {
                                                                            $get = $conn->query("SELECT * FROM card WHERE username = '{$result["username"]}' AND status 2");
                                                                            if ($get->num_rows > 0) { 
                                                                                while($row = $get->fetch_array()) {
                                                                                    $total += 1;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    echo number_format($total);
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tổng số thẻ thực nhận:</td>
                                                                <td>
                                                                <?php 
                                                                    $total = 0;
                                                                    $get_accounts = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'"); 
                                                                    if ($get_accounts->num_rows > 0) {
                                                                        while ($result = $get_accounts->fetch_array()) {
                                                                            $get = $conn->query("SELECT * FROM card WHERE username = '{$result["username"]}' AND status = 1");
                                                                            if ($get->num_rows > 0) { 
                                                                                while($row = $get->fetch_array()) {
                                                                                    $price += $row["real_amount"];
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    echo number_format($total);
                                                                ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card bottom-border-primary">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">Chiết khấu thẻ cào:</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <th>❖ Loại thẻ</th>
                                                    <th>10.000đ</th>
                                                    <th>20.000đ</th>
                                                    <th>30.000đ</th>
                                                    <th>50.000đ</th>
                                                    <th>100.000đ</th>
                                                    <th>200.000đ</th>
                                                    <th>500.000đ</th>
                                                    <th>1.000.000đ</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $arr = ["Viettel", "Vinaphone", "Mobifone", "Vietnamobile", "Gate", "Zing", "Garena"];
                                                        for ($i = 0; $i < count($arr); $i++) { 
                                                            echo '<tr><td>'. $arr[$i] .'</td>';
                                                            $get = $conn->query("SELECT * FROM card_type WHERE type = '{$arr[$i]}'");
                                                            if ($get->num_rows > 0) {
                                                                while ($row = $get->fetch_array()) {
                                                                    echo '
                                                                        <td>'. $row["rate"] .'</td>
                                                                    ';
                                                                }
                                                            }
                                                            echo '</tr>';
                                                        }
                                                        
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="assets/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="assets/vendor/slick/slick.min.js">
    </script>
    <script src="assets/vendor/wow/wow.min.js"></script>
    <script src="assets/vendor/animsition/animsition.min.js"></script>
    <script src="assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="assets/vendor/select2/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main JS-->
    <script src="assets/js/main.js"></script>
    <script src="handler/js/index.js"></script>
</body>

</html>
<!-- end document-->
