<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$id_submateri = $_GET['id_submateri'];
$sql = "SELECT * FROM tb_d_konten WHERE id_submateri = '$id_submateri'";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card mb-4">
    <div class="card-header">List Konten</div>
    <div class="card-body">
        <table id="datatables" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>File Konten</th>
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
                        <td><?php echo $row['file']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="javascript:;" onclick="handle_open_modal('<?= base_url('guru/konten/edit.php?id_id_submateri=' . $id_submateri . '&id=' . $row['id_konten']) ?>',  '#modalListResult', '#contentListResult')" class="btn btn-warning">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Ubah
                                </a>
                                <?php
                                $id = [
                                    'id_konten' => $row['id_konten'],
                                    'id_submateri' => $id_submateri
                                ]
                                ?>
                                <a href="javascript:;" onclick="hapus('<?= join(',', $id); ?>', '<?= base_url('guru/konten/function.php') ?>')" class="btn btn-danger">
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