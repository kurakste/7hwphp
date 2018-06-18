window.onload =function () {
   var xhr = new XMLHttpRequest();
   xhr.open("GET", '/', true);
   // xhr.open('GET', 'http://www.mozilla.org/', true); 
   // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhr.send();
   console.log(xhr.status);
   if (xhr.status != 200) {
  // обработать ошибку
  alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
      alert('Don\'t work');
} else {
  // вывести результат
  alert( xhr.responseText ); // responseText -- текст ответа.
}

}
