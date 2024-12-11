<?php
include("../controller/nguyenvatlieuController.php");  // Gọi file chứa các hàm

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ngay_mua']) && !empty($_POST['ngay_mua'])) {
        $ngay_mua = $_POST['ngay_mua'];
        hienThiDanhSachMonAn($ngay_mua);
    } elseif (isset($_POST['so_luong']) && !empty($_POST['so_luong'])) {
        $ngay_mua = $_POST['ngay_mua'];
        $so_luong = $_POST['so_luong'];
        
        $success = luuNguyenVatLieu($ngay_mua, $so_luong);
        
        if ($success) {
            hienThiBangNguyenVatLieu($ngay_mua, $so_luong);
        } else {
            echo "Có lỗi khi lưu dữ liệu!";
        }
    }
} else {
    hienThiFormNgayMua();
}
?>
