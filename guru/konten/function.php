<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'tambah') {
    $id_submateri = htmlspecialchars($_POST['id_submateri']);
    $judul = htmlspecialchars($_POST['judul']);
    $file = time() . '.' .  explode('.', $_FILES['file']['name'])[1];
    move_uploaded_file($_FILES['file']['tmp_name'], '../../assets/file/' . $file);
    if (empty($judul)) {
        $response = array(
            'status' => 'error',
            'message' => 'Judul tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($_FILES['file'])) {
        $response = array(
            'status' => 'error',
            'message' => 'Deskripsi tidak boleh kosong'
        );
        echo json_encode($response);
    } else {
        //   insert data using PDO
        $sql = "INSERT INTO tb_d_konten (id_submateri, judul, file) VALUES ('$id_submateri', '$judul', '$file')";
        $query = $con->prepare($sql);
        $query->execute();
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Berhasil menambahkan data',
                'url' =>  BASE_URL . 'guru/konten/list.php?id_submateri=' . $id_submateri,
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
} elseif ($_POST['action'] == 'edit') {
    $id = htmlspecialchars($_POST['id']);
    $id_submateri = htmlspecialchars($_POST['id_submateri']);
    $judul = htmlspecialchars($_POST['judul']);
    $file = time() . '.' .  explode('.', $_FILES['file']['name'])[1];
    move_uploaded_file($_FILES['file']['tmp_name'], '../../assets/file/' . $file);
    if (empty($nama)) {
        $response = array(
            'status' => 'error',
            'message' => 'Nama tidak boleh kosong'
        );
        echo json_encode($response);
    } else {
        //   Update data using PDO
        $sql = "UPDATE tb_d_konten SET judul = '$judul', file = '$file' WHERE id_kontent = '$id'";
        $query = $con->prepare($sql);
        $query->execute();
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Berhasil mengubah data',
                'url' =>  BASE_URL . 'guru/konten/list.php?id_submateri=' . $id_submateri,
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
} elseif ($_POST['action'] == 'hapus') {
    $id = htmlspecialchars($_POST['id'][0]);
    $id_submateri = htmlspecialchars($_POST['id'][1]);
    //   Delete data using PDO
    $sql = "DELETE FROM tb_d_konten WHERE id_kontent = '$id'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Berhasil menghapus data',
            'url' =>  BASE_URL . 'guru/konten/list.php?id_submateri=' . $id_submateri,
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
