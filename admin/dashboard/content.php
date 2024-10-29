<!-- Begin Page Content -->
<div class="container-fluid">
<?php
    echo'kietpro';
?>
<div class="card shadow mb-4">

<div class="container-add" id="popupFormBlog" >
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Nhập thông tin món ăn</h6>
        <div class="ml-auto">
            <input type="button" value="Đóng" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" id="btn" onclick="closeForm()" style="background-color: red;">
        </div>
    </div>    

    <div class="card-body">
        <form action="" enctype="multipart/form-data" name="formBlog" id="popupFormBlog" class="popup-form-blog" method="post">
            <table class="styletb">
                <tbody>
                <div class="form-group">
                    <label for="tieude_blog">Tên món ăn:</label>
                    <input type="text" id="tieude_blog" name="tieude_blog" required class="form-control" placeholder="Nhập tên món ăn">
                </div>
                <div class="form-group">
                    <label for="noidung_blog">Quy trình chế biến:</label>
                    <textarea id="noidung_blog" name="noidung_blog" rows="5" required class="form-control" placeholder="Nhập quy trình chế biến"></textarea>
                </div>
                    <tr>
                        <td><label for="anh1_blog">Hình ảnh 1:</label></td>
                        <td><input type="file" id="anh1_blog" name="anh1_blog"><br></td>
                    </tr>
                    <tr>
                        <td><label for="anh2_blog">Hình ảnh 2:</label></td>
                        <td><input type="file" id="anh2_blog" name="anh2_blog"><br></td>
                    </tr>
                    <tr>
                        <td><label for="anh3_blog">Hình ảnh 3:</label></td>
                        <td><input type="file" id="anh3_blog" name="anh3_blog"><br></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" name="btn" value="Lưu món ăn" class="btn btn-primary">
        </form>
    </div>
</div>


    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách món ăn</h6>
        <div class="ml-auto">
                 <!-- Thêm sản phẩm-->
            <form action="post">
                <input type="button" value="Thêm món ăn" id="btnShowBlog" class="btn btn-primary">
            </form>    
            <script>
            var btnShowBlog = document.getElementById("btnShowBlog");
            var popupFormBlog = document.getElementById("popupFormBlog");

            function openPopup(popup) {
                popup.style.display = "block";
            }

            function closeForm() {
                popupFormBlog.style.display = "none";
                location.reload();
            }

            btnShowBlog.onclick = function() {
                openPopup(popupFormBlog);
            };
            </script>
        </div>
    </div>

    <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên món ăn</th>
                            <th>Trạng thái</th>
                            <th>Ảnh</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>

                    <!--
                         <tfoot>
                               <tr>
                                  <th>ID</th>
                                  <th>Tiêu đề</th>
                                  <th>Nội dung</th>
                                  <th>Ảnh 1</th>
                                  <th>Tùy chọn</th>
                              </tr>
                         </tfoot>
                    -->

                    <tbody>         
                    <?php 
                       /*
                             $product->listblog("SELECT * FROM blog");
                             if (isset($_GET['message'])) {
                             echo '<div>' . htmlspecialchars($_GET['message']) . '</div>';
                             }
                       */
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
</div>
<!-- /.container-fluid -->