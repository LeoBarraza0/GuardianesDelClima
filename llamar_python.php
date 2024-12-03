<?php
$prompt = "segun las condiciones climaticas, recomienda actividades: temperatura: 29 viento: 4.63 km/h humedad: 79% visibilidad: 10km presión: 1010mb";
$command = "python3 prueba.py \"$prompt\"";
$output = exec($command, $output_array, $return_var);

echo "Respuesta: " . $output;
?>