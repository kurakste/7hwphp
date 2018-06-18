<?php 
/**
 *  Загрузит все php файлы по пути из переменной  $path. 
 *
 * @param string $path - Path to autoload.
 *
 * @return void
 * @author kurakste
 */
function loadLibraries($path) {
	foreach (glob($path.'/*.php') as $libFile) {
		require_once $libFile;
	}
}

loadLibraries('../config');
loadLibraries('../models');
loadLibraries('../engine');
loadLibraries('../app');
loadLibraries('../controllers');

