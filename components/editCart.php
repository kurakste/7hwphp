<?php if (session_id() == '') session_start() ?>
<!--
/**
 * выводи корзину в удобном для редактирования виде.
 */ -->
<table>
    <tr>
        <th>Наименование</th>
        <th>Цена</th>
        <th>удалить<th>
    </tr>
    <?php foreach ($_SESSION['cart'] as $item) : ?>
        <tr>
            <td><?php echo $item['Name'] ?></td>
            <td><?php echo $item['price'] ?></td>
            <td><a href="/remove-item-from-cart/<?php echo $item['id'] ?>">Удалить</a></td>
        </tr>
    <?php endforeach ?>
</table>
    <form action="/make_new_order" method="post">
        <button type="submit">Оформить заказ</button>    
    </form>


