<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();
    require 'class/settings.class.php';
    
    $bank = array(
        "MOMO" => "MOMO",
        "MBBANK" => "MB BANK",
        "TECHCOMBANK" => "TECHCOMBANK",
        "AGRIBANK" => "Agribank",
        "CB" => "CB",
        "BIDV" => "BIDV",
        "VIETINBANK" => "VietinBank",
        "VIETCOMBANK" => "Vietcombank",
        "VPBANK" => "VPBank",
        "ACB" => "ACB",
        "SHB" => "SHB",
        "HDBANK" => "HDBank",
        "SCB" => "SCB",
        "SACOMBANK" => "Sacombank",
        "VIB" => "VIB",
        "VPBANK" => "VPBank",
    );
// Database
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db_name = "admin";
    
    $conn = new mysqli($host, $user, $pass, $db_name);
    $conn->set_charset("utf8");
    
    if (isset($_SESSION["username"])) {
        $users = $conn->query("SELECT * FROM users WHERE username = '{$_SESSION["username"]}'")->fetch_array();
        $rank = $users["rank"];
    }
    
    $settings = new settings($conn);

    $settings->add("title", "Doicard1s - Đối tác");
    $settings->add("notify", "on");
    $settings->add("notify_content", "Chào mừng các bạn đến với dịch vụ đổi thẻ created by I4104");

// Function
    function login($username, $password) {
        global $conn;
        $username = $conn->real_escape_string(strip_tags(addslashes($username)));
        $password = $conn->real_escape_string(strip_tags(addslashes($password)));
        
        if ($username == "" || $password == "") {
            return swal("Oops", "Vui lòng nhập đầy đủ thông tin!", "warning", false);
        }
        if (!check($password)) {
            return swal("Oops", "Mật khẩu chứa ký tự không cho phép!", "warning", false);
        }
        $password = k04hash($password);
        $get = $conn->query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
        if ($get->num_rows > 0) {
            $_SESSION["username"] = $username;
            return swal("Thành công", "Đăng nhập thành công!", "success", true);
        } else {
            return swal("Thất bại", "Tài khoản hoặc mật khẩu không chính xác!", "error", false);
        }
    }
    
    function check($string) {
        $allow_char = "QWERTYUIOPASDFGHJKLZXCVBNM@qwertyuiopasdfghjklzxcvbnm1234567890_-.";
        $arr = str_split($allow_char);
        $char = str_split($string);
        $bool = true;
        foreach($char as $c) {
            if (!in_array($c, $arr)) {
                $bool = false;
                break;
            }
        }
        return $bool;
    }

    function k04hash($password) {
        $hash = hash('md5', 'I4104.').hash('sha256', $password);
        $hash = hash('sha256', $hash);
        return $hash;
    }
    
    function swal($title, $message, $type, $reload=false) {
        return json_encode(array("title" => $title, "message" => $message, "type" => $type, "reload" => $reload), JSON_UNESCAPED_UNICODE);
    }
    
    function format_str($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
         
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ','_',$str);
        return $str;
    }

    function status_card($i) {
        if ($i == 0) {
            $status = "<span class='badge badge-warning'>Chờ duyệt</span>";
        }
        if ($i == 1) {
            $status = "<span class='badge badge-success'>Thành công</span>";
        }
        if ($i == 2) {
            $status = "<span class='badge badge-danger'>Thất bại</span>";
        }
        return $status;
    }

    function status($i) {
        if ($i == 0) {
            $status = "<span class='badge badge-warning'>Chờ duyệt</span>";
        }
        if ($i == 1) {
            $status = "<span class='badge badge-success'>Hoạt động</span>";
        }
        if ($i == 2) {
            $status = "<span class='badge badge-danger'>Đã hủy</span>";
        }
        return $status;
    }

    function CMS_card($serial, $pin, $amount, $type, $transId) {
        switch ($type) {
            case 'Viettel':
                $type_cms = "VTT";
                $url = "https://congthe.biz/apis/card/add";
                break;
            case 'Vinaphone':
                $type_cms = "VNP";
                $url = "https://congthe.biz/apis/card/add";
                break;
            case 'Mobifone':
                $type_cms = "VMS";
                $url = "https://congthe.biz/apis/card/add";
                break;
            case 'Vietnamobile':
                $type_cms = "VNM";
                $url = "https://congthe.biz/apis/card/add";
                break;
            case 'Gate':
                $type_cms = "GATE";
                $url = "https://congthe.biz/apis/card/add-game";
                break;
            case 'Zing':
                $type_cms = "ZING";
                $url = "https://congthe.biz/apis/card/add-game";
                break;
            case 'Garena':
                $type_cms = "GARENA";
                $url = "https://congthe.biz/apis/card/add-game";
                break;
            default:
                $type_cms = "VTT";
                $url = "https://congthe.biz/apis/card/add";
                break;
        }
        $postData = array(
            "client_token_api"=> "MWUyOGY0MzJiYjdhNDk4NjMyNGRkMjFhYTQyYzY2Y2I=",
            "client_code_request"=> "RVpf9W",
            "client_signature"=> md5("MWUyOGY0MzJiYjdhNDk4NjMyNGRkMjFhYTQyYzY2Y2I=" . "RVpf9W"),
            "client_code_card"=> $pin,
            "client_seri_card"=> $serial,
            "client_type_card"=> $type_cms,
            "client_value_card"=> $amount,
            "client_transaction_id"=> $transId,
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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

        return json_decode($response, true);
    }

    function tstprovn($serial, $pin, $amount, $type, $note) {
        $postData = array(
            "api_key"=> "CD24D7B86254BE22055C6F1EB5A8B045",
            "pin"=> $pin,
            "serial"=> $serial,
            "typecard"=> $type,
            "amount"=> $amount,
            "note"=> $note,
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://tstprovn.fun/api/card',
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

        return json_decode($response, true);
    }
?>