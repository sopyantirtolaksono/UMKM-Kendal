<?php 
    // mulai session
    session_start();
    // koneksi ke database
    require 'admin/connection.php';
    // cek jika member sudah login
    if(isset($_SESSION['member'])) {
        echo "<script>location ='index.php';</script>";
        header('Location: index.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UMKMKendal - Login</title>
    <!-- Link bootstrap -->
    <link rel="stylesheet" href="css/css-logreg/bootstrap.min.css">
    <!-- Link font-awesome -->
    <link rel="stylesheet" href="css/css-logreg/font-awesome.min.css">
    <!-- Link style login -->
    <link rel="stylesheet" href="css/css-logreg/login.css">
    <!-- JavaScript jQuery -->
    <script src="js/js-logreg/jquery-2.2.4.min.js"></script>
</head>
<body>

    <div class="row-login">
        <div class="col-form-login" style="">
            <div class="form-login-content">
                <h2 class="card-title text-center h2-login">Login</h2><br>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-warning btn-block btn-lg" name="login">Login</button><br>

                    <!-- Script login -->
                    <?php 
                        if(isset($_POST["login"])) {
                            $username = $_POST["username"];
                            $password = $_POST["password"];
                            $ambil = $conn->query("SELECT * FROM tbl_member WHERE username = '$username' AND password = '$password'");
                            $akunCocok = $ambil->num_rows;

                            if($akunCocok == 1) {
                                $akunMember = $ambil->fetch_assoc();
                                $_SESSION["member"] = $akunMember;
                                require "footer_login.php";
                                echo "<script>location='index.php';</script>";
                            }
                            else {
                                echo "<div class='alert alert-danger text-center'>Login Gagal, Silahkan periksa username dan password anda!</div>";
                                echo "<script>
                                        $('div.form-login-content input').addClass('is-invalid')
                                        $('div.form-login-content h2.h2-login').addClass('text-danger')
                                </script>";
                            }
                        }

                    ?>

                    <!-- Link registrasi -->
                    <a href="registration.php">Have not account ?</a>

                </form>
            </div>
        </div>
        <div class="col-bg-login">
            <div class="bg-login-content" 
                 style="display: flex;
                        justify-content: center;
                        align-items: center;
                        background: url('images/breakfast-9.jpg') no-repeat center center / cover;
                        height: 100vh;
                        text-align: center;">

            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <!-- JavaScript bootstrap -->
    <script src="js/js-logreg/bootstrap.min.js"></script>

</body>
</html>