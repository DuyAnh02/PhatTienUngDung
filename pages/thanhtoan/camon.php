<?php
session_start();
include_once("../../admin/controller/clsproduct.php");

$order = new Clsproduct();

$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; // Put your secret key in there

$result = ''; // Initialize the result variable

if (!empty($_GET)) {
    $partnerCode = $_GET["partnerCode"];
    $orderId = $_GET["orderId"];
    $message = $_GET["message"];
    $transId = $_GET["transId"];
    $orderInfo = utf8_encode($_GET["orderInfo"]);
    $amount = $_GET["amount"];
    $responseTime = $_GET["responseTime"];
    $requestId = $_GET["requestId"];
    $extraData = $_GET["extraData"];
    $payType = $_GET["payType"];
    $orderType = $_GET["orderType"];
    $m2signature = $_GET["signature"]; // MoMo signature

    // Checksum
    $rawHash = "partnerCode=" . $partnerCode . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
        "&orderType=" . $orderType . "&transId=" . $transId . "&message=" . $message . "&responseTime=" . $responseTime .
        "&payType=" . $payType . "&extraData=" . $extraData;

    $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);

        if ($message == 'Successful.') {
            // Process the order if payment is successful

                $order_id = $orderId;
                $order_price = $amount;
                $name = $_SESSION['name_cus'];
                $phone = $_SESSION['phone_cus'];
                $address = $_SESSION['address'];
                $trangthai = 'Chờ xử lý';
                $thanhtoan = 'Đã thanh toán'; 
                $order_date = date('Y-m-d H:i:s'); 
                unset($_SESSION['cart']);
                
                // Insert order into database
                if ($order->ade("INSERT INTO `order_cus` (`order_id`, `order_price`, `name_order`, `phone_order`, `trangthai`, `thanhtoan`, `address`, `order_date`) VALUES ('$order_id', $order_price, '$name', '$phone', '$trangthai', '$thanhtoan', '$address', '$order_date')") == 1) {
                    echo '<script>
                        alert("Đặt hàng thành công!");
                        setTimeout(function() {
                            window.location = "../giohang/"; // Redirect after 2 seconds
                        }, 100);
                    </script>';
                    exit();
                } else {
                    echo '<script>
                        alert("Đặt hàng thất bại!");
                        setTimeout(function() {
                            window.location = "../giohang/";
                        }, 100);
                    </script>';
                    exit();
                }
     
    } else {
        $result = '<div class="alert alert-danger">This transaction could be hacked, please check your signature and returned signature</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MoMo Sandbox</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Kết quả thanh toán</h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $result; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="fxRate" class="col-form-label">PartnerCode</label>
                                <input type='text' name="partnerCode" value="<?php echo $partnerCode; ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="fxRate" class="col-form-label">OrderId</label>
                                <input type='text' name="orderId" value="<?php echo $orderId; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="fxRate" class="col-form-label">TransId</label>
                                <input type='text' name="transId" value="<?php echo $transId; ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="fxRate" class="col-form-label">OrderInfo</label>
                                <input type='text' name="orderInfo" value="<?php echo $orderInfo; ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="fxRate" class="col-form-label">OrderType</label>
                                <input type='text' name="orderType" value="<?php echo $orderType; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="fxRate" class="col-form-label">Amount</label>
                                <input type='text' name="amount" value="<?php echo $amount; ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="fxRate" class="col-form-label">Message</label>
                                <input type='text' name="message" value="<?php echo $message; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="fxRate" class="col-form-label">PayType</label>
                                <input type='text' name="payType" value="<?php echo $payType; ?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="fxRate" class="col-form-label">Signature</label>
                                <input type='text' name="signature" value="<?php echo $m2signature; ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="/" class="btn btn-primary">Back to continue payment...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
