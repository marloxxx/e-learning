<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
global $con;
header('Content-Type: application/json');
if ($_POST['action'] == 'update') {
    $id_siswa = htmlspecialchars($_POST['id_siswa']);
    $status = htmlspecialchars($_POST['status']);
    if (empty($status)) {
        $response = array(
            'status' => 'error',
            'message' => 'Judul tidak boleh kosong'
        );
        echo json_encode($response);
    } else {
        //   update data using PDO
        $sql = "UPDATE tb_m_siswa SET status = '$status' WHERE id_siswa = '$id_siswa'";
        $query = $con->prepare($sql);
        $query->execute();
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Berhasil memperbarui status',
                'url' =>  BASE_URL . 'guru/siswa/list.php'
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Gagal memperbarui status'
            );
            echo json_encode($response);
        }
    }
}
