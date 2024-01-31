1.http://znak/read.php - Выводит весь список
2.http://znak/read.php?search=Футболка - Поиск товара
3.http://znak/Goods/create.php -Создает товар (Создовал через Postman)
({  
     "name" : "Кошель",
     "inn" : "12317893",
     "barcode" : "12332131",
    "description" : "Хороший товар, но есть косяки",
    "price": "200",
    "category_id" : 3
}) 
4.http://znak/Goods/update.php/6 -Обновление товара (Обновлял через Postman)
({  
     "name" : "Кошель",
     "inn" : "12317893",
     "barcode" : "12332131",
    "description" : "Хороший товар",
    "price": "200",
    "category_id" : 3
})
5.http://znak/Goods/delete.php/6 - Удаление товара 
6. http://znak/Categories/categori.php - Просмотр категорий 
