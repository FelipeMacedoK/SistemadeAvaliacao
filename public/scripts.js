let perguntas = [];
let perguntaAtual = 0;

async function carregarPerguntas() {
    const response = await fetch('../models/carregarperguntas.php'); // Ajuste o caminho se necessário
    perguntas = await response.json();

    if (perguntas.length > 0) {
        exibirPergunta(perguntaAtual);
    } else {
        document.getElementById('perguntasContainer').innerHTML = '<p>Nenhuma pergunta disponível.</p>';
    }
}

function exibirPergunta(indice) {
    const container = document.getElementById('perguntasContainer');
    container.innerHTML = '';

    const pergunta = perguntas[indice];
    const perguntaElement = document.createElement('div');
    perguntaElement.innerHTML = `<p>${pergunta.pergunta}</p>`;
    
    for (let i = 1; i <= 10; i++) {
        const label = document.createElement('label');
        label.innerHTML = `
            <input type="radio" name="nota" value="${i}" required> ${i}
        `;
        perguntaElement.appendChild(label);
    }

    container.appendChild(perguntaElement);
    document.getElementById('contador').innerHTML = `Pergunta ${indice + 1} de ${perguntas.length}`;
}

document.getElementById('avaliacao-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const nota = document.querySelector('input[name="nota"]:checked').value;
    
    fetch('../controllers/salvaravaliacao.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `pergunta_id=${perguntas[perguntaAtual].id}&nota=${nota}`
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            perguntaAtual++;
            if (perguntaAtual < perguntas.length) {
                exibirPergunta(perguntaAtual);
            } else {
                alert('Avaliação concluída! Obrigado pela sua participação.');
            }
        } else {
            alert('Erro ao salvar avaliação.');
        }
    });
});

carregarPerguntas();