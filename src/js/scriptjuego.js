let preguntas = [];
let vidas = 3;
const mensajesAliento = [
  "¡No te rindas! Cada error es una oportunidad para aprender más sobre el medio ambiente.",
  "La perseverancia es clave para proteger nuestro planeta. ¡Inténtalo de nuevo!",
  "Tu esfuerzo por aprender sobre el medio ambiente es admirable. ¡Sigue adelante!",
  "Recuerda, cada pequeña acción cuenta. ¡Vuelve a intentarlo y marca la diferencia!",
  "El conocimiento es poder. ¡Usa esta experiencia para crecer y proteger nuestro mundo!"
];

document.addEventListener('DOMContentLoaded', iniciarJuego);

async function iniciarJuego() {
  vidas = 3;
  actualizarVidas();
  document.getElementById('gameOver').classList.add('hidden');
  document.getElementById('btnGirar').addEventListener('click', girarRuleta);
  document.getElementById('btnReiniciar').addEventListener('click', iniciarJuego);
  
  try {
    const response = await fetch('../templates/preguntas.php');
    preguntas = await response.json();
  } catch (error) {
    console.error('Error al cargar las preguntas:', error);
  }
}

function actualizarVidas() {
  const vidasElement = document.getElementById('vidas');
  vidasElement.innerHTML = '❤️'.repeat(vidas);
  vidasElement.setAttribute('aria-label', `Te quedan ${vidas} vidas`);
}

function girarRuleta() {
  const ruleta = document.getElementById('ruleta');
  const btnGirar = document.getElementById('btnGirar');
  const grados = Math.floor(Math.random() * 360 + 1440); // Gira entre 4 y 5 vueltas
  
  btnGirar.disabled = true;
  btnGirar.style.opacity = '0.5';
  
  ruleta.style.transform = `rotate(${grados}deg)`;

  setTimeout(() => {
    const numeroSeleccionado = obtenerNumeroSeleccionado(grados);
    mostrarPregunta(preguntas[numeroSeleccionado - 1]);
    btnGirar.disabled = false;
    btnGirar.style.opacity = '1';
    
    setTimeout(() => {
      ruleta.style.transition = 'none';
      ruleta.style.transform = `rotate(${grados % 360}deg)`;
      setTimeout(() => {
        ruleta.style.transition = 'transform 3s cubic-bezier(0.25, 0.1, 0.25, 1)';
      }, 50);
    }, 50);
  }, 3000);
}

function obtenerNumeroSeleccionado(grados) {
  const gradosNormalizados = grados % 360;
  const sectorGrados = 360 / 6;
  return 6 - Math.floor(gradosNormalizados / sectorGrados);
}

function mostrarPregunta(data) {
  const preguntaDiv = document.getElementById('pregunta');
  const opcionesDiv = document.getElementById('opciones');
  const resultadoDiv = document.getElementById('resultado');

  preguntaDiv.innerText = data.pregunta;
  opcionesDiv.innerHTML = '';
  resultadoDiv.innerText = '';

  data.opciones.forEach(opcion => {
    const boton = document.createElement('button');
    boton.innerText = opcion;
    boton.addEventListener('click', () => verificarRespuesta(opcion, data.respuesta_correcta));
    opcionesDiv.appendChild(boton);
  });

  preguntaDiv.style.opacity = '0';
  opcionesDiv.style.opacity = '0';
  
  setTimeout(() => {
    preguntaDiv.style.transition = 'opacity 0.5s ease';
    opcionesDiv.style.transition = 'opacity 0.5s ease';
    preguntaDiv.style.opacity = '1';
    opcionesDiv.style.opacity = '1';
  }, 100);
}

function verificarRespuesta(opcionSeleccionada, respuestaCorrecta) {
  const resultadoDiv = document.getElementById('resultado');
  const esCorrecta = opcionSeleccionada === respuestaCorrecta;
  
  resultadoDiv.innerText = esCorrecta ? '¡Correcto! 🎉' : 'Incorrecto 😞';
  resultadoDiv.style.color = esCorrecta ? '#2ecc71' : '#e74c3c';
  
  resultadoDiv.style.transform = 'scale(0)';
  resultadoDiv.style.opacity = '0';
  
  setTimeout(() => {
    resultadoDiv.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
    resultadoDiv.style.transform = 'scale(1)';
    resultadoDiv.style.opacity = '1';
  }, 100);

  if (!esCorrecta) {
    vidas--;
    actualizarVidas();
    if (vidas === 0) {
      setTimeout(mostrarGameOver, 1500);
    }
  }
}

function mostrarGameOver() {
  const gameOverDiv = document.getElementById('gameOver');
  const mensajeAliento = document.getElementById('mensajeAliento');
  gameOverDiv.classList.remove('hidden');
  mensajeAliento.innerText = mensajesAliento[Math.floor(Math.random() * mensajesAliento.length)];
}