<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$id_materi = $_GET['id_materi'];
$sql = "SELECT * FROM tb_r_submateri WHERE id_materi = '$id_materi'";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card mb-4">
    <div class="card-header">List Sub Materi</div>
    <div class="card-body">
        <table id="datatables" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Sub Materi</th>
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
                                <a href="<?= base_url('guru/konten/?id_submateri=' . $row['id_submateri']) ?>" class="btn btn-primary">
                                    <span class="symbol-btn-group">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    Tambah Konten
                                </a>
                                <a href="javascript:;" onclick="handle_open_modal('<?= base_url('guru/submateri/edit.php?id_materi=' . $id . '&id=' . $row['id_submateri']) ?>',  '#modalListResult', '#contentListResult')" class="btn btn-warning">
                                    <span class="symbol-btn-group">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Ubah
                                </a>
                                <?php
                                $id = [
                                    'id_submateri' => $row['id_submateri'],
                                    'id_materi' => $id_materi
                                ]
                                ?>
                                <a href="javascript:;" onclick="hapus('<?= join(',', $id); ?>', '<?= base_url('guru/submateri/function.php') ?>')" class="btn btn-danger">
                                    <span class="symbol-btn-group">
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