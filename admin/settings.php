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
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
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
						<li class="nav-item">
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
						<li class="nav-item active">
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
						<h4 class="page-title">Quản lý website</h4>
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Thông tin cơ bản</h4>
										<p class="card-category">Chỉnh sửa thông tin cơ bản của website</p>
									</div>
									<form id="basic">
										<div class="card-body">
											<div class="row">
												<div class="col-md-6 form-group">
													<label>Title</label>
													<input class="form-control shadow-none" type="text" name="username" value="<?php echo $settings->get("title"); ?>" required>
												</div>
												<div class="col-md-6 form-group">
													<label>Thông báo</label>
													<select class="form-control" name="notify" id="notify" required>
														<option>Chọn trạng thái thông báo</option>
														<option value="on">Bật</option>
														<option value="off">Tắt</option>
													</select>
												</div>
											</div>
											<div class="form-group">
                                                <label>Nội dung thông báo:</label>
                                                <div id="notify_content"><?php echo $settings->get("notify_content"); ?></div>
                                            </div>
										</div>
										<div class="card-footer text-right">
											<button class="btn btn-success" type="submit">Lưu lại</button>
										</div>
									</form>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Thông tin thẻ cào</h4>
										<p class="card-category">Chỉnh sửa thông tin thẻ cào</p>
									</div>
									<form id="card">
										<div class="card-body" style="padding: 20px;">
											<div class="row">
												<div class="table-responsive">
													<table class="table table-bordered">
														<thead>
															<th>Loại thẻ</th>
															<th>Mệnh giá</th>
															<th>Chiết khấu (%)</th>
															<th>Bên api nhận thẻ</th>
														</thead>
														<tbody>
														<?php
		                                                    $get = $conn->query("SELECT * FROM card_type");
		                                                    if ($get->num_rows > 0) {
		                                                        while ($row = $get->fetch_array()) {
		                                                            echo '
		                                                            <tr>
		                                                                <td>'. $row["type"] .'</td>
		                                                                <td>'. number_format($row["amount"]) .'đ</td>
		                                                                <td><input class="form-control shadow-none" type="number" name="rate_'. $row["id"] .'" value="'. $row["rate"] .'"></td>
		                                                                <td>
		                                                                	<select class="form-control" name="api_'. $row["id"] .'" id="api_'. $row["id"] .'" required>
		                                                                		<option>Chọn bên nhận thẻ cào</option>
																				<option value="CMS_card">CMS</option>
																				<option value="tstprovn">Tstprovn</option>
		                                                                	</select>
		                                                                </td>
		                                                                <script>$("#api_'. $row["id"] .'").val("'. $row["api"] .'");</script>
		                                                            </tr>
		                                                            ';
		                                                        }
		                                                    }
														?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<div class="card-footer text-right">
											<button class="btn btn-success" type="submit">Lưu lại</button>
										</div>
									</form>
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
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css"><script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script type="text/javascript">
	$("#notify").val("<?php echo $settings->get("notify"); ?>");

    var toolbarOptions = [
      ['bold', 'italic', 'underline', 'strike'], 
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      [{ 'color': [] }],      
      [{ 'font': [] }],                   
    ];
    var quill = new Quill('#notify_content', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    $("#basic").on("submit", function(e) {
        e.preventDefault();
        var notify_content = quill.root.innerHTML;
        
        var fd = new FormData(this);
        fd.append("notify_content", notify_content);
        $.ajax({
            url: "handler/settings.php?action=save",
            type: "POST",
            data: fd,
            processData: false, 
            contentType: false, 
            success: function(data) {
                var data = JSON.parse(data);
                swal(data.title, data.message, data.type).then(function() {
                    if (data.reload) {
                        window.location.reload();
                    }
                });
            }
        });
    });

    $("#card").on("submit", function(e) {
        e.preventDefault();
        
        $.ajax({
            url: "handler/settings.php?action=save",
            type: "POST",
            data: $(this).serialize(), 
            success: function(data) {
                var data = JSON.parse(data);
                swal(data.title, data.message, data.type).then(function() {
                    if (data.reload) {
                        window.location.reload();
                    }
                });
            }
        });
    });

	function price(total) {
		var re = new RegExp(',', 'g');
	    total = total.replace(re, '');
	    total = parseFloat(total, 10).toFixed(3).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
	    total = total.substr(0, total.length - 4);
	    return total;
	}

	function isNumber(number) {
	    var regex = /^[0-9]*$/g
	    return regex.test(number);
	}
</script>
</html>