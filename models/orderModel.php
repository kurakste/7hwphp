<?php
/**
 * Модель отвечает за обработку заказов.
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
 *  Добавляет новый заказ в базу данных.
 *
 *  @param $userId    integer Айди пользователя.
 *  @param $cartItems array   Массив элементов корзины.
 *
 * @return boolean
 * @author kurakste
 */
function addNewOrderToDatabase(int $userId, array $cartsItems) 
{
    global $db;
    // Поле active по умолчанию ставится в true.   
    $request = "INSERT INTO orders (`userid`) VALUES ('$userId');";
    $query = mysqli_query($db, $request);

    if (!$query) return false; 
    $orderId = mysqli_insert_id($db);

    foreach ($cartsItems as $item) {
        $itemId = $item['itemid'];
        $request = "INSERT INTO ordersStrings (`orderid`, `itemId`, `amount`)
             VALUES ('$orderId', '$itemId', '1');";
        $query = mysqli_query($db, $request);
    if (!$query) return false; 
    }
    return true;
}

/**
 * Выбирает все открытые заказы и формирует массив объеденяя данные из 
 * таблиц orders, items, users, OrderStrings для вывода в панели администратора.
 * Содержит заголовок заказа и его табличную часть.
 * @param $status boolean Статус заказа.
 *
 * @return array
 * @author kurakste
 */
function getOrdersByStatusFromDb($status)
{
    global $db;
    $request =
        "SELECT o.`id`, o.`active`, u.`Name` 
            FROM `orders` as o 
            LEFT JOIN (`users` as u) ON (o.`userId` = u.`id`)
            WHERE o.`active` = '$status';";
        
    $query = mysqli_query($db, $request);
    $out =[];
    while ($row = mysqli_fetch_assoc($query)) {
        $orderId = $row['id'];
        $request =
            "SELECT i.`Name`, i.`description`, i.`condition`, i.`price`, 
            s.`amount` FROM `orders` as o 
            LEFT JOIN (`ordersStrings` as s) ON (o.`id` = s.`orderId`) 
            LEFT JOIN (`items` as i) ON (s.`itemId` = i.`id`) 
            LEFT JOIN (`users` as u) ON (o.`userId` = u.`id`)
            WHERE o.`id` = '$orderId';";
            $query2 = mysqli_query($db, $request);
            $out2 = [];
            while ($itemsrow = mysqli_fetch_assoc($query2)) {
                $out2[]= $itemsrow;
            }
        $row['items'] = $out2;
        $out[] = $row;
    }
    return $out;
}

/**
 * Функция вернет все заказы, которые соответствуют указанному статусу
 * в виде строк с суммой и кол-вом айтемов без их расшифровки.
 *
 * @param $status string Status of order for filter.
 *
 * @return array
 * @author kurakste
 */
function getOrderByStatusAsFlatTabelFromDb($status)
{
    global $db;
    $request ="
        SELECT orders.`id`, users.`name`, orders.`active`, 
        SUM(ordersStrings.`amount`) as items, SUM(items.`price`) 
        as sum FROM `orders` 
        LEFT JOIN ordersStrings ON (`ordersStrings`.`orderId` = orders.`id`)
        LEFT JOIN items ON (ordersStrings.`itemId`=items.`id`)
        LEFT JOIN users ON (orders.`userId`=users.`id`)
        GROUP BY orders.`id`
        HAVING orders.`active`='$status';
    ";

    $query = mysqli_query($db, $request);
    $out =[];
    while ($row = mysqli_fetch_assoc($query)) {
        $out[] = $row;
    }

    return $out;
}

/**
 * Пометить заказ с данным номером как не активный (завершенный) 
 *
 * @param $orderId string id of order for filter.
 *
 * @return bulean
 * @author kurakste
 */
function markOrderAsInactiveInDb ($orderId) 
{
    global $db;
    $request ="
        UPDATE orders set active = '0' WHERE id = '$orderId';
    ";
    $query = mysqli_query($db, $request);
    $out = $query ? true : false;
    return $out;

}
