<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Laporan Pengaduan</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            margin: 10px;
            padding: 10px;
        }

        .text-center {
            text-align: center;
        }

        #head {
            margin-top: 8px;
        }

        hr {
            margin-top: 8px;
        }

        table {
            margin: 0 auto;
            margin-top: 8px;
            border: 1px solid #778899;
        }

        table th {
            padding: 8px 8px;
            border-left: 1px solid #778899;
            margin-bottom: 1px solid #778899;
            background: #87cefa;
        }

        table tr {
            text-align: center;
            padding-left: 20px;
        }

        table td {
            padding: 8px 8px;
            border-top: 1px solid #778899;
            border-left: 1px solid #778899;
        }
    </style>
</head>

<body>
    <div id="head">
        <h2 class="text-center">Aplikasi Pengaduan Masyarakat</h2>
        <h5 class="text-center">Laporan Pengaduan</h5>
        <hr>
    </div>

    <?php if (empty($pengaduan)): ?>
        <h5>Tidak Ada Data</h5>
    <?php else: ?>
        <table cellspacing="0">
            <thead>
                <tr>
                    <th>Tanggal Laporan</th>
                    <th>NIK</th>
                    <th>Nama Pelapor</th>
                    <th>Isi Laporan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                date_default_timezone_set('Asia/Jakarta');
                foreach ($pengaduan as $p) { ?>
                    <tr>
                        <td>
                            <?= date('d M Y, H:i:s', $p->id_pengaduan); ?>
                        </td>
                        <td>
                            <?= $p->nik; ?>
                        </td>
                        <td>
                            <?= $p->nama; ?>
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
                            <?php if ($p->status == 0): ?>
                                diproses
                            <?php else: ?>
                            <?php endif; ?>
                            <?php if ($p->status == 3): ?>
                                menunggu
                            <?php else: ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>