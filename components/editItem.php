 <div class="clearfix"></div>
 <form id="contact-form" enctype="multipart/form-data" action="save_changes_in_item" method="post">
       <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />      
       <input type="hidden" name="itemId" value="<?= $input['id'] ?>" />      
    <fieldset>
       <legend>Форма добавления новой позиции.</legend>
       <p class="label">Название позиции</p> 
       <p class="input">
       <input 
       placeholder="Введите название позиции."
       type="text" 
       name="fname" 
       id="fname" 
       value="<?= $input['Name'] ?>" />
       </p>
       <p class="label"><label for="fcodition">Расскажите о состоянии.</label></p>
       <p class="input"><textarea  
          name="fcondition" 
          id="fcondition" 
          rows="5"
          cols="103"><?= $input['condition'] ?></textarea></p>
       <p class="label"><label for="fdescription">Расскажите о вашем лоте.</label></p>
       <p class="input"><textarea  
          name="fdescription" 
          id="fdescription" 
          rows="5"
          cols="103"><?= $input['description'] ?></textarea></p> 
       <p class="label">Цена</p> 
       <p class="input">
       <input 
       placeholder="Введите цену."
       type="text" 
       name="fprice" 
       id="fprice" 
       value="<?= $input['price'] ?>" />
       </p>
       <p><input multiple type="file" name="myfile[]" id="" value="" />
       <p><input type="submit" value="Отправить"></p>

    </fieldset>
</form>

