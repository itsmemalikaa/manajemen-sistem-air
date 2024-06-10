<?php
class klas_air
{
    function koneksi()
    {
       $koneksi = mysqli_connect("localhost", "webq3894_irmamalika", "#Irmalika_123#", "webq3894_irmamalika");
        return $koneksi;
    }
    function tipe_user($sesi_user)
    {
        $q = mysqli_query($this->koneksi(), "SELECT tipe_user FROM data_user WHERE username='$sesi_user'");
        $d = mysqli_fetch_row($q);
        return $d[0];
    }
    function dt_user($sesi_user)
    {
        $q = mysqli_query($this->koneksi(), "SELECT nama,kota,tipe_user FROM data_user WHERE username='$sesi_user'");
        $d = mysqli_fetch_row($q);
        return $d;
    }
    function sesi_to_nik($sesi)
    {
        $q=mysqli_query($this->koneksi(), "SELECT nik FROM data_user WHERE username='$sesi'");
        $d=mysqli_fetch_row($q);
        return $d[0]; 
    }
    function nik_to_nama($nik)
    {
    $q = mysqli_query($this->koneksi(), "SELECT nama FROM data_user WHERE nik='$nik'");
    $d = mysqli_fetch_row($q);
    if ($d !== null) {
        return $d[0];
    } else {
        return null; // or some default value
    }
    }
    function date_balik($date)
    {
        //2024-05-04 --> 04-05-2024
        $e = explode("-",$date);
        $date_baru = $e[2] . '-' . $e[1] . '-' . $e[0];
        return $date_baru;
    }
}
?>