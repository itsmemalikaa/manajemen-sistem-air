<?php
session_start();
include "./assets/func.php";
$air = new klas_air;
$koneksi = $air->koneksi();

// $q=mysqli_query($koneksi,"SELECT nik,username,password,tipe_user FROM data_user ORDER BY nama ASC");
//  while ($d = mysqli_fetch_row($q)) {
//     $nik = $d[0];
//     $user = $d[1];
//     $pass = password_hash($user,PASSWORD_DEFAULT);
//     $tipe_user = $d[2];
//     echo "nik: $nik | user: $user | pass: $pass | tipe_user : $tipe_userl<BR>";

//     mysqli_query($koneksi, "UPDATE data_user SET password=\"$pass\" WHERE nik='$nik'");

// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - AquaticWater</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-custom"style = "background-image:url('gambar.jpg');">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header bg-custom" style = "background-color: #7db7c7;"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                   <h1 class="text-center medium" style="font-family :Arial Narrow Bold;">Welcome, Customer IrmalikAquatica! </h1> 
                                    <div class="text-center small" style="font-family :monospace;"><i>"better water for better life"</i></div>    
                                    <div class="card-body">
                                    <?php
                                    if (isset($_POST['tombol'])) {
                                        $username = $_POST['user'];
                                        $password = $_POST['password'];
                                        // echo "username: $username | password: $password<BR>";

                                        //cek user tsb ada atau tdk di tabel user
                                        $qc = mysqli_query($koneksi, "SELECT username,password FROM data_user WHERE username='$username'");
                                        $dc = mysqli_fetch_row($qc);
                                        if (!empty($dc[0])) $user_cek = $dc[0];

                                        //jika username yg diisi ada di tabel user
                                        if (!empty($user_cek)) {

                                            $pass_cek = $dc[1];
                                            //cek password
                                            if (password_verify($password, $pass_cek)) {

                                                //daftarkan session
                                                
                                                $_SESSION['user'] = $username;
                                                $_SESSION['pass'] = $password;

                                                //redirect ke dashboard page
                                                echo "<script>window.location.replace('./login/index.php')</script>";
                                            } else
                                                echo "
                                                    <div class=\"alert alert-danger alert-dismissible fade show\">
                                                        <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                        <strong>Login</strong> salah....
                                                    </div>";
                                        } else { //jika username yang diisikan tdk ada ditabel user

                                            echo "
                                            <div class=\"alert alert-danger alert-dismissible fade show\">
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Username</strong> tidak ditemukan....
                                            </div>";
                                        }
                                    }
                                    ?>
                                    <form method="post" class="needs-validation">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputUsername" type="text" name="user" required />
                                            <label for="inputUsername">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <input class="btn btn-primary" type="submit" name="tombol" value="Login">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3 bg-custom" style = "background-color:  #7db7c7;">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; IrmalikAquatica Corp. 2024</div>
                        <div>
                             <a href="#">Privacy Policy</a>
                            &bull;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html> 
                                