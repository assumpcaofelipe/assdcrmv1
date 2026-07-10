const form = document.querySelector(".validacao-forms");
const error = document.querySelector(".error");

form.addEventListener("submit", function (event) {

  const inputEmpresa = document.querySelector('[name="empresa_nome"]');
  const inputEmail = document.querySelector('[name="email"]');

  if (inputEmpresa.value.trim() === "" || inputEmail.value.trim() == "") {

    event.preventDefault();

    inputEmpresa.style.border = "1px solid red";
    inputEmail.style.border = "1px solid red";

    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });

    error.textContent = "PREENCHA OS CAMPOS OBRIGATÓRIOS: NOME DA EMPRESA E E-MAIL!";
    error.style.color = "red";
    error.style.fontSize = "18px";
  }

});
