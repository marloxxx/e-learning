<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'tambah') {
    $id_kuis = htmlspecialchars($_POST['id_kuis']);
    $pertanyaan = htmlspecialchars($_POST['pertanyaan']);
    $opsi_1 = htmlspecialchars($_POST['opsi_1']);
    $nilai_opsi_1 = intval(htmlspecialchars($_POST['nilai_opsi_1']));
    $opsi_2 = htmlspecialchars($_POST['opsi_2']);
    $nilai_opsi_2 = intval(htmlspecialchars($_POST['nilai_opsi_2']));
    $opsi_3 = htmlspecialchars($_POST['opsi_3']);
    $nilai_opsi_3 = intval(htmlspecialchars($_POST['nilai_opsi_3']));
    $opsi_4 = htmlspecialchars($_POST['opsi_4']);
    $nilai_opsi_4 = intval(htmlspecialchars($_POST['nilai_opsi_4']));
    if (empty($pertanyaan)) {
        $response = array(
            'status' => 'error',
            'message' => 'Pertanyaan tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($opsi_1)) {
        $response = array(
            'status' => 'error',
            'message' => 'Opsi 1 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (strlen($nilai_opsi_1) == 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Nilai opsi 1 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($opsi_2)) {
        $response = array(
            'status' => 'error',
            'message' => 'Opsi 2 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (strlen($nilai_opsi_2) == 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Nilai opsi 2 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($opsi_3)) {
        $response = array(
            'status' => 'error',
            'message' => 'Opsi 3 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (strlen($nilai_opsi_3) == 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Nilai opsi 3 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($opsi_4)) {
        $response = array(
            'status' => 'error',
            'message' => 'Opsi 4 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (strlen($nilai_opsi_4) == 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Nilai opsi 4 tidak boleh kosong'
        );
        echo json_encode($response);
    } else {
        //   insert data using PDO
        $sql = "INSERT INTO tb_r_soal (id_kuis, pertanyaan) VALUES ('$id_kuis', '$pertanyaan')";
        $query = $con->prepare($sql);
        $query->execute();
        $id_soal = $con->lastInsertId();
        $sql = "INSERT INTO tb_d_detail_soal (id_soal, opsi_1, nilai_opsi_1, opsi_2, nilai_opsi_2, opsi_3, nilai_opsi_3, opsi_4, nilai_opsi_4) VALUES ('$id_soal', '$opsi_1', '$nilai_opsi_1', '$opsi_2', '$nilai_opsi_2', '$opsi_3', '$nilai_opsi_3', '$opsi_4', '$nilai_opsi_4')";
        $query = $con->prepare($sql);
        $query->execute();
        $response = array(
            'status' => 'success',
            'message' => 'Soal berhasil ditambahkan',
            'url' => BASE_URL . 'guru/soal/list.php?id_kuis=' . $id_kuis
        );
        echo json_encode($response);
    }
} elseif ($_POST['action'] == 'edit') {
    $id_soal = htmlspecialchars($_POST['id_soal']);
    $id_kuis = htmlspecialchars($_POST['id_kuis']);
    $pertanyaan = htmlspecialchars($_POST['pertanyaan']);
    $opsi_1 = htmlspecialchars($_POST['opsi_1']);
    $nilai_opsi_1 = htmlspecialchars($_POST['nilai_opsi_1']);
    $opsi_2 = htmlspecialchars($_POST['opsi_2']);
    $nilai_opsi_2 = htmlspecialchars($_POST['nilai_opsi_2']);
    $opsi_3 = htmlspecialchars($_POST['opsi_3']);
    $nilai_opsi_3 = htmlspecialchars($_POST['nilai_opsi_3']);
    $opsi_4 = htmlspecialchars($_POST['opsi_4']);
    $nilai_opsi_4 = intval(htmlspecialchars($_POST['nilai_opsi_4']));
    if (empty($pertanyaan)) {
        $response = array(
            'status' => 'error',
            'message' => 'Pertanyaan tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($opsi_1)) {
        $response = array(
            'status' => 'error',
            'message' => 'Opsi 1 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (strlen($nilai_opsi_1) == 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Nilai opsi 1 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($opsi_2)) {
        $response = array(
            'status' => 'error',
            'message' => 'Opsi 2 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (strlen($nilai_opsi_2) == 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Nilai opsi 2 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($opsi_3)) {
        $response = array(
            'status' => 'error',
            'message' => 'Opsi 3 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (strlen($nilai_opsi_3) == 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Nilai opsi 3 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (empty($opsi_4)) {
        $response = array(
            'status' => 'error',
            'message' => 'Opsi 4 tidak boleh kosong'
        );
        echo json_encode($response);
    } elseif (strlen($nilai_opsi_4) == 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Nilai opsi 4 tidak boleh kosong'
        );
        echo json_encode($response);
    } else {
        //   insert data using PDO
        $sql = "UPDATE tb_r_soal SET pertanyaan = '$pertanyaan' WHERE id_soal = '$id_soal'";
        $query = $con->prepare($sql);
        $query->execute();
        $sql = "UPDATE tb_d_detail_soal SET opsi_1 = '$opsi_1', nilai_opsi_1 = '$nilai_opsi_1', opsi_2 = '$opsi_2', nilai_opsi_2 = '$nilai_opsi_2', opsi_3 = '$opsi_3', nilai_opsi_3 = '$nilai_opsi_3', opsi_4 = '$opsi_4', nilai_opsi_4 = '$nilai_opsi_4' WHERE id_soal = '$id_soal'";
        $query = $con->prepare($sql);
        $query->execute();
        $response = array(
            'status' => 'success',
            'message' => 'Soal berhasil diubah',
            'url' => BASE_URL . 'guru/soal/list.php?id_kuis=' . $id_kuis
        );
        echo json_encode($response);
    }
} elseif ($_POST['action'] == 'hapus') {
    $id = htmlspecialchars($_POST['id'][0]);
    $id_kuis = htmlspecialchars($_POST['id_kuis'][1]);
    //   Delete data using PDO
    $sql = "DELETE FROM tb_r_soal WHERE id_soal = '$id'";
    $query = $con->prepare($sql);
    $query->execute();
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Berhasil menghapus data',
            'url' =>  BASE_URL . 'guru/soal/list.php?id_kuis=' . $id_kuis
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
