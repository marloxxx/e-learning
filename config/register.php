<?php
require_once('koneksi.php');
require_once('function.php');
global $con;
header('Content-Type: application/json');
$nama = htmlspecialchars($_POST['nama']);
$username = htmlspecialchars($_POST['username']);
$nisn = htmlspecialchars($_POST['nisn']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$confirm_password = htmlspecialchars($_POST['confirm_password']);
$kelas = htmlspecialchars($_POST['kelas']);
if (empty($nama)) {
    $response = array(
        'status' => 'error',
        'message' => 'Nama tidak boleh kosong'
    );
    echo json_encode($response);
} elseif (empty($username)) {
    $response = array(
        'status' => 'error',
        'message' => 'Username tidak boleh kosong'
    );
    echo json_encode($response);
} elseif (empty($nisn)) {
    $response = array(
        'status' => 'error',
        'message' => 'NISN tidak boleh kosong'
    );
    echo json_encode($response);
} elseif (empty($email)) {
    $response = array(
        'status' => 'error',
        'message' => 'Email tidak boleh kosong'
    );
    echo json_encode($response);
} elseif (empty($password)) {
    $response = array(
        'status' => 'error',
        'message' => 'Password tidak boleh kosong'
    );
    echo json_encode($response);
} elseif (empty($confirm_password)) {
    $response = array(
        'status' => 'error',
        'message' => 'Konfirmasi password tidak boleh kosong'
    );
    echo json_encode($response);
} elseif ($password != $confirm_password) {
    $response = array(
        'status' => 'error',
        'message' => 'Konfirmasi password tidak sama'
    );
    echo json_encode($response);
} else {
    $sql = "SELECT * FROM tb_m_siswa WHERE username = '$username'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query->rowCount() > 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Username sudah terdaftar'
        );
        echo json_encode($response);
    } else {
        $sql = "SELECT * FROM tb_m_siswa WHERE nisn = '$nisn'";
        $query = $con->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            $response = array(
                'status' => 'error',
                'message' => 'NISN sudah terdaftar'
            );
            echo json_encode($response);
        } else {
            $sql = "SELECT * FROM tb_m_siswa WHERE email = '$email'";
            $query = $con->prepare($sql);
            $query->execute();
            if ($query->rowCount() > 0) {
                $response = array(
                    'status' => 'error',
                    'message' => 'Email sudah terdaftar'
                );
                echo json_encode($response);
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO tb_m_siswa (nama, username, nisn, email, password, id_kelas) VALUES ('$nama', '$username', '$nisn', '$email', '$password', '$kelas')";
                $query = $con->prepare($sql);
                $query->execute();
                if ($query) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Pendaftaran berhasil',
                        'url' => BASE_URL
                    );
                    echo json_encode($response);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Pendaftaran gagal'
                    );
                    echo json_encode($response);
                }
            }
        }
    }
}
