<?php
// Kết nối cơ sở dữ liệu
include("connect.php");

// Lấy thông tin khách hàng từ bảng khachhang
function hienThiDanhSachKhachHang($search_term = '') {
    $db = new ConnectD();
    $conn = $db->connect();
    
    $sql = "SELECT * FROM khachhang";
    
    // Nếu có từ khóa tìm kiếm, thêm điều kiện vào truy vấn
    if ($search_term != '') {
        $sql .= " WHERE name_cus LIKE '%{$search_term}%' OR id LIKE '%{$search_term}%'";
    }
    
    $result = mysqli_query($conn, $sql);

    echo '<div class="container mt-5">';
    echo '<h3 class="mb-4">Danh sách khách hàng</h3>';
    echo '<form action="" method="GET">';
    echo '<div class="form-group">';
    echo '<label for="search">Tìm kiếm khách hàng (Mã hoặc Tên):</label>';
    echo '<input type="text" name="search" class="form-control" value="' . htmlspecialchars($search_term) . '" placeholder="Nhập mã hoặc tên khách hàng">';
    echo '</div>';
    echo '<button type="submit" class="btn btn-primary">Tìm kiếm</button>';
    echo '</form>';
    
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-bordered mt-4">';
        echo '<thead><tr><th>Mã khách hàng</th><th>Tên khách hàng</th><th>Địa chỉ</th><th>Hành động</th></tr></thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name_cus']}</td>
                    <td>{$row['address_cus']}</td>
                    <td>
                        <a href='?id={$row['id']}' class='btn btn-info'>Xem thông tin</a>
                    </td>
                  </tr>";
        }

        echo '</tbody></table>';
    } else {
        echo '<p>Không có khách hàng nào.</p>';
    }

    echo '</div>';
    mysqli_close($conn);
}

// Hàm xem thông tin chi tiết khách hàng
function xemThongTinKhachHang($id) {
    $db = new ConnectD();
    $conn = $db->connect();

    // Lấy thông tin chi tiết khách hàng
    $sql_khachhang = "SELECT * FROM khachhang WHERE id = {$id}";
    $result_khachhang = mysqli_query($conn, $sql_khachhang);
    $khachhang = mysqli_fetch_assoc($result_khachhang);

    // Lấy thông tin đơn hàng của khách hàng
    $sql_donhang = "SELECT * FROM order_cus WHERE id_khachhang = {$id}";
    $result_donhang = mysqli_query($conn, $sql_donhang);

    // Thêm lớp CSS cho phần hiển thị thông tin khách hàng
    echo '<div class="container" style="padding-left: 20px; padding-right: 20px;">'; // Thêm padding 20px vào 2 bên
    echo "<h5>Mã khách hàng: {$khachhang['id']}</h5>";
    echo "<p>Tên khách hàng: {$khachhang['name_cus']}</p>";
    echo "<p>Địa chỉ: {$khachhang['address_cus']}</p>";

    // Hiển thị thông tin đơn hàng
    echo '<h6>Lịch sử đơn hàng</h6>';
    echo '<table class="table table-bordered mt-2">';
    echo '<thead><tr><th>Mã đơn hàng</th><th>Giá đơn hàng</th><th>Số điện thoại</th><th>Ngày đặt hàng</th></tr></thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($result_donhang)) {
        echo "<tr>
                <td>{$row['order_id']}</td>
                <td>{$row['order_price']}</td>
                <td>{$row['phone_order']}</td>
                <td>{$row['order_date']}</td>
              </tr>";
    }

    echo '</tbody></table>';
    echo '</div>';
    mysqli_close($conn);
}

// Kiểm tra nếu có ID khách hàng được truyền vào
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    xemThongTinKhachHang($id); // Gọi hàm để xem thông tin chi tiết khách hàng
} else {
    // Hiển thị danh sách khách hàng nếu không có ID
    $search_term = isset($_GET['search']) ? $_GET['search'] : '';
    hienThiDanhSachKhachHang($search_term);
}
?>
