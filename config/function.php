<?php
define('BASE_URL', 'http://localhost/e-learning/');
function base_url($url = null)
{
    if ($url != null) {
        echo BASE_URL . $url;
    } else {
        echo BASE_URL;
    }
}
function antiinjeksi($text)
{
    global $mysqli;
    $safetext = $mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($text, ENT_QUOTES))));
    return $safetext;
}
function getDay($date)
{
    // ambil hari, tanggal dan tahun
    $day = date('D', strtotime($date));
    $dayList = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
    );
    $month = date('M', strtotime($date));
    $monthList = array(
        'Jan' => 'Januari',
        'Feb' => 'Februari',
        'Mar' => 'Maret',
        'Apr' => 'April',
        'May' => 'Mei',
        'Jun' => 'Juni',
        'Jul' => 'Juli',
        'Aug' => 'Agustus',
        'Sep' => 'September',
        'Oct' => 'Oktober',
        'Nov' => 'November',
        'Dec' => 'Desember'
    );
    $year = date('Y', strtotime($date));
    // hasilkan hari dengan format indonesia
    $result = $dayList[$day] . ', ' . $monthList[$month] . ' ' . $year;
    return $result;
}
function getMinute($date)
{
    $minute = date('i', strtotime($date));
    return $minute;
}
function validasi($str, $tipe)
{
    switch ($tipe) {
        default:
        case 'sql':
            $str = stripcslashes($str);
            $str = htmlspecialchars($str);
            $str = preg_replace('/[^A-Za-z0-9]/', '', $str);
            return intval($str);
            break;
        case 'xss':
            $str = stripcslashes($str);
            $str = htmlspecialchars($str);
            $str = preg_replace('/[\W]/', '', $str);
            return $str;
            break;
    }
}

function extension($path)
{
    $file = pathinfo($path);
    if (file_exists($file['dirname'] . '/' . $file['basename'])) {
        return $file['basename'];
    }
}

function redirect($role)
{
    if ($role == 'admin') {
        header('location: ' . BASE_URL . 'admin/dashboard/');
    } elseif ($role == 'guru') {
        header('location: ' . BASE_URL . 'guru/dashboard/');
    } elseif ($role == 'siswa') {
        header('location: ' . BASE_URL . 'siswa/dashboard/');
    } else {
        header('location: ' . BASE_URL);
    }
}

function cek_login()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

function logout()
{
    session_destroy();
    header('location: ' . BASE_URL);
}
function relation($table, $id, $field)
{
    global $con;
    $sql = "SELECT * FROM $table WHERE $field = $id";
    $query = $con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function getJawaban($id)
{
    global $con;
    $sql = "SELECT * FROM tb_d_jawaban WHERE id_soal = $id AND id_siswa = " . $_SESSION['user']['id'];
    $query = $con->query($sql);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if ($data) {
        return $data['jawaban'];
    } else {
        return null;
    }
    return $data;
}
