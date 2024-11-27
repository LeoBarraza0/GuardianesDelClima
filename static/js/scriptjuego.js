let currentQuestion = null;

async function loadQuestion() {
    try {
        const response = await fetch('get_question.php');
        const data = await response.json();
        
        currentQuestion = data;
        
        document.getElementById('question-text').textContent = data.question;
        
        const optionsContainer = document.getElementById('options-container');
        optionsContainer.innerHTML = '';
        
        data.options.forEach((option, index) => {
            const button = document.createElement('button');
            button.className = 'option';
            button.textContent = option;
            button.onclick = () => selectOption(index);
            optionsContainer.appendChild(button);
        });
        
        updateHearts(data.hearts);
        
        document.getElementById('message').className = 'message hidden';
        document.getElementById('game-over').className = 'hidden';
        document.getElementById('question-container').className = '';
    } catch (error) {
        console.error('Error loading question:', error);
    }
}

function updateHearts(count) {
    const hearts = document.querySelectorAll('.hearts-container i');
    hearts.forEach((heart, index) => {
        heart.className = index < count ? 'fas fa-heart' : 'fas fa-heart lost';
    });
}

async function selectOption(index) {
    try {
        const response = await fetch('check_answer.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                selected_option: index
            })
        });
        
        const data = await response.json();
        
        const message = document.getElementById('message');
        message.textContent = data.correct ? '¡Correcto!' : 'Incorrecto';
        message.className = `message ${data.correct ? 'correct' : 'incorrect'}`;
        
        updateHearts(data.hearts);
        
        if (data.gameOver) {
            document.getElementById('question-container').className = 'hidden';
            document.getElementById('game-over').className = '';
        } else {
            setTimeout(loadQuestion, 1500);
        }
    } catch (error) {
        console.error('Error checking answer:', error);
    }
}

async function restartGame() {
    try {
        await fetch('restart.php');
        loadQuestion();
    } catch (error) {
        console.error('Error restarting game:', error);
    }
}

// Cargar la primera pregunta al iniciar
document.addEventListener('DOMContentLoaded', loadQuestion);