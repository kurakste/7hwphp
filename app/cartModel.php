<?php
/**
 * Модель отвечает за все операции с корзиной в базе данных.
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
 *  Добавит к корзине пользователя айтем.
 *
 * @param string $itemId Just item's id whos we will ad in cart.
 *
 * @return void
 * @author kurakste
 */
function addItemToCart($itemId)
{
    global $db;
    $userId = $_SESSION['userid'];
    $request = "INSERT INTO carts(userid, itemid) VALUE ".
        "('$userId', '$itemId');";
    $query = mysqli_query($db, $request);
}

/**
 *  Удалить из корзины переданный айтем.
 *
 * @param string $itemId Just item's id whos we will ad in cart.
 *
 * @return void
 * @author kurakste
 */
function removeCartsItemFromDb($itemId)
{
    global $db;
    $request = "DELETE FROM carts WHERE id='$itemId';";
    $query = mysqli_query($db, $request);
}

/**
 * Получить содержимое корзины в виде массива.  
 *
 * @return array;
 * @author kurakste
 */
function getCartAsArray()
{
    $userId = $_SESSION['userid'];
    global $db;
    $request =
    "SELECT carts.`id`, carts.`itemid`, Name, price FROM `carts`  
    LEFT JOIN `items` ON (carts.`itemid` = items.`id`) 
    WHERE userId = '$userId';";
    $query = mysqli_query($db, $request);
    $result = [];

    while ($row=mysqli_fetch_assoc($query)) {
        $result[] = $row; 
    };
    return $result;
}
