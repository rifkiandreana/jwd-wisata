<?php
include("koneksi.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telepon = $_POST['telepon'];
   
    $sql = "INSERT INTO data_pembeli (nama, email, password, telepon) VALUES ('$nama', '$email', '$password', '$telepon')";

    if (mysqli_query($db, $sql)) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container .form-group {
            margin-bottom: 15px;
        }
        .login-container .form-control {
            border-radius: 4px;
        }
        .login-container .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .login-container .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .login-container .text-center {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Sign Up</h2>
        <form  method="post" action="signup.php" >
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" id="username" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="password" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="password">Nomor Telepon</label>
                <input type="text" name="telepon" class="form-control" id="telepon" placeholder="Enter your number phone" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
