
<!-- Begin Page Content -->
<div class="container-fluid custom-container">

<div>
<?php
    include("../../admin/controller/clsproductkh.php");
    $productkh = new Clsproductkh();
?>

    <!-- sn ban chay -->
    <div class="sp-ban-chay row">
            <div class="col-md-8 mx-auto">
                <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Sản phẩm bán chạy</h6>
                        </div>
                        <div class="row justify-content-center">
                            <?php 
                                $productkh->xuatproductkh("SELECT * FROM product ORDER BY sold DESC LIMIT 6");
                            ?>
                        </div>
                    </div>
            </div>
    </div>


    <div class="quangcao row pb-2">
            <div class="col-md-8 mx-auto mb-2">
                <img src="../../img/88.jpg" alt="" style="width: 100%;">
            </div>
    </div>
            <!-- Spham-->
    <div class="sp-ban-chay row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ăn nhanh no lâu</h6>
                </div>
                <div class="row justify-content-center">
                    <?php 
                        $productkh->xuatproductkh("SELECT * FROM product ORDER BY price ASC LIMIT 6");
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="sp-ban-chay row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Bữa trưa dinh dưỡng</h6>
                </div>
                <div class="row justify-content-center">
                    <?php 
                        
                    ?>
                </div>
            </div>
        </div>
    </div>
    

    
   
</div>
<!-- /.container-fluid -->