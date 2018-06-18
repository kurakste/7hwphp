<?php 
?>    
<div class="clearfix"></div>
<?php foreach ($input as $item) : ?>
<div id="orderList">
    <p>
        Покупатель: <?= $item['Name'] ?>
        айди заказа: <?= $item['id'] ?>
        Статус заказа: <?= $item['active'] ?>
    </p>
    <table>
        <tr>
            <th>Название</th>
            <th>кол-во</th>
            <th>цена</th>
        </tr>
            <?php foreach ($item['items'] as $rows) : ?>
            <tr>
                <td><?= $rows['Name'] ?> </td> 
                <td><?= $rows['price'] ?> </td> 
                <td><?= $rows['amount'] ?> </td> 
            </tr> 
            <?php endforeach ?>
        
    </table>

</div>
<?php endforeach ?>
