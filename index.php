<?php
require_once 'classes.php';
session_start();

// Inisialisasi Diglett jika belum ada di sesi
if (!isset($_SESSION['myPokemon'])) {
    $_SESSION['myPokemon'] = new Diglett();
}

$pokemon = $_SESSION['myPokemon'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>PokéCare - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>PokéCare Center</h1>
        <h2>Halo, Trainer! Ini Pokémon Anda:</h2>
        
        <div class="card">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/50.png" alt="Diglett" class="pokemon-img">
            
            <div class="pokemon-info">
                <p><strong>Nama:</strong> <?php echo $pokemon->getName(); ?></p>
                <p><strong>Tipe:</strong> <?php echo $pokemon->getType(); ?></p>
                <p><strong>Level:</strong> <?php echo $pokemon->getLevel(); ?></p>
                <p><strong>HP:</strong> <?php echo $pokemon->getHp(); ?></p>
                <p><strong>Jurus Spesial:</strong> <?php echo $pokemon->specialMove(); ?></p>
            </div>
        </div>

        <div class="nav">
            <a href="train.php" class="btn">Mulai Latihan</a>
            <a href="history.php" class="btn">Riwayat Latihan</a>
        </div>
    </div>
</body>
</html>