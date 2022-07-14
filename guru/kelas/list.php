<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$sql = "SELECT * FROM tb_m_kelas";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card mb-4">
    <div class="card-header">List Kelas</div>
    <div class="card-body">
        <table id="datatables" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
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
                        <td>
                            <div class="btn-group" role="group">
                                <a href="javascript:;" onclick="handle_open_modal('<?= base_url('guru/kelas/edit.php?id=' . $row['id_kelas']) ?>',  '#modalListResult', '#contentListResult')" class="btn btn-warning">
                                    <span class="symbol-btn-group">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Ubah
                                </a>
                                <a href="javascript:;" onclick="hapus('<?= $row['id_kelas'] ?>', '<?= base_url('guru/kelas/function.php') ?>')" class="btn btn-danger">
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