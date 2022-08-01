<?php

function render($page, $params = []){
    return renderTemplate('layout/main', [
        'title' => $params['title'],
        'style' => $params['style'],
		'js' => $params['js'],
        'content' => renderTemplate($page, $params),
        'header' => renderTemplate('layout/header', [
            'menu' => renderTemplate('layout/header_components/menu'),
            'cart' => renderTemplate('layout/header_components/cart', [
				'data' => getCart(session_id()),
				'total_price' => getTotalPrice(session_id())['total_price']
			]),
			'quantity' => getCartQuantity(session_id())['quantity']
        ]),
        'footer' => renderTemplate('layout/footer')
    ]);
}


function renderTemplate($page, $params = []){
    ob_start();

    extract($params);

    include TEMPLATES_DIR . $page . ".php";

    return ob_get_clean();
}