<?php
$host    = "localhost";
$user    = "root";
$pass    = "";
$db    = "db_elearning";
$con = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
try {
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Koneksi Gagal: " . $e->getMessage();
}
date_default_timezone_set('Asia/Jakarta');
