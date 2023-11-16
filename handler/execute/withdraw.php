<?php 
	include "../config.php";

	$action = isset($_GET["action"]) ? $_GET["action"] : "";

	if ($action == "withdraw") {
		$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
		$bank = isset($_POST["bank"]) ? $_POST["bank"] : "";
		$price = isset($_POST["price"]) ? str_replace(",", "", $_POST["price"]) : 0;
		$note = isset($_POST["note"]) ? $_POST["note"] : "";
		$pass2 = isset($_POST["pass2"]) ? $_POST["pass2"] : "";

		if ($username == "") {
    		echo swal("Thất bại", "Vui lòng đăng nhập để sử dụng tính năng này!", "warning", true);
    		return;
    	}
    	if ($bankid == "" || $price == "" || $pass2 == "") {
			echo swal("Thất bại", "Vui lòng nhập đủ thông tin!", "warning", false);
    		return;
    	} else {
			$note = $conn->real_escape_string(strip_tags(addslashes($note)));
			$pass2 = $conn->real_escape_string(strip_tags(addslashes($pass2)));

			$pass2 = k04hash($pass2);

			$get = $conn->query("SELECT * FROM users WHERE username = '{$username}' AND pass2 = '{$pass2}'");
			if ($get->num_rows > 0) {
				if ($price < 50000) {
					echo swal("Thất bại", "Số tiền rút tối thiếu phải từ 50.000đ trở lên!", "warning", false);
				} else {
					if ($price < 300000) {
						$prices = $price + 3000;
					} else {
						$prices = $price;
					}
					$row = $get->fetch_array();
					if ($row["price"] >= $prices) {
						$conn->query("UPDATE users SET price = price - '{$prices}' WHERE username = '{$username}'");
						$conn->query("INSERT INTO withdraw SET username = '{$username}', price = '{$price}', bank = '{$bank}', note = '{$note}'");
						echo swal("Thành công", "Đã tạo lệnh chuyển tiền, vui lòng chờ admin xác nhận!", "success", true);
					} else {
						echo swal("Thất bại", "Số dư của bạn không đủ để thực hiện giao dịch!", "warning", false);
					}
				}
			} else {
				echo swal("Thất bại", "Mật khẩu cấp 2 không chính xác!", "warning", false);
			}
    	}
	}



?>