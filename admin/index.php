<?php
    include "../handler/config.php";
    if (!isset($_SESSION["username"])) {
        header("location: ../");
    }
    if ($rank != "admin") {
        header("location: ../");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Website Manager</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="/" class="logo">
					I4104
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt="user-img" width="36" class="img-circle"><span ><?php echo $_SESSION["username"]; ?></span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt="user"></div>
										<div class="u-text">
											<h4><?php echo $_SESSION["username"]; ?></h4>
											<p class="text-muted"><?php echo $users["email"]; ?></p>
										</div>
									</div>
								</li>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="../handler/execute/users.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
							</ul>
								<!-- /.dropdown-user -->
						</li>
					</ul>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<ul class="nav">
						<li class="nav-item active">
							<a href="index.php">
								<i class="far fa-clipboard"></i>
								<p>Thông tin</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="users.php">
								<i class="fa fa-users"></i>
								<p>Người dùng</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="card.php">
								<i class="fa fa-box"></i>
								<p>Thẻ cào</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="bank.php">
								<i class="fa fa-credit-card"></i>
								<p>Ngân hàng</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="settings.php">
								<i class="fa fa-cog"></i>
								<p>Tùy chỉnh</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<h4 class="page-title">Dashboard</h4>
						<div class="row">
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center icon-warning">
													<i class="fa fa-user text-success"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Người dùng</p>
													<h4 class="card-title"><?php echo $conn->query("SELECT * FROM users")->num_rows; ?></h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="fa fa-donate text-success"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Tổng thẻ tháng</p>
													<h4 class="card-title">
														<?php
															$total = 0;
															$get = $conn->query("SELECT * FROM card WHERE status = 1 AND MONTH(`date`) = MONTH(NOW()) AND YEAR(`date`) = YEAR(NOW());");
                                                            if ($get->num_rows > 0) { 
                                                                while($row = $get->fetch_array()) {
                                                                    $total += $row["amount"];
                                                                }
                                                            }
                                                            echo number_format($total);
														?> 
													đ</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="fa fa-list text-danger"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Tổng thực nhận tháng</p>
													<h4 class="card-title">
														<?php
															$total = 0;
															$get = $conn->query("SELECT * FROM card WHERE status = 1 AND MONTH(`date`) = MONTH(NOW()) AND YEAR(`date`) = YEAR(NOW());");
                                                            if ($get->num_rows > 0) { 
                                                                while($row = $get->fetch_array()) {
                                                                    $total += $row["real_amount"];
                                                                }
                                                            }
                                                            echo number_format($total);
														?> 
													đ</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="fa fa-shopping-cart text-primary"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Tổng thẻ tháng</p>
													<h4 class="card-title">
														<?php
															$total = 0;
															$get = $conn->query("SELECT * FROM card WHERE status = 1 AND MONTH(`date`) = MONTH(NOW()) AND YEAR(`date`) = YEAR(NOW());");
                                                            if ($get->num_rows > 0) { 
                                                                while($row = $get->fetch_array()) {
                                                                    $total += 1;
                                                                }
                                                            }
                                                            echo number_format($total);
														?> 
													đ</h4>
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
		</div>
	</div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/demo.js"></script>

</html>