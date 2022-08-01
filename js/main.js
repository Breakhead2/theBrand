import addProduct from "./modules/addProduct.js";

//логика работы бургер-меню и кнопок в шапке
const removeActiveClass = () => {
    let actives = document.querySelectorAll('.active');
    actives.forEach(item => {
        item.classList.remove('active');
    })
}

const addActiveClass = (title, ...boxes) =>{
    if (title.classList.contains('active')){
        removeActiveClass();
    }else{
        removeActiveClass();
        title.classList.add('active');
        boxes.forEach(item => item.classList.add('active'));
    }
}

window.addEventListener('click', ()=>{
    findAttribute(event);
})

const findAttribute = (event) => {
    let currentElement = event.target;
    if (currentElement.hasAttribute('active')){
        let block = currentElement.closest("div[box]");
        addActiveClass(block);
    }
}

let btn_menu = document.querySelector('#menu_btn');
let menu = document.querySelector('.menuList');
btn_menu.addEventListener('click', () => {
    addActiveClass(btn_menu, menu)
})

let btn_cart = document.querySelector('#cart_btn');
let cart = document.querySelector('.cartContainer');
btn_cart.addEventListener('click', () => {
    addActiveClass(btn_cart, cart)
})

let btn_search = document.querySelector('#search_btn');
let searchForm = document.querySelector('.searchForm');
btn_search.addEventListener('click', () => {
    addActiveClass(btn_search, searchForm)
})


window.onscroll = ()=>{
    let scrollTop = document.documentElement.scrollTop;
    if (scrollTop >= 500){
       removeActiveClass();
    }
}

//Валидация и отправки email сабов

let subForm = document.querySelector('#form');
let subsInput = subForm?.querySelector('#email_sub');
let error_subs = subForm?.querySelector('.error_subs');
const patternEmail = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\\.[a-zA-Z0-9-]+)*$");

subForm?.addEventListener('submit', (event) =>{
	event.preventDefault();
	if(!subsInput.value.length){
		error_subs.className = 'error_subs active';
		error_subs.innerText = 'Поле пустое';
	}else if(patternEmail.test(subsInput.value)){
		(async () => {
			const response = await fetch('/api/subs', {
				method: 'POST',
				headers: new Headers({"Content-type":"application/json"}),
				body: JSON.stringify({
					email: subsInput.value
				})
			})
			error_subs.className = 'error_subs';
			subsInput.value = '';
			const answer = await response.json();
			if(answer.status === 'already have'){
				error_subs.className = 'error_subs active';
				error_subs.innerText = 'Вы уже наш подписчик';
			}
		})()
	}else{
		error_subs.className = 'error_subs active';
		error_subs.innerText = "Некорректно задан адрес электронной почты";
	}
})


//передача разрешения экрана

window.onload = async () =>{
	const response = await fetch('/api/window',{
		method: 'POST',
		headers: new Headers({"Content-type":"application/json"}),
		body: JSON.stringify({
			window: window.innerWidth
		})
	});
}

//слайдер отзывов
let offset = 0;
const review = document.querySelector('.review');

setInterval(()=>{
	offset += 280;
	if(offset > 744) offset = 0
	review.style.bottom = offset + 'px';
}, 7000);

