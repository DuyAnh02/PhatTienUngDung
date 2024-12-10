<?php 

if(isset($_POST['order']) && $_POST['order'] === 'Xác nhận đặt hàng')
{
    $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : ''; 
    $order_price = isset($_POST['order_price']) ? $_POST['order_price'] : 0; 
    $name = isset($_POST['name']) ? $_POST['name'] : ''; 
    $phone = isset($_POST['phone']) ? $_POST['phone'] : ''; 
    $address = isset($_POST['address']) ? $_POST['address'] : ''; 
    $trangthai = 'Chờ xử lý'; 
    $thanhtoan = 'Chưa thanh toán'; 
    $order_date = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại
    unset($_SESSION['cart']);
    if($order->ade("INSERT INTO `order_cus` (`order_id`, `order_price`, `name_order`, `phone_order`, `trangthai`, `thanhtoan`, `address`, `order_date`) VALUES ('$order_id', $order_price, '$name', '$phone', '$trangthai', '$thanhtoan', '$address', '$order_date')")==1)
    {   
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        echo '<script>
            alert("Đặt hàng thành công!");
            setTimeout(function() {
                window.location = "../giohang/"; // Chuyển hướng sau 2 giây
                }, 100); // Thời gian delay là 500ms
            </script>';
            exit();
    }
    else
    {
        echo '<script>
        alert("Đặt hàng thất bại!");
        setTimeout(function() {
                window.location = "../giohang/"; // Chuyển hướng sau 2 giây
                }, 100); // Thời gian delay là 500ms
        </script>';
        exit();
    }

}

?>