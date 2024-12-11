<!-- Begin Page Content -->
<div class="container-fluid">
    <?php include("../controller/qlnv.php"); ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý nhân viên</h1>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tất cả nhân viên</h6>
            <!-- <a href="add_employee.php" class="btn btn-sm btn-primary shadow-sm">Thêm nhân viên</a> -->
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên đăng nhập</th>
                            <th>Mật khẩu</th>
                            <th>Họ và tên</th>
                            <th>Chức vụ</th>
                            <th>Ngày làm việc</th>
                            <th>Số điện thoại</th>
                            <th>Tùy chọn</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        <?php showEmployeeList(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Content -->
