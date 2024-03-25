<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php"); // Chuyển hướng người dùng đã đăng nhập đến trang chính
    exit;
}

// Xử lý dữ liệu đăng nhập khi người dùng gửi form
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Kiểm tra username và password có hợp lệ không, ví dụ:
    if($_POST['username'] === 'admin' && $_POST['password'] === 'password'){
        // Đăng nhập thành công, lưu session và chuyển hướng đến trang chính
        $_SESSION["loggedin"] = true;
        header("location: index.php");
    } else{
        // Đăng nhập không thành công, hiển thị thông báo lỗi
        $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <h2>Đăng nhập</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Đăng nhập">
    </form>
    <?php
    if(isset($error)){
        echo "<p>$error</p>";
    }
    ?>
</body>
</html>
<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php"); // Chuyển hướng người dùng chưa đăng nhập đến trang đăng nhập
    exit;
}
// Tiếp tục hiển thị nội dung trang chính sau khi đăng nhập
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chính</title>
</head>
<body>
    <h2>Xin chào, <?php echo $_SESSION['username']; ?>!</h2>
    <p>Đây là trang chính.</p>
    <!-- Các phần còn lại của trang -->
</body>
</html>