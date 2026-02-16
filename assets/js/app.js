
//Modal

const btn = document.querySelector('#openModal');
const modal = document.querySelector('dialog');
const btnClose = document.querySelector('dialog button');

btn.onclick = function () {
  modal.showModal()  

}

btnClose.onclick = function() {
    modal.close()
}