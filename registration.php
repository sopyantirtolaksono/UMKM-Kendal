<?php 
    // mulai session
    session_start();
    // koneksi ke database
    require "admin/connection.php";

    // cek jika member sudah login
    if(isset($_SESSION['member'])) {
        echo "<script>location ='index.php';</script>";
        header('Location: index.php');
        exit();
    }

    // cek jika tombol registrasi diklik
    if(isset($_POST["registrasi"])) {
        // ambil data dari form
        $namaLengkap   = $_POST["nama_lengkap"];
        $username      = $_POST["username"];
        $password      = $_POST["password"];

        // insert data ke database
        $conn->query("INSERT INTO tbl_member (nama_lengkap, username, password) VALUES ('$namaLengkap', '$username', '$password')");

        // Arahkan ke halaman login
        header("location:login.php");

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UMKMKendal | Registration</title>
    <!-- Link bootstrap -->
    <link rel="stylesheet" href="css/css-logreg/bootstrap.min.css">
    <!-- Link font-awesome -->
    <link rel="stylesheet" href="css/css-logreg/font-awesome.min.css">
    <!-- Link style login -->
    <link rel="stylesheet" href="css/css-logreg/registration.css">
    <!-- JavaScript jQuery -->
    <script src="js/js-logreg/jquery-2.2.4.min.js"></script>
</head>
<body>

    <div class="row-registration">
        
        <div class="col-bg-registration">
            <div class="bg-registration-content"
                 style="display: flex;
                        justify-content: center;
                        align-items: center;
                        background: url('images/dinner-4.jpg') no-repeat center center / cover;
                        height: 100vh;
                        text-align: center;">

            </div>
        </div>

        <div class="col-form-registration" style="">
            <div class="form-registration-content">
                <h2 class="card-title text-center">Registration</h2><br>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="namaLengkap">Full name</label>
                        <input type="text" class="form-control form-control-lg" name="nama_lengkap" id="namaLengkap" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Enter password" required>
                    </div>

                    <button type="submit" class="btn btn-warning btn-block btn-lg" name="registrasi">Create account</button><br>

                   <!-- Link login -->
                    <a href="login.php">Have account ?</a>

                </form>
            </div>
        </div>

    </div>

    <!-- JavaScript -->
    <!-- JavaScript bootstrap -->
    <script src="js/js-logreg/bootstrap.min.js"></script>

</body>
</html>