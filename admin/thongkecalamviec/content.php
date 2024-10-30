<!-- Begin Page Content -->
<div class="container-fluid">
<?php
    echo'Xin chào';
?>
<div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách ca làm việc</h6>
        <div class="ml-auto">
                 <!-- Thêm sản phẩm-->
            <form action="post">
            <label for="dishSelect">Chọn cửa hàng</label>
            <select id="dishSelect" name="dishSelect" required>
                <option value="">12 Nguyễn Văn Bảo</option>
                <option value="">16 Nguyễn Văn Bảo</option>
            </select><br>
            <label for="startDate">Ngày bắt đầu:</label>
            <input type="date" id="startDate" name="startDate" required><br><br>

            <!-- Chọn Ngày Kết Thúc -->
            <label for="endDate">Ngày kết thúc:</label>
            <input type="date" id="endDate" name="endDate" required><br><br>
  
            <input type="submit" value="Xác nhận" style="margin-left: auto"><br>
            <label for="dishSelect">Chọn nhân viên</label>
            <select id="dishSelect" name="dishSelect" required>
                <option value="">Nhân viên phục vụ</option>
                <option value="">Nhân viên bếp</option>
            </select>
            
            <input type="button" value="Xuất báo cáo" id="btnShowBlog" class="btn btn-primary">

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
                            <th>Mã nhân viên</th>
                            <th>Tên nhân viên</th>
                            <th>Số ngày làm</th>
                            <th>Số giờ làm</th>
                            <th>Số ngày nghỉ</th>
                            <th>Vi phạm</th>
                            <th>Xem chi tiết</th>
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