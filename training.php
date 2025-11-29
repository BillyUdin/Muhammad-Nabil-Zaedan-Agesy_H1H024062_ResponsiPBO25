<?php
session_start();


require_once 'classes/Zubat.php';


if (!isset($_SESSION['pokemon'])) {
    header('Location: index.php');
    exit;
}

$zubat = unserialize($_SESSION['pokemon']);
$trainingResult = null;


if (isset($_SESSION['training_result'])) {
    $trainingResult = $_SESSION['training_result'];
    unset($_SESSION['training_result']); 
}

$pokemonInfo = $zubat->getInfo();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Pokémon - PRTC</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>🏋️ Sesi Latihan Pokémon</h1>
            <p class="subtitle">Latih <?php echo $pokemonInfo['name']; ?> untuk meningkatkan kemampuannya!</p>
        </header>

        <!-- Current Status -->
        <div class="status-card">
            <h3>📊 Status Saat Ini</h3>
            <div class="status-grid">
                <div class="stat-item">
                    <span class="stat-label">Level</span>
                    <span class="stat-value">Lv. <?php echo $pokemonInfo['level']; ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">HP</span>
                    <span class="stat-value"><?php echo $pokemonInfo['hp']; ?> / <?php echo $pokemonInfo['maxHp']; ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Flight Speed</span>
                    <span class="stat-value"><?php echo $zubat->getFlightSpeed(); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Poison Level</span>
                    <span class="stat-value"><?php echo $zubat->getPoisonLevel(); ?></span>
                </div>
            </div>
        </div>

        <!-- Training Result (if exists) -->
        <?php if ($trainingResult): ?>
            <div class="result-card success">
                <h3>✅ Latihan Berhasil!</h3>
                <p class="result-message"><?php echo $trainingResult['message']; ?></p>
                
                <div class="result-stats">
                    <div class="result-row">
                        <span class="result-label">Jenis Latihan:</span>
                        <span class="result-value"><?php echo $trainingResult['trainingType']; ?></span>
                    </div>
                    <div class="result-row">
                        <span class="result-label">Intensitas:</span>
                        <span class="result-value"><?php echo $trainingResult['intensity']; ?> / 10</span>
                    </div>
                    <div class="result-row">
                        <span class="result-label">Level:</span>
                        <span class="result-value">
                            <?php echo $trainingResult['oldLevel']; ?> → 
                            <strong class="highlight"><?php echo $trainingResult['newLevel']; ?></strong>
                            (+<?php echo $trainingResult['newLevel'] - $trainingResult['oldLevel']; ?>)
                        </span>
                    </div>
                    <div class="result-row">
                        <span class="result-label">HP:</span>
                        <span class="result-value">
                            <?php echo $trainingResult['oldHp']; ?> → 
                            <strong class="highlight"><?php echo $trainingResult['newHp']; ?></strong>
                            (+<?php echo $trainingResult['newHp'] - $trainingResult['oldHp']; ?>)
                        </span>
                    </div>
                </div>

                <!-- Special Move Demo -->
                <?php 
                $specialMove = $zubat->specialMove();
                ?>
                <div class="special-move-demo">
                    <h4>⚡ Special Move Demo:</h4>
                    <div class="move-display">
                        <span class="move-name"><?php echo $specialMove['move']; ?></span>
                        <span class="move-power">Power: <?php echo $specialMove['power']; ?></span>
                    </div>
                    <p class="move-description"><?php echo $specialMove['description']; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Training Form -->
        <div class="training-form-card">
            <h3>🎯 Mulai Sesi Latihan Baru</h3>
            
            <form action="process_training.php" method="POST" class="training-form">
                <!-- Training Type Selection -->
                <div class="form-group">
                    <label for="training_type">Jenis Latihan:</label>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="training_type" value="Attack" required>
                            <span class="radio-label">
                                ⚔️ <strong>Attack Training</strong>
                                <small>Meningkatkan kekuatan serangan dan poison level</small>
                            </span>
                        </label>
                        
                        <label class="radio-option">
                            <input type="radio" name="training_type" value="Defense" required>
                            <span class="radio-label">
                                🛡️ <strong>Defense Training</strong>
                                <small>Meningkatkan pertahanan dan HP</small>
                            </span>
                        </label>
                        
                        <label class="radio-option">
                            <input type="radio" name="training_type" value="Speed" required>
                            <span class="radio-label">
                                💨 <strong>Speed Training</strong>
                                <small>Meningkatkan kecepatan terbang dan level</small>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Intensity Selection -->
                <div class="form-group">
                    <label for="intensity">Intensitas Latihan: <span id="intensity_value">5</span> / 10</label>
                    <input 
                        type="range" 
                        id="intensity" 
                        name="intensity" 
                        min="1" 
                        max="10" 
                        value="5" 
                        class="intensity-slider"
                        oninput="document.getElementById('intensity_value').textContent = this.value"
                        required
                    >
                    <div class="intensity-labels">
                        <span>Ringan</span>
                        <span>Sedang</span>
                        <span>Berat</span>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-large">
                        🚀 Mulai Latihan
                    </button>
                </div>
            </form>
        </div>

        <!-- Navigation Buttons -->
        <div class="button-group">
            <a href="index.php" class="btn btn-secondary">
                🏠 Kembali ke Beranda
            </a>
            <a href="history.php" class="btn btn-secondary">
                📊 Lihat Riwayat
            </a>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>© 2024 PRTC - Pokémon Research & Training Center</p>
        </footer>
    </div>
</body>
</html>