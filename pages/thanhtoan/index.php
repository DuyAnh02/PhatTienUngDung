<?php 
session_start();
function execPostRequest($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $_SESSION['sum_price']; // Sử dụng tổng tiền trong giỏ hàng
        $orderId = "ORD-".time()."-".$_SESSION['phone_cus'];
        $redirectUrl = "http://localhost:8077/SOP/pages/thanhtoan/camon.php";
        $ipnUrl = "http://localhost:8077/SOP/pages/thanhtoan/camon.php";

        // Tạo chữ ký
        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey={$accessKey}&amount={$amount}&extraData=&ipnUrl={$ipnUrl}&orderId={$orderId}&orderInfo={$orderInfo}&partnerCode={$partnerCode}&redirectUrl={$redirectUrl}&requestId={$requestId}&requestType={$requestType}";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        // Dữ liệu gửi đi
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => '',
            'requestType' => $requestType,
            'signature' => $signature
        );

        // Gửi yêu cầu đến MoMo
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        // Kiểm tra kết quả trả về
        if (isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            exit();
        } else {
            $errorMsg = isset($jsonResult['message']) ? $jsonResult['message'] : 'Không có thông điệp lỗi';
            echo '<script>alert("Lỗi khi nhận URL thanh toán: ' . $errorMsg . '");</script>';
        }

?>