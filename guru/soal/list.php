<?php
require_once('../../config/koneksi.php');
require_once('../../config/function.php');
$id_kuis = $_GET['id_kuis'];
$sql = "SELECT * FROM tb_r_soal WHERE id_kuis = '$id_kuis'";
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
                    <th>Pertanyaan</th>
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
                        <td><?php echo $row['pertanyaan']; ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="javascript:;" onclick="load_detail('<?= base_url('guru/soal/detail.php?id_soal=' . $row['id_soal']) ?>')" class="btn btn-info">
                                    <span class="symbol-btn-group me-2">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    Info
                                </a>
                                <a href="javascript:;" onclick="load_input('<?= base_url('guru/soal/edit.php?id_soal=' . $row['id_soal']) ?>')" class="btn btn-warning">
                                    <span class="symbol-btn-group">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Ubah
                                </a>
                                <a href="javascript:;" onclick="hapus('<?= $row['id_guru'] ?>', '<?= base_url('guru/kuis/function.php') ?>')" class="btn btn-danger">
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