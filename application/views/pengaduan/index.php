<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h3>Management Data Pengaduan</h3>

    <div style="margin-top: 70px; margin-bottom: 7x0px;" class="row">
        <div class="col-lg-12">



            <div style="margin-bottom:200px;" class="card shadow">
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="myTable">
                        <thead class="table-info">
                            <tr>
                                <th>Tanggal</th>
                                <th>Isi Pengaduan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pengaduan as $p) { ?>
                                <strong>
                                    <tr>
                                        <td>
                                            <?= date('d M Y H:i:s', $p->id_pengaduan); ?>
                                        </td>
                                        <td>
                                            <?= $p->isi_laporan; ?>
                                        </td>
                                        <td>
                                            <?php if ($p->status == 1): ?>
                                                Selesai
                                            <?php else: ?>
                                            <?php endif; ?>
                                            <?php if ($p->status == 2): ?>
                                                ditolak
                                            <?php else: ?>
                                            <?php endif; ?>
                                            <?php if ($p->status == 3): ?>
                                                diproses
                                            <?php else: ?>
                                            <?php endif; ?>
                                            <?php if ($p->status == 0): ?>
                                                menunggu
                                            <?php else: ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('pengaduan/del_pengaduan/') . $p->id_pengaduan; ?>"
                                                class="btn btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i></a>
                                            <a href="<?= base_url('pengaduan/detail/') . md5($p->id_pengaduan); ?>"
                                                class="btn btn-primary btn-sm"><i class="fa fa-arrow-right"></i></a>
                                        </td>
                                    </tr>
                                </strong>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->