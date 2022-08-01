let colors_box = document.querySelector('[data-id = "colors"]');
let sizes_box = document.querySelector('[data-id = "sizes"]');
let form = document.querySelector('#colors_sizes_form');
let colors = colors_box?.querySelectorAll('input');
let sizes = sizes_box?.querySelectorAll('input');
let product_id = document.querySelector('.itemInfoBox').getAttribute("data-item");
let title = document.querySelector('.itemDescription__title').innerText;
let price = document.querySelector('.itemDescription__price span').innerText;
let checked_color = null;
let checked_size = null;
let error = form.querySelector('.error');
let cartIndicator = document.querySelector('#quantityItemsInCard');
let totalPrice = document.querySelector('#total_price');
let cartBox = document.querySelector('.cartBox');

form.addEventListener('submit', (event)=>{
    event.preventDefault();

    if(colors){
        for(let i = 0; i < colors.length; i++){
            if(colors[i].checked) checked_color = colors[i];
        }
    }
    if(sizes){
        for(let i = 0; i < sizes.length; i++){
            if(sizes[i].checked) checked_size = sizes[i];
        }
    }


    if(colors !== undefined && checked_color === null){
        error.className = "error active";
        error.innerText = "Вы не выбрали цвет";
        return
    }else if (sizes !== undefined && checked_size === null){
        error.className = "error active";
        error.innerText = "Вы не выбрали размер";
        return
    }
    error.className = "error";
    error.innerText = "";

    (async ()=>{
        const response = await fetch('/api/add',{
            method:'POST',
            headers: new Headers({"Content-type" : "application/json"}),
            body: JSON.stringify({
                product_id,
                title,
                price,
                color: checked_color?.getAttribute("data-color"),
                size: checked_size?.getAttribute("data-size")
            })
        });
        const answer = await response.json();
        cartIndicator.innerText = answer.quantity;
        totalPrice.innerText = answer.totalPrice;
        if(answer.status === "new"){
            let element = `<div class="cartItem" data-cartId="${answer.item.id}">
								<a href="/product/${answer.item.product_id}">
									<img src="/images/catalog/${answer.item.product_id}.jpg" alt="item image" />
								</a>
								<div class="cartItem__info">
									<h3 class="cartItem__info__title">${answer.item.title}</h3>
									<div class="cartItem__info__price">
									    <p style="margin-bottom:5px">Цвет:
                                            <span id="color">${answer.item.color}</span>
                                        </p>
                                        <p style="margin-bottom:5px">Размер:
                                            <span id="size">${answer.item.size}</span>
                                        </p>
										<p style="margin-bottom:5px">Количество: 
											<span id="quantity">${answer.item.quantity}</span>
										</p>
										<p>Цена: <span id="price">${answer.item.price}</span> &#x20bd </p>
									</div>
								</div>
							</div>`;

            if(!cartBox.querySelector('.cartItem')){
                cartBox.innerHTML = '';
            }
            cartBox.insertAdjacentHTML('beforeend', element);

            let color_span = cartBox.querySelector('#color');
            let size_span = cartBox.querySelector('#size');
            if(!color_span.innerText.length){
                let row = color_span.closest('p');
                row.remove();
            }
            if(!size_span.innerText.length){
                let row = size_span.closest('p');
                row.remove();
            }

        }else{
            let currentItem = cartBox.querySelector("div[data-cartId='"+answer.item.id+"']"); // поиск элемента через дата-атрибут
            currentItem.querySelector('#quantity').innerText = answer.item.quantity;
        }
    })()

})