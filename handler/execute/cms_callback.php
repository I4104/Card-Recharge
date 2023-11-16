<?php
	include "../handler/config.php";

	$dataJSON = file_get_contents('php://input');

	$data = json_decode($dataJSON, true);
    $status = isset($data['status']) ? $data['status'] : "";
    $msg = isset($data['msg']) ? $data['msg'] : "";
    $note = isset($data['note']) ? $data['note'] : "";
    $real_amount = isset($data['card_real_amount']) ? $data['card_real_amount'] : "";
    $receive_amount = isset($data['card_received_amount']) ? $data['card_received_amount'] : "";
    $transaction = isset($data['card_transaction_id']) ? $data['card_transaction_id'] : "";

    $get = $conn->query("SELECT * FROM card WHERE transId = '{$transaction}'");
    if ($get->num_rows > 0) {
    	$row = $get->fetch_array();
    	
    	if ($status == 2) {
    		// Thẻ đúng
    		if ($receive_amount != $row["amount"]) {
    			// Thẻ sai mệnh giá
	    		$price = $row["real_amount"] - ($row["real_amount"] * 50 / 100);
	    		$conn->query("UPDATE users SET price = price + {$price}");
	    		$conn->query("UPDATE card SET status = 1, real_amount = '{$price}' WHERE transId = '{$transaction}'");
	    		$postData = array(
		            "status"=> $status,
		            "msg"=> $msg,
		            "note"=> $note,
		            "amount"=> $real_amount,
		            "real_amount"=> $price,
		            "receive_amount"=> $receive_amount,
		            "transaction"=> $transaction,
		        );
    		} else {
    			$conn->query("UPDATE users SET price = price + {$row["real_amount"]}");
    			$conn->query("UPDATE card SET status = 1 WHERE transId = '{$transaction}'");
    			$postData = array(
		            "status"=> $status,
		            "msg"=> $msg,
		            "note"=> $note,
		            "amount"=> $real_amount,
		            "real_amount"=> $row["real_amount"],
		            "receive_amount"=> $receive_amount,
		            "transaction"=> $transaction,
		        );
    		}

    		if ($row["apikey"] != "website") {
    			$apikey = $conn->query("SELECT * FROM apikey WHERE apikey = '{$row["apikey"]}'")->fetch_array();
		        $curl = curl_init();
		        curl_setopt_array($curl, array(
		            CURLOPT_URL => $apikey["callback"],
		            CURLOPT_RETURNTRANSFER => true,
		            CURLOPT_ENCODING => '',
		            CURLOPT_MAXREDIRS => 10,
		            CURLOPT_TIMEOUT => 0,
		            CURLOPT_FOLLOWLOCATION => true,
		            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		            CURLOPT_CUSTOMREQUEST => 'POST',
		            CURLOPT_POSTFIELDS =>json_encode($postData),
		            CURLOPT_HTTPHEADER => array(
		                'Content-Type: application/json'
		            ),
		        ));
		        $response = curl_exec($curl);
		        curl_close($curl);
    		}
    	}

    	if ($status == 3) {
    		// Thẻ sai
    		$conn->query("UPDATE card SET status = 3 WHERE transId = '{$transaction}'");

    		if ($row["apikey"] != "website") {
    			// Trả callback về cho website user
    			$postData = array(
		            "status"=> $status,
		            "msg"=> $msg,
		            "note"=> $note,
		            "amount"=> $real_amount,
		            "real_amount"=> $price,
		            "receive_amount"=> $receive_amount,
		            "transaction"=> $transaction,
		        );

    			$apikey = $conn->query("SELECT * FROM apikey WHERE apikey = '{$row["apikey"]}'")->fetch_array();
		        $curl = curl_init();
		        curl_setopt_array($curl, array(
		            CURLOPT_URL => $apikey["callback"],
		            CURLOPT_RETURNTRANSFER => true,
		            CURLOPT_ENCODING => '',
		            CURLOPT_MAXREDIRS => 10,
		            CURLOPT_TIMEOUT => 0,
		            CURLOPT_FOLLOWLOCATION => true,
		            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		            CURLOPT_CUSTOMREQUEST => 'POST',
		            CURLOPT_POSTFIELDS =>json_encode($postData),
		            CURLOPT_HTTPHEADER => array(
		                'Content-Type: application/json'
		            ),
		        ));
		        $response = curl_exec($curl);
		        curl_close($curl);
    		}
    	}
    }

?>