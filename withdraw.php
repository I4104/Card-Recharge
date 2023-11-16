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
    <title>Rút tiền - <?php echo $settings->get("title"); ?></title>

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
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="au-card recent-report bottom-border-success">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Rút tiền</h3>
                                        <hr>
                                        <form id="withdraw">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label><i class="fa fa-credit-card"></i> Ngân hàng:</label>
                                                        <select class="form-control shadow-none" name="bank" id="bank" required>
                                                            <option>Chọn ngân hàng</option>
                                                            <?php
                                                                $get = $conn->query("SELECT * FROM bank WHERE username = '{$_SESSION["username"]}'");
                                                                if ($get->num_rows > 0) {
                                                                    while ($row = $get->fetch_array()) {
                                                                        echo '<option value="'. $row["bankname"] .' - '. $row["stk"] .'">'. $row["bankname"] .' - '. $row["stk"] .'</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>❖ Số tiền cần rút:</label>
                                                        <input class="form-control shadow-none" type="text" name="price" id="price" placeholder="Nhập số tiền muốn rút" required readonly>
                                                    </div>
                                                </div>
                                            </div>    
                                            <div class="row">
                                            	<div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>❖ Lời nhắn:</label>
                                                        <input class="form-control shadow-none" type="text" name="note" placeholder="Có thể bỏ trống">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>❖ Mật khẩu cấp 2:</label>
                                                        <input class="form-control shadow-none" type="password" name="pass2" placeholder="Nhập mật khẩu cấp 2" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="padding-top: 10px;">
                                                <div class="col-md-12 text-center">
                                                    <button class="btn btn-success" id="btnSubmit" disabled>❖ Vui lòng chọn ngân hàng</button>    
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
                                        ❖ Số tiền rút phải lớn hơn hoặc bằng 50.000đ.<br>
                                        ❖ Phí rút tiền 3.000đ, trên 300.000đ không mất phí!<br>
                                        ❖ Bắt buộc phải thêm ngân hàng trước khi rút tiền<br>
                                        ❖ Vui lòng kiểm tra kĩ dữ liệu trước khi gửi yêu cầu. <br>
                                        ❖ Nếu sai thông tin, mất tiền, chúng tôi không chịu trách nhiệm!
                                    </p>
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
    <script src="assets/vendor/select2/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main JS-->
    <script src="assets/js/main.js"></script>

    <script type="text/javascript" src="handler/js/withdraw.js"></script>
</body>

</html>
<!-- end document-->
