<?php
require_once 'classes.php';
session_start();

if (!isset($_SESSION['myPokemon'])) {
    header("Location: index.php");
    exit;
}

$pokemon = $_SESSION['myPokemon'];
$histories = $pokemon->getHistory();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Latihan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Riwayat Pelatihan Diglett</h1>
        
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Jenis Latihan</th>
                    <th>Intensitas</th>
                    <th>Level (Awal -> Akhir)</th> <th>HP (Awal -> Akhir)</th> </tr>
            </thead>
            <tbody>
                <?php foreach(array_reverse($histories) as $log): ?>
                <tr>
                    <td><?php echo $log['time']; ?></td>
                    <td><?php echo $log['type']; ?></td>
                    <td><?php echo $log['intensity']; ?></td>
                    <td><?php echo $log['old_level'] . " -> " . $log['new_level']; ?></td>
                    <td><?php echo $log['old_hp'] . " -> " . $log['new_hp']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="nav">
            <a href="index.php">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>