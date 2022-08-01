import validation from "./modules/validation.js";

const formProfile = document.querySelector('#formProfile');
const inputsFromProfile = formProfile.querySelectorAll('[data-valid="check"]');
let phone = formProfile?.querySelector("#phone");

if (phone){
    let inputMask = new Inputmask('+9 (999) 999-99-99');
    inputMask.mask(phone);
}

for (let input of inputsFromProfile){
    input.addEventListener('input',(input)=>{
        validation(input.target)
    })
}


formProfile.addEventListener('submit', (event) =>{
    let status = true;
    for (let input of inputsFromProfile) {
        if (!validation(input)){
            status = false;
        }
    }
    if(!status){
        event.preventDefault();
    }
})


