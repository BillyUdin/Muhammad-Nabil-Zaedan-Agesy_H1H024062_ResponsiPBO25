<?php
session_start();


require_once 'classes/Zubat.php';


if (!isset($_SESSION['pokemon'])) {
    $zubat = new Zubat();
    $_SESSION['pokemon'] = serialize($zubat);
    $_SESSION['training_history'] = [];
} else {
    $zubat = unserialize($_SESSION['pokemon']);
}

$pokemonInfo = $zubat->getInfo();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRTC - Pokémon Training Center</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>🔬 Pokémon Research & Training Center</h1>
            <p class="subtitle">Sistem Simulasi Pelatihan Pokémon</p>
        </header>

        <!-- Pokemon Card -->
        <div class="pokemon-card zubat-card">
            <div class="card-header">
                <h2>📋 Informasi Pokémon Anda</h2>
            </div>
            
            <div class="card-body">
                <!-- Pokemon Image/Icon -->
                <div class="pokemon-icon">
                    <div class="zubat-sprite">🦇</div>
                </div>

                <!-- Pokemon Info -->
                <div class="pokemon-info">
                    <div class="info-row">
                        <span class="label">Nama:</span>
                        <span class="value"><?php echo $pokemonInfo['name']; ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="label">Tipe:</span>
                        <span class="value type-badge poison-flying">
                            <?php echo $pokemonInfo['type']; ?>
                        </span>
                    </div>
                    
                    <div class="info-row">
                        <span class="label">Level:</span>
                        <span class="value level-badge">Lv. <?php echo $pokemonInfo['level']; ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="label">HP:</span>
                        <div class="hp-bar-container">
                            <div class="hp-bar" style="width: <?php echo ($pokemonInfo['hp'] / $pokemonInfo['maxHp']) * 100; ?>%">
                                <?php echo $pokemonInfo['hp']; ?> / <?php echo $pokemonInfo['maxHp']; ?>
                            </div>
                        </div>
                    </div>

                    <div class="info-row">
                        <span class="label">Flight Speed:</span>
                        <span class="value"><?php echo $zubat->getFlightSpeed(); ?> 💨</span>
                    </div>

                    <div class="info-row">
                        <span class="label">Poison Level:</span>
                        <span class="value"><?php echo $zubat->getPoisonLevel(); ?> ☠️</span>
                    </div>
                </div>

                <!-- Special Moves -->
                <div class="special-moves">
                    <h3>⚡ Jurus Spesial:</h3>
                    <div class="moves-grid">
                        <?php foreach ($pokemonInfo['specialMoves'] as $move): ?>
                            <div class="move-badge"><?php echo $move; ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="info-box">
                    <h4>📖 Tentang Zubat</h4>
                    <p>
                        <strong>Zubat</strong> adalah Pokémon tipe <strong>Poison/Flying</strong> yang hidup di gua-gua gelap. 
                        Zubat tidak memiliki mata dan mengandalkan gelombang ultrasonik untuk navigasi. 
                        Serangan racunnya sangat efektif dan kemampuan terbangnya membuatnya sulit ditangkap.
                    </p>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="button-group">
            <a href="training.php" class="btn btn-primary">
                🏋️ Mulai Latihan
            </a>
            <a href="history.php" class="btn btn-secondary">
                📊 Riwayat Latihan
            </a>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>© 2024 PRTC - Pokémon Research & Training Center</p>
            <p class="small-text">Trainer: <strong>Anda</strong> | Pokemon ID: #041</p>
        </footer>
    </div>
</body>
</html>