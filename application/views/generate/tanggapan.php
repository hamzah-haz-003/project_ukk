<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Laporan Masyarakat</title>
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
        <h5 class="text-center">Laporan Masyarakat</h5>
        <hr>
    </div>

    <?php if (empty($tanggapan)): ?>
        <h5>Tidak Ada Data</h5>
    <?php else: ?>
        <table cellspacing="0">
            <thead>
                <tr>
                    <th>nama admin</th>
                    <th>nama pengadu</th>
                    <th>isi pengaduan</th>
                    <th>isi tanggapan</th>
                    <th>tanggal pengaduan</th>

                </tr>
            </thead>
            <tbody>
                <?php
                date_default_timezone_set('Asia/Jakarta');
                foreach ($tanggapan as $t) { ?>

                    <tr>
                        <td>
                            <?= $t->nama_masyarakat; ?>
                        </td>
                        <td>
                            <?= $t->nama_admin; ?>
                        </td>
                        <td>
                            <?= $t->isi_laporan; ?>
                        </td>
                        <td>
                            <?= $t->tanggapan; ?>
                        </td>
                        <td>
                            <?= $t->tgl_pengaduan; ?>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>