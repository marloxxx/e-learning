<?php
function antiinjeksi($text)
{
    global $mysqli;
    $safetext = $mysqli->real_escape_string(stripslashes(strip_tags(htmlspecialchars($text, ENT_QUOTES))));
    return $safetext;
}
function buatkalender($tanggal, $bulan, $tahun)
{
    $bulanan = array(
        1 => "Januari", "Februari", "Maret", "April",
        "Mei", "Juni", "Juli", "Agustus", "September",
        "Oktober", "November", "Desember"
    );
    $bln = date("n");
    $thn = date("Y");

    $jmlhari = date("t", mktime(0, 0, 0, $bulan, 1, $tahun));
    $haritglsatu = date("w", mktime(0, 0, 0, $bulan, 1, $tahun));

    $kalender = "<table cellspacing=1 cellpadding=4  
                 border=0 class=tabel_data>\n";
    $kalender .= "<tr class=tr_terang>
                 <td colspan=7>$bulanan[$bln], $thn
                 </td></tr>\n";

    $kalender .= "<tr class=tr_judul>
                  <td>M</td><td>S</td><td>S</td><td>R</td>
                  <td>K</td><td>J</td><td>S</td></tr>\n";
    $a       = 1;
    $adabaris   = TRUE;
    $mulaicetak = 0;
    while ($adabaris) {
        $kalender .= "<tr align=center class=tr_terang>";
        for ($i = 0; $i < 7; $i++) {
            if ($mulaicetak < $haritglsatu) {
                $kalender .= "<td>&nbsp;</td>";
                $mulaicetak++;
            } elseif ($a <= $jmlhari) {
                $tt = $a;
                if ($a == $tanggal) {
                    $tt = "<span style='color: blue; font-weight: bold; 
                   font-size: larger; text-decoration: blink;'>
                   $tt</span>";
                }
                if ($i == 0) {
                    $tt = "<font color=\"#FF0000\">$tt</font>";
                }
                $kalender .= "<td>$tt</td>";
                $a++;
            } else {
                $kalender .= "<td>&nbsp;</td>";
            }
        }
        $kalender .= "</tr>\n";
        if ($a <= $jmlhari) {
            $adabaris = TRUE;
        } else {
            $adabaris = FALSE;
        }
    }
    $kalender .= "</table>\n";
    return $kalender;
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

function login($username, $password)
{
    global $mysqli;
    $username = antiinjeksi($username);
    $password = antiinjeksi($password);
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $query = $mysqli->query($sql);
    $row = $query->fetch_array();
    if ($query->num_rows > 0) {
        $_SESSION['user'] = array(
            'id' => $row['id'],
            'username' => $row['username'],
            'password' => $row['password'],
            'level' => $row['level'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'alamat' => $row['alamat'],
            'no_hp' => $row['no_hp'],
            'tgl_lahir' => $row['tgl_lahir'],
            'foto' => $row['foto'],
            'status' => $row['status'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at']
        );
        return true;
    } else {
        return false;
    }
}
function redirect($role)
{
    if ($role == 'admin') {
        header('location: admin/index.php');
    } elseif ($role == 'guru') {
        header('location: guru/index.php');
    } elseif ($role == 'siswa') {
        header('location: siswa/index.php');
    } else {
        header('location: index.php');
    }
}
