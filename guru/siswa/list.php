<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$sql = "SELECT * FROM tb_m_siswa";
$query = $con->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card mb-4">
    <div class="card-header">List Siswa</div>
    <div class="card-body">
        <table id="datatables" class="table" style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>NISN</th>
                    <th>Email</th>
                    <th>Kelas</th>
                    <th>Status</th>
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
                        <td><?php echo $row['nisn']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo relation('tb_m_kelas', 'id_kelas', $row['id_kelas'])['nama']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="javascript:;" onclick="load_input('<?= base_url('guru/siswa/show.php?id_siswa=' . $row['id_siswa']) ?>')" class="btn btn-info">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    Detail
                                </a>
                                <a href="javascript:;" onclick="handle_open_modal('<?php base_url('guru/siswa/edit.php?id_siswa=' . $row['id_siswa']) ?>',  '#modalListResult', '#contentListResult');" class="btn btn-warning">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    Ubah
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