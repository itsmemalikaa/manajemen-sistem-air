<?php
ob_start();
session_start();
    if (empty($_SESSION['user']) && empty($_SESSION['pass'])) {
        echo "<script>window.location.replace('../index.php')</script>";
    }
    include "../assets/func.php";
    $air = new klas_air;
    $koneksi = $air->koneksi();
    $dt_user = $air->dt_user($_SESSION['user']);
    $tipe_user = $air->tipe_user($_SESSION['user']); 
    ?>

    <!DOCTYPE html>
    <html lang="en"> 

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - IrmamalikAquatica</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
            .nav-link {
                font-family:Cochin;
                font-size: 1.1rem;
            }
        </style> 
    </head>

    <body class="sb-nav-fixed">
        <!-- irmalika -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-custom" style= "background-color:#28304d;">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">IrmalikAquatica</a>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-custom" id="btnNavbarSearch" type="button" style= "background-color:#008080;"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark bg-custom" style= "background-color:#28304d;" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-danger"></i></div>
                                Dashboard
                            </a>
                            <?php
                            if ($tipe_user == "admin") {
                            ?>
                                <a class="nav-link" href="index.php?p=user">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Manajemen User
                                </a>
                                <a class="nav-link" href="index.php?p=lihat_komplain">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Lihat Komplain
                                </a>
                                <a class="nav-link" href="index.php?p=pemakaian">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Data Pemakaian
                                </a>
                            <?php
                            } elseif ($tipe_user == "warga") {
                            ?>
                                <a class="nav-link" href="index.php?p=pemakaian_warga">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Lihat Pemakaian
                                </a>
                                <a class="nav-link" href="index.php?p=lihat_tagihan">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Lihat Tagihan
                                </a>
                                <a class="nav-link" href="index.php?p=ajukan_komplain">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Ajukan Komplain
                                </a>
                            <?php
                            } elseif ($tipe_user == "petugas") {
                            ?>
                                <a class="nav-link" href="index.php?p=catat_meter">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-pen-to-square fa-bounce text-info"></i></div>
                                    Catat Meter
                                </a>
                                <a class="nav-link" href="index.php?p=pemakaian">
                                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-user fa-bounce text-info"></i></div>
                                    Lihat Data Pemakaian
                                </a>
                                <a class="nav-link" href="index.php?p=lihat_komplain">
                                    <div class="sb-nav-link-icon"><i class="fa-solid fa-hand-holding-droplet fa-bounce text-info"></i></div>
                                    Lihat Komplain
                                </a>
                                <?php
                            } elseif ($tipe_user == "bendahara") {
                            ?>
                                <a class="nav-link" href="index.php?p=transaksi_pembayaran">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Transaksi Pembayaran
                                </a>
                                <a class="nav-link" href="index.php?p=tarif">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Manajemen Tarif
                                </a>
                                <a class="nav-link" href="index.php?p=lihat_komplain">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Lihat Komplain
                                </a>
                                <a class="nav-link" href="index.php?p=pemakaian">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fa-spin text-success"></i></div>
                                    Lihat Data Pemakaian
                                <?php
                            }
                                ?>
                            <!-- <div class="sb-sidenav-menu-heading">Interface</div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Layouts
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Pages
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                            Authentication
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="login.html">Login</a>
                                                <a class="nav-link" href="register.html">Register</a>
                                                <a class="nav-link" href="password.html">Forgot Password</a>
                                            </nav>
                                        </div>
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                            Error
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="401.html">401 Page</a>
                                                <a class="nav-link" href="404.html">404 Page</a>
                                                <a class="nav-link" href="500.html">500 Page</a>
                                            </nav>
                                        </div>
                                    </nav>
                                </div>
                                <div class="sb-sidenav-menu-heading">Addons</div>
                                <a class="nav-link" href="charts.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Charts
                                </a>
                                <a class="nav-link" href="tables.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                    Tables
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"><i class="fa-solid fa-right-to-bracket fa-bounce text-warning"></i> Logged in as <?php echo $tipe_user ?>:</div>
                        <i class="fa-regular fa-id-card fa-bounce text-danger"></i>
                        <?php
                        //Nama user (kota)
                        echo $dt_user[0] . ' (' . $dt_user[1] . ')';
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <?php
                        // echo $_SERVER['REQUEST_URI'];
                    $e = explode("=", $_SERVER['REQUEST_URI']);
                    // echo "<BR>$e[1];
                    if (!empty($e[1])) {
                        if ($e[1] == "user" || $e[1] == "user_edit&nik") {
                            $h1 = "Manajemen User";
                            $h2 = "Menu untuk CRUD user";
                        } elseif ($e[1] == "lihat_komplain") {
                            $h1 = "Lihat Komplain";
                            $h2 = "Menu untuk lihat komplain warga";
                        } elseif ($e[1] == "pemakaian") {
                            $h1 = "Lihat Pemakaian";
                            $h2 = "Menu untuk lihat pemakaian air warga";
                        } elseif ($e[1] == "pemakaian_warga") {
                            $h1 = "Lihat Pemakaian Air";
                            $h2 = "Menu untuk lihat pemakaian air";
                        } elseif ($e[1] == "lihat_tagihan") {
                            $h1 = "Lihat Tagihan Air";
                            $h2 = "Menu untuk lihat tagihan air";
                        } elseif ($e[1] == "ajukan_komplain") {
                            $h1 = "Pengajuan Komplain";
                            $h2 = "Menu untuk mengajukan komplain";
                        } elseif ($e[1] == "catat_meter" || $e[1] == "catat_meter_edit&id_meter" ) {
                            $h1 = "Catat Meter";
                            $h2 = "Menu untuk memasukkan data meter";
                        } elseif ($e[1] == "ubah_meter") {
                            $h1 = "Ubah Meter";
                            $h2 = "Menu untuk mengubah data meter 1 bulan";
                        } elseif ($e[1] == "transaksi_pembayaran") {
                            $h1 = "Transaksi Pembayaran";
                            $h2 = "Menu untuk mengelola transaksi pembayaran";
                        } elseif ($e[1] == "tarif" || $e[1] == "tarif_edit&id_tarif") {
                            $h1 = "Manajemen Tarif";
                            $h2 = "Menu untuk mengelola data tarif";
                        }
                    } else {
                        $h1 = "DASHBOARD";
                        $h2 = "Selamat Datang di IrmalikAquatica Dashboard !";
                    }
                    ?>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo $h1; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $h2; ?></li>
                        </ol>
                        <div class="row" id="summary">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body d-flex justify-content-center">
                                    <h1></h1>
                                    <div class="ms-3">m<sup>3</sup></div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="mx-auto">Total Volume Pemakaian</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body d-flex justify-content-center">
                                    <h1></h1>
                                    <div class="ms-3">orang</div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="mx-auto">Jumlah Pelanggan</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body d-flex justify-content-center">
                                    <h1></h1>
                                    <div class="ms-3">pelanggan</div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="mx-auto">Sudah Dicatat</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body d-flex justify-content-center">
                                    <h1></h1>
                                    <div class="ms-3">pelanggan</div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="mx-auto">Belum Dicatat</div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row" id="chart">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <!-- The Modal -->
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body"></div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <form method="post">
                                            <button type="submit" name="tombol" value="user_hapus" class="btn btn-danger" data-bs-dismiss="modal">Ya</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tidak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?PHP

                        if (isset($_POST['tombol'])) {
                            $t = $_POST['tombol'];
                            if ($t == "user_add") {
                                $nik = $_POST ['nik'];
                                $nama = $_POST ['nama'];
                                $tipe_user = $_POST ['tipe_user'];
                                $alamat = $_POST ['alamat'];
                                $kota = $_POST ['kota'];
                                $no_hp = $_POST ['no_hp'];
                                $email = $_POST ['email'];
                                $username = $_POST ['username'];
                                $password = $_POST ['password'];

                                $qc = mysqli_query($koneksi, "SELECT nik FROM data_user WHERE nik ='$nik' OR username ='$username'");
                                $jc = mysqli_num_rows($qc);
                                if (empty($jc)) {
                                    mysqli_query($koneksi, "INSERT INTO data_user (nik,nama,level,alamat,kota,no_hp,email,username,password) VALUES ('$nik',\"$nama\",'$tipe_user','$alamat','$kota','$no_hp','$email','$username','$password')");
                                    if (mysqli_affected_rows($koneksi) > 0) {
                                        echo "<div class=\"alert alert-success alert-dismissible fade show\">
                                        <button type=button class=btn-close data-bs-dismissible=alert></button>
                                        <strong>Data User</strong> Berhasil Masuk ! </div>";
                                    } else {
                                        echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                        <button type=button class=btn-close data-bs-dismissible=alert></button>
                                        <strong>Data User</strong> Gagal Masuk ! </div>";
                                    }
                                } else {
                                    echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                    <button type=button class=btn-close data-bs-dismissible=alert></button>
                                    <strong>NIK $nik atau username $username</strong> Sudah Ada </div>";
                                }
                            } elseif ($t == "user_edit") {
                                $nik = $_POST ['nik'];
                                $nama = $_POST ['nama'];
                                $tipe_user = $_POST ['tipe_user'];
                                $alamat = $_POST ['alamat'];
                                $kota = $_POST ['kota'];
                                $no_hp = $_POST ['no_hp'];
                                $email = $_POST ['email'];

                                mysqli_query($koneksi, "UPDATE data_user SET nama=\"$nama\", tipe_user='$tipe_user',alamat='$alamat',kota='$kota', no_hp='$no_hp',email='$email' WHERE nik='$nik'");
                                if (mysqli_affected_rows($koneksi)) { //data berhasil masuk
                                    echo "<div class=\"alert alert-success alert-dismissible fade show\" id=alert-user>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Berhasil diubah !
                                        </div>";
                                } else { //data gagal masuk
                                    echo "<div class=\"alert alert-success alert-dismissible fade show\" id=alert-user>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Tidak ada perubahan :(
                                        </div>";
                                }
                            } elseif ($t == "user_hapus") {
                                $nik = $_POST['nik'];
                                mysqli_query($koneksi, "DELETE FROM data_user WHERE nik='$nik'");
                                if (mysqli_affected_rows($koneksi)) {
                                    echo "<div class=\"alert alert-success alert-dismissible fade show\" >
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> berhasil dihapus....
                                        </div>";
                                } else {
                                    echo "<div class=\"alert alert-success alert-dismissible fade show\">
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> tidak jadi dihapus....
                                        </div>";
                                }                         
                            } elseif ($t == "tarif_add") {
                                $id_tarif = $_POST['id_tarif'];
                                $tipe_tarif = $_POST['tipe_tarif'];
                                $status = $_POST['status'];
                                $tarif = $_POST['tarif'];


                                mysqli_query($koneksi, "INSERT INTO tarif (id_tarif,tipe,tarif,status) VALUES ('$id_tarif',\"$tipe_tarif\",'$status','$tarif')");
                                // echo "INSERT INTO user (nik,nama,tipe_user,email,no_hp,username,password,alamat,kota) VALUES ('$nik',\"$nama\",'$tipe_user','$email','$no_hp','$user','$password','$alamat','$kota')";
                                if (mysqli_affected_rows($koneksi) > 0) {
                                    echo " 
                                        <div class=\"alert alert-success alert-dismissible fade show\">
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Berhasil diinput
                                        </div>";
                            } else {
                                echo "
                                        <div class=\"alert alert-danger alert-dismissible fade show\" id=alert-tarif>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data</strong> Gagal diinput
                                        </div>";
                            }
                                } elseif ($t == "tarif_edit") { //tombol simpan di #user_add diklik untuk ubah data
                                    $id_tarif = $_POST['id_tarif'];
                                    $tipe_tarif = $_POST['tipe_tarif'];
                                    $status = $_POST['status'];
                                    $tarif = $_POST['tarif'];
                                        
                                    mysqli_query($koneksi, "UPDATE data_tarif SET tipe='$tipe_tarif',tarif='$tarif',status='$status' WHERE id_tarif='$id_tarif'");
                                    if (mysqli_affected_rows($koneksi)) { //data berhasil masuk
                                        echo "<div class=\"alert alert-success alert-dismissible fade show\" id=alert-tarif>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> berhasil diubah....
                                            </div>";
                                    } else { //data gagal masuk
                                        echo "<div class=\"alert alert-success alert-dismissible fade show\" id=alert-tarif>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data</strong> tidak ada perubahan....
                                            </div>";
                                    }
                                } elseif ($t == "tarif_hapus") { 
                                
                                    if (isset($_POST['id_tarif'])) {
                                        $id_tarif = $_POST['id_tarif'];
                                        mysqli_query($koneksi, "DELETE FROM data_tarif WHERE id_tarif='$id_tarif'");
                                        if (mysqli_affected_rows($koneksi)) 
                                        { 
                                            echo "<div class=\"alert alert-success alert-dismissible fade show\">
                                                    <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                    <strong>Berhasil</strong> Oke! Data sudah dihapus
                                                </div>";
                                        } 
                                        else 
                                        { 
                                            echo "<div class=\"alert alert-success alert-dismissible fade show\">
                                                    <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                    <strong>Gagal</strong> Siap! Tidak jadi hapus data
                                                </div>";
                                        }
                                    }
                                } elseif ($t == "catat_meter_add") { //tombol simpan di #user_add diklik untuk ubah data
                                    $id_pelanggan = $_POST['id_pelanggan'];
                                    $meter_awal = $_POST['meter_awal'];
                                    $meter_akhir = $_POST['meter_akhir'];
                                    $date = $_POST['date'];
                                    $waktu = isset($_POST['waktu']) ? $_POST['waktu'] : '';
        
                                    if($meter_akhir < $meter_awal){
                                        echo "<div class=\"alert alert-danger alert-dismissible fade show\" id=alert-catat_meter>
                                        <button type=button class=btn-close data-bs-dismiss=alert></button>
                                        <strong>Maaf!</strong><strong>Data Meter Akhir</strong>Tidak Boleh Lebih Kecil Dari Meter Awal
                                    </div>";
                                    } else { 
                                        $pemakaian=$meter_akhir - $meter_awal;
                                        $id_pencatat = $air->sesi_to_nik ($_SESSION['user']);
                                        //masukkan data ke tabel meter
                                        mysqli_query ( $koneksi, "INSERT into data_meter (id_pelanggan,meter_awal,meter_akhir,pemakaian,date,waktu,id_pencatat) VALUES ('$id_pelanggan','$meter_awal','$meter_akhir','$pemakaian','$date','$waktu','$id_pencatat')");
                                        if (mysqli_affected_rows($koneksi)) { //data berhasil masuk
                                        echo "<div class=\"alert alert-success alert-dismissible fade show\">
                                        <button type=button class=btn-close data-bs-dismiss=alert></button>
                                        <strong>Data Meter</strong> Berhasil di Input
                                                </div>";
                                        } else { //data gagal masuk
                                            echo "<div class=\"alert alert-danger alert-dismissible fade show\" id=alert-catat_meter>
                                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                                            <strong>Data Meter</strong> Gagal di Input
                                        </div>";
                                        }
                                    }
                                    
                                } elseif ($t == "catat_meter_edit") { //tombol simpan di #user_add diklik untuk ubah data
                                    $id_meter= $_POST['id_meter'];
                                    $id_pelanggan = $_POST['id_pelanggan'];
                                    $meter_awal = $_POST['meter_awal'];
                                    $meter_akhir = $_POST['meter_akhir'];
                                    $date = $_POST['date'];
                                   $waktu = isset($_POST['waktu']) ? $_POST['waktu'] : '';
        
                                if($meter_akhir < $meter_awal) {
                                        echo "<div class=\"alert alert-danger alert-dismissible fade show\" id=alert-catat_meter>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Maaf!</strong><strong>Data Meter Akhir</strong>Tidak Boleh Lebih Kecil Dari Meter Awal
                                            </div>";
                                    } else{
                                        $pemakaian=$meter_akhir - $meter_awal;
                                        $id_pencatat = $air->sesi_to_nik ($_SESSION['user']);
    
                                        mysqli_query($koneksi, "UPDATE data_meter SET id_pelanggan='$id_pelanggan',meter_awal='$meter_awal',meter_akhir='$meter_akhir',pemakaian='$pemakaian',date='$date',waktu='$waktu',id_pencatat='$id_pencatat' WHERE id_meter='$id_meter'");
                                        if (mysqli_affected_rows($koneksi)) { //data berhasil masuk
                                        echo "<div class=\"alert alert-success alert-dismissible fade show\" id=alert-catat_meter>
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data Meter</strong> Berhasil diubah
                                            </div>";
                                    } else { //data gagal masuk
                                        echo "<div class=\"alert alert-danger alert-dismissible fade show\" id=alert-catat_meter>
                                        <button type=button class=btn-close data-bs-dismiss=alert></button>
                                        <strong>Ubah Data Meter</strong> Tidak Berhasil
                                    </div>";
                                    }
        
                                    }
        
                                    
                                } elseif ($t == "catat_meter_hapus") {
                                    $id_meter = $_POST['id_meter'];
                                    mysqli_query($koneksi, "DELETE FROM data_meter WHERE id_meter='$id_meter'");
                                    if (mysqli_affected_rows($koneksi)) { //data berhasil dihapus
                                        echo "<div class=\"alert alert-success alert-dismissible fade show\">
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Data Meter</strong> Berhasil Dihapus
                                            </div>";
                                    } else { //data gagal masuk
                                        echo "<div class=\"alert alert-danger alert-dismissible fade show\" id=alert-user>
                                        <button type=button class=btn-close data-bs-dismiss=alert></button>
                                        <strong>Data Meter</strong> Tidak Jadi Dihapus
                                    </div>";
                                    }
                                }
                        } elseif (isset($_GET['p'])) { //tombol ubah di #user_list diklik
                            $p = $_GET['p'];
                            if ($p == "user_edit") {
                                // echo "masuk sini";
                                $nik = $_GET['nik'];
                                
                                $q = mysqli_query($koneksi, "SELECT nama,tipe_user,email,no_hp,password,username,alamat,kota FROM data_user WHERE nik='$nik'");
                                $d = mysqli_fetch_row($q);
                                $nama = $d[0];
                                $tipe_user = $d[1];
                                $email = $d[2];
                                $no_hp = $d[3];
                                $pass = $d[4];
                                $user = $d[5];
                                $alamat = $d[6];
                                $kota = $d[7];
                            } elseif($p == "tarif") {
                                $id_tarif = ""; 
                                $status = "";
                            } elseif($p == "tarif_edit") {
                                $id_tarif = $_GET['id_tarif']; 
                                $q = mysqli_query($koneksi, "SELECT tipe,status,tarif FROM data_tarif WHERE id_tarif='$id_tarif'");
                                $d = mysqli_fetch_row($q);
                                $tipe_tarif = $d[0];
                                $status = $d[1];
                                $tarif = $d[2];
                            } elseif ($p == "catat_meter") {
                                $id_pelanggan ="";
                            } elseif ($p == "catat_meter_edit") {
                                $id_meter = $_GET['id_meter'];
                                $q = mysqli_query($koneksi, "SELECT id_pelanggan,meter_awal,meter_akhir,pemakaian,date,waktu FROM data_meter WHERE id_meter='$id_meter'");
                                $d = mysqli_fetch_row($q);
                                $id_pelanggan = $d[0];
                                $meter_awal = $d[1];
                                $meter_akhir = $d[2];
                                $pemakaian = $d[3];
                                $date = $d[4];
                                $waktu = $d[5];
                            }
                        }
                        ?>
                    <div class="card mb-4" id="user_add">
                        <div class="card-header">
                            <i class="fa-solid fa-user-plus"></i> User
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="needs-validation" id="user_form">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK:</label>
                                    <input type="text" class="form-control" id="nik" placeholder="Masukkan NIK" name="nik" value="<?php echo $nik ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Nama" class="form-label">Nama:</label>
                                    <input type="text" class="form-control" id="Nama" placeholder="Masukkan Nama" name="Nama" value="<?php echo $nama ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="Alamat" class="form-label">Alamat:</label>
                                    <input type="text" class="form-control" id="Alamat" placeholder="Masukkan Alamat" name="Alamat" value="<?php echo $alamat ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="Kota" class="form-label">Kota:</label>
                                    <input type="text" class="form-control" id="Kota" placeholder="Masukkan Kota" name="Kota" value="<?php echo $kota ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tipe_user" class="form-label">Tipe User:</label>
                                    <select class="form-select form-select-sm" name="tipe_user">
                                        <option value="">Tipe User</option>
                                        <?php
                                        $tu = array("admin", "petugas", "bendahara", "warga");
                                        foreach ($tu as $tu2) {
                                            if ($tipe_user == $tu2) $sel = "SELECTED";
                                            else $sel = "";
                                            echo "<option value=$tu2 $sel>" . ucwords($tu2) . "</option>";
                                        }
                                        ?>

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telephone" class="form-label">Telephone:</label>
                                        <input type="text" class="form-control" id="no_hp" placeholder="Enter Nomor Telepon" name="no_hp" value="<?php echo $no_hp ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username:</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" value="<?php echo $user ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pwd" class="form-label">Password:</label>
                                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" value="<?php echo $pass ?>" name="pswd">
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat">Alamat:</label>
                                        <textarea class="form-control" rows="4" id="alamat" name="alamat"><?php echo $alamat ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kota" class="form-label">Kota:</label>
                                        <input type="text" class="form-control" id="kota" placeholder="Enter Kota" name="kota" value="<?php echo $kota ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" name="tombol" value="user_add">Simpan</button>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-4" id="tarif_add">
                            <div class="card-header">
                                <i class="fa-solid fa-sack-dollar"></i> Tarif 
                            </div>
                            <div class="card-body">
                                <form action="" method="post" class="needs-validation" id="tarif_form">

                                    <div class=" mb-3">
                                        <label for="id_tarif" class="form-label">ID Tarif:</label>
                                        <input type="text" class="form-control" id="id_tarif" placeholder="Enter ID Tarif" name="id_tarif" value="<?php echo $id_tarif ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tipe_tarif" class="form-label">Tipe Tarif:</label>
                                        <select class="form-select" name="tipe_tarif">
                                            <option value="">Tipe Tarif</option>
                                            <?php
                                            $tt = array("rumah", "kos");
                                            foreach ($tt as $tt2) {
                                                if ($tipe_tarif == $tt2) $sel = "SELECTED";
                                                else $sel = "";
                                                echo "<option value=$tt2 $sel>" . ucwords($tt2) . "</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="tarif" class="form-label">Tarif:</label>
                                        <input type="number" class="form-control" id="tarif" placeholder="Enter Tarif" name="tarif" value="<?php echo $tarif ?>">
                                    </div>
                                    <?php
                                    $st=array("AKTIF", "TIDAK AKTIF");
                                    foreach($st as $st2) {
                                        if ($status == $st2) $sel = "CHECKED";
                                        else $sel = "";
                                        echo "<div class=\"form-check form-check-inline\">
                                                <input type=radio class=form-check-input id=radio1 name=status value=\"$st2\" $sel>
                                                <label class=form-check-label for=status>$st2</label>
                                            </div>";
                                    }
                                    ?>
                                    <div class="mt-3">
                                        <button type="submit"class="btn btn-primary btn-block" name="tombol" value="tarif_add">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-4" id="catat_meter_add">
                            <div class="card-header">
                                <i class="fa-solid fa-truck-droplet"></i> Catat Meter
                            </div>
                            <div class="card-body"></div>
                                 <form action="" method="post" class="needs-validation" id="catat_meter_form">
                                    <div class="mb-3">
                                        <label for="tipe_tarif" class="form-label">Nama Pelanggan:</label>
                                        <select class="form-select" name="id_pelanggan" required>
                                            <option value="">Nama Pelanggan</option>
                                            <?php
                                            $q=mysqli_query($koneksi,"SELECT nik,nama FROM data_user WHERE tipe_user='warga' ORDER BY nama ASC");
                                            while ($d=mysqli_fetch_row($q)) {
                                                if ($id_pelanggan == $d[0]) $sel = "SELECTED";
                                                else $sel = "";
                                                echo "<option value=$d[0] $sel>" . ucwords($d[1]) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="meter_awal" class="form-label">Meter Awal (m<sup>3</sup>):</label>
                                        <input type="number" class="form-control" min="0" id="meter_awal" placeholder="Enter Meter Awal" name="meter_awal" value="<?php echo $meter_awal ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="meter_akhir" class="form-label">Meter Akhir (m<sup>3</sup>):</label>
                                        <input type="number" class="form-control" min="0" id="meter_akhir" placeholder="Enter Meter Akhir" name="meter_akhir" value="<?php echo $meter_akhir ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Tanggal:</label>
                                        <input type="date" class="form-control" id="date" placeholder="Enter Tanggal" name="date" value="<?php echo $date ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="waktu" class="form-label">Waktu:</label>
                                        <input type="time" class="form-control" id="waktu" placeholder="Enter Waktu" name="waktu" value="<?php echo $waktu ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary " name="tombol" value="catat_meter_add">Simpan</button>
                            </form>
                        </div>
                     </div>
                        <!-- The Modal -->
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body"></div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <form method="post">
                                            <button type="submit" name="tombol" value="user_hapus" class="btn btn-danger" data-bs-dismiss="modal">Ya</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tidak</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-4" id="user_list">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data User
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Tipe User</th>
                                            <th>Telephone</th>
                                            <th>Username</th>
                                            <th>Edit/Hapus</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($koneksi, "SELECT nik,nama,tipe_user,email,no_hp,username FROM data_user ORDER BY tipe_user ASC,nama ASC");
                                        while ($d = mysqli_fetch_row($q)) {
                                            $nik = $d[0];
                                            $nama = $d[1];
                                            $tipe_user2 = $d[2];
                                            $email = $d[3];
                                            $no_hp = $d[4];
                                            $username2 = $d[5];
                                            echo "<tr>
                                                    <td>$nik</td>
                                                    <td>$nama</td>
                                                    <td>$tipe_user</td>                                                
                                                    <td>$no_hp</td>
                                                    <td>$username2</td>
                                                    <td>
                                                        <a href=index.php?p=user_edit&nik=$nik><button type=button class=\"btn btn-outline-success btn-sm\" onclick>Ubah</button></a>
                                                        <button type=button class=\"btn btn-outline-danger btn-sm\" data-bs-toggle=modal data-bs-target=#myModal data-nik=$nik>Hapus</button>
                                                    </td>
                                                </tr>";
                                        }
                                        ?>

                                    </tbody>
                                    </table>
                                </div>
                        </div>
                        <div class="card mb-4" id="tarif_list">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Data Tarif
                                </div>
                                <div class="card-body">
                                    <table id="tarif_table">
                                        <thead>
                                            <tr>
                                                <th>ID Tarif</th>
                                                <th>Tipe Tarif</th>
                                                <th>Tarif</th>
                                                <th>Status</th>
                                                <th>Edit Data</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                            $q = mysqli_query($koneksi, "SELECT id_tarif,tipe,tarif,status FROM data_tarif ORDER BY id_tarif ASC");
                                            while ($d = mysqli_fetch_row($q)) {
                                                $id_tarif= $d[0];
                                                $tipe_tarif= $d[1];
                                                $status= $d[2];
                                                $tarif= $d[3];

                                                echo "<tr>
                                                        <td>$id_tarif</td>
                                                        <td>$tipe_tarif</td>
                                                        <td>$status</td>
                                                        <td>$tarif</td>
                                                        <td>
                                                        <a href=index.php?p=tarif_edit&id_tarif=$id_tarif><button type=button class=\"btn btn-sm btn-outline-primary\">Ubah</button></a>
                                                        <button type=button class=\"btn btn-sm btn-outline-danger\" data-bs-toggle=modal data-bs-target=#myModal data-id_tarif=$id_tarif>Hapus</button>
                                                        </td>
                                                    </tr>";
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4" id="catat_meter_list">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Data Pemakaian Air
                                </div>
                                <div class="card-body">
                                    <table id="catat_meter_table">
                                        <thead>
                                            <tr>
                                            <th>Nama Pelanggan</th>
                                            <th>Meter Awal (m<sup>3</sup>) </th>
                                            <th>Meter Akhir (m<sup>3</sup>) </th>
                                            <th>Pemakaian (m<sup>3</sup>) </th>
                                            <th>Datetime</th>
                                            <th>Petugas Pencatat</th>
                                            <th>Edit Data</th>
                                            </tr>
                                            </thead>
                                    <tbody>
                                        <?php
                                        $q = mysqli_query($koneksi, "SELECT * FROM data_meter ORDER BY date DESC");
                                        while ($d = mysqli_fetch_row($q)) {
                                            $id_meter = $d[0];
                                            $id_pelanggan = ucwords($air->nik_to_nama($d[1]));
                                            $meter_awal = $d[2];
                                            $meter_akhir = $d[3];
                                            $pemakaian = $d[4];
                                            $date = $air->date_balik($d[5]);
                                            $waktu = date("H:i:s", strtotime($d[6]));
                                            $id_pencatat = ucwords($air->nik_to_nama($d[7]));

                                            echo "<tr>
                                                    <td>$id_pelanggan</td>
                                                    <td>$meter_awal</td>
                                                    <td>$meter_akhir</td>
                                                    <td>$pemakaian</td>
                                                    <td>$date $waktu</td>
                                                    <td>$id_pencatat</td>
                                                    <td>
                                                        <a href='index.php?p=catat_meter_edit&id_meter=$id_meter' class='btn btn-success btn-sm me-1'>Ubah</a>
                                                        <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#myModal' data-id_meter='$id_meter'>Hapus</button>
                                                    </td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <style>
                        .container-fluid {
                            font-family:Cochin;
                            font-size: 1.1rem;
                        }
                        </style>    
                                    
                </main>
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
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="../js/air.js"></script>
    </body>

    </html>