## Get plots by cadastral numbers:

* **Url:**
`'/api/plots/search'`

* **Method:**
GET
* **Data:**
```
{
    "cadastral_numbers":"69:27:0000022:1306"
}
```
* **Success Response:**
  * **Code:** 200
  * **Content:** 
```
{
    "data": [
        {
            "cadastral_number": "69:27:0000022:1306",
            "address": "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
            "area": "10035.0000",
            "price": "36126.0000"
        }
    ]
}
```

* **Error(Validation) Response:**
  * **Code:** 400
  * **Content:** 
```
{
    "error": [
        "Неправильный формат номера(ов). Пример: 01:02:0100014:6, 01:02:0100014:7"
    ]
}
```