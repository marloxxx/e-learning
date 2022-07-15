<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$id_mapel = $_GET['id_mapel'];
$sql = "SELECT * FROM tb_m_materi WHERE id_mapel = $id_mapel";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card mb-4">
    <div class="card-header">List Materi</div>
    <div class="card-body">
        <table id="datatables" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Materi</th>
                    <th>Deskripsi</th>
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
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('guru/submateri/?id_materi=' . $row['id_materi']) ?>" class="btn btn-primary">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    Tambah Sub Materi
                                </a>
                                <a href="javascript:;" onclick="handle_open_modal('<?= base_url('guru/materi/edit.php?id_mapel=' . $id_mapel . '&id=' . $row['id_materi']) ?>',  '#modalListResult', '#contentListResult')" class="btn btn-warning">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Ubah
                                </a>
                                <?php
                                $id = [
                                    'id_materi' => $row['id_materi'],
                                    'id_mapel' => $id_mapel
                                ]
                                ?>
                                <a href="javascript:;" onclick="hapus('<?= join(',', $id);  ?>', '<?= base_url('guru/materi/function.php') ?>')" class="btn btn-danger">
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