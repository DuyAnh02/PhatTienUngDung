<!-- Begin Page Content -->
<div class="container-fluid">
<?php
    include("../controller/clsproduct.php");
    $product = new Clsproduct();
?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách sản phẩm</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

            
            <div class="container-add" id="popupForm1">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Nhập thông tin sản phẩm</h6>
                    <div class="ml-auto">
                        <input type="button" value="Đóng" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" id="btn" onclick="closeForm()" style="background-color: red;">
                    </div>
                </div>    

                <div class="card-body">
                    <form action="" enctype="multipart/form-data" name="form1" id="popupForm1" class="popup-form1" method="post" display="">
                    <table class="styletb">
                        <tbody>
                        <tr>
                                <td ><label for="name_product">Tên sản phẩm:</label></td>
                                <td ><input type="text" id="name_product" name="name_product" ><br></td>
                            </tr>
                            
                            <tr>
                                <td><label for="category">Danh mục:</label></td>
                                <td >   
                                    <?php 
                                        $product->category();
                                    ?>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td ><label for="quantity">Số lượng:</label></td>
                                <td><input type="number" id="quantity" name="quantity" ><br></td>
                            </tr>
                            
                            <tr>
                                <td ><label for="price_discount">Giá:</label></td>
                                <td ><input type="number" id="price_discount" name="price_discount"><br></td>
                            </tr>
                            <tr>
                                <td><label for="img_product">Hình ảnh:</label></td>
                                <td><input type="file" id="img_product" name="img_product"><br></td>
                            </tr>
                            
                             
                            </tr>
                        </tbody>
                        </table>
                        <div class="form-cusac" id="popupForm_cusac" style="display: none;">
                        <table class="styletb">
                                <tr>
                                    <td width="20%"><label for="ket_noi">Kết nối:</label></td>
                                    <td width="80%"><textarea id="ket_noi" name="ket_noi"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="pin_sac">Pin & Sạc:</label></td>
                                    <td width="80%"><textarea id="pin_sac" name="pin_sac"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="tien_ich">Tiện ích:</label></td>
                                    <td width="80%"><textarea id="tien_ich" name="tien_ich"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="thong_tin_chung">Thông tin chung:</label></td>
                                    <td width="80%"><textarea id="thong_tin_chung" name="thong_tin_chung"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="img_mota">Hình ảnh mô tả:</label></td>
                                    <td width="80%"><input type="file" id="img_mota" name="img_mota"><br></td>
                                    <td width="20% " ><input type="submit" value="Lưu sản phẩm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" name="btn" id="btn"></td>
                                </tr>
                            </table>
                        </div>

                        <div class="form-dienthoai" id="popupForm_dienthoai" style="display: none;">
                            <table class="styletb">
                                <tr>
                                    <td width="20%"><label for="man_hinh">Màn hình:</label></td>
                                    <td width="80%"><textarea id="man_hinh" name="man_hinh"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="camera_sau">Camera sau:</label></td>
                                    <td width="80%"><textarea id="camera_sau" name="camera_sau"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="camera_truoc">Camera trước:</label></td>
                                    <td width="80%"><textarea id="camera_truoc" name="camera_truoc"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="he_dieu_hanh_cpu">Hệ điều hành & CPU:</label></td>
                                    <td width="80%"><textarea id="he_dieu_hanh_cpu" name="he_dieu_hanh_cpu"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="bo_nho_luu_tru">Bộ nhớ lưu trữ:</label></td>
                                    <td width="80%"><textarea id="bo_nho_luu_tru" name="bo_nho_luu_tru"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="ket_noi">Kết nối:</label></td>
                                    <td width="80%"><textarea id="ket_noi" name="ket_noi"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="pin_sac">Pin & Sạc:</label></td>
                                    <td width="80%"><textarea id="pin_sac" name="pin_sac"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="tien_ich">Tiện ích:</label></td>
                                    <td width="80%"><textarea id="tien_ich" name="tien_ich"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="thong_tin_chung">Thông tin chung:</label></td>
                                    <td width="80%"><textarea id="thong_tin_chung" name="thong_tin_chung"  rows="5" style="width: 100%;"></textarea><br></td>
                                </tr>
                                <tr>
                                    <td width="20%"><label for="img_mota">Hình ảnh mô tả:</label></td>
                                    <td width="80%"><input type="file" id="img_mota" name="img_mota"><br></td>
                                    <td width="20% " ><input type="submit" value="Lưu sản phẩm" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" name="btn" id="btn"></td>
                                </tr>
                            </table>
                        </div>
                    </form> 
                </div>
            
    </div>


        <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tất cả sản phẩm</h6>
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
                            <th>ID</th>
                            <th>Tên voucher</th>
                            
                            <th>Mã voucher</th>
                            
                            <th>Số lượng</th>
                            
                            <th>Tùy Chọn</th>
                        </tr>
                    </thead>

                    

                    <tbody>         
                    <?php 
                        require("xuatproduct.php");
                        if (isset($_GET['message'])) {
                            echo '<div>' . htmlspecialchars($_GET['message']) . '</div>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Content Row -->
   
</div>
<!-- /.container-fluid -->