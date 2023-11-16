<?php 
    include "../handler/config.php";
    if (!isset($_SESSION["username"])) {
        header("../location: login.php");
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
    <title>Lịch sử đổi thẻ - <?php echo $settings->get("title"); ?></title>

    <!-- Fontfaces CSS-->
    <link href="../assets/css/font-face.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../assets/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../assets/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../assets/css/theme.css" rel="stylesheet" media="all">

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
	                                    <h3 class="title-2">Lịch sử đổi thẻ</h3>
                                        <hr>
                                        <div class="row">
		                                    <div class="col-md-12 text-center">
		                                        <label class="sr-only">Tìm kiếm lịch sử</label>
										      	<div class="input-group mb-2">
											        <div class="input-group-prepend">
											          	<div class="input-group-text">Search:</div>
											        </div>
										        	<input type="text" class="form-control shadow-none shadow-none" id="search" placeholder="Tìm kiếm lịch sử">
										      	</div>
		                                    </div>
	                                    </div>
	                                    <hr>
	                                    <div class="table-responsive">
	                                    	<table class="table table-bordered text-center">
                                                <?php if ($rank == "boss") { ?>
                                                    <thead class="bg-primary text-white">
                                                        <th>ID</th>
                                                        <th>Mã giao dịch</th>
                                                        <th>Username</th>
                                                        <th>Loại thẻ</th>
                                                        <th>Mệnh giá</th>
                                                        <th>Serial</th>
                                                        <th>Mã thẻ</th>
                                                        <th>Thực nhận</th>
                                                        <th>Trạng thái</th>
                                                        <th>Thời gian</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $get_accounts = $conn->query("SELECT * FROM users WHERE boss_account = '{$_SESSION["username"]}'"); 
                                                            if ($get_accounts->num_rows > 0) {
                                                                while ($result = $get_accounts->fetch_array()) {
                                                                    $get = $conn->query("SELECT * FROM card WHERE username = '{$result["username"]}'");
                                                                    if ($get->num_rows > 0) { 
                                                                        while($row = $get->fetch_array()) {
                                                        ?>
                                                        <tr>
                                                            <td>#<?php echo $row["id"]; ?></td>
                                                            <td>#<?php echo $row["transId"]; ?></td>
                                                            <td><?php echo $row["username"]; ?></td>
                                                            <td><?php echo $row["type"]; ?></td>
                                                            <td><?php echo $row["amount"]; ?></td>
                                                            <td><?php echo $row["serial"]; ?></td>
                                                            <td><?php echo $row["pin"]; ?></td>
                                                            <td><?php echo $row["real_amount"]; ?></td>
                                                            <td><?php echo status_card($row["status"]); ?></td>
                                                            <td><?php echo $row["date"]; ?></td>
                                                        </tr>
                                                        <?php 
                                                                        }
                                                                    } else {
                                                                        echo '<tr><td colspan="10" class="text-center">Không có dữ liệu!</td></tr>';
                                                                    }
                                                                }
                                                            } else {
                                                                echo '<tr><td colspan="10" class="text-center">Không có dữ liệu!</td></tr>';
                                                            } 
                                                        ?>
                                                    </tbody>
                                                <?php } else { ?>
    	                                    		<thead class="bg-primary text-white">
    	                                    			<th>ID</th>
                                                        <th>Mã giao dịch</th>
    	                                    			<th>Loại thẻ</th>
    	                                    			<th>Mệnh giá</th>
    	                                    			<th>Serial</th>
    	                                    			<th>Mã thẻ</th>
                                                        <th>Thực nhận</th>
    	                                    			<th>Trạng thái</th>
                                                        <th>Thời gian</th>
    	                                    		</thead>
    	                                    		<tbody>
                                                        <?php 
                                                            $get = $conn->query("SELECT * FROM card WHERE username = '{$_SESSION["username"]}'");
                                                            if ($get->num_rows > 0) { 
                                                                while($row = $get->fetch_array()) {
                                                        ?>
    	                                    			<tr>
    	                                    				<td>#<?php echo $row["id"]; ?></td>
    	                                    				<td>#<?php echo $row["transId"]; ?></td>
    	                                    				<td><?php echo $row["type"]; ?></td>
                                                            <td><?php echo $row["amount"]; ?></td>
                                                            <td><?php echo $row["serial"]; ?></td>
                                                            <td><?php echo $row["pin"]; ?></td>
                                                            <td><?php echo $row["real_amount"]; ?></td>
    	                                    				<td><?php echo status_card($row["status"]); ?></td>
    	                                    				<td><?php echo $row["date"]; ?></td>
    	                                    			</tr>
                                                        <?php 
                                                                }
                                                            } else {
                                                                echo '<tr><td colspan="9" class="text-center">Không có dữ liệu!</td></tr>';
                                                            } 
                                                        ?>
    	                                    		</tbody>
                                                <?php }  ?>
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
    <script src="../assets/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../assets/vendor/slick/slick.min.js">
    </script>
    <script src="../assets/vendor/wow/wow.min.js"></script>
    <script src="../assets/vendor/animsition/animsition.min.js"></script>
    <script src="../assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../assets/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../assets/vendor/select2/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main JS-->
    <script src="../assets/js/main.js"></script>
</body>

</html>
<!-- end document-->
