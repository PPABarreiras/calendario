const buscarButton = document.getElementById('buscarButtonBuscar');
const adicionarButton = document.getElementById('adicionarButtonBuscar');
const containerBuscar = document.querySelector('.button-container-buscar');
const containerAdicionar = document.querySelector('.button-container-Adicionar');
const textAdd = document.querySelector('.textadd');
const textBusc = document.querySelector('.textbusc');

// Mostrar apenas o conteúdo de busca inicialmente
containerAdicionar.style.display = 'none';
textAdd.style.display = 'none';

buscarButton.addEventListener('click', () => {
    containerBuscar.style.display = 'flex';
    containerAdicionar.style.display = 'none';
    textAdd.style.display = 'none';
    textBusc.style.display = 'block';
});

adicionarButton.addEventListener('click', () => {
    containerBuscar.style.display = 'none';
    containerAdicionar.style.display = 'flex';
    textAdd.style.display = 'block';
    textBusc.style.display = 'none';
});
