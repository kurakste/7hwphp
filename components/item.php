 <div class="clearfix"></div>
 <div class="itemContainer">
     <div class="leftPanel">

        <?php $images = getImagesFromDB($input['id']) ?>
        <h2>ЛОТ №<?php echo $input['id'] ?></h2>
        <a href="<?php echo $input['titleImagePath'] ?>" target="_blank">
           <img 
           class="bigImages"
           src="<?php echo $input['titleImagePath'] ?>" 
           alt="<?php echo $input['titleImagePath'] ?>" />
        </a>
        <div>
        <?php if (is_array($images)) : ?>
            <?php foreach($images as $image): ?>
               <a href="<?php echo $image['pathtoimage'] ?>" target="_blank">
                  <img 
                  class="prew"
                  src="<?php echo $image['pathtoimage'] ?>" 
                  alt="" /></a>
            <?php endforeach ?>
        <?php else: ?>
            <h2>Not found </h2>
        <?php endif ?>
        </div>
     </div> <!-- left panel -->
     <div class="rightPanel">
        <h4 class="style41"><?php echo $input['Name'] ?></h4>  
        <h5>Цена: <?php echo $input['price'] ?> руб.</h5>
        <p class="style41">Характеристики:</p> 
        <p class="style42"><?php echo $input['condition'] ?></p>
        <p class="style41">Описание:</p> 
        <p class="style43"><?php echo $input['description'] ?></p>
     </div> <!-- rightPanel -->
  </div> <!-- itemContainer -->


 <div class="clearfix"></div>
 <div  class="smallBtn"><a href="#">КУПИТЬ</a></div>

