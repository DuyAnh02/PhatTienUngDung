
<!-- Begin Page Content -->
<div class="container-fluid custom-container">

<div>
<?php
    include("../../admin/controller/clsproductkh.php");
    $productkh = new Clsproductkh();
?>
            <!-- Spham-->
    <div class="sp-ban-chay row dataTables_wrapper dt-bootstrap4">
        <div class="col-md-8 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tất cả sản phẩm</h6>
                    <form method="GET" class="form-inline">
                        <input type="text" name="search" class="form-control mr-2" placeholder="Tìm sản phẩm..." />
                        <button type="submit" class="btn btn-primary">Tìm</button>
                    </form>
                </div>
                <div class="row justify-content-center">
                    <?php 
                    if(isset($_GET['search']))
                    {
                        $search = isset($_GET['search']) ? $_GET['search'] : '';
                        if (!empty($search)) 
                        {
                            $productkh->xuatproductkh("SELECT * FROM product WHERE name_product LIKE '%$search%' "); 
                        }
                        else
                        {
                            $productkh->xuatproductkh("SELECT * FROM product ");
                        }
                    }
                    else
                    {
                        $productkh->xuatproductkh("SELECT * FROM product ");
                    }
                        
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>