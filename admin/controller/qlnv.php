<?php
include("connect.php");

// Hàm hiển thị danh sách nhân viên
function showEmployeeList()
{
    // Tạo đối tượng và khởi tạo kết nối
    $db = new ConnectD();
    $conn = $db->connect(); // Gọi phương thức connect()

    // Lấy danh sách nhân viên
    $sql = "SELECT * FROM user"; // Giả sử bảng là 'user'
    $result = mysqli_query($conn, $sql);

    // Hiển thị danh sách nhân viên
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name_us']}</td> <!-- Sử dụng name_us thay vì id_us -->
                    <td>{$row['name_us']}</td>
                    <td>{$row['pass_us']}</td>
                    <td>{$row['yourname_us']}</td>
                    <td>{$row['chucvu']}</td>
                    <td>{$row['ngaylv']}</td>
                    <td>{$row['sdt']}</td>
                    <td>
                        <a href='edit.php?name={$row['name_us']}' class='btn btn-sm btn-warning'>Sửa</a>
                        <a href='delete.php?name={$row['name_us']}' class='btn btn-sm btn-danger'>Xóa</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>Không có dữ liệu</td></tr>";
    }

    // Đóng kết nối
    mysqli_close($conn);
}

// Hàm chỉnh sửa thông tin nhân viên
function editEmployee($name)
{
    // Tạo đối tượng và khởi tạo kết nối
    $db = new ConnectD();
    $conn = $db->connect(); // Gọi phương thức connect()

    // Lấy thông tin nhân viên theo tên
    $sql = "SELECT * FROM user WHERE name_us = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        // Nếu có nhân viên, lấy thông tin và hiển thị vào form chỉnh sửa
        $row = $result->fetch_assoc();
?>
        <div class="container mt-5">
            <h3 class="mb-4">Chỉnh sửa thông tin nhân viên</h3>
            <form method="POST" action="update.php">
                <input type="hidden" name="name_us" value="<?php echo htmlspecialchars($row['name_us']); ?>">

                <div class="form-group">
                    <label for="pass_us">Mật khẩu:</label>
                    <input type="password" name="pass_us" class="form-control" value="<?php echo htmlspecialchars($row['pass_us']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="yourname_us">Tên người dùng:</label>
                    <input type="text" name="yourname_us" class="form-control" value="<?php echo htmlspecialchars($row['yourname_us']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="chucvu">Chức vụ:</label>
                    <input type="text" name="chucvu" class="form-control" value="<?php echo htmlspecialchars($row['chucvu']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="ngaylv">Ngày làm việc:</label>
                    <input type="date" name="ngaylv" class="form-control" value="<?php echo htmlspecialchars($row['ngaylv']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="sdt">Số điện thoại:</label>
                    <input type="text" name="sdt" class="form-control" value="<?php echo htmlspecialchars($row['sdt']); ?>" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="index.php" class="btn btn-secondary ml-2">Quay lại danh sách</a>
                </div>
            </form>
        </div>
<?php
    } else {
        echo "<p>Không tìm thấy nhân viên.</p>";
    }

    // Đóng kết nối
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


// Hàm cập nhật thông tin nhân viên
function updateEmployee()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Nhận các dữ liệu từ form
        $name_us = $_POST['name_us'];
        $pass_us = $_POST['pass_us'];
        $yourname_us = $_POST['yourname_us'];
        $chucvu = $_POST['chucvu'];
        $ngaylv = $_POST['ngaylv'];
        $sdt = $_POST['sdt'];

        // Tạo đối tượng và khởi tạo kết nối
        $db = new ConnectD();
        $conn = $db->connect(); // Gọi phương thức connect()

        // Cập nhật thông tin nhân viên trong cơ sở dữ liệu
        $sql = "UPDATE user SET pass_us = ?, yourname_us = ?, chucvu = ?, ngaylv = ?, sdt = ? WHERE name_us = ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $pass_us, $yourname_us, $chucvu, $ngaylv, $sdt, $name_us);

        // Kiểm tra nếu cập nhật thành công
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Thông tin nhân viên đã được cập nhật thành công.</p>";
            echo "<a href='index.php'>Quay lại danh sách</a>";
        } else {
            echo "<p>Đã có lỗi xảy ra, vui lòng thử lại.</p>";
        }

        // Đóng kết nối
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

// Hàm xóa nhân viên
function deleteEmployee($name)
{
    // Tạo đối tượng và khởi tạo kết nối
    $db = new ConnectD();
    $conn = $db->connect(); // Gọi phương thức connect()

    // Câu lệnh xóa nhân viên theo tên
    $sql = "DELETE FROM user WHERE name_us = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);

    // Kiểm tra và thực thi câu lệnh
    if (mysqli_stmt_execute($stmt)) {
        echo "<p>Nhân viên đã được xóa thành công.</p>";
        echo "<a href='index.php'>Quay lại danh sách</a>";
    } else {
        echo "<p>Đã có lỗi xảy ra, vui lòng thử lại.</p>";
    }

    // Đóng kết nối
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


// Hàm thêm nhân viên
function addEmployee()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Nhận các dữ liệu từ form
        $name_us = $_POST['name_us'];
        $pass_us = $_POST['pass_us'];
        $yourname_us = $_POST['yourname_us'];
        $chucvu = $_POST['chucvu'];
        $ngaylv = $_POST['ngaylv'];
        $sdt = $_POST['sdt'];

        // Tạo đối tượng và khởi tạo kết nối
        $db = new ConnectD();
        $conn = $db->connect(); // Gọi phương thức connect()

        // Câu lệnh thêm nhân viên vào cơ sở dữ liệu
        $sql = "INSERT INTO user (name_us, pass_us, yourname_us, chucvu, ngaylv, sdt) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $name_us, $pass_us, $yourname_us, $chucvu, $ngaylv, $sdt);

        // Kiểm tra nếu thêm thành công
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Nhân viên đã được thêm thành công.</p>";
            echo "<a href='index.php'>Quay lại danh sách</a>";
        } else {
            echo "<p>Đã có lỗi xảy ra, vui lòng thử lại.</p>";
        }

        // Đóng kết nối
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        // Hiển thị form thêm nhân viên
?>
        <div class="container mt-5">
            <h3 class="mb-4">Thêm nhân viên mới</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name_us">Tên đăng nhập:</label>
                    <input type="text" name="name_us" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="pass_us">Mật khẩu:</label>
                    <input type="password" name="pass_us" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="yourname_us">Tên người dùng:</label>
                    <input type="text" name="yourname_us" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="chucvu">Chức vụ:</label>
                    <input type="text" name="chucvu" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="ngaylv">Ngày làm việc:</label>
                    <input type="date" name="ngaylv" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="sdt">Số điện thoại:</label>
                    <input type="text" name="sdt" class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                    <a href="index.php" class="btn btn-secondary ml-2">Quay lại danh sách</a>
                </div>
            </form>
        </div>
<?php
    }
}

?>