 jqWar(document).ready(function () {
     //Делаем возвращение на предыдущую страницу - ХАК!
     setTimeout(function() { 
         if(jqWar( "a:contains('Вернуться назад')" ).length > 0) {
             console.log('Бросаем на предыдущую страницу');
             jqWar( "a:contains('Вернуться назад')" )[0].click()
         }
         if(jqWar("a:contains('Вернуться к редактированию таблицы')").length > 0) {
             console.log('Бросаем на предыдущую страницу');
             jqWar( "a:contains('Вернуться к редактированию таблицы')" )[0].click()
         }
         if(jqWar("a:contains('перейти к его просмотру')").length > 0) {
            console.log('Бросаем на предыдущую страницу');
            jqWar( "a:contains('перейти к его просмотру')" )[0].click()
        }         
    },50);
 });