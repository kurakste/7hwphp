<?php
/**
 * Модель пользователей. Реализует функции добавить/удалить/проверить пароль
 * пользователья. 
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
 * Функция создает нового пользователя с именем  $user и паролем $password
 *
 * @param string $user     User name.
 * @param string $password Password.
 *
 * @return void
 * @author kurakste
 */
function addNewUserToDB(string $user, $password)
{
    global $db;
    $user = mysqli_real_escape_string($db, $user); 
    $request = 'INSERT INTO users(name, password) VALUES (\''
        .$user.'\',\''.$password.'\');';

    $query = mysqli_query($db, $request);
    
    /* echo 'var: '.$query. '<br>'; */
    /* die; */
    
    return $query;
     
}

/**
 * Функция функция проверяет есть ли в базе данных пользователь с таким
 * сочитанием мени пользователя и пароля. Если есть устанавливает 
 * в сессии значения переменным name & userid возвращает true. 
 *
 * @param string $user     User name.
 * @param string $password Password.
 *
 * @return boolean
 * @author kurakste
 */
function chekUserAuthInDB(string $user, $password)
{
    global $db;
    $user = mysqli_real_escape_string($db, $user); 
    $request = 'SELECT id, name, password, role FROM users WHERE name=\''
        .$user.'\';';
    
    $query = mysqli_query($db, $request);
    
    if (!$query) {
        $out = false;
    } else {
        $result = mysqli_fetch_assoc($query);

        if (!$result['name']) {
            $out = false;
        } else { 
            $out = ($password === $result['password']);
            if ($out) {
                $_SESSION['name'] = $result['name'];
                $_SESSION['userid'] = $result['id'];
                $_SESSION['userRole'] = $result['role'];
            }
        } 
    }
    return $out;
}
     

