<?php 
/**
 * Точка входа в приложение.
 */

require_once('../engine/autoload.php');
dbOpen();
session_start();

$controllerName = getControllerName();
$content = callController($controllerName);

echo $content;

dbClose();


