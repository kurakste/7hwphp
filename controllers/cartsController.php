<?php
/**
 * Контроллер отвечает за все операции с корзиной кроме
 * вывода инконки в хедере. Иконка обрабатывается компонентой
 * cart.php и берет данные из $_SESSION['cart']. 
 * $_SESSION['cart'] содержит массив вида:
 * [
 *  ['itemId'=>'2', 'itemName'=>'PHP....', 'price' =>'300'],
 *  ['itemId'=>'4', 'itemName'=>'JQuery....', 'price' =>'300'],
 * ]
 *
 * PHP version 7
 *
 * @category  App
 * @package   Default
 * @author    kurakste <kurakste@gmail.com>
 * @copyright 2018 kurakste
 * @license   http://www.nowhere.net Nothing
 * @version   GIT:0001
 * @link      noway
 */

/**
 *   Функция добавит айтем в корзину.
 * 
 * @param string $itemId Айди айтема, который нужно добавить в корзину.
 *
 * @return void
 * @author kurakste
 */
function addToCart($itemId)
{
    addItemToCart($itemId);    
    $itemInCart = getCartAsArray();
    $_SESSION['cart'] = [];

    foreach ($itemInCart as $item) {
        $_SESSION['cart'][]=$item;
    }
    header('Location: /catalog');    
}
/**
 *   Функция удалит айтем из корзины.
 * 
 * @param string $itemId Айди айтема, который нужно удалить из корзины.
 *
 * @return void
 * @author kurakste
 */
function removeItemFromCart($itemId)
{
    removeCartsItemFromDb($itemId);    
    $itemInCart = getCartAsArray();

    $_SESSION['cart'] = [];
    foreach ($itemInCart as $item) {
        $_SESSION['cart'][]=$item;
    }
    header('Location: /edit-cart');    
}

/**
 *   Функция востановит состояние корзины с прошлого визита.
 * 
 * @author kurakste
 * @return void
 */
function loadCartFromDb()
{
    $itemInCart = getCartAsArray();
    $_SESSION['cart'] = [];

    foreach ($itemInCart as $item) {
        $_SESSION['cart'][]=$item;
    }
}

/**
 * Returns curent catalog as HTML string
 *
 * @return void
 */
function getCartEditPage()
{
    $out = renderComponent('editCart');

    return directView(['content'=>$out]);
}


