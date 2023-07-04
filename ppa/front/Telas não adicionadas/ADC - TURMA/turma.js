const numeroTurmaInput = document.getElementById('numero-turma-input');
const periodoSelect = document.querySelector('aside .button-container select');
const cursoSelect = document.querySelector('aside .button-tec select');
const adicionarButton = document.getElementById('adicionar-button');
const main = document.querySelector('main');


function adicionarResposta() {
  const numeroTurma = numeroTurmaInput.value;
  const periodoSelecionado = periodoSelect.value;
  const cursoSelecionado = cursoSelect.value;


  const resposta = document.createElement('div');
  resposta.innerHTML = `
    <h3>Informações da turma:</h3>
    <p>Número da turma: ${numeroTurma}</p>
    <p>Período: ${periodoSelecionado}</p>
    <p>Curso: ${cursoSelecionado}</p>
    <button class="delete-button">Deletar</button>
  `;


  main.appendChild(resposta);


  numeroTurmaInput.value = '';
  periodoSelect.selectedIndex = 0;
  cursoSelect.selectedIndex = 0;
}


adicionarButton.addEventListener('click', () => {
  adicionarResposta();
});
 