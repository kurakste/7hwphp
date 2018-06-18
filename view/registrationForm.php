<style>
    .formcontainer {
        width: 100%;
        height: 100%;
        text-align: center;
    }
    #fregister {
        margin: 5%  auto;
        width: 500px;
        height: 200px;
        background-color: #FAFAFA;
    }
    #fregister input {
       width: 300px; 
       height: 20px;
    
    }
</style>

<div class = "formcontainer">
    <form id="fregister" class='fcenter' action="/add-new-user" method="post">
        <fieldset>
            <legend>Форма регистрации нового пользователя.</legend>
            <p class="label">Введите ваше имя:</p> 
            <input type="text" name="fname" id="fname" value="" />
            <p class="label">Введите пароль:</p> 
            <input type="password" name="fpassword" id="fpassword" value="" />
            <p><input type="submit" name="" id="" value="GO" /></p>
        </fieldset>
    </form>
<div>
