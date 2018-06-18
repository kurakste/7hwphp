<?php
function getItemAsHTML($input) 
{
    $item = getItemFromDb($input);
    $out = renderComponent('item', $item);
    return directView(['content'=>$out]);
}
/**
 * Открывает форму добавления нового айтема. 
 *
 * @return void
 * @author kurakste
 */
function addNewItemForm()
{
    return view('addNewItem');
}
/**
 * Вызывает функцию модели и добавляет айтем. 
 *
 * @return void
 * @author kurakste
 */
function addNewItem()
{
    $data = is_array($_POST) ? $_POST : false; 
    $out = $data ? addNewItemToDb($data) : false; 
    header('Location: /catalog');
    return null;
}

function removeItem()
{
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0; 
    removeItemFromDb($id);
    header('Location: /catalog');
    return null;
}

function changeItem()
{
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0; 
    $item = getItemFromDb($id);
    $data ['content'] = renderComponent('editItem', $item);

    /* dd($data); */
    return directView($data);
}

function saveChangeInItem() 
{
    $data = is_array($_POST) ? $_POST : false; 
    $out = $data ? changeItemInDb($data) : false; 
    header('Location: /catalog');
    return null;
} 
