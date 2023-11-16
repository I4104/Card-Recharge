<?php
    include "../config.php";

    $action = isset($_GET["action"]) ? $_GET["action"] : "";

    if ($action == "login") {
        $username = isset($_POST["username"]) ? $_POST["username"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        echo login($username, $password);
    }

    if ($action == "changepass") {
        $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
        $password = isset($_POST["old"]) ? $_POST["old"] : "";
        $new = isset($_POST["new"]) ? $_POST["new"] : "";
        $renew = isset($_POST["renew"]) ? $_POST["renew"] : "";

        $password = $conn->real_escape_string(strip_tags(addslashes($password)));
        $new = $conn->real_escape_string(strip_tags(addslashes($new)));
        $renew = $conn->real_escape_string(strip_tags(addslashes($renew)));

        if ($username == "") {
            echo swal("Oops", "Không thể bỏ trống username", "error", true);
            return;
        }

        $password = k04hash($password);

        $get = $conn->query("SELECT * FROM users WHERE password = '{$password}' AND username = '{$username}'");
        if ($get->num_rows > 0) {
            if ($new == $renew) {
                $conn->query("UPDATE users SET password = '{$password}' WHERE username = '{$username}'");
                echo swal("Thành công", "Cập nhật thông tin thành công", "success", true);
            } else {
                echo swal("Thất bại", "Nhập lại mật khẩu không chính xác", "error", false);
            }
        } else {
            echo swal("Thất bại", "Mật khẩu cũ không chính xác", "error", false);
        }
        
    }

    if ($action == "create") {
        $boss = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
        $username = isset($_POST["username"]) ? $_POST["username"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";

        if ($boss == "") {
            echo swal("Oops", "Bạn cần đăng nhập để sử dụng tính năng này", "error", true);
            return;
        }

        if ($username == "" || $password == "") {
            echo swal("Oops", "Vui lòng nhập đủ thông tin", "error", true);
            return;
        }
        $get = $conn->query("SELECT * FROM users WHERE username = '{$username}'");
        if ($get->num_rows > 0) {
            echo swal("Thất bại", "Username đã tồn tại", "error", false);
        } else {
            $password = k04hash($password);
            $row = $conn->query("SELECT * FROM users WHERE username = '{$boss}'")->fetch_array();
            $conn->query("INSERT INTO users SET username = '{$username}', password = '{$password}', pass2 = '{$password}', email = '{$row["email"]}', phone = '{$row["email"]}', rank = 'default', boss_account = '{$boss}'");
            echo swal("Thành công", "Cập nhật thông tin thành công", "success", true);   
        }
        
    }
    
    if ($action == "logout") {
        unset($_SESSION);
        session_destroy();
        header("location: ../../index.php");
    }
?>