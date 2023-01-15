<?php
include("../connection.php");
session_start();

date_default_timezone_set("Asia/Jakarta");

$employee_id = $_SESSION['employee_id'];
$tgl = date('Y-m-d');
$clock_in = date('H:i:s');

if(isset($_POST['absen'])){
    $check_absensi = "SELECT tgl FROM attendances WHERE employee_id = $employee_id AND tgl='$tgl'";
    
    $check = $db->query($check_absensi);

    if($check->num_rows > 0){
        header("location:index.php?message=Anda sudah");
    } else {
        $sql = "INSERT INTO attendances (id, employee_id, tgl, clock_in, clock_out) values (null, '$employee_id', '$tgl', '$clock_in', null)";
        $result = $db->query($sql);
    if ($result == true){
        header("location:index.php?message=Absen berhasil!");
    } else {
        header("location:index.php?message=Absen gagal!");
    }
    }

}
?>