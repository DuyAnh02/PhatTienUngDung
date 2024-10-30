<!-- Begin Page Content -->
<div class="container-fluid">
<?php
    echo'Xin chàoo';
?>
<div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Thống kê nguyên liệu</h6>
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
  
            <input type="submit" value="Xác nhận" style="margin-left: auto"><br><br>
            
            
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
                            <th>Tên nguyên liệu</th>
                            <th>Ngày</th>
                            <th>Số lượng nhập</th>
                            <th>Số lượng sử dụng</th>
                            <th>Số lượng tồn</th>
                            <th>Đơn vị tính</th>
                            
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