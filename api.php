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
    <title>Tích hợp API - <?php echo $settings->get("title"); ?></title>

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
                            <div class="col-lg-12">
                                <div class="au-card recent-report bottom-border-success">
                                    <div class="au-card-inner">
	                                    <h3 class="title-2">Tích hợp API</h3>
                                        <hr>
                                        <div class="row">
	                                        <div class="col-md-4">
		                                        <button class="btn btn-success" data-target="#create" data-toggle="modal"><i class="fa fa-folder-plus"></i> Tạo APIkey mới</button>
                                                <?php if ($rank == "boss") { ?>
                                                    <button class="btn btn-danger"><i class="fa fa-folder-hand-holding-usd"></i> Rút toàn bộ tiền</button>
                                                <?php } ?>
		                                    </div>
		                                    <div class="col-md-4">
		                                        <label class="sr-only">Tìm kiếm apikey</label>
										      	<div class="input-group mb-2">
											        <div class="input-group-prepend">
											          	<div class="input-group-text">Search:</div>
											        </div>
										        	<input type="text" class="form-control shadow-none shadow-none" id="search" placeholder="Tìm kiếm apikey">
										      	</div>
		                                    </div>
		                                    <div class="col-md-4">
		                                        
		                                    </div>
	                                    </div>
	                                    <hr>
                                        <?php if ($rank == "boss") { ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered text-center">
                                                    <thead class="bg-primary text-white">
                                                        <th>ID</th>
                                                        <td>Tài khoản</td>
                                                        <th>APIKey</th>
                                                        <th>Link callback</th>
                                                        <td>Tổng tiền</td>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $get_accounts = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'"); 
                                                            if ($get_accounts->num_rows > 0) {
                                                                while ($result = $get_accounts->fetch_array()) {
                                                                    $get = $conn->query("SELECT * FROM apikey WHERE username = '{$result["username"]}'");
                                                                    if ($get->num_rows > 0) { 
                                                                        while($row = $get->fetch_array()) {
                                                        ?>
                                                        <tr>
                                                            <td>#<?php echo $row["id"]; ?></td>
                                                            <td><?php echo $row["username"]; ?></td>
                                                            <td><?php echo $row["apikey"]; ?></td>
                                                            <td><?php echo $row["callback"]; ?></td>
                                                            <td><?php echo $result["price"]; ?></td>
                                                            <td><?php echo status($row["status"]); ?></td>
                                                            <td><?php echo $row["date"]; ?></td>
                                                            <td><a href="javascript: void(0);" onclick="edit_boss_api(<?php echo $row["id"]; ?>);"><i class="fa fa-edit"></i></a> <a href="javascript: void(0);" onclick="delete_api(<?php echo $row["id"]; ?>);"><i class="fa fa-trash"></i></a></td>
                                                        </tr>
                                                        <?php 
                                                                        }
                                                                    }
                                                                }
                                                            } else {
                                                                echo '<tr><td colspan="8" class="text-center">Không có dữ liệu!</td></tr>';
                                                            } 
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
    	                                    <div class="table-responsive">
    	                                    	<table class="table table-bordered text-center">
    	                                    		<thead class="bg-primary text-white">
    	                                    			<th>ID</th>
    	                                    			<th>APIKey</th>
    	                                    			<th>Link callback</th>
    	                                    			<th>Status</th>
    	                                    			<th>Date</th>
    	                                    			<th>Action</th>
    	                                    		</thead>
    	                                    		<tbody>
                                                        <?php 
                                                            $get = $conn->query("SELECT * FROM apikey WHERE username = '{$_SESSION["username"]}'");
                                                            if ($get->num_rows > 0) { 
                                                                while($row = $get->fetch_array()) {
                                                        ?>
    	                                    			<tr>
    	                                    				<td>#<?php echo $row["id"]; ?></td>
    	                                    				<td><?php echo $row["apikey"]; ?></td>
    	                                    				<td><?php echo $row["callback"]; ?></td>
    	                                    				<td><?php echo status($row["status"]); ?></td>
    	                                    				<td><?php echo $row["date"]; ?></td>
    	                                    				<td><a href="javascript: void(0);" onclick="edit_api(<?php echo $row["id"]; ?>);"><i class="fa fa-edit"></i></a> <a href="javascript: void(0);" onclick="delete_api(<?php echo $row["id"]; ?>);"><i class="fa fa-trash"></i></a></td>
    	                                    			</tr>
                                                        <?php 
                                                                }
                                                            } else {
                                                                echo '<tr><td colspan="6" class="text-center">Không có dữ liệu!</td></tr>';
                                                            } 
                                                        ?>
    	                                    		</tbody>
    	                                    	</table>
    	                                    </div>
                                        <?php } ?>
	                                    <hr style="border: none;">
	                                    <p>
	                                    	<i class="fa fa-file"></i> Tài liệu tích hợp: <a href="#">Xem ngay</a> <br>
	                                    	<i class="fa fa-file-download"></i> File tích hợp mẫu (PHP): <a href="#">Tải xuống</a>
	                                    </p>
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
    <?php if ($rank == "default") { ?>
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Tạo APIKey mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="apikey">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>❖ Link callback:</label>
                                <input class="form-control shadow-none" type="text" name="callback" placeholder="Nhập link callback" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-success">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Sửa APIKey</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="edit_apikey">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>❖ Link callback:</label>
                                <input class="form-control shadow-none" type="text" name="callback" id="edit_callback" placeholder="Nhập link callback" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-success" id="btn_save">Lưu lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Tạo APIKey mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="boss_apikey">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>❖ Username:</label>
                                <select class="form-control" name="username" required>
                                    <option>Chọn một tài khoản</option>
                                    <?php
                                        $get = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'");
                                        if ($get->num_rows > 0) {
                                            while ($row = $get->fetch_array()) {
                                                echo '<option value="'. $row["username"] .'">'. $row["username"] .'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>❖ Link callback:</label>
                                <input class="form-control shadow-none" type="text" name="callback" placeholder="Nhập link callback" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-success">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Sửa APIKey</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="edit_boss_apikey">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>❖ Username:</label>
                                <select class="form-control" name="username" required>
                                    <option>Chọn một tài khoản</option>
                                    <?php
                                        $get = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'");
                                        if ($get->num_rows > 0) {
                                            while ($row = $get->fetch_array()) {
                                                echo '<option value="'. $row["username"] .'">'. $row["username"] .'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>❖ Link callback:</label>
                                <input class="form-control shadow-none" type="text" name="callback" id="edit_callback" placeholder="Nhập link callback" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-success" id="btn_save">Lưu lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    <script type="text/javascript" src="handler/js/api.js"></script>
</body>

</html>
<!-- end document-->
