<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$sql = "SELECT * FROM tb_m_kuis";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card mb-4">
    <div class="card-header">List Kuis</div>
    <div class="card-body">
        <table id="datatables" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Materi</th>
                    <th>Waktu</th>
                    <th>Jumlah Soal</th>
                    <th>Tanggal Mulai</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($result as $row) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo relation('tb_m_materi', 'id_materi', $row['id_materi'])['judul']; ?></td>
                        <td><?php echo $row['waktu']; ?></td>
                        <td><?php echo $row['jumlah_soal']; ?></td>
                        <td><?php echo $row['waktu_mulai']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('guru/soal/?id_kuis=' . $row['id_kuis']) ?>" class="btn btn-primary">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    Tambah Soal
                                </a>
                                <a href="javascript:;" onclick="load_input('<?= base_url('guru/kuis/edit.php?id=' . $row['id_guru']) ?>')" class="btn btn-warning">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Ubah
                                </a>
                                <a href="javascript:;" onclick="hapus('<?= $row['id_guru'] ?>', '<?= base_url('guru/kuis/function.php') ?>')" class="btn btn-danger">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>