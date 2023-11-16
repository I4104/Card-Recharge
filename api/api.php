<?php
	include "../handler/config.php";

	$dataJSON = file_get_contents('php://input');

	$data = json_decode($dataJSON, true);
    $api_key = isset($data['api_key']) ? $conn->real_escape_string(strip_tags(addslashes($data['api_key']))); : "";
    $note = isset($data['note']) ? $conn->real_escape_string(strip_tags(addslashes($data['note']))); : "";
    $pin = isset($data['pin']) ? $conn->real_escape_string(strip_tags(addslashes($data['pin']))); : "";
    $serial = isset($data['serial']) ? $conn->real_escape_string(strip_tags(addslashes($data['serial']))); : "";
    $amount = isset($data['amount']) ? $conn->real_escape_string(strip_tags(addslashes($data['amount']))); : "";
    $typecard = isset($data['typecard']) ? $conn->real_escape_string(strip_tags(addslashes($data['typecard']))); : "";

    if ($api_key == "") {
    	$arr = array(
    		"status" => 2,
    		"msg" => "APIKey không chính xác!"
    	);
    	echo json_encode($arr);
    	return;
    }
    $get = $conn->query("SELECT * FROM apikey WHERE apikey = '{$api_key}'");
    if ($get->num_rows > 0) {
    	$row = $get->fetch_array();
    } else {
    	$arr = array(
    		"status" => 2,
    		"msg" => "APIKey không chính xác!"
    	);
    	echo json_encode($arr);
    	return;
    }

    if ($pin == "" || $serial == "" || $amount == "" || $typecard == "") {
    	$arr = array(
    		"status" => 2,
    		"msg" => "Không được bỏ trống thông tin!"
    	);
    	echo json_encode($arr);
    	return;
    }
    $get = $conn->query("SELECT * FROM card WHERE `pin` = '{$pin}' OR `serial` = '{$serial}'");
    if ($get->num_rows > 0) {
    	$arr = array(
    		"status" => 2,
    		"msg" => "Thẻ đã tồn tại trên hệ thống!"
    	);
    	echo json_encode($arr);
    	return;	
    }

    $get = $conn->query("SELECT * FROM card_type WHERE type = '{$type}' AND amount = '{$amount}'")->fetch_array();
    $real_amount = $amount - ($amount * $get["rate"] / 100);

    $code = rand(10000000, 99999999);

    if ($get["api"] == "tstprovn") {
		$data = tstprovn($serial, $pin, $amount, $typecard, $note);

	    if ($data["status"] == 2) {
	    	echo $data;
	    } else {
	    	$conn->query("INSERT INTO card SET username = '{$row["username"]}', transId = '{$code}', apikey = '{$api_key}', `serial` = '{$serial}', `pin` = '{$pin}', `type` = '{$typecard}', `amount` = '{$amount}', `real_amount` = '{$real_amount}', `note` = '{$note}' ");
		    $arr = array(
				"status" => 1,
				"msg" => "Gửi thẻ thành công, vui lòng chờ duyệt!",
				"transaction" => $code
			);
			echo json_encode($arr);
	    }
	} 
    
    if ($get["api"] == "CMS_card") {
    	$code = rand(100000, 999999);
    	$data = CMS_card($serial, $pin, $amount, $typecard, $code);
    	if ($data["code"] != "999") {
    		$arr = array(
				"status" => 2,
				"msg" => $data["message"]
			);
    	} else {
			$conn->query("INSERT INTO card SET username = '{$row["username"]}', transId = '{$code}', apikey = '{$api_key}', `serial` = '{$serial}', `pin` = '{$pin}', `type` = '{$typecard}', `amount` = '{$amount}', `real_amount` = '{$real_amount}', `note` = '{$note}' ");
		    $arr = array(
				"status" => 1,
				"msg" => "Gửi thẻ thành công, vui lòng chờ duyệt!",
				"transaction" => $code
			);
		}
		echo json_encode($arr);
    }


    
?>