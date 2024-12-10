                <?php 
                error_reporting(0);
                session_start();
                if(isset($_SESSION['khdn'])==1)
                {
                    $name = 'Xin chào '.$_SESSION['name_cus'];
                    $phone_cus = $_SESSION['phone_cus'];
                    $name_cus = $_SESSION['name_cus'];
                }
                else 
                {
                    $name = null;
                }
                ?>
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-primary topbar static-top ">
                     
                <!-- Topbar Navbar -->
                <div class="navbar-nav ml-auto">
                    <div class="nav-link text-white mr"><strong><?php echo $name ?></strong></div>
                </div>
                    <div class="navbar-nav mr-auto">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="../trangchu/login">Đăng nhập</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="../trangchu/logout.php">Đăng xuất</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-item nav-link text-white" href="../giohang">
                                    <i class="fas fa-shopping-cart fa-sm text-white mr-1"></i>
                                    Giỏ hàng
                                    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): echo '<span class="badge bg-danger ml-1">!</span>'; ?>
                                    <?php endif; ?>
                                    <!--<span class="badge bg-danger ml-1">!</span> -->
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End of Topbar -->
                  <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc muốn đăng xuất</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Ấn vào đăng xuất để xác nhận</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                            <a class="btn btn-primary" href="../../admin/login.html">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--nav bot-->
                <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top ">
                    <div class="collapse navbar-collapse justify-content-center">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active text-white" href="../trangchu/">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="../sanpham">Sản phẩm</a>
                            </li>
                            <li class="nav-item text-white">
                                <a class="nav-link text-white" href="#">Phụ kiện</a>
                            </li>
                            <li class="nav-item text-white">
                                <a class="nav-link text-white" href="../blog">Blog</a>
                            </li>
                            <li class="nav-item text-white">
                                <a class="nav-link text-white" href="#">Giới thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </nav>

            