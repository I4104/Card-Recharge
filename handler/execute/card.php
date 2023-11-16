<?php
	include '../config.php';

    $action = isset($_GET["action"]) ? $_GET["action"] : "";

    if ($action == "card") {
    	$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";
	    $serial = (isset($_POST['serial'])) ? $_POST['serial'] : "";
	    $pin = (isset($_POST['pin'])) ? $_POST['pin'] : "";
	    $type = (isset($_POST['type'])) ? $_POST['type'] : "";
	    $amount = (isset($_POST['amount'])) ? $_POST['amount'] : "";
	    $note = (isset($_POST['note'])) ? $_POST['note'] : "";

	    if ($username == "") {
    		echo swal("Thất bại", "Vui lòng đăng nhập để sử dụng tính năng này!", "warning", true);
    		return;
    	}

    	if ($serial == "" || $pin == "" || $type == "" || $amount == "") {
    		echo swal("Thất bại", "Vui lòng nhập đầy đủ thông tin!", "warning", false);
    		return;
    	}

    	$get = $conn->query("SELECT * FROM card_type WHERE type = '{$type}' AND amount = '{$amount}'")->fetch_array();
    	$real_amount = $amount - ($amount * $get["rate"] / 100);

    	if ($get["api"] == "tstprovn") {
    		$data = tstprovn($serial, $pin, $amount, $type, $note);

		    if ($data["status"] == 2) {
		    	echo swal("Thất bại", $data["msg"], "error", false);
		    } else {
		    	$conn->query("INSERT INTO card SET username = '{$username}', transId = '{$data["transaction"]}', apikey = 'website', `serial` = '{$serial}', `pin` = '{$pin}', `type` = '{$type}', `amount` = '{$amount}', `real_amount` = '{$real_amount}', `note` = '{$note}' ");
		    	echo swal("Thành công", "Thẻ đã được gửi đi, vui lòng chờ duyệt!", "success", true);
		    }
    	} 
	    
	    if ($get["api"] == "CMS_card") {
	    	$code = rand(100000, 999999);
	    	$data = CMS_card($serial, $pin, $amount, $type, $code);
	    	if ($data["code"] != "999") {
	    		echo swal("Thất bại", $data["message"], "error", false);
	    	} else {
    			$conn->query("INSERT INTO card SET username = '{$username}', transId = '{$code}', apikey = 'website', `serial` = '{$serial}', `pin` = '{$pin}', `type` = '{$type}', `amount` = '{$amount}', `real_amount` = '{$real_amount}', `note` = '{$note}' ");
    			echo swal("Thành công", "Thẻ đã được gửi đi, vui lòng chờ duyệt!", "success", true);
    		}
	    }
    }

?>