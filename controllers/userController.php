<?php
/**
 * Контроллер обрабатывает все что относится к аутентификации пользовалеля и 
 * определения его прав в системе. 
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
const SALT = 'THIS IS MY SOLT@#$$#@!';

/**
 * Функция выведи на экран форму для ввода пользователем логина и пароля.
 *
 * @return view with login form. 
 * @author kurakste
 */
function showLoginForm() 
{
    echo 'hi!';
}

/**
 * Функция выведи на экран форму для регистрации нового пользователя в системе.
 *
 * @return view with login form. 
 * @author kurakste
 */
function showRegisterForm() 
{
    return view('registrationForm');
}
/**
 * Функция выведи на экран форму для аутентификации пользователя в системе.
 *
 * @return view with auth form. 
 * @author kurakste
 */
function showAuthForm() 
{
    return view('authForm');
}
/**
 * Функция проверит пользовательский ввод на недопустимые символы.
 * Вернет true если данные валидние и false если нет.
 *
 * @param string $input String for checking.
 *
 * @return void
 * @author kurakste
 */
function clearInput(string $input) 
{
    return true;
}

/**
 * Функция зарегестирирует в системе нового пользователя. 
 *
 * @return view with login form. 
 * @author kurakste
 */
function addNewUser() 
{
    $fname = $_POST['fname'];
    $fpassword = $_POST['fpassword'];

    if (!($fname) || !($fpassword)) {
        echo 'error!';
        die;
    } 

    $password = crypt($fpassword, SALT);
     
    if (!addNewUserToDB($fname, $password)) {
        return 'User with such name exist.';
    }  
    checkUserAuth();
    header('Location: /');    
}

/**
 *  Функция проверяет установлен совпадает ли логин и прароль с существующими 
 *  в базе. Если да, то добавляет к сeссии имя пользователя и 
 *  его id в базе данных. Затем переадресует браузер /.
 *
 * @return view with login form. 
 * @author kurakste
 */
function checkUserAuth()
{
    $fname = $_POST['fname'];
    $fpassword = $_POST['fpassword'];

    if (!($fname) || !($fpassword)) {
        
        header('Location: /auth');    
        die;
    } 
    
    $password = crypt($fpassword, SALT);
    
    if (!chekUserAuthInDB($fname, $password)) {
        header('Location: /auth');    
        die;
    } else {
        loadCartFromDb();
        header('Location: /');    
        return true;
    } 
    
} 

/**
 * Функция уничтожает данные сессии и перегружает на домашнюю страничку. 
 *
 * @return / 
 * @author kurakste
 */
function signOut()
{
    unset($_SESSION['name']);
    unset($_SESSION['userid']);
    unset($_SESSION['cart']);
    unset($_SESSION['userRole']);
    header('Location: /');    
        
    return true;
} 
