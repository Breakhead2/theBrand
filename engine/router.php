<?php
function router($page, $array_url, $action = ""): array
{
    $data = [];

    switch($page){
        case 'review':
            $user = getUserById($_SESSION['user']);
            $review = $_POST['review'];
            createReview($_SESSION['user'], $user['name'], $user['surname'], $user['profile_photo'], $review);
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();
        case 'search':
            $_SESSION['search'] = $_POST['search'];
            header("Location: /catalog");
            die();
        case 'edit':
            $profile = [];
            if($_FILES['profile_photo']['size']){
                loadImage();
                $profile['profile_photo'] = $_FILES['profile_photo']['name'];
            }
            $profile ['country'] = safety($_POST['country']);
            $profile ['city'] = safety($_POST['city']);
            $profile ['postcode'] = safety($_POST['postcode']);
            $profile ['phone'] = validation('phone', $_POST['phone']);
            $profile ['about'] = safety($_POST['about']);
            $filtered = checkChanges($profile);
            if(!empty($filtered)) editUser($filtered);
            header("Location: /profile");
            die();

        case 'logout':
            session_regenerate_id();
            session_destroy();
            setcookie("user", "", time()  -3600, "/");
            header("Location: /");
            die();
        case 'login':
            $email = safety($_POST['email']);
            $password = safety($_POST['password']);

            if(auth($email, $password)){
                unset($_SESSION['error']);
                header("Location: /");
                die();
            }
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();

        case 'signup':
            $name = safety($_POST['firstName']);
            $surname = safety($_POST['secondName']);
            $gender = $_POST['gender'];
            $email = safety($_POST['email']);
            $password = safety($_POST['password']);

            if(signup($name, $surname, $gender, $email, $password)){
                header("Location: /");
                die();
            }

            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();

        case 'enter':
            $data["page"] = 'enter';
            $data["params"] = [
                'title' => 'Вход',
                'style' => 'login',
                'js' => 'auth',
                'review' => renderTemplate('components/review',[
                    'review' => getReviews()
                ])
            ];
            break;
        case 'catalog':
            $windowWith = $_SESSION['window'];
            if($_SESSION['search']){
                $catalog = getCatalogBySearch($windowWith, $_SESSION['search']);
                unset($_SESSION['search']);
            }else{
                if(count($array_url) === 5){
                    $list = $array_url[4];
                    $type = $array_url[3];
                    $category = $array_url[2];
                    $catalog = filter($type,$category, $windowWith, $list);
                }elseif(count($array_url) === 4){
                    $category = $array_url[2];
                    if($array_url[3] > 0){
                        $list = $array_url[3];
                        $catalog = getCatalog($category, $windowWith, $list);
                    }else{
                        $type = $array_url[3];
                        $catalog = filter($type, $category, $windowWith);
                    }
                }else{
                    $category =  $array_url[2];
                    $catalog = getCatalog($category, $windowWith);
                }
            }
            if(is_null($catalog)){
                $data["page"] = "404";
                $data["params"] = [
                    'title' => '404'
                ];
            }else{
                $data["page"] = "catalog";
                $data["params"] = [
                    'title' => 'Каталог',
                    'style' => 'catalog',
                    'js' => 'catalog',
                    'review' => renderTemplate('components/review',[
                        'review' => getReviews()
                    ]),
                    'guarantees' => renderTemplate('components/guarantees'),
                    'catalog' => $catalog,
                ];
            }
            break;

        case 'product':
            $id = $array_url[count($array_url) - 1];
            $product = getProduct($id);
            if(is_null($product)){
                $data["page"] = "404";
                $data["params"] = [
                    'title' => '404'
                ];
            }else{
                $images = array_splice(scandir("images/catalog/items_image/" . $id), 2);
                $data["page"] = "product";
                $data["params"] = [
                    'title' => $product['title'],
                    'style' => 'product',
                    'js' => 'product',
                    'review' => renderTemplate('components/review',[
                        'review' => getReviews()
                    ]),
                    'data' => $product,
                    'images' => $images,
                    'another' => recommendation($product['category'], $product['types'], $_SESSION['window'], $product['id']),
                    'colors' => getColors($id),
                    'sizes' => getSizes($id)
                ];
            }
            break;

        case 'registration':
            $data["page"] = "registration";
            $data["params"] = [
                'title' => 'Регистрация',
                'style' => 'registration',
                'js' => 'auth',
                'review' => renderTemplate('components/review',[
                    'review' => getReviews()
                ])
            ];
            unset($_SESSION['error']);
            break;

        case 'cart':
            $data["page"] = "cart";
            $cart = getCart(session_id());
            $sizes = [];
            $colors = [];
            foreach ($cart as $item){
                foreach ($item as $key => $value){
                    if($key === 'product_id'){
                        $sizes[$value] = getSizes($value);
                        $colors[$value] = getColors($value);
                }
               }
            }
            $data["params"] = [
				'js' => 'cart',
                'total_price' => getTotalPrice(session_id())['total_price'],
                'title' => 'Корзина',
                'style' => 'cart',
                'review' => renderTemplate('components/review',[
                    'review' => getReviews()
                ]),
				'data' => $cart,
				'sizes' => $sizes,
				'colors' => $colors,
            ];
            if (isset($_SESSION['user'])){
                $data["params"]["user"] = getUserById($_SESSION['user']);
            }
            break;

        case 'index':
            $data["page"] = "index";
            $data["params"] = [
                'style' => 'index',
                'title' => 'The Brand',
                'review' => renderTemplate('components/review',[
                    'review' => getReviews()
                ]),
                'guarantees' => renderTemplate('components/guarantees'),
                'featured' => getFeaturedProducts($_SESSION['window'])
            ];
            break;

        case 'profile':
            if($action !== $_SESSION['user']){
                $action = $_SESSION['user'];
            }
            $user = getUserById($action);
            $data["page"] = "profile";
            $data["params"] = [
                'style' => 'profile',
                'title' => $user['name'] . " " . $user['surname'],
                'user' => $user,
                'review' => renderTemplate('components/review',[
                    'review' => getReviews()
                ]),
                'reviewEdit' => renderTemplate('reviewEdit')
            ];
            break;

        case 'profileEdit':
            if($action !== $_SESSION['user']){
                $action = $_SESSION['user'];
            }
            $user = getUserById($action);
            $data["page"] = "profileEdit";
            $data["params"] = [
                'style' => 'profileEdit',
                'js' => 'profile',
                'title' => $user['name'] . " " . $user['surname'],
                'user' => $user,
                'review' => renderTemplate('components/review',[
                    'review' => getReviews()
                ]),
            ];
            break;

		case 'api':
			$action = $array_url[count($array_url) - 1];
            $answer = restApi($action);
            header('Content-type: application/json');
            echo json_encode($answer);
            die();

        default:
            $data["page"] = '404';
            $data["params"] = [
                'title' => '404'
            ];
    }

    return $data;
}
