<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'tambah') {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $nip = htmlspecialchars($_POST['nip']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    if (empty($nama)) {
        $response = array(
            'status' => 'error',
            'message' => 'Nama tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($nip)) {
        $response = array(
            'status' => 'error',
            'message' => 'NIP tidak boleh kosong'
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
                //   insert data using PDO
                $sql = "INSERT INTO tb_m_guru (nama, username, nip, email, password) VALUES ('$nama', '$username', '$nip', '$email', '$password')";
                $query = $con->prepare($sql);
                $query->execute();
                if ($query) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Berhasil menambahkan data',
                    );
                    echo json_encode($response);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Gagal menambahkan data'
                    );
                    echo json_encode($response);
                }
            }
        }
    }
} elseif ($_POST['action'] == 'edit') {
    $nama = htmlspecialchars($_POST['nama']);
    $nip = htmlspecialchars($_POST['nip']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $id = htmlspecialchars($_POST['id']);
    if (empty($nama)) {
        $response = array(
            'status' => 'error',
            'message' => 'Nama tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($nip)) {
        $response = array(
            'status' => 'error',
            'message' => 'NIP tidak boleh kosong'
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
                $sql = "UPDATE tb_m_guru SET nama = '$nama', nip = '$nip', email = '$email', password = '$password' WHERE id_guru = '$id'";
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
} elseif ($_POST['action'] == 'hapus') {
    $id = htmlspecialchars($_POST['id']);
    //   Delete data using PDO
    $sql = "DELETE FROM tb_m_guru WHERE id_guru = '$id'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Berhasil menghapus data',
            'url' =>  BASE_URL . 'admin/guru/list.php',
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Gagal menghapus data'
        );
        echo json_encode($response);
    }
}
