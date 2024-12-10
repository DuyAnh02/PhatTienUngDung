<?php
ob_start();

if (isset($_POST["btn"]) && $_POST["btn"] === 'Lưu bài viết') {

    $tieude_blog = isset($_REQUEST['tieude_blog']) ? $_REQUEST['tieude_blog'] : '';
    $noidung_blog = isset($_REQUEST['noidung_blog']) ? $_REQUEST['noidung_blog'] : '';
    
    $anh1_blog = isset($_FILES['anh1_blog']['name']) ? $_FILES['anh1_blog']['name'] : '';
    $tmp_name1 = isset($_FILES['anh1_blog']['tmp_name']) ? $_FILES['anh1_blog']['tmp_name'] : '';
    
    if (!empty($_FILES['anh1_blog']['name'])) {
        $anh1_blog = time() . '_' . $_FILES['anh1_blog']['name'];
        $tmp_name1 = $_FILES['anh1_blog']['tmp_name'];
    }

    $anh2_blog = isset($_FILES['anh2_blog']['name']) ? $_FILES['anh2_blog']['name'] : '';
    $tmp_name2 = isset($_FILES['anh2_blog']['tmp_name']) ? $_FILES['anh2_blog']['tmp_name'] : '';
    
    if (!empty($_FILES['anh2_blog']['name'])) {
        $anh2_blog = time() . '_' . $_FILES['anh2_blog']['name'];
        $tmp_name2 = $_FILES['anh2_blog']['tmp_name'];
    }

    $anh3_blog = isset($_FILES['anh3_blog']['name']) ? $_FILES['anh3_blog']['name'] : '';
    $tmp_name3 = isset($_FILES['anh3_blog']['tmp_name']) ? $_FILES['anh3_blog']['tmp_name'] : '';
    
    if (!empty($_FILES['anh3_blog']['name'])) {
        $anh3_blog = time() . '_' . $_FILES['anh3_blog']['name'];
        $tmp_name3 = $_FILES['anh3_blog']['tmp_name'];
    }

    // Upload hình ảnh
    if ($anh1_blog != '' && $product->uploadfile($anh1_blog, $tmp_name1, "../../img") == 1) {
        if ($product->ade("INSERT INTO blog (tieude_blog, noidung_blog, anh1_blog, anh2_blog, anh3_blog) 
                            VALUES ('$tieude_blog', '$noidung_blog', '$anh1_blog', '$anh2_blog', '$anh3_blog')") == 1) {

            echo '<script>
            alert("Thêm bài viết thành công!");
            setTimeout(function() {
                window.location = "../dashboard/"; // Chuyển hướng sau 2 giây
            }, 500); // Thời gian delay là 500ms
          </script>';
            exit();
        } else {
            echo '<script>alert("Cập nhật thất bại blog: ' . mysqli_error($link) . '");</script>';
        }
    } else {
        echo '<script>alert("Cập nhật thất bại ảnh");</script>';
    }
}

if (isset($_POST["btn-xoa"]) && $_POST["btn-xoa"] === 'Xóa bài') {
    $id_blog = isset($_REQUEST['id_blog']) ? $_REQUEST['id_blog'] : '';

    // Kiểm tra xem id_blog có phải là số hay không
    if (is_numeric($id_blog)) {
        if ($product->ade("DELETE FROM blog WHERE id_blog = {$id_blog};") == 1) {
            echo '<script>
            alert("Xóa bài viết thành công!");
            setTimeout(function() {
                window.location = "../dashboard/"; // Chuyển hướng sau 2 giây
            }, 500); // Thời gian delay là 500ms
          </script>';
            exit();
        } else {
            echo '<script>alert("Xóa bài viết thất bại");</script>';
        }
    } else {
        echo '<script>alert("ID bài viết không hợp lệ.");</script>';
    }
}

ob_end_flush();
?>
