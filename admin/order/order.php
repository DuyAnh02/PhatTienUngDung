<!-- Begin Page Content -->
<div class="container-fluid">
<?php
    include("../controller/clsproduct.php");
    $product = new Clsproduct();
?>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Tất cả đơn hàng</h6>
        <div class="ml-auto">
                <!-- Thêm sản phẩm-->
            <form action="post">
                <input type="button" id="btnShow" value="Thêm sản phẩm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> 
            </form>
               
        </div>
    </div>
    <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Đơn giá</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo đơn</th>
                            <th>Địa chỉ</th>
                            <th>Thanh toán</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>ID Đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Nội dung</th>
                            <th>Đơn giá</th>
                            <th>Trạng thái</th>
                            <th>Địa chỉ</th>
                            <th>Thanh toán</th>
                        </tr>
                    </tfoot>

                    <tbody>         
                    <?php 
                        $product->qlorder("SELECT * FROM order_cus");
                        if (isset($_GET['message'])) {
                            echo '<div>' . htmlspecialchars($_GET['message']) . '</div>';
                        }
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if (isset($_POST['trangthai']) || isset($_POST['thanhtoan'])) {
                                $order_id = $_POST['order_id'];
                                if (isset($_POST['trangthai'])) {
                                    $trangthai = $_POST['trangthai'];
                                    if($product->ade("UPDATE order_cus SET trangthai='$trangthai' WHERE order_id='$order_id'"))
                                    {
                                        echo '<script>
                                        alert("Cập nhật thành công trạng thái");
                                        setTimeout(function() {
                                            window.location = "../order/"; // Chuyển hướng sau 2 giây
                                            }, 100); // Thời gian delay là 500ms
                                        </script>';
                                        exit();
                                    }
                                }
                        
                                if (isset($_POST['thanhtoan'])) {
                                    $thanhtoan = $_POST['thanhtoan'];
                                    if($product->ade("UPDATE order_cus SET thanhtoan='$thanhtoan' WHERE order_id='$order_id'"))
                                    {
                                        echo '<script>
                                        alert("Cập nhật thành công thanh toán");
                                        setTimeout(function() {
                                            window.location = "../order/"; // Chuyển hướng sau 2 giây
                                            }, 100); // Thời gian delay là 500ms
                                        </script>';
                                        exit();
                                    }
                                    
                                }
                            }
                        }
                        
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
</div>
<!-- /.container-fluid -->