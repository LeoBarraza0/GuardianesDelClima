<?php
$preguntas = [
    [
        "pregunta" => "¿Cómo podemos reducir el riesgo de incendios forestales?",
        "opciones" => ["Evitar quemas controladas", "Dejar basura en bosques", "Usar fuego sin control"],
        "respuesta_correcta" => "Evitar quemas controladas"
    ],
    [
        "pregunta" => "¿Qué medidas se deben tomar para prevenir inundaciones?",
        "opciones" => ["Construir presas", "Deforestar", "Tirar basura al río"],
        "respuesta_correcta" => "Construir presas"
    ],
    [
        "pregunta" => "¿Qué es la reforestación y por qué es importante?",
        "opciones" => ["Plantar árboles", "Construir carreteras", "Eliminar vegetación"],
        "respuesta_correcta" => "Plantar árboles"
    ],
    [
        "pregunta" => "¿Cómo podemos reducir la contaminación del aire?",
        "opciones" => ["Usar transporte público", "Quemar basura", "Aumentar el uso de combustibles fósiles"],
        "respuesta_correcta" => "Usar transporte público"
    ],
    [
        "pregunta" => "¿Qué acción ayuda a conservar el agua?",
        "opciones" => ["Cerrar el grifo al cepillarse los dientes", "Dejar correr el agua", "Usar mangueras sin boquilla"],
        "respuesta_correcta" => "Cerrar el grifo al cepillarse los dientes"
    ],
    [
        "pregunta" => "¿Cuál es una práctica sostenible para proteger los océanos?",
        "opciones" => ["Evitar el uso de plásticos de un solo uso", "Pescar sin límites", "Verter residuos tóxicos"],
        "respuesta_correcta" => "Evitar el uso de plásticos de un solo uso"
    ]
];

header('Content-Type: application/json');
echo json_encode($preguntas);
?>
