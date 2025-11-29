<?php
session_start();

// Include class files
require_once 'classes/Zubat.php';

// Pastikan Pokemon sudah ada di session
if (!isset($_SESSION['pokemon'])) {
    header('Location: index.php');
    exit;
}

$zubat = unserialize($_SESSION['pokemon']);
$pokemonInfo = $zubat->getInfo();

// Ambil history dari session
$history = isset($_SESSION['training_history']) ? $_SESSION['training_history'] : [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Latihan - PRTC</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>📊 Riwayat Latihan Pokémon</h1>
            <p class="subtitle">Catatan lengkap sesi latihan <?php echo $pokemonInfo['name']; ?></p>
        </header>

        <!-- Pokemon Summary -->
        <div class="summary-card">
            <h3 style="display:flex; align-items:center; gap:8px;"><img src="path_ke_gambar/zubat.png" alt="Zubat" style="width:40px; height:40px;"><?php echo $pokemonInfo['name']; ?> – Status Terkini</h3>
            <div class="summary-stats">
                <div class="summary-stat">
                    <span class="summary-label">Level</span>
                    <span class="summary-value">Lv. <?php echo $pokemonInfo['level']; ?></span>
                </div>
                <div class="summary-stat">
                    <span class="summary-label">HP</span>
                    <span class="summary-value"><?php echo $pokemonInfo['hp']; ?> / <?php echo $pokemonInfo['maxHp']; ?></span>
                </div>
                <div class="summary-stat">
                    <span class="summary-label">Total Latihan</span>
                    <span class="summary-value"><?php echo count($history); ?> Sesi</span>
                </div>
            </div>
        </div>

        <!-- Training History -->
        <div class="history-card">
            <div class="history-header">
                <h3>📋 Daftar Riwayat Latihan</h3>
                <?php if (count($history) > 0): ?>
                    <span class="history-count"><?php echo count($history); ?> sesi tercatat</span>
                <?php endif; ?>
            </div>

            <?php if (count($history) === 0): ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h4>Belum Ada Riwayat Latihan</h4>
                    <p>Mulai latih <?php echo $pokemonInfo['name']; ?> untuk melihat riwayat di sini!</p>
                    <a href="training.php" class="btn btn-primary">
                        🏋️ Mulai Latihan Pertama
                    </a>
                </div>
            <?php else: ?>
                <!-- History List -->
                <div class="history-list">
                    <?php foreach ($history as $index => $entry): ?>
                        <div class="history-item">
                            <div class="history-number">#<?php echo $index + 1; ?></div>
                            
                            <div class="history-content">
                                <div class="history-header-row">
                                    <span class="training-type-badge <?php echo strtolower($entry['training_type']); ?>">
                                        <?php 
                                        $icons = [
                                            'Attack' => '⚔️',
                                            'Defense' => '🛡️',
                                            'Speed' => '💨'
                                        ];
                                        echo $icons[$entry['training_type']] . ' ' . $entry['training_type']; 
                                        ?>
                                    </span>
                                    <span class="history-time">
                                        🕐 <?php echo date('d/m/Y H:i', strtotime($entry['timestamp'])); ?>
                                    </span>
                                </div>

                                <div class="history-details">
                                    <div class="detail-row">
                                        <span class="detail-label">Intensitas:</span>
                                        <span class="detail-value">
                                            <?php echo $entry['intensity']; ?> / 10
                                            <span class="intensity-bar">
                                                <?php echo str_repeat('▮', $entry['intensity']) . str_repeat('▯', 10 - $entry['intensity']); ?>
                                            </span>
                                        </span>
                                    </div>

                                    <div class="detail-row">
                                        <span class="detail-label">Level:</span>
                                        <span class="detail-value">
                                            Lv. <?php echo $entry['old_level']; ?> → 
                                            <strong class="level-up">Lv. <?php echo $entry['new_level']; ?></strong>
                                            <?php if ($entry['new_level'] > $entry['old_level']): ?>
                                                <span class="increase-badge">+<?php echo $entry['new_level'] - $entry['old_level']; ?></span>
                                            <?php endif; ?>
                                        </span>
                                    </div>

                                    <div class="detail-row">
                                        <span class="detail-label">HP:</span>
                                        <span class="detail-value">
                                            <?php echo $entry['old_hp']; ?> → 
                                            <strong class="hp-up"><?php echo $entry['new_hp']; ?></strong>
                                            <?php if ($entry['new_hp'] > $entry['old_hp']): ?>
                                                <span class="increase-badge">+<?php echo $entry['new_hp'] - $entry['old_hp']; ?></span>
                                            <?php endif; ?>
                                        </span>
                                    </div>

                                    <div class="history-message">
                                        <span class="message-icon">💬</span>
                                        <?php echo $entry['message']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Statistics Summary -->
                <div class="statistics-card">
                    <h4>📈 Statistik Latihan</h4>
                    <div class="stats-grid">
                        <?php
                        // Hitung statistik
                        $attackCount = 0;
                        $defenseCount = 0;
                        $speedCount = 0;
                        $totalIntensity = 0;
                        $totalLevelGain = 0;
                        $totalHpGain = 0;

                        foreach ($history as $entry) {
                            switch ($entry['training_type']) {
                                case 'Attack': $attackCount++; break;
                                case 'Defense': $defenseCount++; break;
                                case 'Speed': $speedCount++; break;
                            }
                            $totalIntensity += $entry['intensity'];
                            $totalLevelGain += ($entry['new_level'] - $entry['old_level']);
                            $totalHpGain += ($entry['new_hp'] - $entry['old_hp']);
                        }

                        $avgIntensity = count($history) > 0 ? round($totalIntensity / count($history), 1) : 0;
                        ?>

                        <div class="stat-box">
                            <span class="stat-icon">⚔️</span>
                            <span class="stat-number"><?php echo $attackCount; ?>x</span>
                            <span class="stat-text">Attack Training</span>
                        </div>

                        <div class="stat-box">
                            <span class="stat-icon">🛡️</span>
                            <span class="stat-number"><?php echo $defenseCount; ?>x</span>
                            <span class="stat-text">Defense Training</span>
                        </div>

                        <div class="stat-box">
                            <span class="stat-icon">💨</span>
                            <span class="stat-number"><?php echo $speedCount; ?>x</span>
                            <span class="stat-text">Speed Training</span>
                        </div>

                        <div class="stat-box">
                            <span class="stat-icon">📊</span>
                            <span class="stat-number"><?php echo $avgIntensity; ?></span>
                            <span class="stat-text">Avg. Intensitas</span>
                        </div>

                        <div class="stat-box">
                            <span class="stat-icon">⬆️</span>
                            <span class="stat-number">+<?php echo $totalLevelGain; ?></span>
                            <span class="stat-text">Total Level Gain</span>
                        </div>

                        <div class="stat-box">
                            <span class="stat-icon">❤️</span>
                            <span class="stat-number">+<?php echo $totalHpGain; ?></span>
                            <span class="stat-text">Total HP Gain</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Navigation Buttons -->
        <div class="button-group">
            <a href="index.php" class="btn btn-secondary">
                🏠 Kembali ke Beranda
            </a>
            <a href="training.php" class="btn btn-primary">
                🏋️ Mulai Latihan Lagi
            </a>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>© 2024 PRTC - Pokémon Research & Training Center</p>
        </footer>
    </div>
</body>
</html>