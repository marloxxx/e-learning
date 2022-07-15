<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'upload') {
    $id = $_SESSION['user']['id'];
    $image = time() . '.' .  explode('.', $_FILES['photo']['name'])[1];
    move_uploaded_file($_FILES['photo']['tmp_name'], '../../assets/img/profile/' . $image);
    $sql = "UPDATE tb_m_admin SET photo = '$image' WHERE id_admin = '$id'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $_SESSION['user']['photo'] = $image;
        $response = array(
            'status' => 'success',
            'message' => 'Berhasil mengubah foto',
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Gagal mengubah foto'
        );
        echo json_encode($response);
    }
} elseif ($_POST['action'] == 'update') {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $id = $_SESSION['user']['id'];
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
    } else {
        if ($password != $confirm_password) {
            $response = array(
                'status' => 'error',
                'message' => 'Password tidak sama'
            );
            echo json_encode($response);
        } else {
            if ($password != $confirm_password) {
                $response = array(
                    'status' => 'error',
                    'message' => 'Password tidak sama'
                );
                echo json_encode($response);
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                //    Update data using PDO
                $sql = "UPDATE tb_m_admin SET nama = '$nama', username = '$username', email = '$email', password = '$password' WHERE id_admin = '$id'";
                $query = $con->prepare($sql);
                $query->execute();
                if ($query) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Berhasil mengubah data',
                    );
                    echo json_encode($response);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Gagal mengubah data'
                    );
                    echo json_encode($response);
                }
            }
        }
    }
}
