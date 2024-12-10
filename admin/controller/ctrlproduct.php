<?php
ob_start();

if (isset($_POST["btn"]) && $_POST["btn"] === 'Lưu sản phẩm') {

    $name_product = isset($_REQUEST['name_product']) ? $_REQUEST['name_product'] : '';
    $id_brand = isset($_REQUEST['id_brand']) ? $_REQUEST['id_brand'] : '';
    $name_brand = isset($_REQUEST['name_brand']) ? $_REQUEST['name_brand'] : '';
    $category = isset($_REQUEST['category']) ? $_REQUEST['category'] : '';
    $sold = isset($_REQUEST['sold']) ? $_REQUEST['sold'] : 0;
    $quantity = isset($_REQUEST['quantity']) ? $_REQUEST['quantity'] : 0;
    $price = isset($_REQUEST['price']) ? $_REQUEST['price'] : 0;
    $price_discount = isset($_REQUEST['price_discount']) ? $_REQUEST['price_discount'] : 0;

    $img_product = isset($_FILES['img_product']['name']) ? $_FILES['img_product']['name'] : '';
    $tmp_name = isset($_FILES['img_product']['tmp_name']) ? $_FILES['img_product']['tmp_name'] : '';

    if (!empty($_FILES['img_product']['name'])) {
        $img_product = time() . '_' . $_FILES['img_product']['name'];
        $tmp_name = $_FILES['img_product']['tmp_name'];
    }

    $bo_nho_luu_tru = $_REQUEST['bo_nho_luu_tru'];
    $camera_sau = $_REQUEST['camera_sau'];
    $camera_truoc = $_REQUEST['camera_truoc'];
    $he_dieu_hanh_cpu = $_REQUEST['he_dieu_hanh_cpu'];

    $img_mota = isset($_REQUEST['img_mota']) ? $_REQUEST['img_mota'] : ''; //chưa code xong cái này 
    $tmp_mota = isset($_REQUEST['img_mota']['name']) ? $_FILES['img_mota']['name'] : '';

    if (!empty($_FILES['img_mota']['name'])) {
        $img_product = time() . '_' . $_FILES['img_mota']['name'];
        $tmp_mota = $_FILES['img_mota']['tmp_name'];
    }

    $ket_noi = $_REQUEST['ket_noi'];
    $pin_sac = $_REQUEST['pin_sac'];
    $man_hinh = $_REQUEST['man_hinh'];
    $thong_tin_chung = $_REQUEST['thong_tin_chung'];
    $tien_ich = $_REQUEST['tien_ich'];

    if ($img_product != '') {
        $img_product = time() . '_' . $img_product;
        if ($product->uploadfile($img_product, $tmp_name, "../../img") == 1) {
            if ($product->ade("INSERT INTO product ( id_brand, category, quantity, sold, name_product, price, price_discount, img_product) 
                                    VALUES ( '$id_brand', '$category', $quantity,'$sold','$name_product', $price, $price_discount, '$img_product')") == 1) {

                $id_product = $product->layIDnew("SELECT id_product FROM product ORDER BY id_product DESC LIMIT 1 ");
                $img_mota = time().'_'.$img_mota;
                if($product->uploadfile($img_mota, $tmp_mota, "../../img") == 1)
                {
                    if ($product->ade("INSERT INTO product_details_dt (id_product, man_hinh, camera_sau, camera_truoc, 
                                            he_dieu_hanh_cpu, bo_nho_luu_tru, ket_noi, pin_sac, tien_ich, thong_tin_chung, img_mota) 
                                            VALUES ($id_product, '$man_hinh', '$camera_sau', '$camera_truoc', 
                                            '$he_dieu_hanh_cpu', '$bo_nho_luu_tru', '$ket_noi', '$pin_sac', 
                                            '$tien_ich', '$thong_tin_chung', '$img_mota')") == 1) 
                    {

                        echo '<script>
                        alert("Thêm sản phẩm thành công!");
                        setTimeout(function() {
                            window.location = "../product/"; // Chuyển hướng sau 2 giây
                        }, 500); // Thời gian delay là 500ms
                        </script>';
                        exit();
                    } else 
                    {
                        echo '<script>alert("Cập nhật thất bại product_details: ' . mysqli_error($link) . '");</script>';
                    }
                }
                else{
                    echo '<script>alert("Cập nhật ảnh mô tả thất bại");</script>';
                }

                
            } else {
                echo '<script>alert("Cập nhật thất bại product: ' . mysqli_error($link) . '");</script>';
            }
        } else {
            echo '<script>alert("Cập nhật thất bại ảnh");</script>';
        }

    }
}

if (isset($_POST["btn-xoa"]) && $_POST["btn-xoa"] === 'Xóa') {
    $id_product = isset($_REQUEST['id_product']) ? $_REQUEST['id_product'] : '';
    
    // Kiểm tra xem id_product có phải là số hay không
    if (is_numeric($id_product)) {
        if ($product->ade("DELETE FROM product WHERE id_product = {$id_product};") == 1) {
            echo '<script>
            alert("Xóa sản phẩm thành công!");
            setTimeout(function() {
                window.location = "../product/"; // Chuyển hướng sau 2 giây
            }, 500); // Thời gian delay là 500ms
          </script>';
    exit();
        } else {
            echo '<script>alert("Xóa sản phẩm thất bại");</script>';
        }
    } else {
        echo '<script>alert("ID sản phẩm không hợp lệ.");</script>';
    }
}
ob_end_flush(); 
?>
