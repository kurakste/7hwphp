<?php
/**
 * Набор методов, отвечающих за рендеринг контента.
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
 * Функция рендерить вид. 
 *
 * @param string $file Name of view.
 * @param array  $vars Variables for rendering view.
 *
 * @return view 
 * @author kurakste
 */
function render($file, array $vars = []) 
{
    $content = file_get_contents('../view/templates/'.$file.'.php');

    foreach ($vars as $name => $value) {
        $content = str_replace('{{'.$name.'}}', $value, $content);
    }
    return $content;
}

/**
 * Функция рендерить вид. 
 *
 * @param string $name Name of view.
 * @param array  $data Variables for rendering view.
 *
 * @return view
 * @author kurakste
 */
function view($name, array $data =[]) 
{
    $content = file_get_contents('../view/'.$name.'.php');
    $data['content'] = $content;
    $data['serverName'] = $_SERVER['SERVER_NAME'];
    $data['loginmenu'] = renderAuthMenu();
    $data['cart'] = renderComponent('cart');

    return render('layout', $data);
} 

/**
 * Функция рендерить вид. 
 *
 * @param array $data Variables for rendering view.
 *
 * @return view
 * @author kurakste
 */
function directView(array $data =[]) 
{
    $data['serverName'] = $_SERVER['SERVER_NAME'];
    $data['loginmenu'] = renderAuthMenu();
    $data['cart'] = renderComponent('cart');
    /* dd($data); */

    return render('layout', $data);
}    
/**
 * Функция рендерит  компонент и отдает его ввиде строки. 
 *
 * @param string $file  File name with component's code.
 * @param array  $input Variables for rendering view.
 *
 * @return view
 * @author kurakste
 */
function renderComponent($file, $input=[]) 
{
     ob_start();
     include '../components/'.$file.'.php';
     $out = ob_get_clean();

     return $out;
}

/**
 * Функция рендерить вид. 
 * 
 * @param string $file  File name with php template.
 * @param array  $input Variables for rendering view.
 *
 * @return view
 * @author kurakste
 */
function renderPhp($file, array $input =[]) 
{
    include  '../view/' . $file;
}


/**
 * Функция рендерит меню авторизации пользователя для хедера.
 * 
 * @return string
 * @author kurakste
 */
function renderAuthMenu() 
{
    $out = renderComponent('authtopmenu');
    return $out;
}
