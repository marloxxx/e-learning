<?php
session_start();
require_once('koneksi.php');
require_once('function.php');
global $con;
header('Content-Type: application/json');
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$role = htmlspecialchars($_POST['role']);
if (empty($username)) {
    $response = array(
        'status' => 'error',
        'message' => 'Username tidak boleh kosong'
    );
    echo json_encode($response);
} elseif (empty($password)) {
    $response = array(
        'status' => 'error',
        'message' => 'Password tidak boleh kosong'
    );
    echo json_encode($response);
} else {
    if ($role == 'siswa') {
        $sql = "SELECT * FROM tb_m_siswa JOIN tb_m_kelas ON tb_m_siswa.id_kelas = tb_m_kelas.id_kelas WHERE username = :username";
        $query = $con->prepare($sql);
        $query->bindParam(':username', $username);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() > 0) {
            if ($result['status'] == 'aktif') {
                if (password_verify($password, $result['password'])) {
                    $_SESSION['user'] = array(
                        'id' => $result['id_siswa'],
                        'nama' => $result['nama'],
                        'username' => $result['username'],
                        'nisn' => $result['nisn'],
                        'email' => $result['email'],
                        'id_kelas' => $result['id_kelas'],
                        'nama_kelas' => $result['nama_kelas'],
                        'photo' => $result['photo'],
                        'role' => $role
                    );
                    $response = array(
                        'status' => 'success',
                        'message' => 'Login berhasil',
                        'url' => BASE_URL . 'siswa/dashboard'
                    );
                    echo json_encode($response);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Password salah'
                    );
                    echo json_encode($response);
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Username tidak ditemukan'
                );
                echo json_encode($response);
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Username tidak terdaftar'
            );
            echo json_encode($response);
        }
    } elseif ($role == 'guru') {
        $sql = "SELECT * FROM tb_m_guru WHERE username = :username";
        $query = $con->prepare($sql);
        $query->bindParam(':username', $username);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() > 0) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user'] = array(
                    'id' => $result['id_guru'],
                    'username' => $result['username'],
                    'role' => $role,
                    'nama' => $result['nama'],
                    'email' => $result['email'],
                    'nip' => $result['nip'],
                    'photo' => $result['photo']
                );
                $response = array(
                    'status' => 'success',
                    'message' => 'Login berhasil',
                    'url' => BASE_URL . 'guru/dashboard'
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Password salah'
                );
                echo json_encode($response);
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Username tidak terdaftar'
            );
            echo json_encode($response);
        }
    } elseif ($role == 'admin') {
        $sql = "SELECT * FROM tb_m_admin WHERE username = :username";
        $query = $con->prepare($sql);
        $query->bindParam(':username', $username);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() > 0) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user'] = array(
                    'id' => $result['id_admin'],
                    'username' => $result['username'],
                    'role' => $role,
                    'nama' => $result['nama'],
                    'email' => $result['email'],
                    'photo' => $result['photo']
                );
                $response = array(
                    'status' => 'success',
                    'message' => 'Login berhasil',
                    'url' => BASE_URL . 'admin/dashboard/'
                );
                echo json_encode($response);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Password salah'
                );
                echo json_encode($response);
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Username tidak terdaftar'
            );
            echo json_encode($response);
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Role tidak ditemukan'
        );
        echo json_encode($response);
    }
}
