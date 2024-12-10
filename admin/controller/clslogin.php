<?php 
class login {
    public function connectLogin() {
        $servername = "localhost";
        $user = "root";
        $password = "";
        $database = "food";
        $con = mysqli_connect($servername, $user, $password, $database);
        if (!$con) {
            echo 'khong the ket noi csdl';
            exit();
        }
        return $con;
    }

    public function loginAdmin($user, $pass) {
        $link = $this->connectLogin();

        $sql="SELECT name_us,pass_us,yourname_us,chucvu from user where name_us='$user' and pass_us ='$pass' limit 1";
        $link = $this->connectLogin();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);

        if ($i == 1) {
            while($row = mysqli_fetch_array($ketqua))
            {
                session_start();
                $_SESSION['dn'] = 1;
                $_SESSION['name_us'] = $row['name_us'];
                $_SESSION['yourname'] = $row['yourname_us'];
                $_SESSION['pass'] = $row['pass_us'];
                $_SESSION['phanquyen'] = $row['chucvu'];
                header('Location: ../dashboard'); 
                exit(); 
            }
            exit();
        } else {
            return 0;
        }
    }

    public function loginkhachhang($user, $pass) {
        $link = $this->connectLogin();

        $sql="SELECT phone_cus,name_cus,pass_cus,address_cus from customer where phone_cus='$user' and pass_cus ='$pass' limit 1";
        $link = $this->connectLogin();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);

        if ($i == 1) {
            while($row = mysqli_fetch_array($ketqua))
            {
                session_start();
                $_SESSION['khdn'] = 1;
                $_SESSION['name_cus'] = $row['name_cus'];
                $_SESSION['phone_cus'] = $row['phone_cus'];
                $_SESSION['pass_cus'] = $row['pass_cus'];
                $_SESSION['address_cus'] = $row['address_cus'];
                header('Location: ../'); 
                exit(); 
            }
            exit();
        } else {
            return 0;
        }
    }

}
?>