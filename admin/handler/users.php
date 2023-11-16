<?php
    include "../../handler/config.php";

    $action = isset($_GET["action"]) ? $_GET["action"] : "";

    if ($action == "add") {
        $username = isset($_POST["username"]) ? $_POST["username"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
        
        $password = k04hash($password);
        $get = $conn->query("SELECT * FROM users WHERE username = '{$username}'");
        if ($get->num_rows > 0) {
            echo swal("Thất bại", "Username đã tồn tại", "error", false);
        } else {
            $conn->query("INSERT INTO users SET username = '{$username}', password = '{$password}', pass2 = '{$password}', email = '{$email}', phone = '{$phone}', rank = 'boss'");
            echo swal("Thành công", "Cập nhật thông tin thành công", "success", true);   
        }
    }

    if ($action == "edit") {
        $id = isset($_GET["id"]) ? $_GET["id"] : "";

        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
        $price = isset($_POST["price"]) ? str_replace(",", "", $_POST["price"]) : 0;
        $rank = isset($_POST["rank"]) ? $_POST["rank"] : "";

        if ($id == "") {
            echo swal("Oops", "User này không tồn tại", "error", true);
            return;
        }

        $get = $conn->query("SELECT * FROM users WHERE id = '{$id}'");
        if ($get->num_rows > 0) {
            $conn->query("UPDATE users SET email = '{$email}', phone = '{$phone}', rank = '{$rank}', price = '{$price}'");
            echo swal("Thành công", "Cập nhật thông tin thành công", "success", true);
        } else {
            echo swal("Thất bại", "User này không tồn tại", "error", false);
        }
        
    }
    
?>