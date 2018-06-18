<div class="clearfix"></div>

<?php $allItemsID = getItemIDArray(); ?>

 <div id="catalog">
     <?php foreach ($allItemsID as $id): ?>

        <?php renderPhp('itemTemplate.php', getItemFromDB($id)) ?> 

     <?php endforeach ?>

    <?php if (isset($_SESSION['userRole']) && $_SESSION['userRole']=='admin'): ?>
        <form action="/add-new-item-form" method="post">
            <button type="submit">add</button>
        </form>        
    <?php endif ?>
 </div> <!-- catalog -->
