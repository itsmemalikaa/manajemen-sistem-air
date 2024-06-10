<?php
include "func.php";
$air = new klas_air;
$koneksi = $air->koneksi();

if(isset($_POST['p'])){
    $p=$_POST['p'];
    if ($p == "summary"){
        $q = mysqli_query($koneksi,"SELECT SUM(pemakaian) as pemakaian FROM data_meter");
        $d = mysqli_fetch_array($q);
        $summary[]=array('total_vol'=> $d['pemakaian']);

        $q = mysqli_query($koneksi,"SELECT COUNT(nik) as jml_pelanggan FROM data_user WHERE tipe_user='warga'");
        $d = mysqli_fetch_array($q);
        $summary[]=array('plg_jml'=> $d['jml_pelanggan']);

        $q = mysqli_query($koneksi,"SELECT data_user.nik FROM data_user JOIN data_meter ON data_user.nik=data_meter.id_pelanggan GROUP BY data_user.nik");
        $j = mysqli_num_rows($q);
        $summary[]=array('plg_catat'=> $j);

        echo json_encode($summary);
    }
}
?>