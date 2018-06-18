<?php    
if (session_id() == '') {
    session_start();
} ?>
<?php if (isset($_SESSION['name'])) : ?>    
<div class=authMenuWrapper>
    <p>Привет, <?php echo $_SESSION['name']; ?>!</p>
    <p><a href='/signout'>SIGN OUT</a></p>
</div>
<?php else: ?>    
<div class=authMenuWrapper>
    <p><a href='/login'>LOGIN</a></p>
    <p><a href='/register'>REGISTER</a></p>
</div>
<?php endif ?>    
