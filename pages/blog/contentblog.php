
<!-- Begin Page Content -->
<div class="container-fluid custom-container">

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
                            <h6 class="m-0 font-weight-bold text-primary">Tất cả bài viết</h6>
                        </div>
                        <div>
                        <?php 
                            $productkh->xuatblogkh("SELECT * FROM blog LIMIT 5");
                        ?>
                        </div>
            </div>
        </div>
    </div>   
</div>
<!-- /.container-fluid -->