const apiKey = '32a8b6a82885431242c1205cb7b288b0'

async function fetchWeatherData(city) {
    try {
        const response = await fetch(
            `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`
        );

        if (!response.ok) {
            throw new Error("Unable to fetch weather data");
        }
        const data = await response.json();
        console.log(data);
        updateWeatherUI(data);
    } catch (error) {
        console.error(error);
    }
}

const cityElement = document.querySelector(".city");
const temperature = document.querySelector(".temp");
const windSpeed = document.querySelector(".wind-speed");
const humidity = document.querySelector(".humidity");
const visibility = document.querySelector(".visibility-distance");
const pressure = document.querySelector(".pressure");
const descriptionText = document.querySelector(".description-text");
const date = document.querySelector(".date");
const descriptionIcon = document.querySelector(".description i");


async function updateWeatherUI(data) {
    cityElement.textContent = "Weather in "+ data.name;
    temperature.textContent = `${Math.round(data.main.temp)}`+"°C";
    windSpeed.textContent = `${data.wind.speed} km/h`;
    humidity.textContent = `${data.main.humidity}%`;
    visibility.textContent = `${data.visibility / 1000} km`;
    descriptionText.textContent = data.weather[0].description;
    pressure.textContent = `${data.main.pressure} mb`;

    const currentDate = new Date();
    date.textContent = currentDate.toDateString();
    const weatherIconName = getWeatherIconName(data.weather[0].main);
    descriptionIcon.innerHTML = `<i class="material-icons">${weatherIconName}</i>`;

    // Llamar a obtenerConsejosIA después de actualizar la UI
    await obtenerConsejosIA(data);
}


const formElement = document.querySelector(".search-form");
const inputElement = document.querySelector(".city-input");

formElement.addEventListener("submit", function (e) {
    e.preventDefault();

    const city = inputElement.value;
    if (city !== "") {
        fetchWeatherData(city);
        inputElement.value = "";
    }
});

function getWeatherIconName(weatherCondition) {
    const iconMap = {
        Clear: "wb_sunny",
        Clouds: "wb_cloudy",
        Rain: "umbrella",
        Thunderstorm: "flash_on",
        Drizzle: "grain",
        Snow: "ac_unit",
        Mist: "cloud",
        Smoke: "cloud",
        Haze: "cloud",
        Fog: "cloud",
    };

    return iconMap[weatherCondition] || "help";
}
async function obtenerConsejosIA(weatherData) {
    try {
        const response = await fetch('http://localhost:5000/generate-advice', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                temperatura: Math.round(weatherData.main.temp),
                descripcion: weatherData.weather[0].description,
                humedad: weatherData.main.humidity,
                viento: weatherData.wind.speed,
                visibilidad: weatherData.visibility / 1000
            })
        });

        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const data = await response.json();
        mostrarConsejos(data.consejos, weatherData);
    } catch (error) {
        console.error('Error al obtener consejos:', error);
        mostrarConsejosError();
    }
}

function mostrarConsejos(consejos, weatherData) {
    const consejosContainer = document.querySelector('.consejos-ia');
    const weatherCondition = weatherData.weather[0].main.toLowerCase();
    
    consejosContainer.innerHTML = `
        <div class="consejos-header ${weatherCondition}">
            <h3>Recomendaciones para ${weatherData.name}</h3>
            <span class="tiempo-actualizacion">Actualizado: ${new Date().toLocaleTimeString()}</span>
        </div>
        <div class="consejos-content">
            ${consejos}
        </div>
    `;
}

function mostrarConsejosError() {
    const consejosContainer = document.querySelector('.consejos-ia');
    consejosContainer.innerHTML = `
        <div class="consejos-error">
            <h3>Consejos no disponibles</h3>
            <p>Por favor, intenta de nuevo más tarde.</p>
        </div>
    `;
}
window.addEventListener('load', () => {
    fetchWeatherData('Bangalore'); // O cualquier otra ciudad por defecto
});

function displayWeatherAdvice(advice) {
    const adviceContainer = document.getElementById('weather-advice');
    adviceContainer.innerHTML = ''; // Limpiar contenido anterior
    
    const alertBox = document.createElement('div');
    alertBox.className = 'alert-box';
    
    // Dividir los consejos en líneas
    const alerts = advice.split('\n');
    
    alerts.forEach(alert => {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'alert-message';
        
        // Determinar el tipo de alerta basado en el contenido
        if (alert.includes('ALERTA')) {
            messageDiv.classList.add('alert-danger');
        } else if (alert.includes('PRECAUCIÓN')) {
            messageDiv.classList.add('alert-warning');
        } else if (alert.includes('✅')) {
            messageDiv.classList.add('alert-success');
        } else {
            messageDiv.classList.add('alert-info');
        }
        
        // Separar el emoji del texto para la animación
        const emoji = alert.match(/^[^\w]*/) ? alert.match(/^[^\w]*/)[0].trim() : '';
        const text = alert.replace(emoji, '').trim();
        
        messageDiv.innerHTML = `
            <span class="emoji">${emoji}</span>
            <span class="alert-text">${text}</span>
        `;
        
        alertBox.appendChild(messageDiv);
    });
    
    adviceContainer.appendChild(alertBox);
}