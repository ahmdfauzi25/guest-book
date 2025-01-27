<!DOCTYPE html>
<html>
<head>
    <title>Laporan Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Dashboard</h2>
    <p>Tanggal: <?= date('d-m-Y') ?></p>

    <h3>Ringkasan</h3>
    <table class="table">
        <tr>
            <td>Total Tamu Hari Ini</td>
            <td><?= $total_guests ?></td>
        </tr>
        <tr>
            <td>Total Tamu Bulan Ini</td>
            <td><?= $total_guests_month ?></td>
        </tr>
        <tr>
            <td>Total Feedback Baik</td>
            <td><?= $total_good_feedback ?></td>
        </tr>
        <tr>
            <td>Total Feedback Buruk</td>
            <td><?= $total_bad_feedback ?></td>
        </tr>
        <tr>
            <td>Total Feedback Terkirim</td>
            <td><?= $total_feedback_submitted ?></td>
        </tr>
    </table>

    <h3>Daftar Tamu Hari Ini</h3>
    <table class="table">
        <tr>
            <th>Nama</th>
            <th>Keperluan</th>
            <th>Waktu</th>
        </tr>
        <?php foreach($guestbook as $guest): ?>
        <tr>
            <td><?= $guest['name_guest'] ?></td>
            <td><?= $guest['kepentingan'] ?></td>
            <td><?= $guest['waktu_kedatangan'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
