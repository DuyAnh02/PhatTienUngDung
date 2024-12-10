<?php

    include("connect.php");
    class Clsproductkh extends ConnectD {
        public function LayCot($sql)
        {
            $link = $this->connect();
            $ketqua = mysqli_query($link,$sql);
            $i = mysqli_num_rows($ketqua);
            $giatri ='';
            if($i>0)
            {
                while($row = mysqli_fetch_array($ketqua))
                {
                    $gt=$row[0];
                    $giatri = $gt;
                }
            }   
            return $giatri;
        }
        public function xuatblogkh($sql)
        {
            $link = $this->connect();
            $ketqua = mysqli_query($link,$sql);
            $i = mysqli_num_rows($ketqua);
            if($i>0)
            {
                while($row = mysqli_fetch_array($ketqua))
                {
                    $id_blog = $row['id_blog'];
                    $tieude_blog = $row['tieude_blog'];
                    $noidung_blog = $row['noidung_blog'];
                    $anh1_blog = $row['anh1_blog'];
                    $anh2_blog = $row['anh2_blog'];
                    $anh3_blog = $row['anh3_blog'];
                    echo '<div class="card mb-4">';
                    echo '<div class="card-body text-black">';
                    echo "<h2 class='card-title'>" . $tieude_blog . "</h2>";
                    echo '<div class="col-md-4"><img src="../../img/' . $anh1_blog . '" class="img-fluid" alt="Ảnh 1" /></div>';
                    echo "<p class='card-text '>" . nl2br($noidung_blog) . "</p>";
                    echo '<div class="col-md-4"><img src="../../img/' . $anh2_blog . '" class="img-fluid" alt="Ảnh 2" /></div>';

                    echo '</div>'; // .card-body
                    echo '</div>'; // .card
                }
            }
        }

        public function xuatproductkh($sql)
        {
            $link = $this->connect();
            $ketqua = mysqli_query($link,$sql);
            $i = mysqli_num_rows($ketqua);
            if($i>0)
            {
                while($row = mysqli_fetch_array($ketqua))
                {
                    $id_product = $row['id_product'];
                    $id_brand = $row['id_brand'];
                    $name_brand = $this->LayCot("SELECT name_brand FROM brand WHERE id_brand='$id_brand' limit 1 ");
                    $category = $row['category'];
                    $quantity = $row['quantity'];
                    $sold = $row['sold'];
                    $name_product = $row['name_product'];
                    $price = $row['price'];
                    $price_discount = $row['price_discount'];
                    $img_product = $row['img_product'];
                    echo '<div class="col-2">
                        <div class="product-card" >
                            <div class="img_product">
                            <form action="" method="get">
                                <a href="../chitietsanpham/?id='.$id_product.'">
                                    <img src="../../img/'.$img_product.'" id="'.$id_product.'" width="150px" height="150px"/>
                                </a>
                            </form>
                                
                            </div>
                            <div class="name_product" >'.$name_product.'</div>
                            <div class="gia_product">'.number_format($price, 0, ',', '.').' VNĐ</div>
                            <div class="giagiam_product">'.number_format($price_discount, 0, ',', '.').' VNĐ</div>
                            <div class="mua">
                                <a href="../chitietsanpham/?id='.$id_product.'">
                                <button class="btn-buy">Mua ngay</button>
                                </a>
                            </div>
                        </div>
                    </div>';

                }
            }
            else
            {
                echo 'Không tìm thấy sản phẩm!';
            }
        }

        public function chitietsanpham($sql)
        {
            $link = $this->connect();
            $ketqua = mysqli_query($link,$sql);
            $i = mysqli_num_rows($ketqua);
            if($i>0)
            {
                while($row = mysqli_fetch_array($ketqua))
                {
                    $id_product = $row['id_product'];
                    $id_brand = $row['id_brand'];
                    $name_brand = $this->LayCot("SELECT name_brand FROM brand WHERE id_brand='$id_brand' limit 1 ");
                    $category = $row['category'];
                    $quantity = $row['quantity'];
                    $sold = $row['sold'];
                    $name_product = $row['name_product'];
                    $price = $row['price'];
                    $price_discount = $row['price_discount'];
                    $img_product = $row['img_product'];
                   
                   echo'
                        <div class="card-body py-3 d-flex">
                            <img src="../../img/'.$img_product.'" width="400px" height="400px">
                            <div class="ml-4 text-dark">
                                <h3 class="font-weight-bold text-dark">'.$name_product.'</h3>
                                <p><strong>Nhãn hiệu: </strong>'.$name_brand.'</p>
                                <p><strong>Giá:</strong> <span class="gia_product">'.number_format($price, 0, ',', '.').' VNĐ</span></p>
                                <p><strong>Giá giảm:</strong> <span class="giagiam_product">'.number_format($price_discount, 0, ',', '.').' VNĐ</span></p>
                                <form action="" method="post">
                                    <input type="hidden" name="id_product" value="'.$id_product.'">
                                    <input type="hidden" name="id_brand" value="'.$id_brand.'">
                                    <input type="hidden" name="name_brand" value="'.$name_brand.'">
                                    <input type="hidden" name="category" value="'.$category.'">
                                    <input type="hidden" name="name_product" value="'.$name_product.'">
                                    <input type="hidden" name="price" value="'.$price.'">
                                    <input type="hidden" name="price_discount" value="'.$price_discount.'">
                                    <input type="hidden" name="img_product" value="'.$img_product.'">                                
                                    <input type="submit" id="btn-addcart" name="btn-addcart" class="btn btn-danger" value="Thêm vào giỏ hàng">     
                                </form> 
                            ';
                }
            }
        }

        public function thongso($sql)
        {
            $link = $this->connect();
            $ketqua = mysqli_query($link,$sql);
            $i = mysqli_num_rows($ketqua);
            if($i>0)
            {
                while($row = mysqli_fetch_array($ketqua))
                {
                    $man_hinh = $row['man_hinh'];
                    $camera_sau = $row['camera_sau'];
                    $camera_truoc = $row['camera_truoc'];
                    $he_dieu_hanh_cpu= $row['he_dieu_hanh_cpu'];
                    $bo_nho_luu_tru = $row['bo_nho_luu_tru'];
                    $ket_noi = $row['ket_noi'];
                    $pin_sac = $row['pin_sac'];
                    $tien_ich = $row['tien_ich'];
                    $thong_tin_chung = $row['thong_tin_chung'];
                    $img_mota = $row['img_mota'];

                   echo'<p><br/><strong>Màn hình: </strong>'.$man_hinh.' </p>
                    <p><strong>Camera sau: </strong>'.$camera_sau.' </p>
                    <p><strong>Camera trước: </strong>'.$camera_truoc.' </p>
                    <p><strong>Hệ điều hành & Cpu: </strong>'.$he_dieu_hanh_cpu.' </p>
                    <p ><strong>Bộ nhớ lưu trữ: </strong>'.$bo_nho_luu_tru.'</p>
                    <p ><strong>Kết nối: </strong>'.$ket_noi.'</p>
                    <p ><strong>Pin sạc: </strong>'.$pin_sac.'</p>
                    <p ><strong>Tiện ích: </strong>'.$tien_ich.'</p>
                    <p ><strong>Thông tin chung: </strong>'.$thong_tin_chung.'</p>
                    </div>
                    </div>
                    '
                    ;
                }
            }
        }

}

?>