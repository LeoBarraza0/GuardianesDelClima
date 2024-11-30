<?php
session_start();

// Inicializar el contador de respuestas correctas si no existe
if (!isset($_SESSION['correct_answers'])) {
    $_SESSION['correct_answers'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $selected_option = $data['selected_option'];
    
    $is_correct = ($selected_option == $_SESSION['current_correct']);
    
    if ($is_correct) {
        $_SESSION['correct_answers']++;
    } else {
        $_SESSION['hearts']--;
    }
    
    // Verificar si el juego ha terminado
    $game_over = ($_SESSION['hearts'] <= 0 || $_SESSION['correct_answers'] >= 3);
    
    header('Content-Type: application/json');
    echo json_encode([
        'correct' => $is_correct,
        'hearts' => $_SESSION['hearts'],
        'gameOver' => $game_over
    ]);
}
?>