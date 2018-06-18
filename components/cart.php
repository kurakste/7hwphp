<?php if (session_id() == '') session_start() ?>
<!--
/**
 * Здесь будем выводить информацию о состоянии корзины если она есть
 * в переменной $_SESSION['cart']. Переменная обрабатывается в 
 * контроллере cartsController.php
 */ -->

<?php if (isset($_SESSION['cart'])) : ?>


<?php
$sum = 0;
$icount = count($_SESSION['cart']);
foreach ($_SESSION['cart'] as $item) {
    $sum += $item['price'];
}; 

?>

    <h5>Товаров: <?php echo $icount ?></h5>
    <h5>Сумма: <?php echo $sum ?></h5>
    <a href="/edit-cart">Редактировать</a>
<?php else : ?>
    <h5>Корзина пуста.</h5>

<?php endif ?>    
