<?php
require_once 'classes.php';
session_start();

if (!isset($_SESSION['myPokemon'])) {
    header("Location: index.php");
    exit;
}

$pokemon = $_SESSION['myPokemon'];
$message = "";

// Proses form saat dikirim 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['training_type'];
    $intensity = (int)$_POST['intensity'];

    // Panggil method OOP train()
    $pokemon->train($type, $intensity);
    
    // Output setelah latihan 
    $message = "Latihan $type selesai! Level dan HP Diglett meningkat.";
    if ($type == "Attack") {
        $message .= "<br>Diglett menggunakan: " . $pokemon->specialMove();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Latihan Pokémon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Ruang Latihan</h1>
        
        <form method="POST">
            <label>Jenis Latihan:</label>
            <select name="training_type">
                <option value="Attack">Attack (Kekuatan)</option>
                <option value="Defense">Defense (Ketahanan)</option>
                <option value="Speed">Speed (Kecepatan)</option>
            </select>
            
            <label>Intensitas (1-10):</label>
            <input type="number" name="intensity" min="1" max="10" required>
            
            <button type="submit">Latih Diglett!</button>
        </form>

        <?php if ($message): ?>
            <div class="alert">
                <p><?php echo $message; ?></p>
                <p>Level Sekarang: <?php echo $pokemon->getLevel(); ?></p>
                <p>HP Sekarang: <?php echo $pokemon->getHp(); ?></p>
            </div>
        <?php endif; ?>

        <div class="nav">
            <a href="index.php">Kembali ke Beranda</a> | 
            <a href="history.php">Riwayat Latihan</a>
        </div>
    </div>
</body>
</html>