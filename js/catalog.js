const filters = document.querySelectorAll('.filterBox__details_link');
const productsBox = document.querySelector('.productsBox');
const filterBox = document.querySelector('.filterBox');
const pagination = document.querySelector('.pagination');
const btn_more = document.querySelector('.pagination');

window.addEventListener('resize', () =>{
        productsBox.style.gridTemplate = "";
})


filters.forEach((link) =>{
    link.addEventListener('click', (e)=>{
        (async () => {
            btn_more.setAttribute('data-page', '1');
            if(location.pathname.split("/").length === 4){
                let path = location.pathname.split("/");
                path.splice(path.length-1,1);
                path = path.join("/");
                history.pushState(null, null,path + "/" + e.target.id);
            }else if(location.pathname.split("/").length === 5){
                let path = location.pathname.split("/");
                path.splice(path.length-2,2);
                path = path.join("/");
                history.pushState(null, null,path + "/" + e.target.id);
            }else{
                history.pushState(null, null,location.pathname + "/" + e.target.id);
            }
            const response = await fetch('/api/filter',{
               method:'POST',
               headers: new Headers({"Content-type":"application/json"}),
               body: JSON.stringify({
                   type: e.target.id,
                   category: location.pathname.split('/')[2]
               })
            });
            const answer = await response.json();
            if (answer.status === 'success'){
                filterBox.classList.remove('active');
                if(!answer.catalog.length){
                    productsBox.innerHTML = `<p style="text-align: center">К сожалению, у нас отсутствуют данные товары.</p>`;
                    productsBox.style.gridTemplate = "auto/minmax(227px, 1fr)";
                    pagination.style.display ="none";
                }else{
                    if(window.innerWidth > 768){
                        productsBox.style.gridTemplate = "auto/repeat(4, minmax(227px, 1fr))";
                    }else if(window.innerWidth <= 425){
                        productsBox.style.gridTemplate = "auto/minmax(227px, 1fr)";
                    }else{
                        productsBox.style.gridTemplate = "auto/repeat(3, minmax(227px, 1fr))";
                    }
                    productsBox.innerHTML = '';
                    pagination.style.display = "flex";
                    for(let item of answer.catalog){
                        let productItem = createProductItem(item);
                        productsBox.insertAdjacentHTML('beforeend', productItem);
                    }
                }
            }
        })();
    })
})

function createProductItem(item){
    return `
    <div class="productsItem" data-id="${item.id}">
        <a href="/product/${item.id}" class="productsItem imageContainer">
            <img
                    src="/images/catalog/${item.id}.jpg"
                    alt="image product"
            />
        </a>
        <div class="productsItem__textContainer">
            <h4 class="productsItem__textContainer__heading" id="title">
                ${item.title}
            </h4>
            <p class="productsItem__textContainer__text">
                ${item.description}
            </p>
        </div>
        <div class="productsItem__button">
            <p class="productsItem__button_price"> <span id="price">${item.price}</span> &#x20bd</p>
        </div>
    </div>`;
}

btn_more.addEventListener('click', ()=>{
    (async ()=>{
        let category = null;
        let type = null;
        let array_url  = location.pathname.split('/');
        let catalog_length = productsBox.querySelectorAll('[data-id]').length;
        if(isNaN(+array_url[array_url.length - 1])){
            history.pushState(null, null, location.pathname + '/' + btn_more.getAttribute('data-page'));
        }else{
            array_url.splice(array_url.length - 1,1);
            let path = array_url.join('/');
            history.pushState(null, null,path + '/' + btn_more.getAttribute('data-page'));
        }
        category = array_url[2];
        if(array_url.length === 4){
            type = array_url[3];
        }
        const response = await fetch('/api/more',{
            method: 'POST',
            headers: new Headers({"Content-type":"application/json"}),
            body: JSON.stringify({
                page: btn_more.getAttribute('data-page'),
                windowWith: window.innerWidth,
                category,
                type,
                catalog_length
            })
        })
        const answer = await response.json();
            if (answer.status === 'success'){
                if(answer.catalog.length !== 0){
                    productsBox.innerHTML = '';
                    for(let item of answer.catalog){
                        let productItem = createProductItem(item);
                        productsBox.insertAdjacentHTML('beforeend', productItem);
                    }
                    btn_more.setAttribute('data-page', answer.page);
                }
            }else{
                btn_more.style.display = "none";
            }
    })();
})