<?php
session_start();

// Array de preguntas sobre desastres ambientales
$questions = [
    [
        'question' => '¿Cuál es la principal causa del cambio climático?',
        'options' => [
            'La emisión de gases de efecto invernadero',
            'La rotación de la Tierra',
            'Las manchas solares',
            'La lluvia ácida'
        ],
        'correct' => 0
    ],
    [
        'question' => '¿Qué desastre natural puede ser causado por el calentamiento global?',
        'options' => [
            'Terremotos',
            'Huracanes más intensos',
            'Erupciones volcánicas',
            'Eclipses solares'
        ],
        'correct' => 1
    ],
    [
        'question' => '¿Cuál es el principal gas de efecto invernadero?',
        'options' => [
            'Oxígeno',
            'Nitrógeno',
            'Dióxido de carbono',
            'Hidrógeno'
        ],
        'correct' => 2
    ],
    // Añade más preguntas aquí
];

if (!isset($_SESSION['hearts'])) {
    $_SESSION['hearts'] = 3;
}

if (!isset($_SESSION['used_questions'])) {
    $_SESSION['used_questions'] = [];
}

// Obtener pregunta aleatoria no utilizada
$available_questions = array_diff(array_keys($questions), $_SESSION['used_questions']);

if (empty($available_questions)) {
    $_SESSION['used_questions'] = []; // Reiniciar preguntas usadas
    $available_questions = array_keys($questions);
}

$question_index = array_rand($available_questions);
$question_id = $available_questions[$question_index];
$_SESSION['used_questions'][] = $question_id;

$current_question = $questions[$question_id];
$_SESSION['current_correct'] = $current_question['correct'];

// Devolver la pregunta en formato JSON
header('Content-Type: application/json');
echo json_encode([
    'question' => $current_question['question'],
    'options' => $current_question['options'],
    'hearts' => $_SESSION['hearts']
]);
?>