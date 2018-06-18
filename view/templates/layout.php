<!DOCTYPE html>
<html lang="ru">
   <head>
      <meta charset="UTF-8">
      <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="/css/main.css" />
      <title>GreenBook.ru</title>
   </head>
   <body>
      <div class="wrapper">
         <div class="header">
            <ul class="menu">
               <li class="menuItem"><a href="/home">Главная</a></li>
               <li class="menuItem"><a href="/catalog">Каталог</a></li>
               <li class="menuItem"><a href="/contact">Контакты</a></li>
            </ul>

            <div class="HeaderCapture">
               <h2>МАГАЗИН ЗЕЛЕНОЙ КНИГИ.</h2>
               <h4>Рады приветствовать вас в нашем магазине!</h4>
               <h4>Мы предлагаем вам сделать нашу планету чуть лучше, а вас чуть-чуть богаче.</h4>
            </div>
         <div id="topSubMenu">
             {{loginmenu}}
             {{cart}}
         </div>
         </div> <!-- header -->
         
        <div class="clearfix"></div>

        {{content}}

         <div class="clearfix"></div>
         <div class="footer">
             <p class="copyRightRecord"> &copy; 2018 все права защищены, ООО "КОПЫТА и РОГА" </p>
          </div>
      </div> <!-- wrapper -->
   </body>
</html>
