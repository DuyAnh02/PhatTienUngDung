<?php 
ob_start();

//include "../thanhtoan/PaymentMomoClass.php";
//$paymentMomo = new payment;
include_once("../../admin/controller/clsproduct.php");

$order = new Clsproduct();
$_SESSION['sum_price']=0;
$_SESSION['sum_card']=0;
function showcart() {
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            $_SESSION['sum_price'] += $item[2];
            echo '<tr>
                <td>' . ($index + 1) . '</td>
                <td><img src="../../img/' . $item[1] . '" alt="" width="30px" height="30px"></td>
                <td>' . $item[0] . '</td>
                <td>' . number_format($item[2], 0, ',', '.') . ' VNĐ</td>
                <td>
                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="item_index" value="' . $index . '">
                        <input type="submit" name="btn-delete" value="Xóa" class="btn btn-danger btn-sm">
                    </form>
                </td>
            </tr>';
        }
        echo '<tfoot>
            <tr>
                <th colspan="4"><div>Tổng tiền</div></th>
                <th>' . number_format($_SESSION['sum_price'], 0, ',', '.') . ' VNĐ</th>
            </tr>
        </tfoot>';
        
    } else {
        
    }
}

// Xử lý xóa sản phẩm trong giỏ hàng
if (isset($_POST['btn-delete'])) {
    $item_index = $_POST['item_index'];
    if (isset($_SESSION['cart'][$item_index])) {
        unset($_SESSION['cart'][$item_index]); 
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        echo '<script>alert("Sản phẩm đã được xóa khỏi giỏ hàng.");</script>';
    }
}

// Kiểm tra khi nhấn nút "đặt hàng online"
if (isset($_POST['btn-buy'])) {
    if (!isset($_SESSION['khdn']) || $_SESSION['khdn'] !== 1) {
        echo '<script>window.onload = function() { showLoginModal(); };</script>';
    } else {
        // Hiển thị popup nhập thông tin thanh toán
        echo '<script>window.onload = function() { showPaymentPopup(); };</script>';
    }
}

if(isset($_POST['momo-payment']))
{
    $_SESSION['address']=$_POST['address'];
    if (!isset($_SESSION['khdn']) || $_SESSION['khdn'] !== 1) {
        echo '<script>
            alert("a!");
            setTimeout(function() {
                window.location = "../thanhtoan/"; // Chuyển hướng sau 2 giây
                }, 100); // Thời gian delay là 500ms
            </script>';
    } else {
        // Hiển thị popup nhập thông tin thanh toán
        echo '<script>
                window.location = "../thanhtoan/";    
            </script>';
    }
}
?>



<!-- Begin Page Content -->
<div class="container-fluid d-flex justify-content-center">
    <div class="card shadow mb-4" style="width: 60%;">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Giỏ hàng của bạn</h6>
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <form action="" method="post">
                    <input class="btn btn-success" type="submit" name="btn-buy" id="btn-buy" value="Đặt hàng online">
                </form>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Số thứ tự</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Giá tiền</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php showcart(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid d-flex justify-content-center mt-4">
    <div class="card shadow mb-4" style="width: 60%;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Đơn hàng của bạn</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="orderTable" width="100%" cellspacing="0">
                    <tbody>
                        <?php 
                            $phone_cus = $_SESSION['phone_cus'];
                            $order->xuatorder("SELECT * FROM `order_cus` WHERE `phone_order` = '$phone_cus'");
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Đăng Nhập -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bạn phải đăng nhập để đặt hàng</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Bạn cần đăng nhập để tiếp tục.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                <a class="btn btn-primary" href="../trangchu/login/">Đăng nhập</a>
            </div>
        </div>
    </div>
</div>

<!-- Popup Nhập Thông Tin Thanh Toán -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Nhập thông tin thanh toán</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Họ và tên:</label>
                        <input type="text" id="name" name="name" required class="form-control" placeholder="Nhập họ và tên" value="<?php echo $_SESSION['name_cus'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="tel" id="phone" name="phone" required class="form-control" placeholder="Nhập số điện thoại" value="<?php echo $_SESSION['phone_cus'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ giao hàng:</label>
                        <input type="text" id="address" name="address" required class="form-control" placeholder="Nhập địa chỉ giao hàng">
                    </div>
                    <div class="form-group">
                        <label for="address">Tổng tiền:</label>
                        <input type="text" id="order_price" name="order_price" required class="form-control" placeholder="Nhập địa chỉ giao hàng" value="<?php echo $_SESSION['sum_price'] ?>">
                    </div>
                        <input type="hidden" name="order_price" value="<?php echo $_SESSION['sum_price'] ?>">
                        <input type="hidden" name="order_id" value="ORD-<?php echo time().'-'.$_SESSION['phone_cus'] ?>">
                    <input type="submit" style="background-color: #a00061;" name="momo-payment" value="Thanh toán momo" class="btn btn-primary">
                    <?php 
   
                        //if (isset($_POST['momo-payment']) && $_POST['momo-payment']) 
                        //{
                            //header('location:../thanhtoan/');
                            // $order_id = $_POST['order_id'];
                            //$order_price = $_POST['order_price'];
                            // $paymentMomo->payment_momo($order_id,$order_price);
                        //}
                    ?>
                        <input type="submit" id="order"  name="order" value="Xác nhận đặt hàng" class="btn btn-primary">  
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function showLoginModal() {
    $('#loginModal').modal('show'); // Hiển thị modal đăng nhập
}

function showPaymentPopup() {
    $('#paymentModal').modal('show'); // Hiển thị popup thanh toán
}
</script>

<?php
ob_end_flush(); // Kết thúc bộ đệm đầu ra
?>
