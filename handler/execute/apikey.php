<?php
	include '../config.php';

    $action = isset($_GET["action"]) ? $_GET["action"] : "";

    if ($action == "create") {
    	$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
    	if ($username == "") {
    		echo swal("Thất bại", "Vui lòng đăng nhập để sử dụng tính năng này!", "warning", true);
    		return;
    	}
    	$callback = isset($_POST["callback"]) ? $_POST["callback"] : "";
    	if ($callback == "") {
    		echo swal("Thất bại", "Vui lòng nhập link callback!", "warning", true);
    		return;
    	}
    	$time = date("Y-m-d H:i:s");
    	$apikey = md5($callback.$time.rand(0, 9999));
    	$conn->query("INSERT INTO apikey SET username = '{$username}', apikey = '{$apikey}', callback = '{$callback}', status = 1");
    	echo swal("Thành công", "Đã thêm APIKey mới!", "success", true);
    }

    if ($action == "edit") {
        $id = isset($_GET['id']) ? $_GET["id"] : "";
        if ($rank == "boss") {
            $username = isset($_POST["username"]) ? $_POST["username"] : "";
            if ($username == "") {
                echo swal("Thất bại", "Vui lòng chọn một tài khoản!", "warning", false);
                return;
            }
        } else {
            $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
            if ($username == "") {
                echo swal("Thất bại", "Vui lòng đăng nhập để sử dụng tính năng này!", "warning", true);
                return;
            }
        }
        
        $get = $conn->query("SELECT * FROM apikey WHERE username = '{$username}' AND id = '{$id}'");
        if ($get->num_rows > 0) {
            $callback = isset($_POST["callback"]) ? $_POST["callback"] : "";
            if ($callback == "") {
                echo swal("Thất bại", "Vui lòng nhập link callback!", "warning", false);
                return;
            }
            if ($rank != "boss") {
                $conn->query("UPDATE apikey SET callback = '{$callback}' WHERE id = '{$id}'");
            } else {
                $conn->query("UPDATE apikey SET username = '{$username}', callback = '{$callback}' WHERE id = '{$id}'");
            }
            echo swal("Thất bại", "Đã lưu APIKey trên", "success", true);
        } else {
            echo swal("Thất bại", "APIKey không tồn tại", "danger", true);
        }
    }

    if ($action == "delete") {
    	$id = isset($_GET['id']) ? $_GET["id"] : "";
    	$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
    	if ($username == "") {
    		echo swal("Thất bại", "Vui lòng đăng nhập để sử dụng tính năng này!", "warning", true);
    		return;
    	}

    	if ($id == "") {
    		echo swal("Thất bại", "APIKey không tồn tại", "danger", true);
    		return;
    	}
    	$get = $conn->query("SELECT * FROM apikey WHERE username = '{$username}' AND id = '{$id}'");
        if ($rank == "boss") {
            $row = $get->fetch_array();
            $get = $conn->query("SELECT * FROM users WHERE username = '{$row["username"]}' AND boss_account = '{$username}'");
        }
    	if ($get->num_rows > 0) {
    		$conn->query("DELETE FROM apikey WHERE id = '{$id}'");
    		echo swal("Thất bại", "Đã xóa APIKey trên", "success", true);
    	} else {
    		echo swal("Thất bại", "APIKey không tồn tại", "danger", true);
    	}
    }

    if ($action == "check") {
        $id = isset($_GET['id']) ? $_GET["id"] : "";
        $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";

        if ($username == "") {
            echo swal("Thất bại", "Vui lòng đăng nhập để sử dụng tính năng này!", "warning", true);
            return;
        }
        if ($id == "") {
            echo swal("Thất bại", "APIKey không tồn tại", "danger", true);
            return;
        }
        $get = $conn->query("SELECT * FROM apikey WHERE username = '{$username}' AND id = '{$id}'");
        if ($get->num_rows > 0) {
            $row = $get->fetch_array();
            echo json_encode($row);
        } else {
            echo "";
        }
    }

?>