const a = document.querySelectorAll(".nav-elements a");

//Deixa uma tag a como "selecionado" se tiver o mesmo url da pagina atual
a.forEach(item => {
    if(item.href === window.location.href){
        item.id = "Nav-selected";
    }
    });

/Deixar algum elemento selecionado visualmente/
a.forEach(item => {
    item.addEventListener("click", Addselect)
 });

    function Addselect(item){
        a.forEach(item => {
            item.id = "Not-Selected"; //Coloca o Id "Não selecionado em todos os li's"
        });
 
        item.target.id = "Nav-selected"; //Coloca o Id "Selecionado" no li que foi clicado
    }
