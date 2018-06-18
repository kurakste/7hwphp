<?php
/**
 * Activate db connection;
 *
 * @return void
 * @author kurakste
 */
function dbOpen()
{
    global $params;
    $mysql = mysqli_connect(
        $params['host'], 
        $params['user'],
        $params['password'],
        $params['dbname']
    );
    if (!$mysql) {
        die('Ошибка соединения: ' . mysql_error());
    }
    mysqli_query($mysql, "SET NAMES 'utf8'");
    mysqli_query($mysql, "SET CHARACTER SET 'utf8'");
    mysqli_query($mysql, "SET SESSION collation_connection = 'utf8_unicode_ci'");

    $GLOBALS['db'] = $mysql;
}
/**
 * Function closes DB conection;
 *
 * @return void
 * @author kurakste
 */
function dbClose() 
{
    global $db;
    mysqli_close($db);

}

function clearPOSTArrayForMysql()
{
    global $db;
    $out = [];
    if (isset($_POST)) {
        foreach ($_POST as $key=>$value) {
            $out[$key] = mysqli_real_escape_string($db, $value);
        }
    }
    return $out;
}
