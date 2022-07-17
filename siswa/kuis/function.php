<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'jawab') {
    $id_soal = $_POST['id_soal'];
    $jawaban = $_POST['jawaban'];
    $id_siswa = $_SESSION['user']['id'];
    $sql = "SELECT * FROM tb_d_jawaban WHERE id_soal = '$id_soal' AND id_siswa = '$id_siswa'";
    $query = $con->prepare($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if (empty($data)) {
        $sql = "INSERT INTO tb_d_jawaban (id_soal, id_siswa, jawaban) VALUES ('$id_soal', '$id_siswa', '$jawaban')";
        $query = $con->prepare($sql);
        $query->execute();
        $data = array(
            'status' => 'success',
        );
        echo json_encode($data);
    } else {
        $sql = "UPDATE tb_d_jawaban SET jawaban = '$jawaban' WHERE id_soal = '$id_soal' AND id_siswa = '$id_siswa'";
        $query = $con->prepare($sql);
        $query->execute();
        $data = array(
            'status' => 'success',
        );
        echo json_encode($data);
    }
} elseif ($_POST['action'] == 'selesai') {
    $id_kuis = $_POST['id_kuis'];
    $id_siswa = $_SESSION['user']['id'];
    $jawaban = "SELECT * FROM tb_d_jawaban WHERE id_siswa = '$id_siswa'";
    $nilai = 0;
    foreach ($con->query($jawaban) as $row) {
        if ($row['jawaban'] == 1) {
            $nilai += relation('tb_d_detail_soal', 'id_soal',  $row['id_soal'])['nilai_opsi_1'];
        } elseif ($row['jawaban'] == 2) {
            $nilai += relation('tb_d_detail_soal', 'id_soal',  $row['id_soal'])['nilai_opsi_2'];
        } elseif ($row['jawaban'] == 3) {
            $nilai += relation('tb_d_detail_soal', 'id_soal',  $row['id_soal'])['nilai_opsi_3'];
        } elseif ($row['jawaban'] == 4) {
            $nilai += relation('tb_d_detail_soal', 'id_soal',  $row['id_soal'])['nilai_opsi_4'];
        }
    }
    // insert data baru ke tb_d_nilai
    $sql = "INSERT INTO tb_d_nilai (id_siswa, id_kuis, nilai) VALUES ('$id_siswa', '$id_kuis', '$nilai')";
    $query = $con->prepare($sql);
    $query->execute();
    $data = array(
        'status' => 'success',
        'url' => BASE_URL . 'siswa/kuis/detail.php?id_kuis=' . $id_kuis,
    );
    echo json_encode($data);
}
