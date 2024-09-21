## PHP Developer Test Assignment
### CRM for service center

- git clone https://github.com/ShurikHot/test-uaitlab.git
- composer install
- create .env from .env.example
- docker-compose up -d
- docker-compose exec app php artisan migrate:fresh --seed
- "Імпортувати данні з таблиць"
- "Імпортувати довідники"
- docker-compose exec app php artisan scout:import "App\Models\SpareParts"

or use shurikhot/test-uaitlab:latest from DockerHub:
- install Docker Desktop
- docker run --name temp_container -d shurikhot/test-uaitlab:latest
- docker cp temp_container:/var/www/ d:\test
- cd www
- docker-compose up -d
- docker-compose exec app php artisan migrate:fresh --seed
- "Імпортувати данні з таблиць"
- "Імпортувати довідники"
- docker-compose exec app php artisan scout:import "App\Models\SpareParts"

#### Завдання:

### Підготовка бази та розробка API

#### База даних на основі файлів:
<li>warranty_claims.xslx (гарантійні заявки)</li>
<li>technical_conclusions.xslx (акти технічної експертизи)</li>
<li>warranty_claim_service_works.xslx (проведені роботи по заявкам)</li>
<li>warranty_claim_spareparts.xslx (використані запчастини в заявках)</li>

#### Задачі:
<li>спарсити файли для кожної таблиці, розробивши структуру по заголовкам файлів</li>
<li>основна таблиця warranty_claims</li>
<li>пов’язати інші три таблиці зовнішніми ключами до основної по ключам warranty_claims_code_1c або warranty_claims_number_1c або додати свій ключ ID використавши ключі для співставлення</li>

#### Маючи базу даних розробити REST API:
Всі запити авторизуються по bearer token

1.  GET запит на отримання гарантійних заявок по параметрам, параметри можуть бути пусті, якщо кілька заповнено то логіка ТА(AND). Можливі умови запиту:
    
- дата створення документу (warranty_claims.date), формат YYYY-MM-DD
- datefrom, наприклад, 2024-08-01
- dateto, наприклад, 2024-08-29 (якщо порожній, то до сьогодні)
- статус (warranty_claims.status)
- по коду документа (code_1c), передавати один або кілька кодів

При відповіді 200, виводити JSON інформацію заявки та всі пов’язані об’єкти в ключах:
- warranty_claim_service_works
- warranty_claim_spareparts
- technical_conclusions

2. POST запит на створення заявки (формат тіла JSON такий, як і при GET запиті, т.б. з данними для таблиць warranty_claims, warranty_claim_service_works, warranty_claim_spareparts та technical_conclusions)

### Адмін-панель та фронт-частина

1.  Адмін панель (свій вигляд на розсуд)

    Адмін - єдиний користувач, який може входити до адмінки (login - admin@admin.com, password - 11111111). Він може:
- створювати, редагувати данні та видаляти користувачів
- працювати з довідниками (редагувати/додавати/видаляти)


2. Фронт-частина для користувача CRM надається. Повинні бути реалізовані такі сторінки:
- сторінка авторизація в CRM
- журнал заявок (warranty_claims) з пагінацією, сортуванням та фільтрацією
- журнал актів (technical_conclusions) з пагінацією, сортуванням та фільтрацією
- форма створення/редагування Заявки
- форма створення/редагування Акту

#### Реализація
- в адмін-панелі відбувається імпорт необхідних таблиць та довідників, додавання необхідних користувачів
- у фронт-частині реалізовані необхідні сторінки для перегляду журналів заявок та актів,  створення та редагування окремих записів, пагінація, сортування та фільтрація
- при редагуванні чи створенні гарантійної заявки реалізоване додавання виконаних робіт та використаних запчастинза допомогою повнотекстового пошуку (MeiliSearch) 

<img src="https://i.postimg.cc/BQRcKRRL/01.png" alt="">


### API-документація

- http://BASE_URL/docs/api-specification-yaml
