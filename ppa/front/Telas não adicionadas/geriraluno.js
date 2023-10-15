document.addEventListener("DOMContentLoaded", function () {
    const adicionarButton = document.getElementById("adicionar-button");
    const addOptions = document.getElementById("add-options");
    const cancelButton = document.getElementById("cancel-add-button");
  
    adicionarButton.addEventListener("click", function () {
      addOptions.classList.remove("hidden");
      document.querySelectorAll(".button-name, .button-matricula, .button-wrapper")
        .forEach(element => {
          element.style.display = "none";
        });
    });
  
    cancelButton.addEventListener("click", function () {
      addOptions.classList.add("hidden");
      document.querySelectorAll(".button-name, .button-matricula, .button-wrapper")
        .forEach(element => {
          element.style.display = "block";
        });
    });
  
    const addStudentForm = document.getElementById("add-student-form");
  
    addStudentForm.addEventListener("submit", function (e) {
      e.preventDefault();
  
      const nome = document.getElementById("aluno-nome").value;
      const email = document.getElementById("aluno-email").value;
      const senha = document.getElementById("aluno-senha").value;
      const idClasse = document.getElementById("aluno-id-classe").value;
  
      document.getElementById("aluno-nome").value = "";
      document.getElementById("aluno-email").value = "";
      document.getElementById("aluno-senha").value = "";
      document.getElementById("aluno-id-classe").value = "";
  
      addOptions.classList.add("hidden");
      document.querySelectorAll(".button-name, .button-matricula, .button-wrapper")
        .forEach(element => {
          element.style.display = "block";
        });
    });
  });