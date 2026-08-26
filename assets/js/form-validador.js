const form = document.querySelector(".validacao-forms");
const error = document.querySelector(".error");

form.addEventListener("submit", function (event) {

  const inputEmpresa = document.querySelector('[name="empresa_nome"]');


  if (inputEmpresa.value.trim() === "") {

    event.preventDefault();

    inputEmpresa.style.border = "1px solid red";

    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });

    error.textContent = "PREENCHA OS CAMPOS OBRIGATÓRIOS:NOME DA EMPRESA";
    error.style.color = "red";
    error.style.fontSize = "18px";
  }

});
