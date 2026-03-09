
//Modal

const btn = document.querySelector('#openModal');
const modal = document.querySelector('dialog');
const btnClose = document.querySelector('dialog button');


// Abrir modal ao adicionar.

btn.onclick = function () { 
    document.getElementById('id').value = ''
    document.getElementById('nome').value = ''
    document.getElementById('email').value = ''
    document.getElementById('senha').value = ''

modal.showModal()  

}

// fechar modal
btnClose.onclick = function () {
    modal.close()
}



// Botões Editar

const botoesEditar = document.querySelectorAll('.editar')

botoesEditar.forEach(function(botao){

    botao.addEventListener('click', function(){

        modal.showModal()

        document.getElementById('id').value = this.dataset.id
        document.getElementById('nome').value = this.dataset.nome
        document.getElementById('email').value = this.dataset.email
        document.getElementById('senha').value = this.dataset.senha

    })

})







//btn.onclick = function () {
 // modal.showModal()  

//}

//btnClose.onclick = function() {
   // modal.close()
//}