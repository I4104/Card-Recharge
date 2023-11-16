<?php
	include '../config.php';

    $action = isset($_GET["action"]) ? $_GET["action"] : "";

    if ($action == "create") {
    	$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
    	if ($username == "") {
    		echo swal("Thất bại", "Vui lòng đăng nhập để sử dụng tính năng này!", "warning", true);
    		return;
    	}
    	
    	$stk = isset($_POST["stk"]) ? $_POST["stk"] : "";
    	$realname = isset($_POST["realname"]) ? $_POST["realname"] : "";
    	$address = isset($_POST["address"]) ? $_POST["address"] : "";
    	$bankname = isset($_POST["bankname"]) ? $_POST["bankname"] : "";
    	

    	if ($stk == "" || $realname == "" || $bankname == "") {
    		echo swal("Thất bại", "Vui lòng nhập đủ thông tin!", "warning", true);
    		return;
    	}
    	
    	$conn->query("INSERT INTO bank SET username = '{$username}', stk = '{$stk}', realname = '{$realname}', bankname = '{$bankname}', address = '{$address}'");
    	echo swal("Thành công", "Đã thêm tài khoản ngân hàng mới!", "success", true);
    }

    if ($action == "delete") {
    	$id = isset($_GET['id']) ? $_GET["id"] : "";
    	$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
    	if ($username == "") {
    		echo swal("Thất bại", "Vui lòng đăng nhập để sử dụng tính năng này!", "warning", true);
    		return;
    	}
    	if ($id == "") {
    		echo swal("Thất bại", "Tài khoản không tồn tại", "danger", true);
    		return;
    	}
    	$get = $conn->query("SELECT * FROM bank WHERE username = '{$username}' AND id = '{$id}'");
    	if ($get->num_rows > 0) {
    		$conn->query("DELETE FROM bank WHERE id = '{$id}'");
    		echo swal("Thất bại", "Đã xóa tài khoản trên", "success", true);
    	} else {
    		echo swal("Thất bại", "Tài khoản không tồn tại", "danger", true);
    	}
    }







?>