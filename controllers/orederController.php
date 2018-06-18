<?php
/**
 * Контроллер полчает управление от корзины. Его задача передать данные
 * для добавления в модель Orders c правильными параметрами. 
 *
 * @return перенаправляет пользователя в каталог.
 * @author kurakste
 */
function makeNewOrder()
{
    $userId = (integer)$_SESSION['userid'];
    $cartsItems = $_SESSION['cart'];
    $result = addNewOrderToDatabase($userId, $cartsItems);
    if (!$result) return false;
    
    // Если заказ сформирован - удалить корзину.
    unset ($_SESSION['cart']); 
    header('Location:/catalog');
    return true;
}

/**
 * Выводит пользователю текущие открытые в системе заказы.  
 *
 * @return  JSON объект с заказами. Эта страница обрабатывается с стороны
 * фронтенда. 
 * @author kurakste
 */
function showOpenOrders() 
{
    /* $result = getOrdersByStatusFromDb(1); */
    $result = getOrderByStatusAsFlatTabelFromDb(1);
    $out = json_encode($result);
    echo $out;
    exit;
    return $out;
}

/**
 * Распаковывает пост запрос от пользователя, извлекает id заказа и 
 * помечает этот заказ как не активный. 
 *
 * @return nul 
 * @author kurakste
 */
function markOrderAsInactive () 
{
    $orderId = $_POST['orderId'] ?? null;
    if ($orderId) {
        markOrderAsInactiveInDb($orderId);
    } 
}
