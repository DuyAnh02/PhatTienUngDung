<?php
include("connect.php");

// Hàm hiển thị form nhập ngày mua
function hienThiFormNgayMua() {
    echo '<div class="container mt-5">';
    echo '<h3 class="mb-4">Tính toán nguyên vật liệu</h3>';
    echo '<form action="" method="POST">';
    echo '<div class="form-group">';
    echo '<label for="ngay_mua">Ngày mua:</label>';
    echo '<input type="date" name="ngay_mua" class="form-control" required>';
    echo '</div>';
    echo '<button type="submit" class="btn btn-primary">Tiếp theo</button>';
    echo '<a href="index.php" class="btn btn-danger ml-2">Thoát</a>';
    echo '</form>';
    echo '</div>';
}

// Hàm xử lý form nhập ngày mua và hiển thị danh sách món ăn
function hienThiDanhSachMonAn($ngay_mua) {
    $db = new ConnectD();
    $conn = $db->connect();

    $sql = "SELECT * FROM mon_an";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        echo '<div class="container mt-5">';
        echo '<h3 class="mb-4">Danh sách món ăn</h3>';
        echo '<form action="" method="POST">';
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>Tên món ăn</th><th>Số lượng</th></tr></thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['ten_mon']}</td>
                    <td><input type='number' name='so_luong[{$row['id']}]' value='0' class='form-control'></td>
                  </tr>";
        }

        echo '</tbody></table>';
        echo '<input type="hidden" name="ngay_mua" value="' . $ngay_mua . '">';
        echo '<button type="submit" class="btn btn-success">Xác nhận</button>';
        echo '</form>';
        echo '</div>';
    } else {
        echo '<p>Không có món ăn nào trong hệ thống.</p>';
    }

    mysqli_close($conn);
}

// Hàm xử lý lưu dữ liệu vào bảng nguyên vật liệu// Hàm xử lý lưu dữ liệu vào bảng nguyên vật liệu
function luuNguyenVatLieu($ngay_mua, $so_luong) {
    $db = new ConnectD();
    $conn = $db->connect();

    $success = true;
    foreach ($so_luong as $id_mon_an => $quantity) {
        if ($quantity > 0) {
            // Lấy thông tin món ăn
            $sql_get_mon_an = "SELECT * FROM mon_an WHERE id = {$id_mon_an}";
            $result_get = mysqli_query($conn, $sql_get_mon_an);
            $row = mysqli_fetch_assoc($result_get);
            $ten_mon = $row['ten_mon'];

            // Lưu vào bảng `nguyen_vat_lieu`
            $sql_insert = "INSERT INTO nguyen_vat_lieu (ten_mon, ngay_mua, so_luong) 
                           VALUES ('{$ten_mon}', '{$ngay_mua}', '{$quantity}')";

            if (!mysqli_query($conn, $sql_insert)) {
                $success = false;  // Nếu có lỗi trong quá trình lưu
                echo "<div class='alert alert-danger'>Lỗi khi lưu dữ liệu: " . mysqli_error($conn) . "</div>";
            }
        }
    }

    mysqli_close($conn);

    // Nếu lưu thành công, thông báo và cung cấp liên kết đến danh sách nguyên vật liệu
    if ($success) {
        echo "<div class='alert alert-success'>Thêm thành công.</div>";
        echo "<a class='btn btn-primary' href='../nguyenvatlieu/danhsachnl.php'>Danh sách nguyên vật liệu</a>";
        exit; // Dừng script để tránh thực thi thêm mã nào nữa
    }

    return $success;
}


// Hàm hiển thị bảng nguyên vật liệu
function hienThiBangNguyenVatLieu($ngay_mua, $so_luong) {
    $db = new ConnectD();
    $conn = $db->connect();

    echo '<div class="container mt-5">';
    echo '<h3 class="mb-4">Bảng nguyên vật liệu cần mua</h3>';
    echo '<table class="table table-bordered">';
    echo '<thead><tr><th>Tên món ăn</th><th>Ngày mua</th><th>Số lượng cần mua</th></tr></thead>';
    echo '<tbody>';

    foreach ($so_luong as $id_mon_an => $quantity) {
        if ($quantity > 0) {
            $sql_get_mon_an = "SELECT * FROM mon_an WHERE id = {$id_mon_an}";
            $result_get = mysqli_query($conn, $sql_get_mon_an);
            $row = mysqli_fetch_assoc($result_get);
            echo "<tr>
                    <td>{$row['ten_mon']}</td>
                    <td>{$ngay_mua}</td>
                    <td>{$quantity}</td>
                  </tr>";
        }
    }

    echo '</tbody></table>';
    echo '<a href="index.php" class="btn btn-danger">Hủy</a>';
    echo '<button type="button" class="btn btn-success">Thanh toán</button>';
    echo '</div>';

    mysqli_close($conn);
}

// Kiểm tra dữ liệu POST và xử lý lưu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ngay_mua']) && isset($_POST['so_luong'])) {
        $ngay_mua = $_POST['ngay_mua'];
        $so_luong = $_POST['so_luong'];

        // Kiểm tra xem mảng so_luong có giá trị hợp lệ hay không
        $has_valid_quantity = false;
        foreach ($so_luong as $quantity) {
            if ($quantity > 0) {
                $has_valid_quantity = true;
                break;
            }
        }

        if (!$has_valid_quantity) {
            echo '<div class="alert alert-warning">Vui lòng nhập số lượng cho ít nhất một món ăn.</div>';
            return;
        }

        $db = new ConnectD();
        $conn = $db->connect();

        // Thực hiện lưu dữ liệu
        $success = luuNguyenVatLieu($ngay_mua, $so_luong);

        if ($success) {
            echo '<div class="alert alert-success">Dữ liệu đã được lưu thành công.</div>';
        } else {
            echo '<div class="alert alert-danger">Có lỗi trong quá trình lưu dữ liệu.</div>';
        }

        mysqli_close($conn);
    }
}

// Hàm hiển thị danh sách nguyên vật liệu đã mua
function hienThiDanhSachNguyenVatLieu() {
    $db = new ConnectD();
    $conn = $db->connect();

    $sql = "SELECT * FROM nguyen_vat_lieu";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        echo '<div class="container mt-5">';
        echo '<h3 class="mb-4">Danh sách nguyên vật liệu đã mua</h3>';
        echo '<table class="table table-bordered">';
        echo '<thead><tr><th>ID</th><th>Tên món ăn</th><th>Ngày mua</th><th>Số lượng</th></tr></thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['ten_mon']}</td>
                    <td>{$row['ngay_mua']}</td>
                    <td>{$row['so_luong']}</td>
                  </tr>";
        }

        echo '</tbody></table>';
        echo '</div>';
    } else {
        echo '<p>Chưa có nguyên vật liệu nào được mua.</p>';
    }

    mysqli_close($conn);
}

?>
