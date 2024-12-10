
<!-- Begin Page Content -->
<div class="container-fluid custom-container">

<?php
    include("../../admin/controller/clsproductkh.php");
    $productkh = new Clsproductkh();
?>
            <!-- Spham-->
            <div class="sp row">
    <div class="col-md-8 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin sản phẩm</h6>
            </div>
            <?php 
                isset($_GET['id']);
                $id_product = $_GET['id'];
                $productkh->chitietsanpham("SELECT * FROM product WHERE id_product = '$id_product' limit 1");
                $productkh->thongso("SELECT * FROM product_details_dt WHERE id_product = '$id_product' limit 1");
            ?>
            <?php
    
            if(!isset($_SESSION['cart'])) $_SESSION['cart']=[];

            if(isset($_POST['btn-addcart'])&&($_POST['btn-addcart'])==='Thêm vào giỏ hàng')
            {
                $name_product=$_POST['name_product'];
                $img_product=$_POST['img_product'];
                $price_discount=$_POST['price_discount'];
                $id_product=$_POST['id_product'];
                $cart = [$name_product,$img_product,$price_discount];
                $_SESSION['cart'][] = $cart;
                echo '<script>alert("Thêm sản phẩm vào giỏ hàng thành công!");
                        setTimeout(function() {
                        window.location = "../giohang/"; // Chuyển hướng sau 2 giây
                        }, 100);</script>';
            }

        ?>
        </div>
    </div>
</div>
</div>



