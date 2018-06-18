<?php 
/**
 * Модуль обрабатывает данные из URL и вызывает необходимый контролер.
 * Считаем все что за www.example.com/ - именем контроллера.  
 *
 * PHP version 7
 *
 * @category  App
 * @package   Default
 * @author    kurakste <kurakste@gmail.com>
 * @copyright 2018 kurakste
 * @license   http://www.nowhere.net Nothing
 * @version   GIT:2233
 * @link      asjdaks
 */

/**
 * Обрабатывает запрос в адресной строке. 
 * Возвращает название запрошенного контроллера.  
 *
 * @return string $controllerName
 * @author kurakste
 */
function getControllerName()
{
    $arr = explode('/', $_SERVER['REQUEST_URI']);
    $arr = array_filter($arr); 
    
    return $arr;
}

/**
 * Функция по имени вызывает контроллер.
 *
 * @param array $input - содержи результаты разбора URI 
 *
 * @return string $controllerName
 * @author kurakste
 */
function callController(array $input)  
{
    $controller = array_shift($input); 
    $controller = explode('?', $controller);
    $controller = $controller[0];
    $out = '';

    switch ($controller) {
    case '':
        $out = showMainPage();
        break;
    case 'home':
        $out = showMainPage();
        break;
    case 'login':
        $out = showAuthForm();
        break;
    case 'signout':
        $out = signOut();
        break;
    case 'register':
        $out = showRegisterForm();
        break;
    case 'auth':
        $out = showAuthForm();
        break;
    case 'auth-user':
        $out = checkUserAuth();
        break;
    case 'add-new-user':
        $out = addNewUser();
        break;
    case 'contact':
        $out = showContactPage();
        break;
    case 'catalog':
        $out = getCatalogAsHTML();
        break;
    case 'item':
        $par = (int)array_shift($input) ?? 0; 
        $out = getItemAsHTML($par);
        break;
    case 'add-to-cart':
        $itemId = array_shift($input); 
        $out = addToCart($itemId);
        break;
    case 'remove-item-from-cart':
        $itemId = (int)array_shift($input) ?? 0; 
        $out = removeItemFromCart($itemId);
        break;
    case 'edit-cart':
        $out = getCartEditPage();
        break;
    case 'add-new-item-form':
        $out = addNewItemForm();
        break;
    case 'add-new-item':
        $out = addNewItem();
        break;
    case 'remove_item':
        $out = removeItem();
        break;
    case 'edit_item':
        $out = changeItem();
        break;
    case 'save_changes_in_item':
        $out = saveChangeInItem();
        break;
    case 'make_new_order':
        $out = makeNewOrder();
        break;
    case 'show_active_orders':
        $out = showOpenOrders();
        break;
    case 'mark_order_inactive':
        $out = markOrderAsInactive();
        break;
    case 'edit_orders':
        $out = view('editOrder'); 
        break;
    default:
        $out = '<h1>ERROR 404</h1>';
    }
    return $out;
}
