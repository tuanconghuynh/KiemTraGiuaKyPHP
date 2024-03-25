<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa nhân viên</title>
</head>
<body>
    <h2>Chỉnh sửa thông tin nhân viên</h2>
    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "QL_NhanSu";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        // Lấy thông tin nhân viên từ cơ sở dữ liệu để hiển thị trong biểu mẫu chỉnh sửa
        $sql = "SELECT * FROM NHANVIEN WHERE Ma_NV='$userId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Hiển thị biểu mẫu chỉnh sửa thông tin nhân viên
            // Ở đây bạn có thể sử dụng các trường thông tin của $row để điền vào các trường nhập của biểu mẫu
    ?>
    <!-- Form chỉnh sửa thông tin nhân viên -->
    <form action="updateNhanVien.php?id=<?php echo $userId; ?>" method="post">
        <!-- Các trường nhập thông tin nhân viên -->
        <label for="Ten_NV">Tên nhân viên:</label><br>
        <input type="text" id="Ten_NV" name="Ten_NV" value="<?php echo $row['Ten_NV']; ?>"><br>
        <label for="Phai">Phái:</label><br>
        <input type="radio" id="Nam" name="Phai" value="Nam" <?php if ($row['Phai'] === 'Nam') echo 'checked'; ?>>
        <label for="Nam">Nam</label>
        <input type="radio" id="Nu" name="Phai" value="Nu" <?php if ($row['Phai'] === 'Nu') echo 'checked'; ?>>
        <label for="Nu">Nữ</label><br>
        <label for="Noi_Sinh">Nơi sinh:</label><br>
        <input type="text" id="Noi_Sinh" name="Noi_Sinh" value="<?php echo $row['Noi_Sinh']; ?>"><br>
        <label for="Ma_Phong">Mã phòng:</label><br>
        <input type="text" id="Ma_Phong" name="Ma_Phong" value="<?php echo $row['Ma_Phong']; ?>"><br>
        <label for="Luong">Lương:</label><br>
        <input type="text" id="Luong" name="Luong" value="<?php echo $row['Luong']; ?>"><br>
        <input type="submit" value="Cập nhật">
    </form>
    <?php
        } else {
            echo "Không tìm thấy nhân viên.";
        }
    }

    $conn->close();
    ?>
</body>
</html>
