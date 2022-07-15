<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$sql = "SELECT * FROM tb_m_mapel";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card mb-4">
    <div class="card-header">List Mata Pelajaran</div>
    <div class="card-body">
        <table id="datatables" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Kelas</th>
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
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo relation('tb_m_kelas', 'id_kelas', $row['id_kelas'])['nama']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('guru/materi/?id_mapel=' . $row['id_mapel']) ?>" class="btn btn-primary">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    Tambah Materi
                                </a>
                                <a href="javascript:;" onclick="handle_open_modal('<?= base_url('guru/mapel/edit.php?id=' . $row['id_mapel']) ?>',  '#modalListResult', '#contentListResult')" class="btn btn-warning">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Ubah
                                </a>
                                <a href="javascript:;" onclick="hapus('<?= $row['id_mapel'] ?>', '<?= base_url('guru/mapel/function.php') ?>')" class="btn btn-danger">
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