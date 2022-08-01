import checkPattern from "./checkPattern.js";

function validation(input){
    let error = document.querySelector('#' + input.id + '+ span.error');
    if(!input.value.length){
        input.className = 'invalid';
        error.className = 'error active';
        error.textContent = "Поле обязательно к заполнению";
        return false;
    }else if(!checkPattern(input.id, input.value)){
        input.className = 'invalid';
        error.className = 'error active';
        switch (input.id){
            case 'country':
            case 'city':
            case 'fio':
            case 'firstName':
            case 'secondName':
                error.textContent = "Используйте кириллицу";
                break;
            case 'postcode':
                error.textContent = "В почтовом индексте 6 цифр";
                break;
            case 'phone':
                error.textContent = "Введите номер телефона по формату: +7 (999) 999-99-99";
                break;
            case 'email':
                error.textContent = "Некорректно задан адрес электронной почты";
                break;
            case 'password':
                error.textContent = "Используйте 8 или более символов, 1 цифру и 1 прописную букву";
        }
        return false;
    }
    input.className = 'valid';
    error.className = 'error';
    error.textContent = "";
    return true;
}

export default validation;