async function addProduct (button){
    let cartIndicator = document.querySelector('#quantityItemsInCard');
    let totalPrice = document.querySelector('#total_price');
    let cartBox = document.querySelector('.cartBox');
    let productId = button.closest('.productsItem').getAttribute('data-id');
    let price = button.closest('.productsItem').querySelector('#price').innerText;
    let title = button.closest('.productsItem').querySelector('#title').innerText;
    const response = await fetch('/api/add', {
        method: 'POST',
        headers: new Headers({'Content-type': 'application/json'}),
        body: JSON.stringify({
            'productId': productId,
            'price': price,
            'title': title
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
    }else{
        let currentItem = cartBox.querySelector("div[data-cartId='"+answer.item.id+"']"); // поиск элемента через дата-атрибут
        currentItem.querySelector('#quantity').innerText = answer.item.quantity;
    }
}
export default addProduct;