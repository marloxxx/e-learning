<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'tambah') {
    $judul = htmlspecialchars($_POST['judul']);
    $id_materi = htmlspecialchars($_POST['materi']);
    $waktu = htmlspecialchars($_POST['waktu']);
    $jumlah = htmlspecialchars($_POST['jumlah_soal']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    if (empty($judul)) {
        $response = array(
            'status' => 'error',
            'message' => 'Judul tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($id_materi)) {
        $response = array(
            'status' => 'error',
            'message' => 'Materi tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($waktu)) {
        $response = array(
            'status' => 'error',
            'message' => 'Waktu tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($jumlah)) {
        $response = array(
            'status' => 'error',
            'message' => 'Jumlah soal tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($tanggal)) {
        $response = array(
            'status' => 'error',
            'message' => 'Tanggal tidak boleh kosong'
        );
        echo json_encode($response);
    } else {
        //   insert data using PDO
        $sql = "INSERT INTO tb_m_kuis (id_materi, judul, waktu, jumlah_soal, waktu_mulai) VALUES ('$id_materi', '$judul', '$waktu', '$jumlah', '$tanggal')";
        $query = $con->prepare($sql);
        $query->execute();
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Berhasil menambahkan data',
                'url' =>  BASE_URL . 'guru/kuis/list.php',
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
    $judul = htmlspecialchars($_POST['judul']);
    $id_materi = htmlspecialchars($_POST['materi']);
    $waktu = htmlspecialchars($_POST['waktu']);
    $jumlah = htmlspecialchars($_POST['jumlah_soal']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    if (empty($judul)) {
        $response = array(
            'status' => 'error',
            'message' => 'Judul tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($id_materi)) {
        $response = array(
            'status' => 'error',
            'message' => 'Materi tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($waktu)) {
        $response = array(
            'status' => 'error',
            'message' => 'Waktu tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($jumlah)) {
        $response = array(
            'status' => 'error',
            'message' => 'Jumlah soal tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($tanggal)) {
        $response = array(
            'status' => 'error',
            'message' => 'Tanggal tidak boleh kosong'
        );
        echo json_encode($response);
    } else {
        //   insert data using PDO
        $sql = "UPDATE tb_m_kuis SET id_materi = '$id_materi', judul = '$judul', waktu = '$waktu', jumlah_soal = '$jumlah', tanggal = '$tanggal' WHERE id_kuis = '$id'";
        $query = $con->prepare($sql);
        $query->execute();
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Berhasil mengubah data',
                'url' =>  BASE_URL . 'guru/kuis/list.php',
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
    $id = htmlspecialchars($_POST['id']);
    //   Delete data using PDO
    $sql = "DELETE FROM tb_m_kuis WHERE id_kuis = '$id'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Berhasil menghapus data',
            'url' =>  BASE_URL . 'guru/kuis/list.php',
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
