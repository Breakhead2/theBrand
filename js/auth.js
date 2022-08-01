import validation from "./modules/validation.js";

const form = document.querySelector('.loginForm') || document.querySelector('.login_form');
let inputsFromAuth = form.querySelectorAll('[data-valid="check"]');

for (let input of inputsFromAuth){
    input.addEventListener('input',(input)=>{
        validation(input.target)
    })
}


form.addEventListener('submit', (event) =>{
    let status = true;
    for (let input of inputsFromAuth) {
        if (!validation(input)){
            status = false;
        }
    }
    if(!status){
        event.preventDefault();
    }

})