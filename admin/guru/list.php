<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$sql = "SELECT * FROM tb_m_guru";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card mb-4">
    <div class="card-header">List Guru</div>
    <div class="card-body">
        <table id="datatables" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>NIP</th>
                    <th>Email</th>
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
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['nip']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="javascript:;" onclick="load_input('<?= base_url('admin/guru/edit.php?id=' . $row['id_guru']) ?>')" class="btn btn-warning">
                                    <span class="symbol-btn-group">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Ubah
                                </a>
                                <a href="javascript:;" onclick="hapus('<?= $row['id_guru'] ?>', '<?= base_url('admin/guru/function.php') ?>')" class="btn btn-danger">
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