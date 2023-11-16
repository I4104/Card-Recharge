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
    <title>Ngân hàng - <?php echo $settings->get("title"); ?></title>

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
                            <div class="col-lg-12">
                                <div class="au-card recent-report bottom-border-primary">
                                    <div class="au-card-inner">
	                                    <h3 class="title-2">Quản lý ngân hàng</h3>
                                        <hr>
                                        <div class="row">
	                                        <div class="col-md-4">
		                                        <button class="btn btn-success" data-target="#create" data-toggle="modal"><i class="fa fa-folder-plus"></i> Thêm ngân hàng mới</button>
		                                    </div>
		                                    <div class="col-md-4">
		                                        <label class="sr-only">Tìm kiếm</label>
										      	<div class="input-group mb-2">
											        <div class="input-group-prepend">
											          	<div class="input-group-text">Search:</div>
											        </div>
										        	<input type="text" class="form-control shadow-none shadow-none" id="search" placeholder="Tìm kiếm ngân hàng">
										      	</div>
		                                    </div>
		                                    <div class="col-md-4">
		                                        
		                                    </div>
	                                    </div>
	                                    <hr>
	                                    <div class="table-responsive">
	                                    	<table class="table table-bordered text-center">
	                                    		<thead class="bg-primary text-white">
	                                    			<th>ID</th>
	                                    			<th>Số tài khoản</th>
	                                    			<th>Tên chủ thẻ</th>
	                                    			<th>Ngân hàng</th>
	                                    			<th>Chi nhánh</th>
	                                    			<th>Date</th>
	                                    			<th>Action</th>
	                                    		</thead>
	                                    		<tbody>
	                                    			<?php 
                                                        $get = $conn->query("SELECT * FROM bank WHERE username = '{$_SESSION["username"]}'");
                                                        if ($get->num_rows > 0) { 
                                                            while($row = $get->fetch_array()) {
                                                    ?>
	                                    			<tr>
	                                    				<td>#<?php echo $row["id"]; ?></td>
	                                    				<td><?php echo $row["stk"]; ?></td>
	                                    				<td><?php echo $row["realname"]; ?></td>
	                                    				<td><?php echo $row["bankname"]; ?></td>
	                                    				<td><?php echo $row["address"]; ?></td>
	                                    				<td><?php echo $row["date"]; ?></td>
	                                    				<td><i class="fa fa-edit"></i> <a href="javascript: void(0);" onclick="delete_bank(<?php echo $row["id"]; ?>);"><i class="fa fa-trash"></i></a></td>
	                                    			</tr>
                                                    <?php 
                                                            }
                                                        } else {
                                                            echo '<tr><td colspan="7" class="text-center">Không có dữ liệu!</td></tr>';
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
    <script src="assets/vendor/select2/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main JS-->
    <script src="assets/js/main.js"></script>

    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Tạo APIKey mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="bank">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>❖ Ngân hàng:</label>
                            <select class="form-control shadow-none shadow-none" name="bankname" required>
                            	<option>Chọn một ngân hàng</option>
                            	<?php 
                            		foreach ($bank as $key => $value) {
                            			echo '<option value="'. $key .'">'. $value .'</option>';
                            		}
                            	?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>❖ Số tài khoản:</label>
                            <input class="form-control shadow-none shadow-none" type="text" name="stk" placeholder="Nhập số tài khoản" required>
                        </div>
                        <div class="form-group">
                            <label>❖ Tên chủ thẻ:</label>
                            <input class="form-control shadow-none shadow-none" type="text" name="realname" id="realname" placeholder="Nhập tên chủ thẻ (Viết hoa không dấu)" required>
                        </div>
                        <div class="form-group">
                            <label>❖ Chi nhánh:</label>
                            <input class="form-control shadow-none shadow-none" type="text" name="address" placeholder="Nhập chi nhánh của bạn (Có thể bỏ trống)">
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
    <script src="handler/js/bank.js"></script>
</body>

</html>
<!-- end document-->
