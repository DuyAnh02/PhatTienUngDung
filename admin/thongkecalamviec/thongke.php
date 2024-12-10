<?php
include("../controller/clsproduct.php");
$product = new Clsproduct();
$link = $product->connect(); // Kết nối đến CSDL

// Truy vấn doanh thu theo tháng
$sql = "SELECT MONTH(order_date) as month, SUM(order_price) as total_revenue, COUNT(*) as total_orders 
        FROM order_cus 
        WHERE YEAR(order_date) = YEAR(CURDATE()) 
        GROUP BY MONTH(order_date)";
$result = mysqli_query($link, $sql);
$monthly_data = [];
$total_orders = 0;
$total_revenue = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $monthly_data[$row['month']] = [
        'total_revenue' => $row['total_revenue'],
        'total_orders' => $row['total_orders']
    ];
    $total_revenue += $row['total_revenue'];
    $total_orders += $row['total_orders'];
}

// Truy vấn số sản phẩm bán ra theo loại
$sql = "SELECT category, SUM(sold) as total_sold FROM product GROUP BY category";
$result = mysqli_query($link, $sql);

$product_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $product_data[] = [
        'type_name' => $row['category'],
        'total_sold' => $row['total_sold']
    ];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Trang Thống Kê Doanh Thu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Begin Page Content -->
<div class="container-fluid mt-5">
    <div class="row">
        <!-- Bảng thống kê doanh thu -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Thống kê nguyên liệu</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="revenueTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Thángssss</th>
                                    <th>Doanh thu (VNĐ)</th>
                                    <th>Đơn hàng bán ra</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($month = 1; $month <= 12; $month++) {
                                    $revenue = isset($monthly_data[$month]) ? number_format($monthly_data[$month]['total_revenue'], 0, ',', '.') : 0;
                                    $orders = isset($monthly_data[$month]) ? $monthly_data[$month]['total_orders'] : 0;
                                    echo "<tr>
                                            <td>{$month}</td>
                                            <td>{$revenue} VNĐ</td>
                                            <td>{$orders}</td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bảng tổng số đơn hàng và tổng doanh thu và biểu đồ -->
        <div class="col-lg-6">
            <!-- Bảng tổng kết -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tổng kết</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="summaryTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tổng số đơn hàng</th>
                                    <th>Tổng doanh thu (VNĐ)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo number_format($total_orders); ?></td>
                                    <td><?php echo number_format($total_revenue, 0, ',', '.'); ?> VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ cột số sản phẩm bán ra theo loại -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Số sản phẩm bán ra theo loại</h6>
                </div>
                <div class="card-body">
                    <canvas id="productTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    // Dữ liệu cho biểu đồ sản phẩm bán ra theo loại
    const productTypeLabels = [
        <?php
        foreach ($product_data as $product) {
            echo "'" . $product['type_name'] . "',";
        }
        ?>
    ];

    const productTypeData = [
        <?php
        foreach ($product_data as $product) {
            echo $product['total_sold'] . ",";
        }
        ?>
    ];

    // Khởi tạo biểu đồ cột bằng Chart.js
    const ctx = document.getElementById('productTypeChart').getContext('2d');
    const productTypeChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: productTypeLabels,
            datasets: [{
                label: 'Số lượng sản phẩm bán ra',
                data: productTypeData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>
