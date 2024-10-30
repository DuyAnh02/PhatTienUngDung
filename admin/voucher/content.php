<!-- Begin Page Content -->
<div class="container-fluid">
<?php
    echo'Xin chào';
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
                    <label for="tieude_blog">Mã voucher:</label>
                    <input type="text" id="tieude_blog" name="tieude_blog" required class="form-control" placeholder="Nhập mã voucher">
                </div>
                <div class="form-group">
                    <label for="giamon">Tên voucher</label>
                    <input type="text" id="giamon" name="giamon" required class="form-control" placeholder="Nhập tên voucher">
                </div>
                <div class="form-group">
                    <label for="nguyenlieu">Mức ưu đãi</label>
                    <input type="text" id="nguyenlieu" name="nguyenlieu" required class="form-control" placeholder="Chọn mức ưu đãi">
                </div>
                <div class="form-group">
                    <label for="noidung_blog">Thời gian:</label>
                    <label for="startDate">Ngày bắt đầu:</label>
                <input type="date" id="startDate" name="startDate" required><br><br>

                <!-- Chọn Ngày Kết Thúc -->
                <label for="endDate">Ngày kết thúc:</label>
                <input type="date" id="endDate" name="endDate" required><br><br>
  
                <input type="submit" value="Xác nhận" style="margin-left: auto"><br><br>
                </div>
                
                </div>
                    
                </tbody>
            </table>
            <input type="submit" name="btn" value="Lưu món ăn" class="btn btn-primary">
        </form>
    </div>
</div>


    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách voucher</h6>
        <div class="ml-auto">
                 <!-- Thêm sản phẩm-->
            <form action="post">
                <input type="button" value="Thêm voucher" id="btnShowBlog" class="btn btn-primary">
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
                            <th>ID</th>
                            <th>Tên khuyến mãi</th>
                            <th>Trạng thái</th>
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