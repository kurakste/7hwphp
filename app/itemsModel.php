<?php

/**
 * Модель извлекает данные из базы и генерит представление для HTML  
 * обрати внимание что что CSS правила к сгенерированным блокам 
 * находятся в общем файле с SCC. Наверняка это не правильно. Нужно 
 * разбираться как это должно работать. 
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
 * Функция вернет айтем каталога по его ID
 *
 * @param string $id Id of items
 *
 * @return html (представление одного айтема для каталога)
 * @author kurakste
 */
function getItemFromDb($id) 
{
    global $db;
    $request = 'SELECT * FROM items where id=\''.$id.'\';';
    $query = mysqli_query($db, $request);
    if (mysqli_num_rows($query)!=0) {
        while ($q = mysqli_fetch_assoc($query)) {
            $out[] = $q;
        }
        $out = $out[0];
        // Теперь в нулевом элементе массива лежит строчка с параметрами айтома.
        $out['titleImagePath'] = getTitleImage($id);
    } else {
        $out = false;
    }
    return $out;
}

/**
 * функция вернет массив адресов изображений для айтома
 *
 * @param $id - id of items
 * @return функция вернет массив адресов изображений для айтома 
 * с конкретным  ID 
 * @author kurakste
 */
function getImagesFromDB ($id) 
{
   global $db;
   $request = 'SELECT * FROM imagesForItems where imageid=\''.$id.'\';';
   $query = mysqli_query($db, $request);
   while ($q = mysqli_fetch_assoc($query)) {
        $out[] = $q;
   }
   return $out ?? '';
}

/**
 * Функция вернет вернет имидж, который должен стоять на транице каталога.
 * На текущий момент это первый инмидж в списке для этого айтема. 
 *
 * @param $id - id of items
 * @return  функция вернет путь до изображения
 * @author kurakste
 */
function getTitleImage ($id) 
{
    $images = getImagesFromDB($id);
    $image = $images[0]['pathtoimage']; 
    return $image;

}
/**
 * Вернет массив ID всех айтемов, которые есть в системе. 
 *
 * @param 
 * @return  массив ID
 * @author kurakste
 */
function getItemIDArray () 
{
   global $db;
   $request = 'SELECT id FROM items;';
   $query = mysqli_query($db, $request);
   while ($q = mysqli_fetch_assoc($query)) {
        $out[] = $q['id'];
   }
   return $out;
}
/**
 * Создает новую позицию в каталоге. 
 *
 * @param [string $name, $condition, $description, $price ]
 * @param array  $images 
 *
 * @return  массив ID
 * @author kurakste
 */

function addNewItemToDb ($input) 
{   
    $data = clearPOSTArrayForMysql();
    extract($data);
    global $db;
    $request = "INSERT INTO items (`Name`, `condition`, `description`, `price`)". 
       " VALUES ('$fname', '$fcondition', '$fdescription', '$fprice');";

    $query = mysqli_query($db, $request);
    $itemId = mysqli_insert_id($db);

    $count = count ($_FILES['myfile']['name']);
    $uploaddir = './img/';
    for ($i=0; $i < $count; $i++) {
       echo $_FILES['myfile']['name'][$i].'<br>'; 
       $uploadfile = $uploaddir.basename($_FILES['myfile']
           ['name'][$i]);
       copy($_FILES['myfile']['tmp_name'][$i], $uploadfile);
       addImageToDb($uploadfile, $itemId);
    }
   return $query;
}

function changeItemInDb($input) 
{
    $data = clearPOSTArrayForMysql();
    extract($data);
    $fname = (string)$fname;
    global $db;
    $request = "UPDATE items SET `Name`='($fname', `condition` = '$fcondition', 
        `description` = '$fdescription', `price` = '$fprice' where `id` = '$itemId';"; 
    $query = mysqli_query($db, $request);

   return $query;
}

function addImageToDb($path, $itemId) 
{
    global $db;
    $request = "INSERT INTO imagesForItems (imageid, pathtoimage) ".
        "VALUES ('$itemId', '$path');"; 
    $query = mysqli_query($db, $request);
    return $query;
}

function removeItemFromDb($itemId) 
{
    global $db;
    $request = "DELETE FROM items WHERE id='$itemId';";
    $query = mysqli_query($db, $request);
    $request = "DELETE FROM imagesForItems WHERE imageid='$itemId';";
    $query = mysqli_query($db, $request);
    return $query;
    
}

