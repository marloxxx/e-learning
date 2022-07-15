<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'tambah') {
    $id_mapel = htmlspecialchars($_POST['id_mapel']);
    $judul = htmlspecialchars($_POST['judul']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    if (empty($judul)) {
        $response = array(
            'status' => 'error',
            'message' => 'Judul tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($deskripsi)) {
        $response = array(
            'status' => 'error',
            'message' => 'Deskripsi tidak boleh kosong'
        );
        echo json_encode($response);
    } else {
        //   insert data using PDO
        $sql = "INSERT INTO tb_m_materi (id_mapel, judul, deskripsi) VALUES ('$id_mapel', '$judul', '$deskripsi')";
        $query = $con->prepare($sql);
        $query->execute();
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Berhasil menambahkan data',
                'url' =>  BASE_URL . 'guru/materi/list.php?id_mapel=' . $id_mapel,
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
    $id_mapel = htmlspecialchars($_POST['id_mapel']);
    $judul = htmlspecialchars($_POST['judul']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    if (empty($judul)) {
        $response = array(
            'status' => 'error',
            'message' => 'Judul tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($deskripsi)) {
        $response = array(
            'status' => 'error',
            'message' => 'Deskripsi tidak boleh kosong'
        );
        echo json_encode($response);
    } else {
        //   insert data using PDO
        $sql = "UPDATE tb_m_materi SET judul = '$judul', deskripsi = '$deskripsi' WHERE id_materi = '$id'";
        $query = $con->prepare($sql);
        $query->execute();
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Berhasil mengubah data',
                'url' =>  BASE_URL . 'guru/materi/list.php?id_mapel=' . $id_mapel,
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
    $id_mapel = htmlspecialchars($_POST['id'][1]);
    //   Delete data using PDO
    $sql = "DELETE FROM tb_m_materi WHERE id_materi = '$id'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Berhasil menghapus data',
            'url' =>  BASE_URL . 'guru/materi/list.php?id_mapel=' . $id_mapel,
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
