<?php
session_start();


require_once 'classes/Zubat.php';


if (!isset($_SESSION['pokemon'])) {
    header('Location: index.php');
    exit;
}

// Validasi: Pastikan request method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: training.php');
    exit;
}


$zubat = unserialize($_SESSION['pokemon']);


$trainingType = isset($_POST['training_type']) ? $_POST['training_type'] : '';
$intensity = isset($_POST['intensity']) ? intval($_POST['intensity']) : 0;

// Validasi input
if (empty($trainingType) || $intensity < 1 || $intensity > 10) {
    $_SESSION['error'] = "Data training tidak valid!";
    header('Location: training.php');
    exit;
}


$validTypes = ['Attack', 'Defense', 'Speed'];
if (!in_array($trainingType, $validTypes)) {
    $_SESSION['error'] = "Jenis training tidak valid!";
    header('Location: training.php');
    exit;
}


$result = $zubat->train($trainingType, $intensity);


$_SESSION['pokemon'] = serialize($zubat);


$_SESSION['training_result'] = $result;


$historyEntry = [
    'timestamp' => date('Y-m-d H:i:s'),
    'training_type' => $trainingType,
    'intensity' => $intensity,
    'old_level' => $result['oldLevel'],
    'new_level' => $result['newLevel'],
    'old_hp' => $result['oldHp'],
    'new_hp' => $result['newHp'],
    'message' => $result['message']
];


if (!isset($_SESSION['training_history'])) {
    $_SESSION['training_history'] = [];
}


array_unshift($_SESSION['training_history'], $historyEntry);


header('Location: training.php');
exit;
?>