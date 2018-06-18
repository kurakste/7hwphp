<div class="lot">
    <div class="lotImage">
        <p><img class="small-image" src="<?php echo $input['titleImagePath'] ?>" alt="PHP Polnoe rookovodstvo"/></P>
    </div>
    <div class="lotDescriptions">
        <h4>Лот №<?php echo $input['id'] ?></h4>
        <h4><?php echo $input['Name'] ?></h4>  
        <h5>Цена:<?php echo $input['price'] ?>  руб.</h5>
        <p><?php echo $input['condition'] ?></p>
        <div class="clearfix"></div>
        <a href="/item/<?php echo $input['id'] ?>">ПОДРОБНЕЕ</a>
        <div class="smallBtn catBuyButton">
<a href="/add-to-cart/<?= $input['id']?>">Купить</a></div>
    <?php if (isset($_SESSION['userRole']) && $_SESSION['userRole']=='admin'): ?>
        <form action="/edit_item" method="post">
            <input type="hidden" name="id" id="id" value="<?= $input['id'] ?>" />    
            <button type="submit">edit</button>
        </form>        
        <form action="/remove_item" method="post">
            <input type="hidden" name="id" id="id" value="<?= $input['id'] ?>" />    
            <button type="submit">remove</button>
        </form>        
    <?php endif ?>
    </div>

</div> <!-- lot --!>

