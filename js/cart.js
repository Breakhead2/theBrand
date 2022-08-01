//подключение модулей
import validation from "./modules/validation.js";

let cards_container = document.querySelector('.cardBox__cards');
let cartBtnsDlt = document.querySelectorAll('#cartBtnDlt');
let totalPriceBox = document.querySelector('.formBox__check_priceBlock_totalPrice');
let cartContainer = document.querySelector('.cards__container');
let cartIndicator = document.querySelector('#quantityItemsInCard');
let totalPrice = document.querySelector('#total_price');
let cartBox = document.querySelector('.cartBox');

//удаление товара

cartBtnsDlt.forEach(btn => {
	btn.addEventListener('click', () =>{
		(async ()=>{
			let cartItemId = btn.closest('.cardBox__cards_item').getAttribute('data-cartId');
			const response = await fetch('/api/delete', {
				method: 'POST',
				headers: new Headers({'Content-type':'application/json'}),
				body: JSON.stringify({'cartId':cartItemId})
			});
			const answer = await response.json();
			if(answer.quantity === null){
				cartContainer.style.gridTemplate = "auto/1fr";
				cartContainer.innerHTML = `<p style = "text-align: center; font-family: inherit; font-size: 20px">Корзина пуста</p>`;
				cartIndicator.innerText = "0";
				totalPrice.innerText = "0";
				cartBox.innerHTML = `<p>Корзина пуста</p>`;
			}else{
				if(answer.status === 'deleted'){
					cartBox.removeChild(document.querySelector("div[data-cartId='"+cartItemId+"']"));
					cards_container.removeChild(document.querySelector("div[data-cartId='"+cartItemId+"']"));
					let price = totalPriceBox.querySelector('#totalPrice');
					price.innerText = answer.totalPrice;
					cartIndicator.innerText = answer.quantity;
					totalPrice.innerText = answer.totalPrice;
				}
			}
		})()
	});
});

//изменение кол-ва

let inputs = cards_container?.querySelectorAll('#inputQuantity');

inputs?.forEach(input => {
	input.addEventListener('change', () => {
		if(input.value < 1){
			return input.value = 1;
		}
		(async ()=>{
			let cartItemId = input.getAttribute('data-id');
			let value = input.value;
			const response = await fetch('/api/change',{
				method: 'POST',
				headers: new Headers({"Content-type" : "application/json"}),
				body: JSON.stringify({
					'cartId': cartItemId,
					'value': value
				})
			});
			const answer = await response.json();
			let price = totalPriceBox.querySelector('#totalPrice');
			price.innerHTML = answer.totalPrice;
			totalPrice.innerHTML = answer.totalPrice;
			input.value = answer.item.quantity;
			cartIndicator.innerText = answer.quantity;
			let currentItem = cartBox.querySelector("div[data-cartId='"+answer.item.id+"']"); // поиск элемента через дата-атрибут
			currentItem.querySelector('#quantity').innerText = answer.item.quantity;
		})()
	});
});

//Изменение цвета и размера

let selects = document.querySelectorAll('select');

selects.forEach((select) =>{
	select.addEventListener('change', ()=>{
		let value = select.options[select.selectedIndex].value;
		let cart_id = select.closest('.cardBox__cards_item').getAttribute('data-cartId');
		(async () => {
			const response = await fetch('api/change',{
				method: "POST",
				headers: new Headers({"Content-type" : "application/json"}),
				body: JSON.stringify({
					change: select.getAttribute("data-name"),
					value,
					cart_id
				})
			});
			const answer = await response.json();
		})();
	})
})


//очистка корзины

let clear_cart = document.querySelector('.cardBox__buttons_btnClear');

clear_cart?.addEventListener('click', () => {
	(async ()=> {
		const response = await fetch('/api/clearcart',{
			method: 'POST',
			headers: new Headers({"Content-type":"application/json"})
		});
		const answer = await response.json();
		if(answer.status === 'cart clear'){
			cartContainer.style.gridTemplate = "auto/1fr";
			cartContainer.innerHTML = `<p style = "text-align: center; font-family: inherit; font-size: 20px">Корзина пуста</p>`;
			cartIndicator.innerText = "0";
			totalPrice.innerText = "0";
			cartBox.innerHTML = `<p>Корзина пуста</p>`;
		}
	})()
});

//Валидация формы

const myForm = document?.querySelector('#myForm');
const inputsCart = myForm?.querySelectorAll('input'); // все инпуты формы
const country = myForm?.querySelector("#country");
const city = myForm?.querySelector("#city");
const postcode = myForm?.querySelector("#postcode");
const fio = myForm?.querySelector('#fio');
const phone = myForm?.querySelector("#phone");
const email = myForm?.querySelector("#email");

//плагин - маска
if (phone){
	let inputMask = new Inputmask('+9 (999) 999-99-99');
	inputMask.mask(phone);
}

if(inputsCart){
	for (let input of inputsCart){
		input?.addEventListener('input',(input)=>{
			validation(input.target)
		})
	}
}

myForm?.addEventListener('submit', (event) => {
	event.preventDefault();
	let status = true;
	for (let input of inputsCart) {
		if (!validation(input)){
			status = false;
		}
	}

	if(status){
		(async () => {
			let phoneNums = phone.value.split('').filter(item =>{
				if(['+', '-', ' ', '(', ')'].indexOf(item) === -1) return item;
			}).join('');
			let response = await fetch('/api/offer',{
				method: 'POST',
				headers: new Headers({"Content-type" : "application/json"}),
				body:JSON.stringify({
					country: country.value,
					city: city.value,
					postcode: postcode.value,
					fio: fio.value,
					phone: phoneNums,
					email: email.value
				})
			});
			const answer = await response.json();
			if(answer.status === 'success'){
				cartContainer.style.gridTemplate = "auto/1fr";
				cartContainer.innerHTML = `<p style = "text-align: center; font-family: inherit; font-size: 20px">Ваш заказ принят. В течении часа с вами свяжется наш оператор</p>`;
				cartIndicator.innerText = "0";
				totalPrice.innerText = "0";
				cartBox.innerHTML = `<p>Корзина пуста</p>`;
			}
		})()
	}
});


