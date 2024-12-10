<?php 
    class ConnectD
    {
        public function connect() {
            $severname = "localhost";
            $user = "root";
            $password = "";
            $database = "quanli_shopdt";
            $con = mysqli_connect($severname,$user,$password,$database);
            if(!$con)
            {
                echo 'khong the ket noi csdl';
                exit();
            }
            else
            {
                
            }
            return $con;
        }        
    }


?>