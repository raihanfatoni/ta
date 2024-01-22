<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    tr,td,th{
        border: 1px solid black;
        padding: 10px;
        margin: 2px;
    }
</style>
<body>
    <?php echo form_open('Latihan/Search') ?>
        <div class = "row">
            <div class = "col-sm-8">
                <input type="text" name ="keyword" placeholder="Search">
            </div>
            <div class = "col-sm-2">
                <button type="submit" name = "search"> Search </button>
            </div>
        </div>
    <?php echo form_close() ?>
    <center>
        <table>
            <thead>
                <tr>
                    <th> Nomor</th>
                    <th> Nama</th>
                    <th> Jabatan</th>
                    <th> Tupoksi</th>
                    <th> Alamat</th>
                    <th> Surat Keterangan</th>
                    <th> Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nadzir as $row) : ?>
                    <tr>
                        <td><?= $row['NadzirWakaf']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['jabatan']; ?></td>
                        <td><?= $row['tupoksi']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['sk']; ?></td>
                        <td><?= $row['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </center>
</body>
</html>